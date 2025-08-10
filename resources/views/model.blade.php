<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Academy Next Top Model</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Font + Tailwind -->
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Newsreader:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom Font Style -->
  <style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    .font-fondamento { font-family: 'Fondamento', cursive; }
  </style>
</head>
<body class="bg-black text-white">
    @include('navbar')

  <!-- === CATEGORY SECTION === -->
  <div class="h-px w-full bg-white/10 my-6"></div>

  <section class="px-[60px] py-[40px]">
    <div class="flex justify-between items-center mb-[30px]">
      <h1 class="text-[48px] font-fondamento">{{ __('messages.models_title') }}</h1>

      <!-- Filter Tabs + Add Model + Search -->
      <div class="flex items-center gap-[20px] text-[18px]" id="filterTabs">
        
        <span class="cursor-pointer font-bold underline" data-filter="all">{{ __('messages.models_all') }}</span>
        <span class="cursor-pointer" data-filter="kids">{{ __('messages.models_kids') }}</span>
        <span class="cursor-pointer" data-filter="teens">{{ __('messages.models_teens') }}</span>
        
        <span class="cursor-pointer" id="searchIcon">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1111.5 4.5a7.5 7.5 0 015.15 12.15z" />
  </svg>
</span>
        <input type="text" id="searchInput"  class="hidden ml-2 px-2 py-1 rounded text-black text-[16px]" />
        @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('models.create') }}" class="ml-2 bg-white text-black px-4 py-2 rounded text-[14px] hover:bg-gray-200">{{ __('messages.models_addmodell') }}</a>
        @endif
      </div>
    </div>

    <!-- Grid Model -->
    <div class="grid grid-cols-4 gap-[20px]" id="modelGrid">
      @foreach($models as $model)
      <a href="{{ route('portofolio.detail', $model->id_model) }}" class="block">
        <div class="relative group model-card" data-category="{{ $model->categories }}">
          <span class="absolute bottom-2 left-2 text-[14px] text-white bg-black/60 px-2 py-1 rounded">{{ $model->nama_model }}</span>
          <img src="{{ $model->photo ? asset('storage/' . $model->photo) : asset('img/models_list/jasmine.png') }}" class="w-full aspect-square object-cover" />
          <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
            <span class="text-white text-sm">{{ __('messages.models_seeporto') }}</span>
          </div>
        </div>
      </a>
      @endforeach
    </div>

    <!-- Footer -->
    <div class="flex justify-between mt-[40px] text-[12px] text-[#ccc]">
      <p>Academy Next Top Model | All Rights Reserved</p>
      <p>FOLLOW TO INSTAGRAM</p>
    </div>
  </section>

  <!-- Filtering Script -->
  <script>
    const tabs = document.querySelectorAll('#filterTabs span[data-filter]');
    const cards = Array.from(document.querySelectorAll('.model-card'));
    const grid = document.getElementById('modelGrid');
    const searchIcon = document.getElementById('searchIcon');
    const searchInput = document.getElementById('searchInput');

    function renderCards(filteredCards) {
      grid.innerHTML = '';
      filteredCards.forEach(card => {
        grid.appendChild(card.parentElement);
      });
    }

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('font-bold', 'underline'));
        tab.classList.add('font-bold', 'underline');
        const filter = tab.dataset.filter;
        let filtered = cards;
        if (filter !== 'all') {
          filtered = cards.filter(card => card.dataset.category === filter);
        }
        // Reset search
        searchInput.value = '';
        renderCards(filtered);
      });
    });

    searchIcon.addEventListener('click', () => {
      searchInput.classList.toggle('hidden');
      searchInput.focus();
    });
    searchInput.addEventListener('input', function() {
      const val = this.value.toLowerCase();
      let filtered = cards.filter(card => {
        const name = card.querySelector('span').textContent.toLowerCase();
        return name.includes(val);
      });
      renderCards(filtered);
    });
  </script>

</body>
</html>
