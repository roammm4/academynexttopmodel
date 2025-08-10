<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Verifikasi OTP - Academy Next Top Model</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    .otp-input {
      width: 3rem;
      height: 3rem;
      text-align: center;
      font-size: 1.5rem;
      border-radius: 0.75rem;
      border: 1px solid #d1d5db;
      background-color: #1f2937;
      color: #fff;
      outline: none;
      transition: border-color 0.2s, background-color 0.2s;
    }
    .otp-input:focus {
      border-color: #38bdf8;
      background-color: #111827;
    }
    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .otp-input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-black via-gray-900 to-gray-800 min-h-screen flex items-center justify-center">
  <div class="bg-gray-950 rounded-2xl shadow-xl p-10 max-w-md w-full text-white border border-gray-800">
    <h1 class="text-3xl font-bold mb-3 text-center"><?php echo e(__('messages.otp_verif')); ?></h1>
    <p class="mb-6 text-sm text-gray-400 text-center"><?php echo e(__('messages.otp_desc')); ?></p>
    
    <?php if(session('success')): ?>
      <div class="bg-green-600 text-white p-3 rounded-lg mb-4 text-sm text-center">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <form action="<?php echo e(route('auth.verifyOtp')); ?>" method="POST" autocomplete="off">
      <?php echo csrf_field(); ?>
      <div class="flex justify-center gap-2 mb-6">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required autofocus oninput="moveToNext(this, event)">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required oninput="moveToNext(this, event)">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required oninput="moveToNext(this, event)">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required oninput="moveToNext(this, event)">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required oninput="moveToNext(this, event)">
        <input type="text" name="otp[]" maxlength="1" class="otp-input" required oninput="moveToNext(this, event)">
      </div>
      <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-red-400 text-xs mb-2 block text-center"><?php echo e($message); ?></span>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      <button type="submit" class="w-full bg-white text-black py-2 rounded-lg font-semibold text-sm hover:bg-gray-200 transition"><?php echo e(__('messages.otp_btton')); ?></button>
    </form>

    <form action="<?php echo e(route('auth.resendOtp')); ?>" method="POST" class="mt-5 text-center">
      <?php echo csrf_field(); ?>
      <button type="submit" class="text-xs text-gray-400 underline hover:text-white transition"><?php echo e(__('messages.otp_rsend')); ?></button>
    </form>
  </div>

  <script>
    function moveToNext(input, event) {
      if (input.value.length === 1 && input.nextElementSibling) {
        input.nextElementSibling.focus();
      } else if (event.inputType === 'deleteContentBackward' && input.previousElementSibling) {
        input.previousElementSibling.focus();
      }
    }
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\academyntm2-main\resources\views/verify_otp.blade.php ENDPATH**/ ?>