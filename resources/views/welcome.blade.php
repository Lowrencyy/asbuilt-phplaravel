<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TelcoVantage Philippines</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
  <style>
    /* ── Splide custom theme ── */
    .splide__arrow {
      background: #fff;
      border: 2px solid #d1d5db;
      width: 2.25rem;
      height: 2.25rem;
      opacity: 1;
      transition: border-color .2s, color .2s;
    }
    .splide__arrow:hover { border-color: #00754A; }
    .splide__arrow svg  { fill: #374151; width: 1rem; height: 1rem; }
    .splide__arrow:hover svg { fill: #00754A; }

    /* Push pagination below the cards */
    #projects-splide { padding-bottom: 3rem !important; }
    .splide__pagination {
      bottom: 0.25rem;
      gap: 6px;
    }
    .splide__pagination__page {
      background: #d1d5db;
      width: 8px; height: 8px;
      margin: 0;
      opacity: 1;
      transition: background .2s, width .2s;
    }
    .splide__pagination__page.is-active {
      background: #00754A;
      width: 24px;
      border-radius: 4px;
      transform: none;
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#00754A',
            'primary-dark': '#005a38',
            'primary-light': '#00996a',
            secondary: '#0046FF',
            'secondary-dark': '#0035cc',
            'bg-light': '#f0f0f0',
          },
          fontFamily: {
            sans: ['Inter', 'Segoe UI', 'sans-serif'],
          },
        },
      },
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    html { scroll-behavior: smooth; }

    /* Mobile menu slide animation */
    #mobile-menu {
      transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1), opacity 0.3s ease;
      max-height: 0; opacity: 0; overflow: hidden;
    }
    #mobile-menu.open { max-height: 500px; opacity: 1; }

    /* Active nav underline */
    .nav-link { position: relative; padding-bottom: 2px; }
    .nav-link::after {
      content: '';
      position: absolute; left: 0; bottom: -2px;
      width: 0; height: 2px;
      background: #00754A;
      transition: width 0.25s ease;
    }
    .nav-link:hover::after,
    .nav-link.active::after { width: 100%; }

    /* Hero logo 3D placeholder shimmer */
    .placeholder-shimmer {
      background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 30%, #81c784 60%, #a5d6a7 100%);
    }
  </style>
</head>
<body class="font-sans bg-bg-light text-gray-900 antialiased">

  <!-- ===========================
       NAVIGATION
  =========================== -->
  <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 lg:h-20">

        <!-- Logo -->
        <a href="#home" class="flex items-center gap-2 flex-shrink-0">
          <img
            src="assets/images/logo-dark.png"
            alt="TelcoVantage Philippines Logo"
            class="h-9 lg:h-11 w-auto"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <!-- Fallback text logo -->
          <div class="hidden flex-col leading-tight">
            <span class="text-sm font-black tracking-wider text-gray-900">TELCOVANTAGE</span>
            <span class="text-[9px] tracking-[0.25em] text-gray-400 uppercase">Philippines</span>
          </div>
        </a>

        <!-- Desktop Nav Links — centered -->
        <ul class="hidden lg:flex items-center gap-8 text-sm font-medium text-gray-700">
          <li><a href="#home"     class="nav-link text-gray-800 hover:text-primary transition-colors">Home</a></li>
          <li><a href="#about"          class="nav-link text-gray-800 hover:text-primary transition-colors">About Us</a></li>
          <li><a href="#mission-vision" class="nav-link text-gray-800 hover:text-primary transition-colors">Mission &amp; Vision</a></li>
          <li><a href="#services"       class="nav-link text-gray-800 hover:text-primary transition-colors">Services</a></li>
          <li><a href="#projects" class="nav-link text-gray-800 hover:text-primary transition-colors">Our Projects</a></li>
          <li><a href="#contact"  class="nav-link text-gray-800 hover:text-primary transition-colors">Contact Us</a></li>
        </ul>

        <!-- Right side: LOGIN + hamburger -->
        <div class="flex items-center gap-3">
          <!-- Login button — visible on md+ -->
          <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-1.5 px-5 py-2 rounded-full bg-primary text-black text-sm font-semibold hover:bg-primary-dark transition-colors shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3"/>
            </svg>
            LOGIN
          </a>

          <!-- Hamburger — visible below lg -->
          <button id="menu-btn" aria-label="Toggle menu"
            class="lg:hidden flex flex-col justify-center items-center w-9 h-9 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition-colors gap-1.5 p-2">
            <span class="w-5 h-0.5 bg-gray-700 block rounded transition-all duration-300 origin-center" id="bar1"></span>
            <span class="w-5 h-0.5 bg-gray-700 block rounded transition-all duration-300" id="bar2"></span>
            <span class="w-5 h-0.5 bg-gray-700 block rounded transition-all duration-300 origin-center" id="bar3"></span>
          </button>
        </div>
      </div>

      <!-- Mobile / Tablet Dropdown Menu -->
      <div id="mobile-menu" class="lg:hidden">
        <div class="py-3 border-t border-gray-100">
          <ul class="flex flex-col text-sm font-medium text-gray-700">
            <li><a href="#home"     class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>Home</a></li>
            <li><a href="#about"          class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>About Us</a></li>
            <li><a href="#mission-vision" class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>Mission &amp; Vision</a></li>
            <li><a href="#services"       class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>Services</a></li>
            <li><a href="#projects" class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>Our Projects</a></li>
            <li><a href="#contact"  class="flex items-center gap-2 px-3 py-3 rounded-xl hover:bg-gray-50 hover:text-primary transition-colors text-gray-800">
              <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>Contact Us</a></li>
          </ul>
          <!-- Login in mobile menu (shown only on xs where button is hidden) -->
          <div class="mt-3 pt-3 border-t border-gray-100 md:hidden">
            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-full bg-primary text-black font-semibold text-sm hover:bg-primary-dark transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3"/>
              </svg>
              LOGIN
            </a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- ===========================
       HERO SECTION
  =========================== -->
  <section id="home" class="bg-bg-light min-h-[90vh] flex items-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 w-full">
      <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">

        <!-- Text Content -->
        <div class="flex-1 text-center md:text-left">
          <p class="text-base sm:text-lg font-semibold tracking-[0.2em] text-gray-700 uppercase mb-2">TELCOVANTAGE</p>
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black uppercase text-gray-900 leading-none mb-6">
            PHILIPPINES
          </h1>
          <p class="text-gray-600 text-sm sm:text-base max-w-md mx-auto md:mx-0 leading-relaxed">
            The most trusted and innovative telecom service partner, empowering businesses with seamless,
            efficient, and sustainable connectivity solutions.
          </p>
          <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
            <a href="#about" class="px-8 py-3 rounded-full bg-primary text-black font-semibold hover:bg-primary-dark transition-colors text-sm">
              Learn More
            </a>
            <a href="#contact" class="px-8 py-3 rounded-full border-2 border-secondary text-secondary font-semibold hover:bg-secondary hover:text-black transition-colors text-sm">
              Contact Us
            </a>
          </div>
        </div>

        <!-- Hero Image / Logo Visual — enlarged -->
        <div class="flex-1 flex justify-center md:justify-end">
          <img
            src="assets/images/logo.png"
            alt="TelcoVantage 3D Logo"
            class="w-[480px] sm:w-[640px] lg:w-[720px] xl:w-[800px] max-w-full object-contain drop-shadow-2xl"
            id="hero-img"
          />
        </div>

      </div>
    </div>
  </section>

  <!-- ===========================
       ABOUT SECTION
  =========================== -->
  <section id="about" class="bg-bg-light py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20">

        <!-- Text Content -->
        <div class="flex-1 text-center md:text-left order-2 md:order-1">
          <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">ABOUT OUR COMPANY</p>
          <h2 class="text-3xl sm:text-4xl font-black uppercase text-gray-900 tracking-wide mb-2">
            TELCOVANTAGE
          </h2>
          <!-- Underline accent -->
          <div class="w-40 h-0.5 bg-gray-900 mx-auto md:mx-0 mb-6"></div>

          <div class="text-gray-600 text-sm sm:text-base leading-relaxed space-y-3 max-w-lg mx-auto md:mx-0">
            <p>
              TelcoVantage is a leading telecommunications service provider in the Philippines,
              dedicated to delivering cutting-edge solutions that empower businesses
              to thrive in the digital age.
            </p>
            <p>
              With our extensive expertise and commitment to excellence,
              we help organizations optimize their telecommunications infrastructure
              and embrace technological innovation.
            </p>
          </div>

          <a href="#services" class="mt-8 inline-flex items-center gap-2 px-7 py-3 rounded-full bg-primary text-black text-sm font-semibold hover:bg-primary-dark transition-colors">
            Our Services
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
          </a>
        </div>

        <!-- About Image -->
        <div class="flex-1 flex justify-center md:justify-end order-1 md:order-2">
          <div class="relative w-full max-w-sm lg:max-w-md">
            <img
              src="assets/images/about-us.png"
              alt="TelcoVantage About Us"
              class="w-full h-full min-h-[320px] lg:min-h-[420px] object-cover object-center rounded-2xl shadow-lg block"
              style="aspect-ratio: 4/3;"
            />
            <!-- Green accent box behind image -->
            <div class="absolute -bottom-4 -right-4 w-full h-full rounded-2xl bg-primary/10 -z-10"></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===========================
       MISSION & VISION SECTION
  =========================== -->
  <section id="mission-vision" class="bg-white py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Header -->
      <div class="text-center mb-14">
        <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">WHO WE ARE</p>
        <h2 class="text-3xl sm:text-4xl font-black uppercase text-gray-900 mb-4">Mission &amp; Vision</h2>
        <div class="w-16 h-1 bg-secondary mx-auto rounded-full"></div>
      </div>

      <!-- Two-column cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Mission Card -->
        <div class="relative bg-bg-light rounded-3xl p-8 lg:p-10 overflow-hidden group hover:shadow-lg transition-shadow">
          <!-- Background accent circle -->
          <div class="absolute -top-8 -right-8 w-36 h-36 rounded-full bg-primary/8 group-hover:bg-primary/12 transition-colors"></div>

          <!-- Icon -->
          <div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center mb-6 shadow-sm">
            <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
            </svg>
          </div>

          <!-- Label -->
          <p class="text-xs font-bold tracking-[0.3em] text-primary uppercase mb-2">Our Mission</p>

          <!-- Heading -->
          <h3 class="text-xl sm:text-2xl font-black text-gray-900 mb-4 leading-snug">
            Empowering Businesses Through Connectivity
          </h3>

          <!-- Divider -->
          <div class="w-10 h-0.5 bg-primary mb-5 rounded-full"></div>

          <!-- Body -->
          <p class="text-gray-600 text-sm leading-relaxed">
            Our mission is to deliver seamless, efficient, and sustainable telecommunications solutions that empower
            businesses to thrive in the digital age. We are committed to providing cutting-edge technology and
            unmatched service quality to help organizations optimize their operations and stay ahead in an
            ever-evolving connected world.
          </p>
        </div>

        <!-- Vision Card -->
        <div class="relative bg-primary rounded-3xl p-8 lg:p-10 overflow-hidden group hover:shadow-lg transition-shadow">
          <!-- Background accent circle -->
          <div class="absolute -top-8 -right-8 w-36 h-36 rounded-full bg-white/10 group-hover:bg-white/15 transition-colors"></div>

          <!-- Icon -->
          <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center mb-6 shadow-sm">
            <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>

          <!-- Label -->
          <p class="text-xs font-bold tracking-[0.3em] text-black/70 uppercase mb-2">Our Vision</p>

          <!-- Heading -->
          <h3 class="text-xl sm:text-2xl font-black text-black mb-4 leading-snug">
            Leading the Future of Telecommunications in the Philippines
          </h3>

          <!-- Divider -->
          <div class="w-10 h-0.5 bg-white/50 mb-5 rounded-full"></div>

          <!-- Body -->
          <p class="text-black/80 text-sm leading-relaxed">
            Our vision is to be the most trusted and innovative telecommunications service provider in the Philippines —
            building a digitally connected nation where every business, community, and individual can access
            world-class connectivity that drives growth, prosperity, and technological advancement for generations to come.
          </p>
        </div>

      </div>

      <!-- Core Values strip -->
      <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-bg-light rounded-2xl p-5 text-center hover:shadow-md transition-shadow">
          <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mx-auto mb-3">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <p class="text-xs font-black uppercase text-gray-800 tracking-wide">Integrity</p>
        </div>
        <div class="bg-bg-light rounded-2xl p-5 text-center hover:shadow-md transition-shadow">
          <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mx-auto mb-3">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
            </svg>
          </div>
          <p class="text-xs font-black uppercase text-gray-800 tracking-wide">Innovation</p>
        </div>
        <div class="bg-bg-light rounded-2xl p-5 text-center hover:shadow-md transition-shadow">
          <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mx-auto mb-3">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
          </div>
          <p class="text-xs font-black uppercase text-gray-800 tracking-wide">Excellence</p>
        </div>
        <div class="bg-bg-light rounded-2xl p-5 text-center hover:shadow-md transition-shadow">
          <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mx-auto mb-3">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
            </svg>
          </div>
          <p class="text-xs font-black uppercase text-gray-800 tracking-wide">Sustainability</p>
        </div>
      </div>

    </div>
  </section>

  <!-- ===========================
       SERVICES SECTION
  =========================== -->
  <section id="services" class="bg-white py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Header -->
      <div class="text-center mb-14">
        <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">WHAT WE OFFER</p>
        <h2 class="text-3xl sm:text-4xl font-black uppercase text-gray-900 mb-4">Our Services</h2>
        <div class="w-16 h-1 bg-secondary mx-auto rounded-full"></div>
      </div>

      <!-- Service Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        <!-- Card 1 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Connectivity Solutions</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Seamless, high-speed internet and network connectivity solutions tailored for businesses of all sizes.
          </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Infrastructure Management</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            End-to-end management of telecommunications infrastructure to ensure optimal performance and uptime.
          </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Digital Innovation</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Helping organizations embrace technological innovation with cutting-edge digital transformation solutions.
          </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Network Security</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Robust security solutions that protect your telecommunications infrastructure from modern threats.
          </p>
        </div>

        <!-- Card 5 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Managed Services</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Comprehensive managed telecom services so your team can focus on your core business goals.
          </p>
        </div>

        <!-- Card 6 -->
        <div class="bg-bg-light rounded-2xl p-8 hover:shadow-lg transition-shadow group">
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">24/7 Support</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Round-the-clock technical support ensuring your operations run without interruption, any time of day.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- ===========================
       PROJECTS SECTION
  =========================== -->
  <section id="projects" class="bg-bg-light py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Header -->
      <div class="text-center mb-12">
        <h2 class="text-4xl sm:text-5xl font-black text-gray-900">Our Projects</h2>
      </div>

      <!-- Splide Carousel -->
      <div id="projects-splide" class="splide" aria-label="Our Projects">
        <div class="splide__track">
          <ul class="splide__list">

            <!-- Slide 1 -->
            <li class="splide__slide">
              <div class="bg-bg-light rounded-3xl p-4 border-2 border-primary shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=600&h=300&q=80" alt="Project 1" class="w-full h-44 object-cover rounded-2xl mb-4" />
                <div class="flex flex-col flex-1 text-center px-2">
                  <h3 class="text-sm font-black uppercase text-primary tracking-wide border-b-2 border-primary pb-2 mb-3">OUR SERVICES TITLE</h3>
                  <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, Upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                  <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-gray-900 text-black text-xs font-bold uppercase tracking-widest hover:bg-primary transition-colors">LEARN MORE</a>
                </div>
              </div>
            </li>

            <!-- Slide 2 -->
            <li class="splide__slide">
              <div class="bg-bg-light rounded-3xl p-4 border-2 border-primary shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=600&h=300&q=80" alt="Project 2" class="w-full h-44 object-cover rounded-2xl mb-4" />
                <div class="flex flex-col flex-1 text-center px-2">
                  <h3 class="text-sm font-black uppercase text-primary tracking-wide border-b-2 border-primary pb-2 mb-3">OUR SERVICES TITLE</h3>
                  <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, Upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                  <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-gray-900 text-black text-xs font-bold uppercase tracking-widest hover:bg-primary transition-colors">LEARN MORE</a>
                </div>
              </div>
            </li>

            <!-- Slide 3 -->
            <li class="splide__slide">
              <div class="bg-bg-light rounded-3xl p-4 border-2 border-primary shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="https://images.unsplash.com/photo-1516116216624-53e697fedbea?auto=format&fit=crop&w=600&h=300&q=80" alt="Project 3" class="w-full h-44 object-cover rounded-2xl mb-4" />
                <div class="flex flex-col flex-1 text-center px-2">
                  <h3 class="text-sm font-black uppercase text-primary tracking-wide border-b-2 border-primary pb-2 mb-3">OUR SERVICES TITLE</h3>
                  <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, Upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                  <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-gray-900 text-black text-xs font-bold uppercase tracking-widest hover:bg-primary transition-colors">LEARN MORE</a>
                </div>
              </div>
            </li>

            <!-- Slide 4 -->
            <li class="splide__slide">
              <div class="bg-bg-light rounded-3xl p-4 border-2 border-primary shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=600&h=300&q=80" alt="Project 4" class="w-full h-44 object-cover rounded-2xl mb-4" />
                <div class="flex flex-col flex-1 text-center px-2">
                  <h3 class="text-sm font-black uppercase text-primary tracking-wide border-b-2 border-primary pb-2 mb-3">OUR SERVICES TITLE</h3>
                  <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, Upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                  <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-gray-900 text-black text-xs font-bold uppercase tracking-widest hover:bg-primary transition-colors">LEARN MORE</a>
                </div>
              </div>
            </li>

            <!-- Slide 5 -->
            <li class="splide__slide">
              <div class="bg-bg-light rounded-3xl p-4 border-2 border-primary shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&h=300&q=80" alt="Project 5" class="w-full h-44 object-cover rounded-2xl mb-4" />
                <div class="flex flex-col flex-1 text-center px-2">
                  <h3 class="text-sm font-black uppercase text-primary tracking-wide border-b-2 border-primary pb-2 mb-3">OUR SERVICES TITLE</h3>
                  <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, Upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                  <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-gray-900 text-black text-xs font-bold uppercase tracking-widest hover:bg-primary transition-colors">LEARN MORE</a>
                </div>
              </div>
            </li>

          </ul>
        </div>
      </div><!-- end splide -->

    </div>
  </section>

  <!-- ===========================
       STATS / WHY US STRIP
  =========================== -->
  <section class="bg-primary py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-black">
        <div>
          <p class="text-4xl font-black">10+</p>
          <p class="text-sm mt-1 opacity-80 font-medium">Years of Experience</p>
        </div>
        <div>
          <p class="text-4xl font-black">500+</p>
          <p class="text-sm mt-1 opacity-80 font-medium">Projects Completed</p>
        </div>
        <div>
          <p class="text-4xl font-black">200+</p>
          <p class="text-sm mt-1 opacity-80 font-medium">Clients Served</p>
        </div>
        <div>
          <p class="text-4xl font-black">24/7</p>
          <p class="text-sm mt-1 opacity-80 font-medium">Support Available</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===========================
       CONTACT SECTION
  =========================== -->
  <section id="contact" class="bg-white py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

        <!-- Contact Info -->
        <div class="flex-1">
          <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">GET IN TOUCH</p>
          <h2 class="text-3xl sm:text-4xl font-black uppercase text-gray-900 mb-2">Contact Us</h2>
          <div class="w-16 h-0.5 bg-secondary mb-6"></div>
          <p class="text-gray-600 text-sm leading-relaxed mb-8 max-w-sm">
            Ready to transform your telecommunications infrastructure? Reach out to us and our team will get back to you promptly.
          </p>

          <div class="space-y-5">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-0.5">Address</p>
                <p class="text-sm text-gray-700">Philippines</p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-0.5">Phone</p>
                <p class="text-sm text-gray-700">+63 (0) 000 000 0000</p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
              </div>
              <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-0.5">Email</p>
                <p class="text-sm text-gray-700">info@telcovantage.ph</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="flex-1">
          <form class="space-y-4" onsubmit="handleSubmit(event)">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1.5">First Name</label>
                <input type="text" placeholder="Juan" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-bg-light text-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition" />
              </div>
              <div>
                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1.5">Last Name</label>
                <input type="text" placeholder="Dela Cruz" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-bg-light text-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition" />
              </div>
            </div>
            <div>
              <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1.5">Email</label>
              <input type="email" placeholder="juan@company.com" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-bg-light text-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition" />
            </div>
            <div>
              <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1.5">Company</label>
              <input type="text" placeholder="Your Company Name" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-bg-light text-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition" />
            </div>
            <div>
              <label class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1.5">Message</label>
              <textarea rows="4" placeholder="Tell us about your project or inquiry..." class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-bg-light text-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 focus:border-secondary transition resize-none"></textarea>
            </div>
            <button type="submit" class="w-full py-3 rounded-xl bg-primary text-black font-semibold text-sm hover:bg-primary-dark transition-colors">
              Send Message
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>

  <!-- ===========================
       FOOTER
  =========================== -->
  <footer class="bg-gray-900 text-black pt-14 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

        <!-- Brand -->
        <div class="lg:col-span-2">
          <img
            src="assets/images/logo-light.png"
            alt="TelcoVantage Philippines"
            class="h-10 w-auto mb-4"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
          />
          <p class="hidden text-lg font-black tracking-widest mb-4">TELCOVANTAGE</p>
          <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
            The most trusted and innovative telecom service partner, empowering businesses with seamless,
            efficient, and sustainable connectivity solutions.
          </p>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="text-xs font-bold tracking-[0.2em] uppercase text-gray-400 mb-4">Quick Links</h4>
          <ul class="space-y-2.5 text-sm text-gray-300">
            <li><a href="#home"     class="hover:text-black transition-colors">Home</a></li>
            <li><a href="#about"    class="hover:text-black transition-colors">About Us</a></li>
            <li><a href="#services" class="hover:text-black transition-colors">Services</a></li>
            <li><a href="#projects" class="hover:text-black transition-colors">Our Projects</a></li>
            <li><a href="#contact"  class="hover:text-black transition-colors">Contact Us</a></li>
          </ul>
        </div>

        <!-- Services -->
        <div>
          <h4 class="text-xs font-bold tracking-[0.2em] uppercase text-gray-400 mb-4">Services</h4>
          <ul class="space-y-2.5 text-sm text-gray-300">
            <li>Connectivity Solutions</li>
            <li>Infrastructure Management</li>
            <li>Digital Innovation</li>
            <li>Network Security</li>
            <li>Managed Services</li>
          </ul>
        </div>

      </div>

      <!-- Bottom bar -->
      <div class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
        <p>&copy; 2024 TelcoVantage Philippines. All rights reserved.</p>
        <p>Empowering businesses through connectivity.</p>
      </div>
    </div>
  </footer>

  <!-- ===========================
       JAVASCRIPT
  =========================== -->
  <script>
    // Mobile menu toggle
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const bar1 = document.getElementById('bar1');
    const bar2 = document.getElementById('bar2');
    const bar3 = document.getElementById('bar3');
    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      mobileMenu.classList.toggle('open', menuOpen);
      if (menuOpen) {
        bar1.style.transform = 'translateY(6px) rotate(45deg)';
        bar2.style.opacity = '0';
        bar2.style.transform = 'scaleX(0)';
        bar3.style.transform = 'translateY(-6px) rotate(-45deg)';
      } else {
        bar1.style.transform = '';
        bar2.style.opacity = '';
        bar2.style.transform = '';
        bar3.style.transform = '';
      }
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        menuOpen = false;
        mobileMenu.classList.remove('open');
        bar1.style.transform = '';
        bar2.style.opacity = '';
        bar3.style.transform = '';
      });
    });

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('header a[href^="#"]');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          navLinks.forEach(link => {
            link.classList.remove('text-primary', 'font-semibold');
            if (link.getAttribute('href') === '#' + entry.target.id) {
              link.classList.add('text-primary', 'font-semibold');
            }
          });
        }
      });
    }, { threshold: 0.4 });

    sections.forEach(section => observer.observe(section));

    function handleSubmit(e) {
      e.preventDefault();
      const btn = e.target.querySelector('button[type="submit"]');
      btn.textContent = 'Message Sent!';
      btn.classList.replace('bg-primary', 'bg-green-600');
      setTimeout(() => {
        btn.textContent = 'Send Message';
        btn.classList.replace('bg-green-600', 'bg-primary');
        e.target.reset();
      }, 3000);
    }
  </script>

  <!-- Splide JS -->
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script>
    new Splide('#projects-splide', {
      type       : 'loop',
      perPage    : 3,
      perMove    : 1,
      gap        : '1.5rem',
      pagination : true,
      arrows     : true,
      breakpoints: {
        1024: { perPage: 2 },
        640 : { perPage: 1 },
      },
    }).mount();
  </script>

</body>
</html>