<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'number_phone' => 'required|string|max:20',
            'role' => 'required|in:client,model',
            'terms' => 'required|accepted',
        ], [
            'terms.required' => 'You must agree to the terms and conditions',
            'terms.accepted' => 'You must agree to the terms and conditions',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'number_phone' => $request->number_phone,
            'is_verified' => false,
        ]);

        // Generate OTP
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Simpan OTP ke database
        Otp::create([
            'user_id' => $user->id_user,
            'otp_code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim OTP ke WhatsApp
        $whatsappService = app(WhatsAppService::class);
        $whatsappService->sendOTP($user->number_phone, $otpCode);

        // Simpan user_id di session untuk verifikasi
        Session::put('pending_user_id', $user->id_user);

        // Hapus data Google dari session jika ada
        Session::forget('google_email');
        Session::forget('google_name');

        return redirect()->route('auth.showOtpForm')->with('success', __('messages.otp_sent'));

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $remember = $request->has('remember');

        if (auth()->attempt($request->only('email', 'password'), $remember)) {
            $user = auth()->user();

            // Cek apakah user sudah terverifikasi
            if (!$user->is_verified) {
                auth()->logout();
                return redirect()->back()
                    ->withErrors(['email' => 'Akun Anda belum terverifikasi. Silakan cek WhatsApp untuk kode OTP.'])
                    ->withInput();
            }

            // Hapus data Google dari session jika ada
            Session::forget('google_email');
            Session::forget('google_name');

            if ($user && $user->role === 'admin') {
                return redirect()->route('admin.home')->with('success', 'Login successful');
            }
            return redirect('/')->with('success', 'Login successful');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
        }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully');
    }

    public function showOtpForm()
    {
        if (!Session::has('pending_user_id')) {
            return redirect('/register')->with('error', 'Silakan daftar terlebih dahulu');
        }
        return view('verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|string|size:1',
        ]);

        $otpInput = implode('', $request->otp);
        $userId = Session::get('pending_user_id');

        if (!$userId) {
            return redirect('/register')->with('error', 'Sesi registrasi tidak ditemukan');
        }

        // Cari OTP yang valid
        $otp = Otp::where('user_id', $userId)
                  ->where('otp_code', $otpInput)
                  ->where('is_used', false)
                  ->where('expires_at', '>', Carbon::now())
                  ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa']);
        }

        // Mark OTP as used
        $otp->update(['is_used' => true]);

        // Update user as verified
        $user = User::find($userId);
        $user->is_verified = true;
        $user->save();

        // Login user
        auth()->login($user);

        // Clear session
        Session::forget('pending_user_id');

        return redirect('/')->with('success', 'Akun berhasil diverifikasi dan Anda telah login!');
    }

    public function resendOtp()
    {
        $userId = Session::get('pending_user_id');
        
        if (!$userId) {
            return redirect('/register')->with('error', 'Sesi registrasi tidak ditemukan');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect('/register')->with('error', 'User tidak ditemukan');
        }

        // Generate OTP baru
        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Hapus OTP lama
        Otp::where('user_id', $userId)->delete();
        
        // Simpan OTP baru
        Otp::create([
            'user_id' => $userId,
            'otp_code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim OTP baru ke WhatsApp
        $whatsappService = app(WhatsAppService::class);
        $whatsappService->sendOTP($user->number_phone, $otpCode);

        return back()->with('success', 'Kode OTP baru telah dikirim ke WhatsApp Anda');
}
}
