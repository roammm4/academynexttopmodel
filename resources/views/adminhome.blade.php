<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .header-right { width: calc(100% - 3.5rem); }
        .sidebar:hover { width: 16rem; }
        @media only screen and (min-width: 768px) { .header-right { width: calc(100% - 16rem); } }
    </style>
</head>
<script src="//unpkg.com/alpinejs" defer></script>

<body class="bg-gray-900 text-white">
<div x-data="{ isDark: true, toggleTheme() { this.isDark = !this.isDark } }" :class="{ 'dark': isDark }">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="fixed w-full flex items-center justify-between h-14 bg-gray-800 text-white z-10">
            <div class="flex items-center pl-3 w-14 md:w-64 h-14">
                <img class="w-8 h-8 md:w-10 md:h-10 mr-2 rounded-full" src={{ asset('img/logo.jpg') }} />
                <span class="hidden md:block font-bold text-lg">{{ __('messages.admin_label') }}</span>
            </div>
            <div class="flex items-center header-right pr-4">
                <div class="bg-gray-700 rounded flex items-center w-full max-w-xs mr-4 p-2 shadow-sm border border-gray-700">
                    <input type="search" placeholder="Search" class="w-full pl-3 text-sm text-white outline-none bg-transparent placeholder-gray-400" />
                </div>
                <button @click="toggleTheme" class="p-2 rounded-full bg-gray-700 text-white ml-2">
                    <svg x-show="isDark" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    <svg x-show="!isDark" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                
                <a href="#" class="ml-4 flex items-center hover:text-gray-300">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    {{ __('messages.admin_logout') }}
                </a>
                <!-- Dropdown Bahasa dengan Alpine.js -->
<div class="relative ml-4" x-data="{ open: false }" @click.away="open = false">
  <button @click="open = !open"
    class="flex items-center gap-2 px-3 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition">
    <span class="w-5 h-5 rounded-full overflow-hidden">
      <img src="https://flagcdn.com/24x18/gb.png" alt="English"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'en' ? 'inline' : 'none' }};" />
      <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'id' ? 'inline' : 'none' }};" />
    </span>
    <span class="text-sm font-medium">{{ strtoupper(app()->getLocale()) }}</span>
    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <ul x-show="open" x-transition
    class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50 text-sm"
    @click="open = false">
    <li>
      <a href="{{ route('lang.switch', 'en') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100 transition">
        <img src="https://flagcdn.com/24x18/gb.png" alt="English"
          class="w-5 h-5 rounded-full border border-gray-300" />
        English
      </a>
    </li>
    <li>
      <a href="{{ route('lang.switch', 'id') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100 transition">
        <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
          class="w-5 h-5 rounded-full border border-gray-300" />
        Indonesia
      </a>
    </li>
  </ul>
</div>

            </div>
            
        </header>
        <!-- Sidebar -->
        <aside class="fixed top-14 left-0 w-14 hover:w-64 md:w-64 bg-gray-800 h-full text-white transition-all duration-300 z-10 sidebar flex flex-col">
            <div class="flex-grow overflow-y-auto">
                <ul class="py-4 space-y-1">
                    <li>
                        <a href="/admin" class="flex flex-row items-center h-11 hover:bg-gray-700 px-4 font-bold">
                            <span class="ml-2 text-sm tracking-wide truncate">{{ __('messages.admin_dashboard') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" class="flex flex-row items-center h-11 hover:bg-gray-700 px-4">
                            <span class="ml-2 text-sm tracking-wide truncate">{{ __('messages.admin_mainweb') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/addmodel" class="flex flex-row items-center h-11 hover:bg-gray-700 px-4">
                            <span class="ml-2 text-sm tracking-wide truncate">{{ __('messages.admin_addmodell') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="profile-link" class="flex flex-row items-center h-11 hover:bg-gray-700 px-4">
                            <span class="ml-2 text-sm tracking-wide truncate">{{ __('messages.admin_userlist') }}</span>
                        </a>
                    </li>
                    <!-- Settings Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                class="flex flex-row items-center justify-between w-full h-11 hover:bg-gray-700 px-4 focus:outline-none">
                <span class="ml-2 text-sm tracking-wide truncate">Settings</span>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
                </svg>
                </button>
                <ul x-show="open" class="pl-6 space-y-1 mt-1 transition-all" x-cloak>
                <li>
                    <a href="#" id="featured-talent-link"
                    class="flex items-center h-9 hover:bg-gray-700 px-2 text-sm rounded">
                    Face of Models Setting
                    </a>
                </li>
                <li>
                <a href="#" id="ourtalent-setting-link"
                    class="flex items-center h-9 hover:bg-gray-700 px-2 text-sm rounded">
                    Meet Our Talent Setting
                    </a>
            </li>
            <li>
                <a href="#" id="populartalent-setting-link"
                    class="flex items-center h-9 hover:bg-gray-700 px-2 text-sm rounded">
                    Popular Models Setting
                    </a>
            </li>

                </ul>
            </li>
                </ul>
            </div>
            <p class="mb-4 px-5 py-3 hidden md:block text-center text-xs text-gray-400">Copyright &copy;2021</p>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 ml-14 mt-14 md:ml-64 p-6 bg-gray-900 min-h-screen">
            <div id="main-dashboard-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-4 text-white font-medium transition-transform duration-200 hover:shadow-2xl hover:scale-105 cursor-pointer" id="visitor-card">
                        <div class="flex justify-center items-center w-14 h-14 bg-gray-700 rounded-full">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">{{ $visitorCount }}</p>
                            <p>{{ __('messages.admin_active_users') }}</p>
                        </div>
                    </div>
                    <div class="bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-4 text-white font-medium transition-transform duration-200 hover:shadow-2xl hover:scale-105 cursor-pointer" id="model-card">
                        <div class="flex justify-center items-center w-14 h-14 bg-gray-700 rounded-full">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">{{ $modelCount }}</p>
                            <p>{{ __('messages.admin_model_active') }}</p>
                        </div>
                    </div>
                </div>
                <div id="visitor-chart-container" class="w-full bg-gray-800 rounded-lg p-6 mt-2 hidden" style="min-height:340px;">
                    <canvas id="visitorChart" style="width:100%;height:320px;"></canvas>
                </div>
                <div id="model-chart-container" class="w-full bg-gray-800 rounded-lg p-6 mt-2 hidden" style="min-height:340px;">
                    <canvas id="modelChart" style="width:100%;height:320px;"></canvas>
                </div>
            </div>
            <div id="profile-table-content" class="hidden">
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">User List</h2>
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('messages.admin_no') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('messages.admin_name') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('messages.admin_email') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('messages.admin_last_active') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @foreach($users as $i => $u)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $i+1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $u->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $u->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(isset($u->is_online) && $u->is_online)
                                        <span class="text-green-400 font-bold">{{ __('messages.admin_online') }}</span>
                                    @elseif(isset($u->last_active) && $u->last_active)
                                        {{ \Carbon\Carbon::parse($u->last_active)->diffForHumans() }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="featured-talent-content" class="hidden">
                <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-white">{{ __('messages.face_of_models') }}</h2>
                <form method="POST" action="{{ route('admin.featured-talents.save') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @for($i = 0; $i < 8; $i++)
                    <div class="flex flex-col gap-2" 
                        x-data="{ selected: '{{ old('model_ids.' . $i, $featured[$i]->id_model ?? '') }}' }">
                        <label class="text-white font-semibold">Model {{ $i + 1 }}</label>
                        <select name="model_ids[]" x-model="selected" class="w-full p-2 rounded bg-gray-700 text-white">
                        <option value="">-- Pilih Model --</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id_model }}">{{ $model->nama_model }}</option>
                        @endforeach
                        </select>

                        <template x-if="selected">
                        <img 
                            :src="'{{ asset('storage') }}/' + ({{ Js::from($models->pluck('photo', 'id_model')) }}[selected] ?? '')" 
                            class="w-full h-48 object-cover rounded">
                        </template>
                    </div>
                    @endfor
                </div>
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-white text-black font-semibold px-6 py-2 rounded-full hover:bg-gray-300 transition">
                    Simpan
                    </button>
                </div>
                </form>
            </div>
            </div>

            <!-- Add more dashboard content here -->

            <div id="ourtalent-setting-content" class="hidden bg-gray-800 p-6 rounded-lg text-white max-w-3xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Upload 8 Gambar untuk "Meet Our Talent"</h2>
        <form method="POST" action="{{ route('admin.ourtalent.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-4 gap-4">
            @for ($i = 0; $i < 8; $i++)
            <div class="relative border-2 border-dashed border-gray-600 rounded-lg h-56 flex items-center justify-center bg-gray-700 group">
                <input type="file" name="images[]" class="hidden" accept="image/*" id="image-{{ $i }}">
                
                <label for="image-{{ $i }}" class="cursor-pointer flex flex-col items-center justify-center text-white group-hover:opacity-100 transition-opacity">
                <span class="text-4xl font-bold">+</span>
                <span class="text-sm mt-1">Upload</span>
                </label>

                <div class="absolute inset-0 hidden" id="preview-wrapper-{{ $i }}">
                <img id="preview-{{ $i }}" class="w-full h-full object-cover rounded-lg" />
                <div class="absolute bottom-2 right-2 flex gap-2">
                    <button type="button" onclick="editImage({{ $i }})" class="bg-white text-black px-2 py-1 text-xs rounded">Edit</button>
                    <button type="button" onclick="removeImage({{ $i }})" class="bg-red-600 text-white px-2 py-1 text-xs rounded">Delete</button>
                </div>
                </div>
            </div>
            @endfor
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">Simpan Gambar</button>
        </form>
        </div>

        <div id="populartalent-setting-content" class="hidden bg-gray-800 p-6 rounded-lg text-white max-w-3xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Upload 8 Gambar untuk "Popular Talent"</h2>
    <form method="POST" action="{{ route('admin.populartalent.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-4 gap-4">
        @for ($i = 0; $i < 8; $i++)
    @php
        $item = $items[$i] ?? null;
    @endphp

    <div class="relative border-2 border-dashed border-gray-600 rounded-lg h-56 flex items-center justify-center bg-gray-700 group">
        <input type="file" name="images[]" class="hidden" accept="image/*" id="popular-image-{{ $i }}">

        <label for="popular-image-{{ $i }}" class="cursor-pointer flex flex-col items-center justify-center text-white group-hover:opacity-100 transition-opacity">
            <span class="text-4xl font-bold">+</span>
            <span class="text-sm mt-1">Upload</span>
        </label>

        <div class="absolute inset-0 {{ ($item && $item->image) ? '' : 'hidden' }}" id="popular-preview-wrapper-{{ $i }}">
            @if($item && $item->image)
                <img id="popular-preview-{{ $i }}" src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover rounded-lg" />
                <div class="absolute bottom-2 right-2 flex gap-2">
                    <button type="button" onclick="editPopularImage({{ $i }})" class="bg-white text-black px-2 py-1 text-xs rounded">Edit</button>
                    <button type="button" onclick="removePopularImage({{ $i }})" class="bg-red-600 text-white px-2 py-1 text-xs rounded">Delete</button>
                </div>
            @endif
        </div>
    </div>
@endfor
        </div>
        <button type="submit" class="mt-6 bg-green-600 text-white px-4 py-2 rounded">Simpan Popular Talent</button>
    </form>
    </div>

        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    for (let i = 0; i < 8; i++) {
        const input = document.getElementById(`popular-image-${i}`);
        const preview = document.getElementById(`popular-preview-${i}`);
        const wrapper = document.getElementById(`popular-preview-wrapper-${i}`);

        input?.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            wrapper.classList.remove('hidden');
        }
        });
    }

    function removePopularImage(i) {
        const input = document.getElementById(`popular-image-${i}`);
        const wrapper = document.getElementById(`popular-preview-wrapper-${i}`);
        input.value = '';
        wrapper.classList.add('hidden');
    }

    function editPopularImage(i) {
        document.getElementById(`popular-image-${i}`).click();
    }
    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const link = document.getElementById('populartalent-setting-link');
  const content = document.getElementById('populartalent-setting-content'); // pastikan ID-nya cocok

  if (link && content) {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      // Sembunyikan semua konten setting (kalau ada banyak)
      document.querySelectorAll('[id$="-setting-content"]').forEach(el => {
        el.classList.add('hidden');
      });

      // Tampilkan yang popular models
      content.classList.remove('hidden');
    });
  }
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuLinks = {
        'featured-talent-link': 'featured-talent-content',
        'ourtalent-setting-link': 'ourtalent-setting-content',
        'popularmodels-setting-link': 'popularmodels-setting-content',
    };

    Object.entries(menuLinks).forEach(([linkId, contentId]) => {
        const link = document.getElementById(linkId);
        const content = document.getElementById(contentId);

        if (link && content) {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                // Hide all
                Object.values(menuLinks).forEach(id => {
                    const section = document.getElementById(id);
                    if (section) section.classList.add('hidden');
                });

                // Show selected
                content.classList.remove('hidden');
            });
        }
    });
});
</script>

    <script>
    function readAndPreview(input, index) {
        const file = input.files[0];
        if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-' + index).src = e.target.result;
            document.getElementById('preview-wrapper-' + index).classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        }
    }

    function editImage(index) {
        document.getElementById('image-' + index).click();
    }

    function removeImage(index) {
        const input = document.getElementById('image-' + index);
        input.value = '';
        document.getElementById('preview-wrapper-' + index).classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', () => {
        for (let i = 0; i < 8; i++) {
        document.getElementById('image-' + i).addEventListener('change', function () {
            readAndPreview(this, i);
        });
        }
    });
    </script>

<script>
    document.getElementById('visitor-card').addEventListener('click', function() {
        const chartContainer = document.getElementById('visitor-chart-container');
        chartContainer.classList.toggle('hidden');
        if (!window.visitorChartLoaded) {
            fetch('/admin/visitor-stats')
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('visitorChart').getContext('2d');
                    window.visitorChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Visitor Count',
                                data: data.counts,
                                borderColor: 'rgba(59, 130, 246, 1)',
                                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Active Users',
                                    color: 'white',
                                    font: {
                                        size: 16,
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Tanggal' } },
                                y: { title: { display: true, text: 'Jumlah Active Users' }, beginAtZero: true }
                            }
                        }
                    });
                    window.visitorChartLoaded = true;
                });
        }
    });

    document.getElementById('model-card').addEventListener('click', function() {
        const chartContainer = document.getElementById('model-chart-container');
        chartContainer.classList.toggle('hidden');
        if (!window.modelChartLoaded) {
            fetch('/admin/model-stats')
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('modelChart').getContext('2d');
                    window.modelChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Model Active',
                                data: data.counts,
                                borderColor: 'rgba(239, 68, 68, 1)',
                                backgroundColor: 'rgba(239, 68, 68, 0.2)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Model Active',
                                    color: 'white',
                                    font: {
                                        size: 16,
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Tanggal' } },
                                y: { title: { display: true, text: 'Jumlah Model Active' }, beginAtZero: true }
                            }
                        }
                    });
                    window.modelChartLoaded = true;
                });
        }
    });

    document.getElementById('profile-link').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('main-dashboard-content').classList.add('hidden');
        document.getElementById('profile-table-content').classList.remove('hidden');
    });

    document.getElementById('featured-talent-link').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('main-dashboard-content').classList.add('hidden');
        document.getElementById('profile-table-content').classList.add('hidden');
        document.getElementById('featured-talent-content').classList.remove('hidden');
    });
    // Tambahkan event handler untuk Meet Our Talent Setting
    document.getElementById('ourtalent-setting-link').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('main-dashboard-content').classList.add('hidden');
        document.getElementById('profile-table-content').classList.add('hidden');
        document.getElementById('featured-talent-content').classList.add('hidden');
        document.getElementById('ourtalent-setting-content').classList.remove('hidden');
    });
</script>
</body>
</html>
