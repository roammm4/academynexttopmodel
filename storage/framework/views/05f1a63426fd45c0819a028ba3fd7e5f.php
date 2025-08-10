<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo e(__('messages.editprofile_title')); ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
    }
    .font-fondamento {
      font-family: 'Fondamento', cursive;
    }
  </style>
</head>
<body class="min-h-screen bg-black text-white">

  <?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen">
    <!-- Left: Form -->
    <div class="flex items-center justify-center px-8 py-12">
      <div class="w-full max-w-md">
        <h2 class="text-3xl font-fondamento mb-6 text-white text-center"><?php echo e(__('messages.editprofile_heading')); ?></h2>

        <?php if(session('success')): ?>
          <div class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center text-sm font-semibold">
            <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>

        <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="space-y-5">
          <?php echo csrf_field(); ?>

          <div>
            <label class="block text-sm mb-1"><?php echo e(__('messages.editprofile_name')); ?></label>
            <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                   class="w-full rounded-md px-3 py-2 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-800" required>
          </div>

          <div>
            <label class="block text-sm mb-1"><?php echo e(__('messages.editprofile_email')); ?></label>
            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                   class="w-full rounded-md px-3 py-2 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-800" required>
          </div>

          <div>
            <label class="block text-sm mb-1"><?php echo e(__('messages.editprofile_phone')); ?></label>
            <input type="text" name="number_phone" value="<?php echo e(old('number_phone', $user->number_phone)); ?>"
                   class="w-full rounded-md px-3 py-2 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-800">
          </div>

          <div>
            <label class="block text-sm mb-1"><?php echo e(__('messages.editprofile_password')); ?> <span class="text-xs text-gray-400">(<?php echo e(__('messages.editprofile_optional')); ?>)</span></label>
            <input type="password" name="password"
                   class="w-full rounded-md px-3 py-2 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-800">
          </div>

          <div>
            <label class="block text-sm mb-1"><?php echo e(__('messages.editprofile_confirm_password')); ?></label>
            <input type="password" name="password_confirmation"
                   class="w-full rounded-md px-3 py-2 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-800">
          </div>

          <div class="flex items-center justify-between pt-4">
            <button type="submit" class="bg-white text-black px-5 py-2 rounded-md font-semibold hover:bg-gray-200 transition">
              <?php echo e(__('messages.editprofile_update_button')); ?>

            </button>
            <button type="button" onclick="confirmDeleteAccount()" class="text-red-500 text-sm font-semibold hover:underline">
              <?php echo e(__('messages.editprofile_delete_button')); ?>

            </button>
          </div>
        </form>

        <form id="delete-account-form" action="<?php echo e(route('profile.delete')); ?>" method="POST" class="hidden">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
        </form>
      </div>
    </div>

    <!-- Right: Image -->
    <div class="hidden md:flex items-center justify-center">
      <img src="<?php echo e(asset('img/becomeamodel.png')); ?>" 
        alt="Model" 
        class="w-full h-5/6 object-contain mx-auto rounded-md shadow-lg">
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDeleteAccount() {
      Swal.fire({
        title: '<?php echo e(__('messages.editprofile_delete_title')); ?>',
        text: '<?php echo e(__('messages.editprofile_delete_warning')); ?>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<?php echo e(__('messages.editprofile_delete_confirm')); ?>',
        background: '#1f1f1f',
        color: '#fff'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-account-form').submit();
        }
      });
    }
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\academyntm2-main\resources\views/editprofile.blade.php ENDPATH**/ ?>