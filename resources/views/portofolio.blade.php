<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Academy Next Top Model</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Font + Tailwind -->
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Newsreader:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
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
<body>
    @include('navbar')
  
  @php $selected = isset($model) ? $model : $models->first(); @endphp
  @if($selected)
    <section class="bg-black text-white px-[50px] py-[60px] font-['Open_Sans']">
      <!-- Model Profile -->
      <div class="flex items-center gap-[30px] mb-[30px]">
        <img src="{{ $selected->photo ? asset('storage/' . $selected->photo) : asset('img/profile.jpg') }}" alt="Model Profile" class="w-[240px] h-[240px] rounded-full object-cover" />
        <div>
        <button class="bg-white text-black text-[12px] font-bold rounded-full px-[10px] py-[3px] mb-[5px]">
    {{ $selected->experience_value }} {{ __('messages.portofolio_' . ($selected->experience_unit ?? 'years')) }} {{ __('messages.portofolio_exp') }}
</button>
          <h2 class="text-[26px] font-semibold mb-[4px]">{{ $selected->nama_model }}</h2>
          <p class="text-[16px] text-gray-300 mb-[6px]">{{ $selected->city }}</p>
          <p class="text-[16px] text-gray-400 mb-[10px]">
    {{ $selected->status == 'available' ? __('messages.portofolio_available') : __('messages.portofolio_not_available') }}
</p>
          <div class="flex items-center gap-3 mt-2">
            <a href="{{ route('models.edit', $selected->id_model) }}" class="inline-block bg-white text-black text-[12px] font-semibold px-[12px] py-[6px] rounded-full hover:bg-gray-200">{{ __('messages.portofolio_edit_model') }}</a>
            <button type="button" onclick="confirmDelete({{ $selected->id_model }})" class="inline-block bg-red-600 text-white text-[12px] font-semibold px-[12px] py-[6px] rounded-full hover:bg-red-800 ml-2">
                {{ __('messages.portofolio_delete_model') }}
            </button>

<form id="delete-form-{{ $selected->id_model }}" action="{{ route('models.destroy', $selected->id_model) }}" method="POST" class="hidden">
  @csrf
  @method('DELETE')
</form>

          </div>
        </div>
      </div>
      <!-- Model Stats -->
      <div class="flex justify-around my-[30px] text-[24px] text-center">
        <div>{{ $selected->height }} cm<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_height') }}</span></div>
        <div>{{ $selected->weight }} kg<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_weight') }}</span></div>
        <div>{{ $selected->age }} th<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_age') }}</span></div>
        <div>{{ $selected->shoes_size }}<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_shoes') }}</span></div>
        <div>{{ $selected->size }}<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_size') }}</span></div>
        <div>{{ $selected->bust }} cm<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_bust') }}</span></div>
        <div>{{ $selected->waist }} cm<br><span class="text-[12px] text-gray-400">{{ __('messages.portofolio_waist') }}</span></div>
      </div>
      <!-- Portfolio Tabs -->
      <div id="portfolio-tabs" class="flex justify-center gap-[40px] text-[16px] font-bold pb-[15px] border-b border-white mb-[30px]">
  <span id="tab-portfolio" class="text-white border-b-2 border-white cursor-pointer" onclick="showTab('portfolio')">{{ __('messages.portofolio_tab_portfolio') }}</span>
  <span id="tab-career" class="text-gray-400 cursor-pointer" onclick="showTab('career')">{{ __('messages.portofolio_tab_career') }}</span>
  <span id="tab-awards" class="text-gray-400 cursor-pointer" onclick="showTab('awards')">{{ __('messages.portofolio_tab_awards') }}</span>
</div>
      <div id="tab-content-portfolio">
        <!-- Gallery -->
<div class="max-w-6xl mx-auto px-4 mb-[40px]">
  <!-- Baris 1: 1 kiri, 4 kanan (2x2 grid) -->
  <div class="flex gap-4 mb-4">
    <!-- Card kiri persegi (slot 1) -->
    <div class="aspect-square flex-1 bg-gray-700 flex items-center justify-center relative overflow-hidden">
      @if(isset($portfolioSlots[1]) && $portfolioSlots[1])
        <img src="{{ asset('storage/' . $portfolioSlots[1]->photo) }}" class="object-cover w-full h-full" />
        <div class="absolute top-2 right-2 flex gap-2 z-10">
          <!-- Edit Button -->
          <form action="{{ route('portofolio.update', [$selected->id_model ?? $model->id_model, 1]) }}" method="POST" enctype="multipart/form-data" id="edit-form-1">
            @csrf
            <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-upload-1">
            <label for="edit-upload-1" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_edit') }}</label>
          </form>
          <!-- Delete Button -->
          <form action="{{ route('portofolio.delete', [$selected->id_model ?? $model->id_model, 1]) }}" method="POST" id="delete-portfolio-form-1">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDeletePortfolio(1)" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
          </form>
        </div>
      @endif
      <form action="{{ route('portofolio.upload', [$selected->id_model ?? $model->id_model, 1]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($portfolioSlots[1]) && $portfolioSlots[1] ? 'display:none;' : '' }}">
        @csrf
        <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="upload-1">
        <label for="upload-1" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
      </form>
    </div>
    <!-- 4 card kanan dalam grid 2x2 (slot 2-5) -->
    <div class="grid grid-cols-2 grid-rows-2 gap-4 flex-1">
      @for($i=2; $i<=5; $i++)
      <div class="aspect-square bg-gray-700 flex items-center justify-center relative overflow-hidden">
        @if(isset($portfolioSlots[$i]) && $portfolioSlots[$i])
          <img src="{{ asset('storage/' . $portfolioSlots[$i]->photo) }}" class="object-cover w-full h-full" />
          <div class="absolute top-2 right-2 flex gap-2 z-10">
            <form action="{{ route('portofolio.update', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" id="edit-form-{{ $i }}">
              @csrf
              <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-upload-{{ $i }}">
              <label for="edit-upload-{{ $i }}" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_edit') }}</label>
            </form>
            <form action="{{ route('portofolio.delete', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" id="delete-portfolio-form-{{ $i }}">
              @csrf
              @method('DELETE')
              <button type="button" onclick="confirmDeletePortfolio({{ $i }})" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
            </form>
          </div>
        @endif
        <form action="{{ route('portofolio.upload', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($portfolioSlots[$i]) && $portfolioSlots[$i] ? 'display:none;' : '' }}">
          @csrf
          <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="upload-{{ $i }}">
          <label for="upload-{{ $i }}" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
        </form>
      </div>
      @endfor
    </div>
  </div>
  <!-- Baris 2: 4 kiri (2x2 grid, slot 6-9), 1 kanan persegi (slot 10) -->
  <div class="flex gap-4">
    <div class="grid grid-cols-2 grid-rows-2 gap-4 flex-1">
      @for($i=6; $i<=9; $i++)
      <div class="aspect-square bg-gray-700 flex items-center justify-center relative overflow-hidden">
        @if(isset($portfolioSlots[$i]) && $portfolioSlots[$i])
          <img src="{{ asset('storage/' . $portfolioSlots[$i]->photo) }}" class="object-cover w-full h-full" />
          <div class="absolute top-2 right-2 flex gap-2 z-10">
            <form action="{{ route('portofolio.update', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" id="edit-form-{{ $i }}">
              @csrf
              <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-upload-{{ $i }}">
              <label for="edit-upload-{{ $i }}" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_edit') }}</label>
            </form>
            <form action="{{ route('portofolio.delete', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" id="delete-portfolio-form-{{ $i }}">
              @csrf
              @method('DELETE')
              <button type="button" onclick="confirmDeletePortfolio({{ $i }})" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
            </form>
          </div>
        @endif
        <form action="{{ route('portofolio.upload', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($portfolioSlots[$i]) && $portfolioSlots[$i] ? 'display:none;' : '' }}">
          @csrf
          <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="upload-{{ $i }}">
          <label for="upload-{{ $i }}" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
        </form>
      </div>
      @endfor
    </div>
    <div class="aspect-square flex-1 bg-gray-700 flex items-center justify-center relative overflow-hidden">
      @if(isset($portfolioSlots[10]) && $portfolioSlots[10])
        <img src="{{ asset('storage/' . $portfolioSlots[10]->photo) }}" class="object-cover w-full h-full" />
        <div class="absolute top-2 right-2 flex gap-2 z-10">
          <form action="{{ route('portofolio.update', [$selected->id_model ?? $model->id_model, 10]) }}" method="POST" enctype="multipart/form-data" id="edit-form-10">
            @csrf
            <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-upload-10">
            <label for="edit-upload-10" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_edit') }}</label>
          </form>
          <form action="{{ route('portofolio.delete', [$selected->id_model ?? $model->id_model, 10]) }}" method="POST" id="delete-portfolio-form-10">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDeletePortfolio(10)" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
          </form>
        </div>
      @endif
      <form action="{{ route('portofolio.upload', [$selected->id_model ?? $model->id_model, 10]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($portfolioSlots[10]) && $portfolioSlots[10] ? 'display:none;' : '' }}">
        @csrf
        <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="upload-10">
        <label for="upload-10" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
      </form>
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
      document.getElementById('delete-portfolio-form-' + slot).submit();
    }
  });
}
</script>

      </div>
      <div id="tab-content-career" style="display:none;">
        <div class="max-w-6xl mx-auto px-4 mb-[40px]">
          <div class="grid grid-cols-3 grid-rows-2 gap-4">
            @for($i=1; $i<=6; $i++)
            <div class="w-full h-[450px] bg-gray-700 flex items-center justify-center relative overflow-hidden">
              @if(isset($careerSlots[$i]) && $careerSlots[$i])
                <img src="{{ asset('storage/' . $careerSlots[$i]->photo) }}" class="object-cover w-full h-full" />
                <div class="absolute top-2 right-2 flex gap-2 z-10">
                  <!-- Edit Career: trigger modal -->
                  <button type="button" class="bg-white text-black px-2 py-1 rounded text-xs font-bold" onclick="openCareerEditModal({{ $i }}, '{{ $careerSlots[$i]->event_name }}', '{{ $careerSlots[$i]->year }}')">{{ __('messages.portofolio_edit') }}</button>
                  <form action="{{ route('career.delete', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" id="delete-career-form-{{ $i }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDeleteCareer({{ $i }})" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
                  </form>
                </div>
                <div class="absolute bottom-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                  {{ $careerSlots[$i]->event_name }}<br>{{ $careerSlots[$i]->year }}
                </div>
                <!-- Edit Modal Form (hidden) -->
                <form action="{{ route('career.update', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" id="edit-career-form-{{ $i }}" style="display:none;">
                  @csrf
                  <input type="file" name="photo" accept="image/*" class="hidden" id="edit-career-upload-{{ $i }}">
                  <input type="hidden" name="event_name">
                  <input type="hidden" name="year">
                </form>
              @endif
              <form action="{{ route('career.upload', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($careerSlots[$i]) && $careerSlots[$i] ? 'display:none;' : '' }}" id="career-upload-form-{{ $i }}">
                @csrf
                <input type="file" name="photo" accept="image/*" class="hidden" onchange="handleCareerFileChange(event, {{ $i }})" id="career-upload-{{ $i }}">
                <input type="hidden" name="event_name">
                <input type="hidden" name="year">
                <label for="career-upload-{{ $i }}" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
              </form>
            </div>
            @endfor
          </div>
        </div>
      </div>
      <div id="tab-content-awards" style="display:none;">
        <div class="max-w-6xl mx-auto px-4 mb-[40px]">
          <div class="grid grid-cols-2 grid-rows-3 gap-4">
            @for($i=1; $i<=6; $i++)
            <div class="w-full h-[350px] bg-gray-700 flex items-center justify-center relative overflow-hidden">
              @if(isset($awardSlots[$i]) && $awardSlots[$i])
                <img src="{{ asset('storage/' . $awardSlots[$i]->photo) }}" class="object-cover w-full h-full" />
                <div class="absolute top-2 right-2 flex gap-2 z-10">
                  <form action="{{ route('award.update', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" id="edit-award-form-{{ $i }}">
                    @csrf
                    <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="edit-award-upload-{{ $i }}">
                    <label for="edit-award-upload-{{ $i }}" class="cursor-pointer bg-white text-black px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_edit') }}</label>
                  </form>
                  <form action="{{ route('award.delete', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" id="delete-award-form-{{ $i }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDeleteAward({{ $i }})" class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">{{ __('messages.portofolio_delete') }}</button>
                  </form>
                </div>
              @endif
              <form action="{{ route('award.upload', [$selected->id_model ?? $model->id_model, $i]) }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center" style="{{ isset($awardSlots[$i]) && $awardSlots[$i] ? 'display:none;' : '' }}">
                @csrf
                <input type="file" name="photo" accept="image/*" class="hidden" onchange="this.form.submit()" id="award-upload-{{ $i }}">
                <label for="award-upload-{{ $i }}" class="cursor-pointer text-4xl text-white bg-gray-800 bg-opacity-70 rounded-full w-14 h-14 flex items-center justify-center hover:bg-gray-600">+</label>
              </form>
            </div>
            @endfor
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
      <!-- Contact & Booking -->
      <div class="text-[14px] text-gray-300 mb-[40px]">
        <h3 class="text-[22px] text-white mb-[15px] font-fondamento">{{ __('messages.portofolio_contact_booking') }}</h3>
        <p>{{ __('messages.portofolio_office') }}<br />
        {{ __('messages.portofolio_address') }}</p>
        <p>{{ __('messages.portofolio_wa') }}</p>
        <p>{{ __('messages.portofolio_ig') }}</p>
        <p>{{ __('messages.portofolio_email') }}</p>
      </div>
      <!-- Footer -->
      <footer class="flex justify-between text-[12px] text-gray-500 border-t border-[#333] pt-[15px]">
        <span>{{ __('messages.portofolio_footer') }}</span>
        <span>{{ __('messages.portofolio_instagram') }}</span>
      </footer>
    </section>
  @endif
</body>
</html>
