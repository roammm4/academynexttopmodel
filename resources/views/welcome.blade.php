<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ __('messages.title') }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Newsreader:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    h1.main {
      font-family: "Fondamento", cursive;
    }
    .font-fondamento { font-family: 'Fondamento', cursive; }
    
    /* Simple Animations */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    .slide-in-left {
      opacity: 0;
      transform: translateX(-30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .slide-in-left.visible {
      opacity: 1;
      transform: translateX(0);
    }
    
    .slide-in-right {
      opacity: 0;
      transform: translateX(30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .slide-in-right.visible {
      opacity: 1;
      transform: translateX(0);
    }
    
    .scale-in {
      opacity: 0;
      transform: scale(0.9);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .scale-in.visible {
      opacity: 1;
      transform: scale(1);
    }
    
    /* Hover Effects */
    .hover-lift {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .hover-scale {
      transition: transform 0.3s ease;
    }
    
    .hover-scale:hover {
      transform: scale(1.03);
    }
    
    /* Stagger Animation */
    .stagger-item {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .stagger-item.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Card Link Animation */
    .card-link {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .card-link:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 15px 35px rgba(255,255,255,0.3);
    }
    
    .card-link:active {
      transform: translateY(-4px) scale(1.02);
    }
  </style>
</head>

  <!-- Animation Script -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Simple intersection observer
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, observerOptions);
    
    // Observe all animated elements
    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in, .stagger-item').forEach(el => {
      observer.observe(el);
    });
    
    // Stagger animation for grid items
    function animateStaggerItems(container) {
      const items = container.querySelectorAll('.stagger-item');
      items.forEach((item, index) => {
        setTimeout(() => {
          item.classList.add('visible');
        }, index * 100);
      });
    }
    
    // Observe stagger containers
    document.querySelectorAll('.stagger-container').forEach(container => {
      const staggerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateStaggerItems(entry.target);
            staggerObserver.unobserve(entry.target);
          }
        });
      }, observerOptions);
      
      staggerObserver.observe(container);
    });
    
    // Initial animations for hero section
    setTimeout(() => {
      document.querySelectorAll('.hero-animate').forEach((el, index) => {
        setTimeout(() => {
          el.classList.add('visible');
        }, index * 200);
      });
    }, 100);
  });

  // Function untuk animasi card link
  function animateCardLink(event, link) {
    event.preventDefault();
    const card = event.currentTarget;
    
    // Tambahkan efek animasi
    card.style.transform = 'scale(0.92)';
    card.style.transition = 'transform 0.15s ease';
    
    setTimeout(() => {
      card.style.transform = '';
      card.style.transition = '';
      
      // Navigasi ke link
      if (link.startsWith('#')) {
        // Smooth scroll untuk anchor links
        const target = document.querySelector(link);
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      } else {
        // Navigasi ke halaman lain
        window.location.href = link;
      }
    }, 150);
  }
</script>

  <!-- Welcome Start -->
<body class="bg-black text-white min-h-screen relative overflow-x-hidden">
  @include('navbar')

  <!-- Hero Section -->
  <div class="relative pt-10">
    <div class="hidden sm:block">
      <div class="absolute top-[20px] left-1/2 transform -translate-x-1/2 z-20">
        <img src="{{ asset('img/home.jpg') }}" alt="Model" class="w-[550px] h-auto relative scale-in hover-scale" loading="lazy">
        <!-- Teks Founder -->
        <div class="absolute bottom-[30%] right-[-80px] text-right z-30 max-w-[280px] slide-in-right">
          <p class="text-white text-[16px] leading-tight font-light">
            {{ __('messages.ceo_founder_coach') }}<br>
            <span class="font-semibold">{{ __('messages.olivarie') }}</span><br>
            <span class="opacity-80 text-[15px]">{{ __('messages.miss_inter') }}</span>
          </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-[200px] bg-gradient-to-b from-transparent via-black/30 to-black"></div>
    </div>
    <h1 class="main text-[78px] md:text-[78px] sm:text-[60px] xs:text-[40px] text-center relative z-10 mt-[-50px] mb-5 hero-animate fade-in">ACADEMY NEXT TOP MODEL</h1>
    <section class="flex flex-col md:flex-row justify-between items-start px-4 md:px-[70px] mt-[-80px] relative z-10">
        <div class="flex-1 pt-8 md:pt-14 md:text-left text-center hero-animate slide-in-left">
          <p class="text-[20px] sm:text-[24px] md:text-[28px] leading-snug opacity-80 font-light">
            {{ __('messages.hero_slogan_1') }}<br>{{ __('messages.hero_slogan_2') }}<br>{{ __('messages.hero_slogan_3') }}
          </p>
          <a href="http://wa.me/+6281219762427" target="_blank"
            class="inline-flex items-center px-4 py-2 border border-white rounded-full text-white text-[16px] mt-6 md:mt-10
                    hover:bg-white hover:text-black hover:border-black transition hover-lift">
            {{ __('messages.lets_collaborate') }} <span class="ml-2">↗</span>
        </a>
      </div>
      <div class="flex-1 md:text-right text-center md:mt-0 mt-8 pt-8 md:pt-14 hero-animate slide-in-right">
          <p class="text-[18px] sm:text-[20px] md:text-[24px] leading-snug opacity-80 font-light">
            {{ __('messages.hero_slogan_4') }}
          </p>
        </div>
      </section>
  </div>

  <!-- Hero Section Mobile -->
  <div class="flex flex-col items-center sm:hidden px-4 pt-6">
    <h1 class="main text-[70px] text-center mb-4 fade-in">ACADEMY NEXT TOP MODEL</h1>
    <p class="text-[16px] leading-snug opacity-80 font-light text-center mb-4 fade-in">
      {{ __('messages.hero_slogan_4') }}
    </p>
    <div class="relative w-[500px] h-auto mb-4">
      <img src="{{ asset('img/home.jpg') }}" alt="Model" class="w-full h-auto rounded-lg shadow-lg hover-scale" loading="lazy">
      <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-b from-transparent via-black/30 to-black pointer-events-none"></div>
      <!-- Teks Founder Mobile -->
      <div class="absolute top-[60%] right-[-40px] pr-4 text-right z-10 max-w-[220px] slide-in-right">
        <p class="text-white text-[15px] leading-tight font-light">
          {{ __('messages.ceo_founder_coach') }}<br>
          <span class="font-semibold">{{ __('messages.olivarie') }}</span><br>
          <span class="opacity-80 text-[14px]">{{ __('messages.miss_inter') }}</span>
        </p>
      </div>
    </div>
    <p class="text-[28px] leading-snug opacity-80 font-light text-center mb-4 fade-in">
      {{ __('messages.hero_slogan_1') }}<br>{{ __('messages.hero_slogan_2') }}<br>{{ __('messages.hero_slogan_3') }}
    </p>
    <a href="http://wa.me/+6281219762427" target="_blank"
      class="inline-flex items-center px-4 py-2 border border-white rounded-full text-white text-[16px] mb-3
              hover:bg-white hover:text-black hover:border-black transition hover-lift fade-in">
      {{ __('messages.lets_collaborate') }} <span class="ml-2">↗</span>
    </a>  
  </div>
</div>

  <!-- About Us Section -->
<section class="hidden sm:flex mt-[250px] flex h-screen fade-in">
  
  <!-- Left -->
  <div class="w-1/2 overflow-hidden">
    <img src="{{ asset('img/becomeamodel.png') }}" alt="Model Image" class="w-full h-full object-cover hover-scale" loading="lazy">
  </div>

  <!-- Right-->
  <div class="w-1/2 px-[60px] py-[80px] flex flex-col justify-center bg-black">
    <h1 class="font-['Fondamento'] text-[60px] leading-tight mb-[30px] slide-in-left">
      {{ __('messages.about_us2') }}
    </h1>
    <p class="text-[15px] mb-[20px] leading-[1.8] slide-in-left">
      {{ __('messages.about_us_desc_1') }}
    </p>
    <p class="text-[15px] mb-[20px] leading-[1.8] slide-in-left">
      {{ __('messages.about_us_desc_2') }}
    </p>
    <a href="http://wa.me/+6281219762427" class="flex items-center border border-white rounded-full pl-8 pr-2 py-2 mt-5 w-[250px] h-[60px] group transition-colors duration-300 bg-black hover-lift slide-in-left">
      <span class="text-white text-lg tracking-wide flex-1">{{ __('messages.more_info') }}</span>
      <span class="bg-white rounded-full w-12 h-12 flex items-center justify-center transition group-hover:bg-black ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-black group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l7-7m0 0v6m0-6H9" transform="rotate(45 12 12)" />
        </svg>
      </span>
    </a>
  </div>
</section>

<!-- Talent Section Mobile -->
<section id="meet-our-talent-mobile" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <div class="w-full flex flex-col items-center mb-4">
    <p class="font-['Fondamento'] text-white text-[70px] leading-none tracking-wider fade-in">{{ __('messages.talent_our') }}</p>
    <p class="font-['Fondamento'] text-white text-[70px] leading-none tracking-wider -mt-2 fade-in">{{ __('messages.talent_talents') }}</p>
  </div>
  @php
    $talentCards = [
      [
        'img' => 'img/talent/model1.png',
        'title' => __('messages.talent_meet'),
        'link' => '#meet-our-talent-mobile', // Kiri atas - mobile
      ],
      [
        'img' => 'img/talent/model3.jpg',
        'title' => __('messages.talent_new'),
        'link' => '#new-models', // Tengah
      ],
      [
        'img' => 'img/talent/model2.png',
        'title' => __('messages.talent_faces'),
        'link' => '#face-of-models', // Kiri bawah
      ],
      [
        'img' => 'img/talent/model4.jpg',
        'title' => __('messages.talent_explore'),
        'link' => url('/models'), // Kanan atas
      ],
      [
        'img' => 'img/talent/model5.jpg',
        'title' => __('messages.talent_popular'),
        'link' => '#popular-models', // Kanan bawah
      ],
    ];
  @endphp
  @foreach($talentCards as $index => $card)
    <a href="{{ $card['link'] }}"
       class="relative w-full max-w-[280px] h-[350px] rounded-[20px] overflow-hidden mb-4 stagger-item hover-lift card-link group transition-all duration-300"
       onclick="animateCardLink(event, '{{ $card['link'] }}')">
      <img src="{{ asset($card['img']) }}" alt="{{ $card['title'] }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
      <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
        <span class="font-['Newsreader'] text-[18px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">
          {{ $card['title'] }}
        </span>
        <span class="bg-white text-black rounded-full w-[32px] h-[32px] flex items-center justify-center font-bold text-[14px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">
          ↗
        </span>
      </div>
    </a>
  @endforeach
  <p class="font-['Newsreader'] text-[20px] text-center text-gray-300 leading-relaxed mt-2 mb-6 max-w-xs fade-in">
    {{ __('messages.talent_ignite') }}
  </p>
</section>

  <!-- Talent Section -->
<section id="meet-our-talent-desktop" class="hidden sm:block mt-[300px] bg-black fade-in">
  <div class="flex justify-center items-center md:gap-[120px] gap-[60px] md:flex-row flex-col">
    <!-- Left Column -->
    <div class="flex md:flex-col flex-row gap-[30px] md:gap-[30px] gap-4 flex-wrap justify-center">
      <!-- Meet Our Talent Card -->
      <a href="#meet-our-talent" 
         class="relative w-[280px] h-[350px] rounded-[20px] overflow-hidden stagger-item hover-lift card-link group transition-all duration-300"
         onclick="animateCardLink(event, '#meet-our-talent')">
        <img src="{{ asset('img/talent/model1.png') }}" alt="{{ __('messages.talent_meet') }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
        <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
          <span class="font-['Newsreader'] text-[22px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">{{ __('messages.talent_meet') }}</span>
          <span class="bg-white text-black rounded-full w-[32px] h-[32px] flex items-center justify-center font-bold text-[16px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">↗</span>
        </div>
      </a>
      
      <!-- Faces Card -->
      <a href="#face-of-models" 
         class="relative w-[280px] h-[350px] rounded-[20px] overflow-hidden stagger-item hover-lift card-link group transition-all duration-300"
         onclick="animateCardLink(event, '#face-of-models')">
        <img src="{{ asset('img/talent/model2.png') }}" alt="{{ __('messages.talent_faces') }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
        <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
          <span class="font-['Newsreader'] text-[18px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">{{ __('messages.talent_faces') }}</span>
          <span class="bg-white text-black rounded-full w-[28px] h-[28px] flex items-center justify-center font-bold text-[14px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">↗</span>
        </div>
      </a>
    </div>

    <!-- Center Column -->
    <div class="flex flex-col items-center gap-[20px] max-w-[320px]">
      <div class="text-left w-full">
        <p class="font-['Fondamento'] text-white text-[70px] leading-none tracking-wider fade-in">{{ __('messages.talent_our') }}</p>
        <p class="font-['Fondamento'] text-white text-[70px] leading-none tracking-wider -mt-2 fade-in">{{ __('messages.talent_talents') }}</p>
      </div>
      <!-- New Models Card -->
      <a href="#new-models" 
         class="relative w-[320px] h-[400px] rounded-[20px] overflow-hidden stagger-item hover-lift card-link group transition-all duration-300"
         onclick="animateCardLink(event, '#new-models')">
        <img src="{{ asset('img/talent/model3.jpg') }}" alt="{{ __('messages.talent_new') }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
        <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
          <span class="font-['Newsreader'] text-[18px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">{{ __('messages.talent_new') }}</span>
          <span class="bg-white text-black rounded-full w-[28px] h-[28px] flex items-center justify-center font-bold text-[14px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">↗</span>
        </div>
      </a>
      <p class="font-['Newsreader'] text-[26px] text-center text-gray-300 leading-relaxed fade-in">
        {{ __('messages.talent_ignite') }}
      </p>
    </div>

    <!-- Right Column -->
    <div class="flex flex-col gap-[30px]">
      <!-- Explore Models Card -->
      <a href="{{ url('/models') }}" 
         class="relative w-[280px] h-[350px] rounded-[20px] overflow-hidden stagger-item hover-lift card-link group transition-all duration-300"
         onclick="animateCardLink(event, '{{ url('/models') }}')">
        <img src="{{ asset('img/talent/model4.jpg') }}" alt="{{ __('messages.talent_explore') }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
        <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
          <span class="font-['Newsreader'] text-[18px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">{{ __('messages.talent_explore') }}</span>
          <span class="bg-white text-black rounded-full w-[28px] h-[28px] flex items-center justify-center font-bold text-[14px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">↗</span>
        </div>
      </a>
      
      <!-- Popular Card -->
      <a href="#popular-models" 
         class="relative w-[280px] h-[350px] rounded-[20px] overflow-hidden stagger-item hover-lift card-link group transition-all duration-300"
         onclick="animateCardLink(event, '#popular-models')">
        <img src="{{ asset('img/talent/model5.jpg') }}" alt="{{ __('messages.talent_popular') }}" class="w-full h-full object-cover block rounded-[20px] hover-scale" loading="lazy">
        <div class="absolute top-0 left-0 right-0 p-[15px] flex justify-between items-start">
          <span class="font-['Newsreader'] text-[18px] text-black border border-white bg-white/90 px-3 py-1 rounded z-10 max-w-[150px] leading-tight group-hover:bg-black group-hover:text-white transition-all duration-300">{{ __('messages.talent_popular') }}</span>
          <span class="bg-white text-black rounded-full w-[28px] h-[28px] flex items-center justify-center font-bold text-[14px] mt-1 transition group-hover:bg-black group-hover:text-white z-10">↗</span>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- Meet Our Talent Section Mobile -->
<section id="meet-our-talent-mobile" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h2 class="font-['Fondamento'] text-white text-[70px] text-center mb-8 fade-in">{{ __('messages.meet_talents') }}</h2>
  <div class="grid grid-cols-2 gap-4 w-full max-w-[520px] stagger-container">
  @foreach($featuredTalents as $ft)
  @if($ft->talent)
    <div class="relative w-[250px] h-[320px] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('storage/' . $ft->talent->photo) }}" alt="{{ $ft->talent->nama_model }}" class="w-full h-full object-cover hover-scale" loading="lazy">
    </div>
  @endif
@endforeach
  </div>
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <a href="{{ url('/models') }}">
      <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white hover-lift">
        {{ __('messages.find_models') }}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
      </button>
    </a>
  </div>
</section>

<!-- Meet Our Talent Section Desktop -->
<section id="meet-our-talent" class="hidden sm:block mt-[100px] bg-black fade-in">
  <div class="max-w-[1200px] mx-auto px-4">
    <h2 class="font-['Fondamento'] text-white text-[60px] text-center mb-16 fade-in">{{ __('messages.meet_talents') }}</h2>
    <div class="grid grid-cols-4 gap-8 place-items-center stagger-container">
      @foreach($ourTalents as $ht)
        <div class="relative w-[250px] h-[320px] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
          <img src="{{ asset('storage/' . $ht->image) }}" alt="Talent {{ $loop->iteration }}" class="w-full h-full object-cover hover-scale" loading="lazy">
        </div>
      @endforeach
    </div>
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
      <a href="{{ url('/models') }}">
        <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white transition duration-300 hover:bg-white hover:text-black hover-lift">
          {{ __('messages.find_models') }}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
          </svg>
        </button>
      </a>
    </div>
  </div>
</section>

<!-- Faces of Models Section Mobile -->
<section id="face-of-models" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h2 class="font-['Fondamento'] text-white text-[70px] text-center mb-8 fade-in">{{ __('messages.face_of_models') }}</h2>
    <div class="grid grid-cols-2 gap-4 w-full max-w-[520px] stagger-container">
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model1.jpg') }}" alt="Raynelle" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Raynelle</h3>
      </div>
    </div>
    
    <!-- Model Card 2 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model2.jpg') }}" alt="Aleeya" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Aleeya</h3>
      </div>
    </div>

    <!-- Model Card 3 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model3.jpg') }}" alt="Cheva" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Cheva</h3>
      </div>
    </div>

    <!-- Model Card 4 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model4.jpg') }}" alt="Kalyca" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Kalyca</h3>
      </div>
    </div>

    <!-- Model Card 5 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model5.jpg') }}" alt="Caren" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Caren</h3>
      </div>
    </div>

    <!-- Model Card 6 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model6.jpg') }}" alt="Camilla" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Camilla</h3>
      </div>
    </div>

    <!-- Model Card 7 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model7.jpg') }}" alt="Maya" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Maya</h3>
      </div>
    </div>

    <!-- Model Card 8 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model8.jpg') }}" alt="Naila" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Naila</h3>
      </div>
    </div>
  </div>

  <!-- {{ __('messages.find_models') }} Button -->
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white hover-lift">
      {{ __('messages.find_models') }}
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
      </svg>
    </button>
  </div>
</section>

<!-- Meet Our Talent Section Desktop -->
<section id="meet-our-talent" class="hidden sm:block mt-[100px] bg-black fade-in">
  <div class="max-w-[1200px] mx-auto px-4">
    <h2 class="font-['Fondamento'] text-white text-[60px] text-center mb-16 fade-in">{{ __('messages.meet_talents') }}</h2>
    <div class="grid grid-cols-4 gap-8 place-items-center stagger-container">
      @foreach($ourTalents as $ht)
        <div class="relative w-[250px] h-[320px] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
          <img src="{{ asset('storage/' . $ht->image) }}" alt="Talent {{ $loop->iteration }}" class="w-full h-full object-cover hover-scale" loading="lazy">
        </div>
      @endforeach
    </div>
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
      <a href="{{ url('/models') }}">
        <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white transition duration-300 hover:bg-white hover:text-black hover-lift">
          {{ __('messages.find_models') }}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
          </svg>
        </button>
      </a>
    </div>
  </div>
</section>

<!-- Faces of Models Section Mobile -->
<section id="face-of-models" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h2 class="font-['Fondamento'] text-white text-[70px] text-center mb-8 fade-in">{{ __('messages.face_of_models') }}</h2>
    <div class="grid grid-cols-2 gap-4 w-full max-w-[520px] stagger-container">
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model1.jpg') }}" alt="Raynelle" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Raynelle</h3>
      </div>
    </div>
    
    <!-- Model Card 2 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model2.jpg') }}" alt="Aleeya" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Aleeya</h3>
      </div>
    </div>

    <!-- Model Card 3 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model3.jpg') }}" alt="Cheva" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Cheva</h3>
      </div>
    </div>

    <!-- Model Card 4 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model4.jpg') }}" alt="Kalyca" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Kalyca</h3>
      </div>
    </div>

    <!-- Model Card 5 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model5.jpg') }}" alt="Caren" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Caren</h3>
      </div>
    </div>

    <!-- Model Card 6 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model6.jpg') }}" alt="Camilla" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Camilla</h3>
      </div>
    </div>

    <!-- Model Card 7 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model7.jpg') }}" alt="Maya" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Maya</h3>
      </div>
    </div>

    <!-- Model Card 8 -->
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/new/model8.jpg') }}" alt="Naila" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute top-3 right-3 z-10 flex items-center justify-center">
        <svg width="32" height="32" viewBox="0 0 24 24" class="w-8 h-8">
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="black"
          stroke-width="4"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M5 12h10M15 8l4 4-4 4"
          fill="none"
          stroke="white"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        </svg>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[28px] font-bold leading-none">Naila</h3>
      </div>
    </div>
  </div>

  <!-- {{ __('messages.find_models') }} Button -->
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white hover-lift">
      {{ __('messages.find_models') }}
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
      </svg>
    </button>
  </div>
</section>

<!-- New Models Section Mobile -->
<section id="new-models" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h2 class="font-['Fondamento'] text-white text-[70px] text-center mb-8 fade-in">{{ __('messages.new_models_title2') }}</h2>
  <div class="grid grid-cols-2 gap-4 w-full max-w-[520px] stagger-container" id="newModelsMobile">
      </div>
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white hover-lift">
      {{ __('messages.find_models') }}
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
      </svg>
    </button>
  </div>
</section>

<!-- New Models Section -->
<section id="new-models" class="hidden sm:block mt-[100px] bg-black fade-in">
  <div class="max-w-[1200px] mx-auto px-4">
    <h2 class="font-['Fondamento'] text-white text-[60px] text-center mb-16 fade-in">{{ __('messages.new_models_title2') }}</h2>
    <div class="grid grid-cols-4 gap-8 place-items-center stagger-container" id="newModelsDesktop">
    </div>
    <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <a href="{{ url('/models') }}">
    <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white transition duration-300 hover:bg-white hover:text-black hover-lift">
    {{ __('messages.find_models') }}
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
    </svg>
    </button>
    </a>
  </div>
</section>

<script>
function renderNewModels(models, target, isMobile) {
  let html = '';
  if (!models.length) {
    html = '<div class="col-span-full text-center text-gray-400 fade-in">No new models found.</div>';
  } else {
    models.forEach((model, index) => {
      // Ambil nama depan saja
      let firstName = model.nama_model ? model.nama_model.split(' ')[0] : '';
      html += `<div class="relative ${isMobile ? 'w-full aspect-[5/7]' : 'w-[250px] h-[320px]'} rounded-[20px] overflow-hidden bg-neutral-800 flex flex-col items-center justify-end stagger-item hover-lift">
        <img src="${model.photo ? '/storage/' + model.photo : '/img/models_list/jasmine.png'}" alt="${firstName}" class="w-full h-full object-cover hover-scale" loading="lazy">
        <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
          <h3 class="text-[22px] font-bold leading-none">${firstName}</h3>
        </div>
      </div>`;
    });
  }
  document.getElementById(target).innerHTML = html;
  
  // Trigger stagger animation for newly added items
  const container = document.getElementById(target);
  const items = container.querySelectorAll('.stagger-item');
  items.forEach((item, index) => {
    setTimeout(() => {
      item.classList.add('visible');
    }, index * 100);
  });
}
fetch('/api/new-models')
  .then(res => res.json())
  .then(models => {
    renderNewModels(models, 'newModelsMobile', true);
    renderNewModels(models, 'newModelsDesktop', false);
  });
</script>

<!-- Popular Models Section Mobile -->
<section id="popular-models" class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h2 class="font-['Fondamento'] text-white text-[70px] text-center mb-8 fade-in">{{ __('messages.new_popular_title2') }}</h2>
  <div class="grid grid-cols-2 gap-4 w-full max-w-[520px] stagger-container">
    <div class="relative w-full aspect-[5/7] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
      <img src="{{ asset('img/models/model1.png') }}" alt="Aisyah" class="w-full h-full object-cover hover-scale" loading="lazy">
      <div class="absolute bottom-0 left-0 right-0 p-4">
        <p class="font-['Newsreader'] text-[18px] text-black">Aisyah</p>
      </div>
    </div>
    @for ($i = 0; $i < 7; $i++)
      <div class="w-full aspect-[5/7] rounded-[20px] bg-[#D9D9D9] stagger-item hover-lift"></div>
    @endfor
  </div>
  <div class="flex justify-center mt-8 mb-12 w-full fade-in">
    <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white hover-lift">
      {{ __('messages.find_models') }}
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
      </svg>
    </button>
  </div>
</section>

<!-- Popular Talent Section Desktop -->
<section id="popular-models" class="hidden sm:block mt-[100px] bg-black fade-in">
  <div class="max-w-[1200px] mx-auto px-4">
    <h2 class="font-['Fondamento'] text-white text-[60px] text-center mb-16 fade-in">{{ __('messages.new_popular_title2') }}</h2>

    <div class="grid grid-cols-4 gap-8 place-items-center stagger-container">
      @foreach($popularTalents as $pt)
        <div class="relative w-[250px] h-[320px] rounded-[20px] overflow-hidden bg-neutral-800 stagger-item hover-lift">
          <img src="{{ asset('storage/' . $pt->image) }}" alt="Popular Talent {{ $loop->iteration }}" class="w-full h-full object-cover hover-scale" loading="lazy">
        </div>
      @endforeach
    </div>

    <div class="flex justify-center mt-8 mb-12 w-full fade-in">
      <a href="{{ url('/models') }}">
        <button class="flex items-center gap-2 bg-transparent border border-white rounded-full px-6 py-3 text-white transition duration-300 hover:bg-white hover:text-black hover-lift">
          {{ __('messages.find_models') }}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
          </svg>
        </button>
      </a>
    </div>
  </div>
</section>


<!-- Benefits Section -->
<section class="hidden sm:block mt-[160px] bg-black fade-in">
  <div class="max-w-[1200px] mx-auto px-4">
    <!-- Title & Tabs -->
    <div class="text-center mb-16">
      <h2 class="font-['Fondamento'] text-white text-[70px] mb-8 fade-in">{{ __('messages.benefits_title') }}</h2>
      <div class="flex justify-center gap-8 text-[30px] fade-in">
        <button onclick="showBenefits('clients')" id="clientsTab" class="text-white opacity-100 transition-opacity duration-300">{{ __('messages.benefits_clients') }}</button>
        <button onclick="showBenefits('models')" id="modelsTab" class="text-white opacity-40 transition-opacity duration-300">{{ __('messages.benefits_models') }}</button>
      </div>
    </div>

    <!-- Benefits Grid untuk Clients -->
    <div id="clientsBenefits" class="grid grid-cols-3 gap-8 fade-in">
      <!-- Client Card 1 -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FF4E4E] rounded-full w-[45px] h-[45px] flex items-center justify-center">01</span>
        </div>
        <div class="text-sm leading-relaxed text-black list-disc pl-4 space-y-2 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_1') }}
        </li>
        <li>{{ __('messages.benefits_clients_1b') }}
        </li>
        </div>
      </div>

      <!-- Client Card 2 -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#00C2FF] rounded-full w-[45px] h-[45px] flex items-center justify-center">02</span>
        </div>
        <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_2') }}</li>
        </ul>
      </div>

      <!-- Client Card 3 -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FFB800] rounded-full w-[45px] h-[45px] flex items-center justify-center">03</span>
        </div>
        <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_3') }}</li>
        </ul>
      </div>

      <!-- Client Card 4 -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FF00B8] rounded-full w-[45px] h-[45px] flex items-center justify-center">04</span>
        </div>
        <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_4') }}</li>
        </ul>
      </div>

      <!-- Client Card 5 -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#B800FF] rounded-full w-[45px] h-[45px] flex items-center justify-center">05</span>
        </div>
        <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
          <li>{{ __('messages.benefits_clients_5') }}</li>
        </ul>
      </div>

      <!-- Client Card 6 - Perbaiki struktur yang salah -->
      <div class="bg-white rounded-[20px] p-4">
        <div class="flex items-center gap-4 mb-4">
          <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#00FFB8] rounded-full w-[45px] h-[45px] flex items-center justify-center">06</span>
        </div>
        <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
          <li>{{ __('messages.benefits_clients_6') }}</li>
        </ul>
      </div>
    </div>

    <!-- Benefits Grid untuk Models -->
    <div id="modelsBenefits" class="hidden fade-in">
      <!-- Top Row -->
      <div class="grid grid-cols-3 gap-8 mb-8 fade-in">
        <!-- Model Card 1 -->
        <div class="bg-white rounded-[20px] p-4">
          <div class="flex items-center gap-4 mb-4">
            <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FF4E4E] rounded-full w-[45px] h-[45px] flex items-center justify-center">01</span>
          </div>
          <ul class="text-sm leading-relaxed text-black list-disc pl-4 space-y-2 font-semibold fade-in">
            <li>{{ __('messages.benefits_models_1') }}</li>
            <li>{{ __('messages.benefits_models_1b') }}</li>
          </ul>
        </div>

        <!-- Model Card 2 -->
        <div class="bg-white rounded-[20px] p-4">
          <div class="flex items-center gap-4 mb-4">
            <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#00C2FF] rounded-full w-[45px] h-[45px] flex items-center justify-center">02</span>
          </div>
          <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
            <li>{{ __('messages.benefits_models_2') }}</li>
          </ul>
        </div>

        <!-- Model Card 3 -->
        <div class="bg-white rounded-[20px] p-4">
          <div class="flex items-center gap-4 mb-4">
            <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FFB800] rounded-full w-[45px] h-[45px] flex items-center justify-center">03</span>
          </div>
          <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
            <li>{{ __('messages.benefits_models_3') }}</li>
            <li>{{ __('messages.benefits_models_3b') }}</li>
          </ul>
        </div>
      </div>

      <!-- Bottom Row - Centered -->
      <div class="flex justify-center gap-8 fade-in">
        <!-- Model Card 4 -->
        <div class="bg-white rounded-[20px] p-4 w-[384px] fade-in"> <!-- Width sama dengan card di atas (1/3 dari total - gap) -->
          <div class="flex items-center gap-4 mb-4">
            <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#FF00B8] rounded-full w-[45px] h-[45px] flex items-center justify-center">04</span>
          </div>
          <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
            <li>{{ __('messages.benefits_models_4') }}</li>
          </ul>
        </div>

        <!-- Model Card 5 -->
        <div class="bg-white rounded-[20px] p-4 w-[384px] fade-in">
          <div class="flex items-center gap-4 mb-4">
            <span class="font-['Newsreader'] text-[24px] font-bold text-black border border-[#B800FF] rounded-full w-[45px] h-[45px] flex items-center justify-center">05</span>
          </div>
          <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
            <li>{{ __('messages.benefits_models_5') }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Benefits Section Mobile -->
<section class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <!-- Judul -->
  <h2 class="font-['Fondamento'] text-white text-[70px] mb-8 text-center fade-in">{{ __('messages.benefits_title') }}</h2>
  <!-- Tabs -->
  <div class="flex justify-center gap-4 mb-6 fade-in">
    <button id="mobileClientsTab" class="text-white text-[22px] font-bold opacity-100 border-b-2 border-white px-3 py-1 transition">{{ __('messages.benefits_clients') }}</button>
    <button id="mobileModelsTab" class="text-white text-[22px] font-bold opacity-40 border-b-2 border-transparent px-3 py-1 transition">{{ __('messages.benefits_models') }}</button>
  </div>
  <!-- Clients Benefits -->
  <div id="mobileClientsBenefits" class="flex flex-col gap-4 w-full max-w-[400px] fade-in">
    <!-- Client Card 1 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FF4E4E] rounded-full w-[38px] h-[38px] flex items-center justify-center">01</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 space-y-1 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_1') }}</li>
        <li>{{ __('messages.benefits_clients_1b') }}</li>
      </ul>
    </div>
    <!-- Client Card 2 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#00C2FF] rounded-full w-[38px] h-[38px] flex items-center justify-center">02</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_2') }}</li>
      </ul>
    </div>
    <!-- Client Card 3 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FFB800] rounded-full w-[38px] h-[38px] flex items-center justify-center">03</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_3') }}</li>
      </ul>
    </div>
    <!-- Client Card 4 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FF00B8] rounded-full w-[38px] h-[38px] flex items-center justify-center">04</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_4') }}</li>
      </ul>
    </div>
    <!-- Client Card 5 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#B800FF] rounded-full w-[38px] h-[38px] flex items-center justify-center">05</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_5') }}</li>
      </ul>
    </div>
    <!-- Client Card 6 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#00FFB8] rounded-full w-[38px] h-[38px] flex items-center justify-center">06</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_clients_6') }}</li>
      </ul>
    </div>
  </div>
  <!-- Models Benefits -->
  <div id="mobileModelsBenefits" class="flex flex-col gap-4 w-full max-w-[400px] hidden fade-in">
    <!-- Model Card 1 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FF4E4E] rounded-full w-[38px] h-[38px] flex items-center justify-center">01</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 space-y-1 font-semibold fade-in">
        <li>{{ __('messages.benefits_models_1') }}</li>
        <li>{{ __('messages.benefits_models_1b') }}</li>
      </ul>
    </div>
    <!-- Model Card 2 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#00C2FF] rounded-full w-[38px] h-[38px] flex items-center justify-center">02</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_models_2') }}</li>
      </ul>
    </div>
    <!-- Model Card 3 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FFB800] rounded-full w-[38px] h-[38px] flex items-center justify-center">03</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_models_3') }}</li>
        <li>{{ __('messages.benefits_models_3b') }}</li>
      </ul>
    </div>
    <!-- Model Card 4 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#FF00B8] rounded-full w-[38px] h-[38px] flex items-center justify-center">04</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_models_4') }}</li>
      </ul>
    </div>
    <!-- Model Card 5 -->
    <div class="bg-white rounded-[20px] p-4">
      <div class="flex items-center gap-4 mb-2">
        <span class="font-['Newsreader'] text-[20px] font-bold text-black border border-[#B800FF] rounded-full w-[38px] h-[38px] flex items-center justify-center">05</span>
      </div>
      <ul class="text-sm leading-relaxed text-black list-disc pl-4 font-semibold fade-in">
        <li>{{ __('messages.benefits_models_5') }}</li>
      </ul>
    </div>
  </div>
</section>

<!-- Become a Model Section Mobile -->
<section class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <!-- Judul -->
  <h1 class="font-['Fondamento'] text-[70px] text-center mb-4 fade-in">{{ __('messages.become_model_title') }}</h1>
  <!-- Gambar -->
  <div class="w-full max-w-[320px] mb-4">
    <img src="{{ asset('img/becomeamodel.png') }}" alt="Model Image" class="w-full h-auto rounded-[20px] shadow-lg hover-scale" loading="lazy">
  </div>
  <!-- Deskripsi -->
  <div class="text-[15px] text-center text-white mb-4 leading-[1.8] slide-in-left">
    {{ __('messages.become_model_description') }} <br>
    {{ __('messages.become_model_description2') }}
  </div>
  <!-- Button -->
  <a href="{{ url('/joinacademy') }}" class="flex items-center justify-center border border-white rounded-full pl-8 pr-2 py-2 mt-2 w-[300px] h-[50px] group transition-colors duration-300 bg-black hover-lift slide-in-left">
    <span class="text-white text-lg tracking-wide flex-1">{{ __('messages.join_now') }}</span>
    <span class="bg-white rounded-full w-10 h-10 flex items-center justify-center transition group-hover:bg-black ml-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l7-7m0 0v6m0-6H9" transform="rotate(45 12 12)" />
      </svg>
    </span>
  </a>
</section>

<!-- Become a Model Section -->
<section class="hidden sm:flex mt-[200px] flex h-screen fade-in">
  <!-- Left Panel -->
  <div class="w-1/2 px-[60px] py-[80px] flex flex-col justify-center bg-black">
    <h1 class="font-['Fondamento'] text-[60px] leading-tight mb-[30px] slide-in-left">
      {{ __('messages.become_model_title') }}
    </h1>
    <p class="text-[15px] mb-[20px] leading-[1.8] slide-in-left">
      {{ __('messages.become_model_description') }}
    </p>
    <p class="text-[15px] mb-[20px] leading-[1.8] slide-in-left">
      {{ __('messages.become_model_description2') }}
    </p>
    <a href="{{ url('/joinacademy') }}" class="flex items-center border border-white rounded-full pl-8 pr-2 py-2 mt-5 w-[250px] h-[60px] group transition-colors duration-300 bg-black hover-lift slide-in-left">
      <span class="text-white text-lg tracking-wide flex-1">{{ __('messages.join_now') }}</span>
      <span class="bg-white rounded-full w-12 h-12 flex items-center justify-center transition group-hover:bg-black ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-black group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l7-7m0 0v6m0-6H9" transform="rotate(45 12 12)" />
        </svg>
      </span>
    </a>
  </div>

  <!-- Right Panel -->
  <div class="w-1/2 overflow-hidden">
    <img src="{{ asset('img/becomeamodel.png') }}" alt="Model Image" class="w-full h-full object-cover">
  </div>
</section>

<!-- Hire Models Section Mobile -->
<section class="sm:hidden flex flex-col items-center bg-black px-4 pt-10 fade-in">
  <h1 class="font-['Fondamento'] text-[70px] text-center mb-2 text-white leading-none fade-in">{{ __('messages.hire_models_title') }}</h1>
  <p class="text-[16px] text-center text-white leading-relaxed mb-8 fade-in">
    {{ __('messages.hire_models_description') }}
  </p>
  <div class="grid grid-cols-2 gap-4 w-full max-w-[440px] stagger-container">
    <!-- Card 1 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Fathia.jpg') }}" alt="Fathia" class="w-full h-full object-cover hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Fathia</h3>
        <p class="text-[12px] leading-none">Bogor</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 2 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Naila.jpg') }}" alt="Naila" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Naila</h3>
        <p class="text-[12px] leading-none">Bogor</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 3 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Rara.jpg') }}" alt="Rara" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Rara</h3>
        <p class="text-[12px] leading-none">Depok</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 4 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Nazwa.jpg') }}" alt="Nazwa" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Nazwa</h3>
        <p class="text-[12px] leading-none">Jakarta</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 5 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Afia.jpg') }}" alt="Afia" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Afia</h3>
        <p class="text-[12px] leading-none">Bogor</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 6 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Nikita.jpg') }}" alt="Nikita" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Nikita</h3>
        <p class="text-[12px] leading-none">Jakarta</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 7 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Raynelle.jpg') }}" alt="Raynelle" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Raynelle</h3>
        <p class="text-[12px] leading-none">Jakarta</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 8 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Michelle.jpg') }}" alt="Michelle" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Michelle</h3>
        <p class="text-[12px] leading-none">Bogor</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 9 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/BabyEyin.jpg') }}" alt="BabyEyin" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Baby Eyin</h3>
        <p class="text-[12px] leading-none">Jakarta</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
    <!-- Card 10 -->
    <div class="relative w-full aspect-[5/7] rounded-[16px] bg-white shadow-lg overflow-hidden stagger-item hover-lift">
      <img src="{{ asset('img/hiremodel/Alexa.jpg') }}" alt="Alexa" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
      <div class="absolute top-3 right-3 z-10">
        <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
      </div>
      <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
        <h3 class="text-[18px] font-bold leading-none">Alexa</h3>
        <p class="text-[12px] leading-none">Jakarta</p>
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-white/0 to-white/0"></div>
    </div>
  </div>
  <p class="mt-8 text-center text-white underline cursor-pointer text-[16px] fade-in">{{ __('messages.see_more') }}</p>
</section>

<!-- Hire Models Section -->
<section class="hidden sm:block py-20 px-4 bg-black fade-in">
  <h1 class="font-['Fondamento'] text-[56px] text-center mb-2 text-white leading-none fade-in">{{ __('messages.hire_models_title') }}</h1>
  <p class="text-[18px] text-center text-white leading-relaxed mb-12 fade-in">
    {{ __('messages.hire_models_description') }}
  </p>

  <div class="flex flex-col items-center">
    @foreach($hireModels->chunk(5) as $rowIndex => $chunk)
    <div class="flex flex-row gap-8 {{ $rowIndex % 2 === 0 ? 'md:mr-20 mr-10' : 'md:ml-20 ml-10' }} stagger-container">
        @foreach($chunk as $hireModels)
          <div class="relative w-[200px] h-[260px] rounded-[16px] bg-white shadow-lg overflow-hidden flex flex-col justify-between stagger-item hover-lift">
            <img src="{{ asset('storage/' . $hireModels->photo) }}" alt="{{ $hireModels->name }}" class="w-full h-full object-cover absolute inset-0 hover-scale" loading="lazy" />
            <div class="absolute top-3 right-3 z-10">
      <a href="{{ url('/portofolio/' . $hireModels->id_model) }}"
                <span class="flex items-center justify-center text-black text-xl font-bold">➝</span>
              </a>
            </div>
            <div class="absolute left-3 bottom-3 z-10 font-['Newsreader'] text-black text-left">
            <h3 class="text-[22px] font-bold leading-none" style="text-shadow: 0 0 4px #fff, 0 0 2px #fff;">
    {{ explode(' ', $hireModels->nama_model)[0] }}
</h3>
<p class="text-[13px] leading-none">
    {{ explode(',', $hireModels->city)[0] }}
</p>

            </div>
          </div>
        @endforeach
      </div>
    @endforeach

    <a href="{{ url('/models') }}">
  <p class="mt-10 text-center text-white underline cursor-pointer text-[16px] fade-in">
    {{ __('messages.see_more') }}
  </p>
</a>

  </div>
</section>

<!-- Why Choose Us Section -->
<section class="hidden sm:block px-[120px] py-[80px] w-full min-h-screen bg-black fade-in">
  <!-- Title -->
  <h2 class="text-white text-[64px] text-center mb-16 font-['Fondamento'] fade-in">{{ __('messages.why_choose_us_title') }}</h2>
  
  <div class="flex">
    <!-- Left Side -->
    <div class="w-1/2 border-r border-white">
      <!-- Box 1 -->
      <div class="p-8 flex flex-col border-b border-white">
        <div class="w-[80px] h-[80px] rounded-full bg-[#FF4E4E] text-white text-center font-bold text-4xl leading-[80px] mb-4 fade-in">
          1
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_1') }}</h3>
          <p class="text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_1b') }}
          </p>
        </div>
      </div>

      <!-- Box 2 -->
      <div class="p-8 flex flex-col border-b border-white">
        <div class="w-[80px] h-[80px] rounded-full bg-[#9C27B0] text-white text-center font-bold text-4xl leading-[80px] mb-4 fade-in">
          3
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_3') }}</h3>
          <p class="text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_3b') }}
          </p>
        </div>
      </div>

      <!-- Box 3 -->
      <div class="p-8 flex flex-col">
        <div class="w-[80px] h-[80px] rounded-full bg-[#2196F3] text-white text-center font-bold text-4xl leading-[80px] mb-4 fade-in">
          5
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_5') }}</h3>
          <p class="text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_5b') }}
          </p>
        </div>
      </div>
    </div>

    <!-- Right Side -->
    <div class="w-1/2 mt-24">
      <!-- Box 2 -->
      <div class="h-[300px] p-8 border-b border-white">
        <div class="w-[80px] h-[80px] rounded-full bg-[#00BCD4] text-white text-center font-bold text-4xl leading-[80px] fade-in">
          2
        </div>
        <h3 class="text-2xl font-semibold text-white mt-4 fade-in">{{ __('messages.why_choose_us_2') }}</h3>
        <p class="text-base text-gray-300 mt-2 w-[500px] fade-in">
          {{ __('messages.why_choose_us_2b') }}
        </p>
      </div>

      <!-- Box 4 -->
      <div class="h-[300px] p-8">
        <div class="w-[80px] h-[80px] rounded-full bg-[#FF9800] text-white text-center font-bold text-4xl leading-[80px] fade-in">
          4
        </div>
        <h3 class="text-2xl font-semibold text-white mt-4 fade-in">{{ __('messages.why_choose_us_4') }}</h3>
        <p class="text-base text-gray-300 mt-2 w-[500px] fade-in">
          {{ __('messages.why_choose_us_4b') }}
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us Section Mobile-->
<section class="sm:hidden px-6 sm:px-[120px] py-[80px] w-full min-h-screen bg-black fade-in">
  <!-- Title -->
  <h2 class="text-white text-[70px] sm:text-[64px] text-center mb-12 sm:mb-16 font-['Fondamento'] fade-in">{{ __('messages.why_choose_us_title') }}</h2>
  
  <div class="flex flex-col sm:flex-row">
    <!-- Left Side -->
    <div class="w-full sm:w-1/2 border-b sm:border-b-0 sm:border-r border-white">
      <!-- Box 1 -->
      <div class="p-6 sm:p-8 flex flex-col border-b border-white">
        <div class="w-[64px] h-[64px] sm:w-[80px] sm:h-[80px] rounded-full bg-[#FF4E4E] text-white text-center font-bold text-3xl sm:text-4xl leading-[64px] sm:leading-[80px] mb-4 fade-in">
          1
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-lg sm:text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_1') }}</h3>
          <p class="text-sm sm:text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_1b') }}
          </p>
        </div>
      </div>

      <!-- Box 2 -->
      <div class="p-6 sm:p-8 border-b border-white">
        <div class="w-[64px] h-[64px] sm:w-[80px] sm:h-[80px] rounded-full bg-[#00BCD4] text-white text-center font-bold text-3xl sm:text-4xl leading-[64px] sm:leading-[80px] mb-4 fade-in">
          2
        </div>
        <h3 class="text-lg sm:text-2xl font-semibold text-white mt-4 fade-in">{{ __('messages.why_choose_us_2') }}</h3>
        <p class="text-sm sm:text-base text-gray-300 mt-2 sm:w-[500px] fade-in">
          {{ __('messages.why_choose_us_2b') }}
        </p>
      </div>

      <!-- Box 3 -->
      <div class="p-6 sm:p-8 flex flex-col border-b border-white">
        <div class="w-[64px] h-[64px] sm:w-[80px] sm:h-[80px] rounded-full bg-[#9C27B0] text-white text-center font-bold text-3xl sm:text-4xl leading-[64px] sm:leading-[80px] mb-4 fade-in">
          3
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-lg sm:text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_3') }}</h3>
          <p class="text-sm sm:text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_3b') }}
          </p>
        </div>
      </div>

      

    <!-- Right Side -->
    <div class="w-full sm:w-1/2">

    
      <!-- Box 4 -->
      <div class="p-6 sm:p-8">
        <div class="w-[64px] h-[64px] sm:w-[80px] sm:h-[80px] rounded-full bg-[#FF9800] text-white text-center font-bold text-3xl sm:text-4xl leading-[64px] sm:leading-[80px] mb-4 fade-in">
          4
        </div>
        <h3 class="text-lg sm:text-2xl font-semibold text-white mt-4 fade-in">{{ __('messages.why_choose_us_4') }}</h3>
        <p class="text-sm sm:text-base text-gray-300 mt-2 sm:w-[500px] fade-in">
          {{ __('messages.why_choose_us_4b') }}
        </p>
      </div>
    </div>
  </div>
  <!-- Box 5 -->
  <div class="p-6 sm:p-8 flex flex-col">
        <div class="w-[64px] h-[64px] sm:w-[80px] sm:h-[80px] rounded-full bg-[#2196F3] text-white text-center font-bold text-3xl sm:text-4xl leading-[64px] sm:leading-[80px] mb-4 fade-in">
          5
        </div>
        <div class="flex flex-col gap-2">
          <h3 class="text-lg sm:text-xl font-semibold text-white fade-in">{{ __('messages.why_choose_us_5') }}</h3>
          <p class="text-sm sm:text-base text-gray-300 leading-relaxed fade-in">
            {{ __('messages.why_choose_us_5b') }}
          </p>
        </div>
      </div>
</section>


<!-- Contact Section -->
<section class="hidden sm:flex flex-col items-center justify-center min-h-screen bg-black relative py-24 fade-in">
  <div class="flex items-center justify-center w-full">
    <!-- CONTACT (vertical) -->
    <div class="flex flex-col items-center justify-center h-[400px] z-20">
      <span class="font-fondamento text-white text-[110px] tracking-wider slide-in-left" style="writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.1em;">{{ __('messages.contact') }}</span>
    </div>
    <!-- Image -->
    <div class="mx-6 z-10">
      <img src="{{ asset('img/contact-model.png') }}" alt="Contact Model" class="w-[510px] h-[643px] object-cover rounded-[20px] bg-gray-200 scale-in hover-scale" loading="lazy" />
    </div>
    <!-- US -->
    <div class="flex items-end h-[700px] z-20">
      <span class="font-fondamento text-white text-[110px] tracking-wider slide-in-right">{{ __('messages.us') }}</span>
    </div>
  </div>
  <!-- Card -->
  <div class="mt-4 bg-[#C4C4C4] rounded-[30px] shadow-lg w-[1000px] max-w-full px-12 py-8 flex flex-col items-center z-30 fade-in">
    <h2 class="font-fondamento text-black text-[50px] text-center mb-2 fade-in">{{ __('messages.where_dreams_walk_the_runway') }}</h2>
    <p class="text-center text-gray-700 mb-6 text-[16px] max-w-[600px] fade-in">{{ __('messages.from_photoshoot_to_runway_coaching') }}</p>
    <div class="flex w-full items-center gap-4">
      <span class="font-bold text-black text-[32px] fade-in">{{ __('messages.join_the_movement') }}</span>
      <div class="flex flex-1 items-center rounded-[20px] px-2 py-2" style="background-color: rgba(59,56,62,0.08);">
        <input type="text" placeholder="No. WhatsApp" class="flex-1 bg-transparent outline-none px-4 text-white text-[16px] placeholder-white fade-in" />
        <a
          href="https://wa.me/6281219762427?text=Saya%20ingin%20berkolaborasi%20dengan%20Academy%20Next%20Top%20Model"
          target="_blank"
          class="bg-[#30B0C7] text-black rounded-[20px] px-8 py-2 ml-4 text-[16px] font-semibold flex items-center justify-center fade-in hover-lift"
        >
          {{ __('messages.lets_collaborate') }}
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section Mobile -->
<section class="sm:hidden flex flex-col items-center justify-center min-h-screen bg-black relative py-24 fade-in">
  <div class="flex items-center justify-center w-full">
    <!-- CONTACT (vertical) -->
    <div class="flex flex-col items-center justify-center h-[400px] z-20">
      <span class="font-fondamento text-white text-[110px] tracking-wider slide-in-left" style="writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.1em;">CONTACT</span>
    </div>
    <!-- Image -->
    <div class="mx-6 z-10">
      <img src="{{ asset('img/contact-model.png') }}" alt="Contact Model" class="w-[510px] h-[643px] object-cover rounded-[20px] bg-gray-200 scale-in hover-scale" loading="lazy" />
    </div>
    <!-- US -->
    <div class="flex items-end h-[700px] z-20">
      <span class="font-fondamento text-white text-[110px] tracking-wider slide-in-right">US</span>
    </div>
  </div>

  <!-- Card -->
  <div class="mt-4 bg-[#C4C4C4] rounded-[30px] shadow-lg w-[420px] h-[400px] px-6 sm:px-12 py-8 flex flex-col items-center z-30 fade-in">

    <h2 class="font-fondamento text-black text-[40px] text-center mb-2 fade-in">{{ __('messages.where_dreams_walk_the_runway') }}</h2>
    <p class="text-center text-gray-700 mb-6 text-[14px] max-w-[600px] fade-in">{{ __('messages.from_photoshoot_to_runway_coaching') }}</p>
    <div class="flex flex-col sm:flex-row w-full items-center gap-4">
      <span class="font-bold text-black text-[18px] text-center sm:text-left fade-in">{{ __('messages.join_the_movement') }}</span>
      <div class="flex flex-1 items-center rounded-[20px] px-2 py-2" style="background-color: rgba(59,56,62,0.08);">
        <input type="text" placeholder="No.WhatsApp" class="flex-1 bg-transparent outline-none text-white text-[16px] placeholder-white fade-in" />
        <a
          href="https://wa.me/6281219762427?text=Saya%20ingin%20berkolaborasi%20dengan%20Academy%20Next%20Top%20Model"
          target="_blank"
          class="bg-[#30B0C7] text-black rounded-[20px] px-8 py-2 ml-4 text-[16px] font-semibold flex items-center justify-center fade-in hover-lift"
        >
          {{ __('messages.lets_collaborate') }}
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="w-full bg-white py-3 flex justify-between items-center px-8 text-black text-[16px] font-['Newsreader'] fade-in">
  <span>{{ __('messages.footer')}}</span>
  <span>{{ __('messages.instagram') }}</span>
</footer>

<script>
function showBenefits(type) {
  const clientsTab = document.getElementById('clientsTab');
  const modelsTab = document.getElementById('modelsTab');
  const clientsBenefits = document.getElementById('clientsBenefits');
  const modelsBenefits = document.getElementById('modelsBenefits');

  if (type === 'clients') {
    clientsTab.classList.remove('opacity-40');
    clientsTab.classList.add('opacity-100');
    modelsTab.classList.remove('opacity-100');
    modelsTab.classList.add('opacity-40');
    clientsBenefits.classList.remove('hidden');
    modelsBenefits.classList.add('hidden');
  } else {
    modelsTab.classList.remove('opacity-40');
    modelsTab.classList.add('opacity-100');
    clientsTab.classList.remove('opacity-100');
    clientsTab.classList.add('opacity-40');
    modelsBenefits.classList.remove('hidden');
    clientsBenefits.classList.add('hidden');
  }
}

  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileLinks = mobileMenu.querySelectorAll('a');

  let menuOpen = false;
  hamburgerBtn.addEventListener('click', function() {
    menuOpen = !menuOpen;
    if (menuOpen) {
      mobileMenu.classList.remove('max-h-0', 'pointer-events-none', 'py-0', 'px-0');
      mobileMenu.classList.add('max-h-[600px]', 'py-4', 'px-6');
    } else {
      mobileMenu.classList.add('max-h-0', 'pointer-events-none', 'py-0', 'px-0');
      mobileMenu.classList.remove('max-h-[600px]', 'py-4', 'px-6');
    }
  });

  // Tutup menu saat link diklik
  mobileLinks.forEach(link => {
    link.addEventListener('click', function() {
      menuOpen = false;
      mobileMenu.classList.add('max-h-0', 'pointer-events-none', 'py-0', 'px-0');
      mobileMenu.classList.remove('max-h-[600px]', 'py-4', 'px-6');
    });
  });

  // Toggle Benefits Mobile
  const mobileClientsTab = document.getElementById('mobileClientsTab');
  const mobileModelsTab = document.getElementById('mobileModelsTab');
  const mobileClientsBenefits = document.getElementById('mobileClientsBenefits');
  const mobileModelsBenefits = document.getElementById('mobileModelsBenefits');

  if (mobileClientsTab && mobileModelsTab) {
    mobileClientsTab.addEventListener('click', function() {
      mobileClientsTab.classList.add('opacity-100', 'border-white');
      mobileClientsTab.classList.remove('opacity-40', 'border-transparent');
      mobileModelsTab.classList.remove('opacity-100', 'border-white');
      mobileModelsTab.classList.add('opacity-40', 'border-transparent');
      mobileClientsBenefits.classList.remove('hidden');
      mobileModelsBenefits.classList.add('hidden');
    });
    mobileModelsTab.addEventListener('click', function() {
      mobileModelsTab.classList.add('opacity-100', 'border-white');
      mobileModelsTab.classList.remove('opacity-40', 'border-transparent');
      mobileClientsTab.classList.remove('opacity-100', 'border-white');
      mobileClientsTab.classList.add('opacity-40', 'border-transparent');
      mobileModelsBenefits.classList.remove('hidden');
      mobileClientsBenefits.classList.add('hidden');
    });
  }
</script>
</body>
</html>

