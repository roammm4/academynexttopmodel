<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Academy Next Top Model</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Font + Tailwind -->
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Newsreader:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <!-- PhotoSwipe CSS -->
<link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">

  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <!-- Custom Font Style -->
  <style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    .font-fondamento { font-family: 'Fondamento', cursive; }
  </style>

<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Hapus model ini?',
      text: "Data akan dihapus secara permanen.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#666',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form-' + id).submit();
      }
    });
  }
</script>

</head>
<!-- PhotoSwipe JS -->
<script src="https://unpkg.com/photoswipe@5/dist/photoswipe.umd.js"></script>
<body>
    <?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  
  <?php $selected = isset($model) ? $model : $models->first(); ?>
  <?php if($selected): ?>
    <section class="bg-black text-white px-[50px] py-[60px] font-['Open_Sans']">
      <!-- Model Profile -->
      <div class="flex items-center gap-[30px] mb-[30px]">
        <img src="<?php echo e($selected->photo ? asset('storage/' . $selected->photo) : asset('img/profile.jpg')); ?>" alt="Model Profile" class="w-[240px] h-[240px] rounded-full object-cover" />
        <div>
        <button class="bg-white text-black text-[12px] font-bold rounded-full px-[10px] py-[3px] mb-[5px]">
    <?php echo e($selected->experience_value); ?> <?php echo e(__('messages.portofolio_' . ($selected->experience_unit ?? 'year'))); ?> <?php echo e(__('messages.portofolio_exp')); ?>

</button>
          <h2 class="text-[26px] font-semibold mb-[4px]"><?php echo e($selected->nama_model); ?></h2>
          <p class="text-[16px] text-gray-300 mb-[6px]"><?php echo e($selected->city); ?></p>
          <p class="text-[16px] text-gray-400 mb-[10px]">
    <?php echo e($selected->status == 'available' ? __('messages.portofolio_available') : __('messages.portofolio_not_available')); ?>

</p>
          <a href="#" class="inline-block mt-[6px] bg-white text-black text-[12px] font-semibold px-[12px] py-[6px] rounded-full"><?php echo e(__('messages.portofolio_hire')); ?> ↗</a>
          <div class="flex items-center gap-3 mt-2">
            

<form id="delete-form-<?php echo e($selected->id_model); ?>" action="<?php echo e(route('models.destroy', $selected->id_model)); ?>" method="POST" class="hidden">
  <?php echo csrf_field(); ?>
  <?php echo method_field('DELETE'); ?>
</form>

          </div>
        </div>
      </div>
      <!-- Model Stats -->
      <div class="flex justify-around my-[30px] text-[24px] text-center">
      <div><?php echo e($selected->height); ?> cm<br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_height')); ?></span></div>
        <div><?php echo e($selected->weight); ?> kg<br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_weight')); ?></span></div>
        <div><?php echo e($selected->age); ?> th<br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_age')); ?></span></div>
        <div><?php echo e($selected->shoes_size); ?><br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_shoes')); ?></span></div>
        <div><?php echo e($selected->size); ?><br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_size')); ?></span></div>
        <div><?php echo e($selected->bust); ?> cm<br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_bust')); ?></span></div>
        <div><?php echo e($selected->waist); ?> cm<br><span class="text-[12px] text-gray-400"><?php echo e(__('messages.portofolio_waist')); ?></span></div>
      </div>
      <!-- Portfolio Tabs -->
      <div id="portfolio-tabs" class="flex justify-center gap-[20px] text-[16px] font-bold pb-[15px] border-b border-white mb-[30px]">
      <span id="tab-portfolio" class="text-white border-b-2 border-white cursor-pointer" onclick="showTab('portfolio')"><?php echo e(__('messages.portofolio_tab_portfolio')); ?></span>
  <span id="tab-career" class="text-gray-400 cursor-pointer" onclick="showTab('career')"><?php echo e(__('messages.portofolio_tab_career')); ?></span>
  <span id="tab-awards" class="text-gray-400 cursor-pointer" onclick="showTab('awards')"><?php echo e(__('messages.portofolio_tab_awards')); ?></span>
</div>
<div id="tab-content-portfolio">
  <!-- Gallery -->
  <div class="max-w-6xl mx-auto px-4 mb-[40px]">

    <!-- Baris 1: 1 kiri, 4 kanan (2x2 grid) -->
<div class="flex gap-4 mb-4">
  <!-- Card kiri persegi (slot 1) -->
  <div class="aspect-square flex-1 bg-gray-700 flex items-center justify-center relative overflow-hidden">
    <?php if(isset($portfolioSlots[1]) && $portfolioSlots[1]): ?>
      <?php
        $size = $portfolioSizes[1] ?? ['width' => 1200, 'height' => 900];
      ?>
      <a href="<?php echo e(asset('storage/' . $portfolioSlots[1]->photo)); ?>"
         data-pswp-width="<?php echo e($size['width']); ?>"
         data-pswp-height="<?php echo e($size['height']); ?>"
         data-pswp-index="0"
         target="_blank"
         class="block w-full h-full">
        <img src="<?php echo e(asset('storage/' . $portfolioSlots[1]->photo)); ?>" class="object-cover w-full h-full" />
      </a>
    <?php endif; ?>
  </div>

  <!-- 4 card kanan dalam grid 2x2 (slot 2-5) -->
  <div class="grid grid-cols-2 grid-rows-2 gap-4 flex-1">
    <?php for($i = 2; $i <= 5; $i++): ?>
      <div class="aspect-square bg-gray-700 flex items-center justify-center relative overflow-hidden">
        <?php if(isset($portfolioSlots[$i]) && $portfolioSlots[$i]): ?>
          <?php
            $size = $portfolioSizes[$i] ?? ['width' => 1200, 'height' => 900];
          ?>
          <a href="<?php echo e(asset('storage/' . $portfolioSlots[$i]->photo)); ?>"
             data-pswp-width="<?php echo e($size['width']); ?>"
             data-pswp-height="<?php echo e($size['height']); ?>"
             data-pswp-index="<?php echo e($i - 1); ?>"
             target="_blank"
             class="block w-full h-full">
            <img src="<?php echo e(asset('storage/' . $portfolioSlots[$i]->photo)); ?>" class="object-cover w-full h-full" />
          </a>
        <?php endif; ?>
      </div>
    <?php endfor; ?>
  </div>
</div>

<!-- Baris 2: 4 kiri (2x2 grid, slot 6-9), 1 kanan persegi (slot 10) -->
<div class="flex gap-4">
  <div class="grid grid-cols-2 grid-rows-2 gap-4 flex-1">
    <?php for($i = 6; $i <= 9; $i++): ?>
      <div class="aspect-square bg-gray-700 flex items-center justify-center relative overflow-hidden">
        <?php if(isset($portfolioSlots[$i]) && $portfolioSlots[$i]): ?>
          <?php
            $size = $portfolioSizes[$i] ?? ['width' => 1200, 'height' => 900];
          ?>
          <a href="<?php echo e(asset('storage/' . $portfolioSlots[$i]->photo)); ?>"
             data-pswp-width="<?php echo e($size['width']); ?>"
             data-pswp-height="<?php echo e($size['height']); ?>"
             data-pswp-index="<?php echo e($i - 1); ?>"
             target="_blank"
             class="block w-full h-full">
            <img src="<?php echo e(asset('storage/' . $portfolioSlots[$i]->photo)); ?>" class="object-cover w-full h-full" />
          </a>
        <?php endif; ?>
      </div>
    <?php endfor; ?>
  </div>

  <div class="aspect-square flex-1 bg-gray-700 flex items-center justify-center relative overflow-hidden">
    <?php if(isset($portfolioSlots[10]) && $portfolioSlots[10]): ?>
      <?php
        $size = $portfolioSizes[10] ?? ['width' => 1200, 'height' => 900];
      ?>
      <a href="<?php echo e(asset('storage/' . $portfolioSlots[10]->photo)); ?>"
         data-pswp-width="<?php echo e($size['width']); ?>"
         data-pswp-height="<?php echo e($size['height']); ?>"
         data-pswp-index="9"
         target="_blank"
         class="block w-full h-full">
        <img src="<?php echo e(asset('storage/' . $portfolioSlots[10]->photo)); ?>" class="object-cover w-full h-full" />
      </a>
    <?php endif; ?>
  </div>
</div>

  </div>

  <script>
    function confirmDeletePortfolio(slot) {
      Swal.fire({
        title: 'Hapus foto portofolio?',
        text: 'Foto akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#666',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-' + slot).submit();
        }
      });
    }

    // PhotoSwipe init
    document.addEventListener("DOMContentLoaded", function () {
      const galleryElements = document.querySelectorAll('[data-pswp-index]');
      const items = [];

      galleryElements.forEach((el, index) => {
        items.push({
          src: el.getAttribute('href'),
          width: parseInt(el.getAttribute('data-pswp-width')),
          height: parseInt(el.getAttribute('data-pswp-height'))
        });

        el.addEventListener('click', function (e) {
          e.preventDefault();
          const pswp = new PhotoSwipe({
            dataSource: items,
            index: index,
          });
          pswp.init();
        });
      });
    });
  </script>
</div>

      <div id="tab-content-career" style="display:none;">
        <div class="max-w-6xl mx-auto px-4 mb-[40px]">
          <div class="grid grid-cols-3 grid-rows-2 gap-4">
            <?php for($i=1; $i<=6; $i++): ?>
            <div class="w-full h-[450px] bg-gray-700 flex items-center justify-center relative overflow-hidden">
              <?php if(isset($careerSlots[$i]) && $careerSlots[$i]): ?>
                <img src="<?php echo e(asset('storage/' . $careerSlots[$i]->photo)); ?>" class="object-cover w-full h-full" />
                <div class="absolute bottom-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                  <?php echo e($careerSlots[$i]->event_name); ?><br><?php echo e($careerSlots[$i]->year); ?>

                </div>
                <!-- Edit Modal Form (hidden) -->
                <form action="<?php echo e(route('career.update', [$selected->id_model ?? $model->id_model, $i])); ?>" method="POST" enctype="multipart/form-data" id="edit-career-form-<?php echo e($i); ?>" style="display:none;">
                  <?php echo csrf_field(); ?>
                  <input type="file" name="photo" accept="image/*" class="hidden" id="edit-career-upload-<?php echo e($i); ?>">
                  <input type="hidden" name="event_name">
                  <input type="hidden" name="year">
                </form>
              <?php endif; ?>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
      <div id="tab-content-awards" style="display:none;">
        <div class="max-w-6xl mx-auto px-4 mb-[40px]">
          <div class="grid grid-cols-2 grid-rows-3 gap-4">
            <?php for($i=1; $i<=6; $i++): ?>
            <div class="w-full h-[350px] bg-gray-700 flex items-center justify-center relative overflow-hidden">
              <?php if(isset($awardSlots[$i]) && $awardSlots[$i]): ?>
                <img src="<?php echo e(asset('storage/' . $awardSlots[$i]->photo)); ?>" class="object-cover w-full h-full" />
                <div class="absolute top-2 right-2 flex gap-2 z-10">
                  <form action="<?php echo e(route('award.update', [$selected->id_model ?? $model->id_model, $i])); ?>" method="POST" enctype="multipart/form-data" id="edit-award-form-<?php echo e($i); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-award-upload-<?php echo e($i); ?>">
                    <label for="edit-award-upload-<?php echo e($i); ?>" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">Edit</label>
                  </form>
                  <form action="<?php echo e(route('award.delete', [$selected->id_model ?? $model->id_model, $i])); ?>" method="POST" id="delete-award-form-<?php echo e($i); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" onclick="confirmDeleteAward(<?php echo e($i); ?>)" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">Delete</button>
                  </form>
                </div>
              <?php endif; ?>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
      <script>
        function showTab(tab) {
          document.getElementById('tab-content-portfolio').style.display = tab === 'portfolio' ? '' : 'none';
          document.getElementById('tab-content-career').style.display = tab === 'career' ? '' : 'none';
          document.getElementById('tab-content-awards').style.display = tab === 'awards' ? '' : 'none';
          document.getElementById('tab-portfolio').classList.toggle('text-white', tab === 'portfolio');
          document.getElementById('tab-portfolio').classList.toggle('text-gray-400', tab !== 'portfolio');
          document.getElementById('tab-portfolio').classList.toggle('border-b-2', tab === 'portfolio');
          document.getElementById('tab-career').classList.toggle('text-white', tab === 'career');
          document.getElementById('tab-career').classList.toggle('text-gray-400', tab !== 'career');
          document.getElementById('tab-career').classList.toggle('border-b-2', tab === 'career');
          document.getElementById('tab-awards').classList.toggle('text-white', tab === 'awards');
          document.getElementById('tab-awards').classList.toggle('text-gray-400', tab !== 'awards');
          document.getElementById('tab-awards').classList.toggle('border-b-2', tab === 'awards');
        }
        function confirmDeleteCareer(slot) {
          Swal.fire({
            title: 'Hapus foto career?',
            text: 'Foto akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#666',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('delete-career-form-' + slot).submit();
            }
          });
        }
        function confirmDeleteAward(slot) {
          Swal.fire({
            title: 'Hapus foto award?',
            text: 'Foto akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#666',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('delete-award-form-' + slot).submit();
            }
          });
        }
        // Modal Career
        function openCareerEditModal(slot, eventName = '', year = '') {
          Swal.fire({
            title: 'Edit Data Event',
            html: `<input id="career-event-name-edit" class="swal2-input" placeholder="Nama Event" value="${eventName}">
                   <input id="career-year-edit" class="swal2-input" placeholder="Tahun" value="${year}">
                   <input id="career-photo-edit" type="file" accept="image/*" class="swal2-file">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            background: '#212121',
            color: '#fff',
            preConfirm: () => {
              return {
                event_name: document.getElementById('career-event-name-edit').value,
                year: document.getElementById('career-year-edit').value,
                photo: document.getElementById('career-photo-edit').files[0]
              };
            }
          }).then((result) => {
            if (result.isConfirmed) {
              let form = document.getElementById('edit-career-form-' + slot);
              if (form) {
                form.querySelector('input[name="event_name"]').value = result.value.event_name;
                form.querySelector('input[name="year"]').value = result.value.year;
                if (result.value.photo) {
                  // Buat DataTransfer untuk set file input
                  const dt = new DataTransfer();
                  dt.items.add(result.value.photo);
                  form.querySelector('input[type="file"]').files = dt.files;
                }
                form.submit();
              }
            }
          });
        }
        function handleCareerFileChange(e, slot) {
          if (e.target.files.length > 0) {
            Swal.fire({
              title: 'Isi Data Event',
              html: `<input id="career-event-name" class="swal2-input" placeholder="Nama Event">
                     <input id="career-year" class="swal2-input" placeholder="Tahun">`,
              focusConfirm: false,
              showCancelButton: true,
              confirmButtonText: 'Simpan',
              background: '#212121',
              color: '#fff',
              preConfirm: () => {
                return [
                  document.getElementById('career-event-name').value,
                  document.getElementById('career-year').value
                ];
              }
            }).then((result) => {
              if (result.isConfirmed) {
                let form = document.getElementById('career-upload-form-' + slot);
                if (form) {
                  form.querySelector('input[name="event_name"]').value = result.value[0];
                  form.querySelector('input[name="year"]').value = result.value[1];
                  form.submit();
                }
              } else {
                // Reset file input jika batal
                e.target.value = '';
              }
            });
          }
        }
      </script>
      <script type="module">
  import PhotoSwipeLightbox from 'https://unpkg.com/photoswipe@5/dist/photoswipe-lightbox.esm.js';

  const lightbox = new PhotoSwipeLightbox({
    gallery: '#tab-content-portfolio',
    children: 'a[data-pswp-index]',
    pswpModule: () => import('https://unpkg.com/photoswipe@5/dist/photoswipe.esm.js')
  });

  lightbox.init();
</script>

      <!-- Contact & Booking -->
      <div class="text-[14px] text-gray-300 mb-[40px]">
        <h3 class="text-[22px] text-white mb-[15px] font-fondamento">Contact and Booking</h3>
        <p>
          Office: Trans Studio Mall Cibubur, GF Floor Second Atrium,<br />
          Jalan Alternatif Cibubur Nomor 230 A, Harjamukti, Kota Depok, Jawa Barat
        </p>
        <p>WA: +62 821-1969-2247</p>
        <p>IG: @academynexttopmodel</p>
        <p>Email: a-modelidn01@gmail.com</p>
      </div>
      <!-- Footer -->
      <footer class="flex justify-between text-[12px] text-gray-500 border-t border-[#333] pt-[15px]">
        <span>Academy Next Top Model | All Rights Reserved.</span>
        <span>FOLLOW TO INSTAGRAM</span>
      </footer>
    </section>
  <?php endif; ?>
  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"></div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\academyntm2-main\resources\views/portofolioasli.blade.php ENDPATH**/ ?>