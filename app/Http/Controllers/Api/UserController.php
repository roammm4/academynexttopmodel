<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Talent;
use App\Models\FeaturedTalent;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function edit()
    {
        $user = auth()->user();
        return view('editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id_user . ',id_user',
            'number_phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number_phone = $request->number_phone;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('profile.edit')->with('success', 'Profile updated!');
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return redirect('/')->with('success', 'Account deleted!');
    }

    public function adminHome()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'admin') {
            return redirect('/');
        }
        // Hapus user yang sudah tidak aktif (lebih dari 30 menit)
        \DB::table('visitor')
            ->where('last_activity', '<', now()->subMinutes(30))
            ->update(['is_online' => 0]);
        // Hitung user non-admin yang sedang online
        $visitorCount = \DB::table('visitor')
            ->join('users', 'visitor.user_id', '=', 'users.id_user')
            ->where('visitor.is_online', 1)
            ->where('users.role', '!=', 'admin')
            ->count();
        // Hitung jumlah model dari tabel models
        $modelCount = \DB::table('models')->count();
        // Ambil semua user untuk tabel profile, join dengan visitor untuk status online dan last_activity
        $users = \DB::table('users')
            ->leftJoin('visitor', function($join) {
                $join->on('users.id_user', '=', 'visitor.user_id')
                    ->where('visitor.is_online', 1);
            })
            ->select('users.*', 'visitor.last_activity as visitor_last_activity', 'visitor.is_online')
            ->get();
        $models = Talent::all();
        $featured = FeaturedTalent::orderBy('order')->get();
        return view('adminhome', compact('user', 'visitorCount', 'modelCount', 'users', 'models', 'featured'));
    }

    // Tambahkan method untuk redirect setelah login
    public function redirectAfterLogin()
    {
        $user = auth()->user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect('/');
    }

    // Portofolio: admin ke portofolio.blade.php, user ke portofolioasli.blade.php
    public function portofolio()
    {
        $user = auth()->user();
        $models = \App\Models\Talent::all();
        if ($user && $user->role === 'admin') {
            $selected = $models->first();
            $portfolio = $selected ? \App\Models\Portfolio::where('id_model', $selected->id_model)->get() : collect();
            $portfolioSlots = [];
            foreach (range(1,10) as $slot) {
                $portfolioSlots[$slot] = $portfolio->firstWhere('description', 'slot_' . $slot);
            }
            $career = $selected ? \App\Models\Career::where('id_model', $selected->id_model)->get() : collect();
            $careerSlots = [];
            foreach (range(1,6) as $slot) {
                $careerSlots[$slot] = $career->get($slot-1);
            }
            $award = $selected ? \App\Models\Award::where('id_model', $selected->id_model)->get() : collect();
            $awardSlots = [];
            foreach (range(1,6) as $slot) {
                $awardSlots[$slot] = $award->get($slot-1);
            }
            return view('portofolio', compact('models', 'portfolioSlots', 'selected', 'careerSlots', 'awardSlots'));
        } else {
            $selected = $models->first();
            $portfolio = $selected ? \App\Models\Portfolio::where('id_model', $selected->id_model)->get() : collect();
            $portfolioSlots = [];
            foreach (range(1,10) as $slot) {
                $portfolioSlots[$slot] = $portfolio->firstWhere('description', 'slot_' . $slot);
            }
            return view('portofolioasli', compact('models', 'portfolioSlots', 'selected'));
        }
    }
}
