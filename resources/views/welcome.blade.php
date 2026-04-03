<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TelcoVantage Philippines</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            ink: '#07111A',
            panel: '#0B1723',
            line: 'rgba(255,255,255,0.10)',
            brand: '#22C55E',
            brand2: '#3B82F6',
            soft: '#94A3B8'
          },
          fontFamily: {
            display: ['Sora', 'sans-serif'],
            body: ['Manrope', 'sans-serif']
          },
          boxShadow: {
            glow: '0 0 0 1px rgba(255,255,255,0.06), 0 20px 70px rgba(0,0,0,0.35)',
            brand: '0 20px 60px rgba(34,197,94,0.22)'
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #ffffff;
      --panel: rgba(255,255,255,0.82);
      --line: rgba(10,92,59,0.10);
      --text-soft: #64748b;
      --brand: #0A5C3B;
      --brand2: #2563EB;
      --brand3: #EAF6FF;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      margin: 0;
      font-family: 'Manrope', sans-serif;
      background: linear-gradient(135deg, #f0f0f0 0%, #edf6f1 35%, #eef6fb 68%, #f4fbf7 100%);
      background-size: 220% 220%;
      animation: bodyGradientShift 16s ease-in-out infinite;
      color: #0f172a;
      overflow-x: hidden;
    }

    .grid-bg {
      background-image:
        linear-gradient(rgba(15,23,42,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15,23,42,0.035) 1px, transparent 1px);
      background-size: 72px 72px;
    }

    .noise::before {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      opacity: .03;
      background-image: radial-gradient(circle, rgba(15,23,42,0.55) 0.7px, transparent 0.8px);
      background-size: 12px 12px;
      mix-blend-mode: multiply;
    }

    .glass {
      background: #ffffff;
      border: 1px solid rgba(15,23,42,0.08);
      box-shadow: 0 16px 40px rgba(15,23,42,0.08);
    }

    .headline {
      font-family: 'Sora', sans-serif;
      letter-spacing: -0.05em;
    }

    .text-soft { color: var(--text-soft); }

    .gradient-line {
      background: linear-gradient(90deg, transparent, rgba(10,92,59,0.95), rgba(37,99,235,0.75), transparent);
    }

    .nav-scrolled {
      background: transparent;
      border-bottom: 1px solid rgba(15,23,42,0.06);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
    }

    .nav-shell {
      background: linear-gradient(135deg, rgba(255,255,255,0.94), rgba(235,247,241,0.84), rgba(234,246,255,0.82));
      border: 1px solid rgba(10,92,59,0.10);
      box-shadow: 0 18px 40px rgba(10,92,59,0.08);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      transition: box-shadow .3s ease, background .3s ease, border-color .3s ease;
    }

    .nav-scrolled .nav-shell {
      background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(239,248,243,0.90), rgba(236,246,255,0.88));
      border-color: rgba(10,92,59,0.12);
      box-shadow: 0 18px 44px rgba(10,92,59,0.10);
    }

    .hero-ring {
      position: absolute;
      inset: 50%;
      transform: translate(-50%, -50%);
      border: 1px solid rgba(15,23,42,0.08);
      border-radius: 999px;
    }

    .service-card:hover .service-icon,
    .project-card:hover .project-arrow {
      transform: translateY(-4px);
    }

    .service-icon,
    .project-arrow {
      transition: transform .35s ease;
    }

    .reveal,
    .reveal-left,
    .reveal-right,
    .reveal-scale {
      will-change: transform, opacity;
    }

    #mobile-menu {
      height: 0;
      overflow: hidden;
      opacity: 0;
    }

    .stats-card {
      background: #ffffff;
      border: 1px solid rgba(15,23,42,0.10);
    }

    .project-overlay {
      background: linear-gradient(180deg, rgba(255,255,255,0.0), rgba(255,255,255,0.88));
    }

    @keyframes bodyGradientShift {
      0% {
        background-position: 0% 50%;
      }
      25% {
        background-position: 100% 50%;
      }
      50% {
        background-position: 100% 100%;
      }
      75% {
        background-position: 0% 100%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    #projects-splide {
      padding-bottom: 3rem;
    }

    #projects-splide .splide__track {
      padding: 0.25rem 0.25rem 1rem;
    }

    #projects-splide .splide__slide {
      display: flex;
      height: auto;
    }

    #projects-splide .splide__slide > article {
      width: 100%;
    }

    .splide__arrow {
      background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(236,248,242,0.88), rgba(234,246,255,0.86));
      border: 1px solid rgba(10,92,59,0.12);
      width: 2.7rem;
      height: 2.7rem;
      opacity: 1;
      box-shadow: 0 10px 24px rgba(10,92,59,0.08);
    }

    .splide__arrow svg {
      fill: #0A5C3B;
      width: 1rem;
      height: 1rem;
    }

    .splide__arrow:hover {
      border-color: rgba(37,99,235,0.18);
    }

    .splide__pagination {
      bottom: 0;
      gap: 0.4rem;
    }

    .splide__pagination__page {
      background: rgba(10,92,59,0.22);
      width: 0.6rem;
      height: 0.6rem;
      margin: 0;
      opacity: 1;
      transition: all .25s ease;
    }

    .splide__pagination__page.is-active {
      background: linear-gradient(135deg, #0A5C3B, #2563EB);
      width: 1.8rem;
      border-radius: 999px;
      transform: none;
    }
  </style>
</head>
<body>
  <header id="site-header" class="fixed inset-x-0 top-0 z-50 transition-all duration-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="nav-shell mt-3 flex items-center justify-between rounded-2xl px-4 py-3">
        <a href="#home" class="flex items-center gap-3 flex-shrink-0">
          <img
            src="{{ asset('assets/images/logo-dark.png') }}"
            alt="TelcoVantage Philippines Logo"
            class="h-8 sm:h-9 lg:h-10 w-auto object-contain"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <div class="hidden flex-col leading-tight">
            <span class="text-sm font-black tracking-[0.28em] text-slate-900">TELCOVANTAGE</span>
            <span class="text-[9px] tracking-[0.35em] text-slate-500 uppercase">Philippines</span>
          </div>
        </a>

        <nav class="hidden items-center gap-7 lg:flex text-sm text-slate-700">
          <a href="#about" class="transition hover:text-[#0A5C3B]">About</a>
          <a href="#vision" class="transition hover:text-[#0A5C3B]">Mission & Vision</a>
          <a href="#services" class="transition hover:text-[#0A5C3B]">Services</a>
          <a href="#projects" class="transition hover:text-[#0A5C3B]">Projects</a>
          <a href="#contact" class="transition hover:text-[#0A5C3B]">Contact</a>
        </nav>

        <div class="flex items-center gap-3">
          <a href="/login" class="hidden sm:inline-flex items-center rounded-full bg-[#0A5C3B] px-5 py-2.5 text-sm font-bold text-white transition hover:bg-[#0c6a43] shadow-[0_12px_26px_rgba(10,92,59,0.16)]">Login</a>
          <button id="menu-btn" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-[#0A5C3B] lg:hidden" aria-label="Toggle menu">
            <svg id="menu-open" width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M4 7H20M4 12H20M4 17H20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            <svg id="menu-close" width="20" height="20" viewBox="0 0 24 24" fill="none" class="hidden">
              <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </button>
        </div>
      </div>

      <div id="mobile-menu" class="mx-1 mt-2 rounded-2xl border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.95),rgba(236,248,242,0.88),rgba(234,246,255,0.82))] px-4 backdrop-blur-xl lg:hidden">
        <div class="flex flex-col py-4 text-sm text-[#0A5C3B]/80">
          <a class="rounded-xl px-3 py-3 hover:bg-white/5" href="#about">About</a>
          <a class="rounded-xl px-3 py-3 hover:bg-white/5" href="#vision">Mission & Vision</a>
          <a class="rounded-xl px-3 py-3 hover:bg-white/5" href="#services">Services</a>
          <a class="rounded-xl px-3 py-3 hover:bg-white/5" href="#projects">Projects</a>
          <a class="rounded-xl px-3 py-3 hover:bg-white/5" href="#contact">Contact</a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section id="home" class="min-h-[84vh] flex items-center pt-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14 w-full">
        <div class="grid items-center gap-6 md:grid-cols-[0.85fr_1.15fr]">

          <div class="reveal-left text-center md:text-left">
            <p class="text-sm sm:text-base lg:text-lg font-semibold tracking-[0.18em] text-gray-700 uppercase mb-3">TELCOVANTAGE</p>
            <h1 class="headline text-[3.4rem] sm:text-[4.6rem] lg:text-[5rem] xl:text-[5.4rem] font-extrabold uppercase text-gray-900 leading-[0.92] mb-5">
              PHILIPPINES
            </h1>
            <p class="text-gray-600 text-base sm:text-lg lg:text-[1.25rem] max-w-xl mx-auto md:mx-0 leading-relaxed">
              The most trusted and innovative telecom service partner, empowering businesses with seamless,
              efficient, and sustainable connectivity solutions.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
              <a href="#about" class="px-8 py-3.5 rounded-full bg-white border border-gray-300 text-slate-900 font-semibold hover:border-[#0A5C3B] hover:text-[#0A5C3B] transition text-base">
                Learn More
              </a>
              <a href="#contact" class="px-8 py-3.5 rounded-full border-2 border-slate-800 text-slate-900 font-semibold hover:bg-slate-900 hover:text-white transition text-base">
                Contact Us
              </a>
            </div>
          </div>

          <div class="reveal-right flex justify-center md:justify-end">
            <img
              src="{{ asset('assets/images/logo.png') }}"
              alt="TelcoVantage 3D Logo"
              class="w-[620px] sm:w-[760px] lg:w-[800px] xl:w-[940px] max-w-none object-contain drop-shadow-[0_28px_52px_rgba(0,0,0,0.16)]"
              id="hero-img"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            />
            <div class="hidden items-center justify-center w-[620px] sm:w-[760px] lg:w-[900px] xl:w-[1040px] max-w-none min-h-[420px] rounded-3xl border border-slate-200 bg-white shadow-sm">
              <div class="text-center px-6">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="TelcoVantage Philippines" class="mx-auto h-12 w-auto object-contain mb-5" />
                <p class="headline text-4xl sm:text-5xl font-extrabold text-slate-900">TELCOVANTAGE</p>
                <p class="mt-2 text-xs tracking-[0.35em] uppercase text-slate-500">Philippines</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="about" class="py-20 md:py-28">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-[0.95fr_1.05fr]">
          <div class="reveal-left text-center md:text-left order-2 lg:order-1">
            <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">ABOUT OUR COMPANY</p>
            <h2 class="headline text-3xl sm:text-4xl font-extrabold uppercase text-slate-900 mb-2">TELCOVANTAGE</h2>
            <div class="w-40 h-0.5 bg-slate-900 mx-auto md:mx-0 mb-6"></div>
            <div class="text-gray-600 text-sm sm:text-base leading-relaxed space-y-4 max-w-xl mx-auto md:mx-0">
              <p>TelcoVantage is a leading telecommunications service provider in the Philippines, dedicated to delivering cutting-edge solutions that empower businesses to thrive in the digital age.</p>
              <p>With our extensive expertise and commitment to excellence, we help organizations optimize their telecommunications infrastructure and embrace technological innovation.</p>
            </div>
            <a href="#services" class="mt-8 inline-flex items-center gap-2 px-7 py-3 rounded-full text-sm font-semibold text-slate-900 hover:text-primary transition-colors">
              Our Services
              <span>→</span>
            </a>
          </div>

          <div class="reveal-right flex justify-center lg:justify-end order-1 lg:order-2">
            <div class="relative w-full max-w-sm lg:max-w-md xl:max-w-lg">
              <img src="{{ asset('assets/images/about-us.png') }}" alt="TelcoVantage About Us" class="w-full h-full min-h-[320px] lg:min-h-[420px] object-cover object-center rounded-[28px] shadow-lg block" style="aspect-ratio: 4/3;" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="vision" class="py-24 sm:py-28 bg-transparent">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="reveal text-center">
          <p class="text-xs font-semibold uppercase tracking-[0.32em] text-[#0A5C3B]/65">Who We Are</p>
          <h2 class="headline mt-4 text-4xl font-extrabold text-slate-900 sm:text-5xl">Mission &amp; Vision</h2>
          <div class="gradient-line mx-auto mt-6 h-px w-48"></div>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-2">
          <div class="reveal rounded-[2rem] border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(232,247,239,0.80),rgba(234,246,255,0.44))] p-8 lg:p-10 shadow-[0_18px_40px_rgba(10,92,59,0.08)] backdrop-blur-xl">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,#0A5C3B,#3BB58A)] text-white shadow-[0_16px_30px_rgba(10,92,59,0.18)]">
              ⚡
            </div>
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-[#0A5C3B]/70">Our Mission</p>
            <h3 class="headline mt-4 text-2xl font-bold text-slate-900">Empowering businesses through seamless connectivity.</h3>
            <p class="mt-5 text-sm leading-8 text-slate-600">Our mission is to deliver efficient, sustainable, and high-performing telecommunications solutions that help organizations optimize infrastructure, improve reliability, and stay competitive in a connected world.</p>
          </div>

          <div class="reveal rounded-[2rem] border border-[rgba(37,99,235,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(236,248,255,0.80),rgba(232,247,239,0.58))] p-8 lg:p-10 shadow-[0_18px_40px_rgba(37,99,235,0.06)] backdrop-blur-xl">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,#DBECFF,#EEF7FF)] text-[#2563EB] shadow-[0_12px_24px_rgba(37,99,235,0.08)]">
              ◉
            </div>
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-[#2563EB]/70">Our Vision</p>
            <h3 class="headline mt-4 text-2xl font-bold text-slate-900">Leading the future of telecommunications in the Philippines.</h3>
            <p class="mt-5 text-sm leading-8 text-slate-600">Our vision is to become the most trusted and innovative telecom service provider in the country by enabling world-class connectivity that drives growth, opportunity, and long-term digital transformation.</p>
          </div>
        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div class="reveal rounded-2xl border border-[rgba(10,92,59,0.08)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(238,248,243,0.74))] p-5 text-center text-slate-900 shadow-[0_10px_24px_rgba(10,92,59,0.05)] backdrop-blur-md">Integrity</div>
          <div class="reveal rounded-2xl border border-[rgba(10,92,59,0.08)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(238,248,243,0.74),rgba(234,246,255,0.44))] p-5 text-center text-slate-900 shadow-[0_10px_24px_rgba(10,92,59,0.05)] backdrop-blur-md">Innovation</div>
          <div class="reveal rounded-2xl border border-[rgba(37,99,235,0.08)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(234,246,255,0.66))] p-5 text-center text-slate-900 shadow-[0_10px_24px_rgba(37,99,235,0.04)] backdrop-blur-md">Excellence</div>
          <div class="reveal rounded-2xl border border-[rgba(10,92,59,0.08)] bg-[linear-gradient(135deg,rgba(255,255,255,0.88),rgba(238,248,243,0.74),rgba(234,246,255,0.36))] p-5 text-center text-slate-900 shadow-[0_10px_24px_rgba(10,92,59,0.05)] backdrop-blur-md">Sustainability</div>
        </div>
      </div>
    </section>

    <section id="services" class="bg-transparent py-20 md:py-28">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal text-center mb-14">
          <p class="text-xs font-bold tracking-[0.3em] text-gray-500 uppercase mb-3">WHAT WE OFFER</p>
          <h2 class="headline text-3xl sm:text-4xl font-extrabold uppercase text-gray-900 mb-4">Our Services</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-14 max-w-6xl mx-auto">
          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">Connectivity Solutions</h3>
            <p class="text-gray-600 text-sm leading-8">Seamless, high-speed internet and network connectivity solutions tailored for businesses of all sizes.</p>
          </article>

          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">Infrastructure Management</h3>
            <p class="text-gray-600 text-sm leading-8">End-to-end management of telecommunications infrastructure to ensure optimal performance and uptime.</p>
          </article>

          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">Digital Innovation</h3>
            <p class="text-gray-600 text-sm leading-8">Helping organizations embrace technological innovation with cutting-edge digital transformation solutions.</p>
          </article>

          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">Network Security</h3>
            <p class="text-gray-600 text-sm leading-8">Robust security solutions that protect your telecommunications infrastructure from modern threats.</p>
          </article>

          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">Managed Services</h3>
            <p class="text-gray-600 text-sm leading-8">Comprehensive managed telecom services so your team can focus on your core business goals.</p>
          </article>

          <article class="reveal group">
            <div class="w-10 h-10 mb-5 text-slate-800">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143"/></svg>
            </div>
            <h3 class="text-[2rem] leading-tight md:text-lg font-bold text-gray-900 mb-3">24/7 Support</h3>
            <p class="text-gray-600 text-sm leading-8">Round-the-clock technical support ensuring your operations run without interruption, any time of day.</p>
          </article>
        </div>
      </div>
    </section>

    <section id="projects" class="py-20 md:py-28">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
          <h2 class="headline text-4xl sm:text-5xl font-extrabold text-gray-900">Our Projects</h2>
        </div>

        <div id="projects-splide" class="splide reveal" aria-label="Our Projects">
          <div class="splide__track">
            <ul class="splide__list">
              <li class="splide__slide">
                <article class="rounded-3xl p-4 border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.9),rgba(238,248,243,0.74),rgba(234,246,255,0.52))] shadow-[0_16px_34px_rgba(10,92,59,0.06)] hover:shadow-[0_18px_40px_rgba(37,99,235,0.08)] transition-shadow flex flex-col h-full">
                  <img src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=900&h=500&q=80" alt="Project 1" class="w-full h-52 object-cover rounded-2xl mb-4" />
                  <div class="flex flex-col flex-1 text-center px-2">
                    <h3 class="text-sm font-black uppercase text-[#0A5C3B] tracking-wide border-b border-[#0A5C3B]/20 pb-2 mb-3">OUR SERVICES TITLE</h3>
                    <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                    <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-[linear-gradient(135deg,#0A5C3B,#2563EB)] text-white text-xs font-bold uppercase tracking-widest hover:opacity-95 transition-colors">LEARN MORE</a>
                  </div>
                </article>
              </li>

              <li class="splide__slide">
                <article class="rounded-3xl p-4 border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.9),rgba(238,248,243,0.74),rgba(234,246,255,0.52))] shadow-[0_16px_34px_rgba(10,92,59,0.06)] hover:shadow-[0_18px_40px_rgba(37,99,235,0.08)] transition-shadow flex flex-col h-full">
                  <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=900&h=500&q=80" alt="Project 2" class="w-full h-52 object-cover rounded-2xl mb-4" />
                  <div class="flex flex-col flex-1 text-center px-2">
                    <h3 class="text-sm font-black uppercase text-[#0A5C3B] tracking-wide border-b border-[#0A5C3B]/20 pb-2 mb-3">OUR SERVICES TITLE</h3>
                    <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                    <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-[linear-gradient(135deg,#0A5C3B,#2563EB)] text-white text-xs font-bold uppercase tracking-widest hover:opacity-95 transition-colors">LEARN MORE</a>
                  </div>
                </article>
              </li>

              <li class="splide__slide">
                <article class="rounded-3xl p-4 border border-[rgba(37,99,235,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.9),rgba(236,248,255,0.78),rgba(238,248,243,0.46))] shadow-[0_16px_34px_rgba(37,99,235,0.05)] hover:shadow-[0_18px_40px_rgba(37,99,235,0.08)] transition-shadow flex flex-col h-full">
                  <img src="https://images.unsplash.com/photo-1516116216624-53e697fedbea?auto=format&fit=crop&w=900&h=500&q=80" alt="Project 3" class="w-full h-52 object-cover rounded-2xl mb-4" />
                  <div class="flex flex-col flex-1 text-center px-2">
                    <h3 class="text-sm font-black uppercase text-[#2563EB] tracking-wide border-b border-[#2563EB]/20 pb-2 mb-3">OUR SERVICES TITLE</h3>
                    <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                    <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-[linear-gradient(135deg,#2563EB,#0A5C3B)] text-white text-xs font-bold uppercase tracking-widest hover:opacity-95 transition-colors">LEARN MORE</a>
                  </div>
                </article>
              </li>

              <li class="splide__slide">
                <article class="rounded-3xl p-4 border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.9),rgba(238,248,243,0.74),rgba(234,246,255,0.52))] shadow-[0_16px_34px_rgba(10,92,59,0.06)] hover:shadow-[0_18px_40px_rgba(37,99,235,0.08)] transition-shadow flex flex-col h-full">
                  <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=900&h=500&q=80" alt="Project 4" class="w-full h-52 object-cover rounded-2xl mb-4" />
                  <div class="flex flex-col flex-1 text-center px-2">
                    <h3 class="text-sm font-black uppercase text-[#0A5C3B] tracking-wide border-b border-[#0A5C3B]/20 pb-2 mb-3">OUR SERVICES TITLE</h3>
                    <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                    <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-[linear-gradient(135deg,#0A5C3B,#2563EB)] text-white text-xs font-bold uppercase tracking-widest hover:opacity-95 transition-colors">LEARN MORE</a>
                  </div>
                </article>
              </li>

              <li class="splide__slide">
                <article class="rounded-3xl p-4 border border-[rgba(37,99,235,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.9),rgba(236,248,255,0.78),rgba(238,248,243,0.46))] shadow-[0_16px_34px_rgba(37,99,235,0.05)] hover:shadow-[0_18px_40px_rgba(37,99,235,0.08)] transition-shadow flex flex-col h-full">
                  <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=900&h=500&q=80" alt="Project 5" class="w-full h-52 object-cover rounded-2xl mb-4" />
                  <div class="flex flex-col flex-1 text-center px-2">
                    <h3 class="text-sm font-black uppercase text-[#2563EB] tracking-wide border-b border-[#2563EB]/20 pb-2 mb-3">OUR SERVICES TITLE</h3>
                    <p class="text-gray-600 text-xs leading-relaxed flex-1">Decommissioning and dismantling of Legacy Systems &amp; sites, upgrading telecom infrastructures by safely sunsetting outdated systems.</p>
                    <a href="#" class="mt-4 inline-block w-full py-2.5 rounded-full bg-[linear-gradient(135deg,#2563EB,#0A5C3B)] text-white text-xs font-bold uppercase tracking-widest hover:opacity-95 transition-colors">LEARN MORE</a>
                  </div>
                </article>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="py-8 bg-transparent">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="reveal rounded-[2rem] border border-[rgba(10,92,59,0.12)] bg-[linear-gradient(135deg,rgba(10,92,59,0.10),rgba(59,181,138,0.12),rgba(234,246,255,0.72),rgba(255,255,255,0.94))] p-6 sm:p-8 lg:p-10 shadow-[0_18px_40px_rgba(10,92,59,0.08)] backdrop-blur-md">
          <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div>
              <p class="text-4xl font-extrabold text-slate-900">10+</p>
              <p class="mt-2 text-sm text-slate-600">Years of Experience</p>
            </div>
            <div>
              <p class="text-4xl font-extrabold text-slate-900">500+</p>
              <p class="mt-2 text-sm text-slate-600">Projects Completed</p>
            </div>
            <div>
              <p class="text-4xl font-extrabold text-slate-900">200+</p>
              <p class="mt-2 text-sm text-slate-600">Clients Served</p>
            </div>
            <div>
              <p class="text-4xl font-extrabold text-slate-900">24/7</p>
              <p class="mt-2 text-sm text-slate-600">Support Available</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="contact" class="py-24 sm:py-28 bg-transparent">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
          <div class="reveal rounded-[2rem] border border-[rgba(10,92,59,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.84),rgba(236,248,242,0.78),rgba(234,246,255,0.62))] p-8 shadow-[0_18px_40px_rgba(10,92,59,0.08)] backdrop-blur-xl">
            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-[#0A5C3B]/70">Get In Touch</p>
            <h2 class="headline mt-4 text-4xl font-extrabold text-slate-900">Contact Us</h2>
            <p class="mt-5 max-w-md text-sm leading-8 text-slate-600">Ready to transform your telecommunications infrastructure? Reach out and let’s build a stronger, more connected operation.</p>

            <div class="mt-10 space-y-6 text-sm text-slate-700">
              <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,rgba(10,92,59,0.10),rgba(59,181,138,0.12))] text-[#0A5C3B] shadow-sm">📍</div>
                <div>
                  <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Address</p>
                  <p class="mt-1">Philippines</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,rgba(37,99,235,0.10),rgba(234,246,255,0.8))] text-[#2563EB] shadow-sm">☎</div>
                <div>
                  <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Phone</p>
                  <p class="mt-1">+63 (0) 000 000 0000</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,rgba(10,92,59,0.10),rgba(234,246,255,0.72))] text-[#0A5C3B] shadow-sm">✉</div>
                <div>
                  <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Email</p>
                  <p class="mt-1">info@telcovantage.ph</p>
                </div>
              </div>
            </div>
          </div>

          <div class="reveal rounded-[2rem] border border-[rgba(37,99,235,0.10)] bg-[linear-gradient(135deg,rgba(255,255,255,0.84),rgba(236,248,242,0.66),rgba(234,246,255,0.74))] p-8 shadow-[0_18px_40px_rgba(37,99,235,0.06)] backdrop-blur-xl">
            <form id="contact-form" class="space-y-5">
              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">First Name</label>
                  <input type="text" placeholder="Juan" class="w-full rounded-2xl border border-[rgba(10,92,59,0.12)] bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-[#0A5C3B]/40 focus:outline-none" />
                </div>
                <div>
                  <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Last Name</label>
                  <input type="text" placeholder="Dela Cruz" class="w-full rounded-2xl border border-[rgba(37,99,235,0.12)] bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-[#2563EB]/40 focus:outline-none" />
                </div>
              </div>
              <div>
                <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Email</label>
                <input type="email" placeholder="juan@company.com" class="w-full rounded-2xl border border-[rgba(10,92,59,0.12)] bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-[#0A5C3B]/40 focus:outline-none" />
              </div>
              <div>
                <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Company</label>
                <input type="text" placeholder="Your Company Name" class="w-full rounded-2xl border border-[rgba(37,99,235,0.12)] bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-[#2563EB]/40 focus:outline-none" />
              </div>
              <div>
                <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Message</label>
                <textarea rows="5" placeholder="Tell us about your project or inquiry..." class="w-full rounded-2xl border border-[rgba(10,92,59,0.12)] bg-white/80 px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-[#0A5C3B]/40 focus:outline-none"></textarea>
              </div>
              <button id="submit-btn" type="submit" class="w-full rounded-2xl bg-[linear-gradient(135deg,#0A5C3B,#2563EB)] px-6 py-3.5 text-sm font-bold text-white transition hover:opacity-95">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="bg-transparent border-t border-gray-200/70 pt-14 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div class="lg:col-span-2">
          <img
            src="{{ asset('assets/images/logo-dark.png') }}"
            alt="TelcoVantage Philippines"
            class="h-10 w-auto mb-4 object-contain"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
          />
          <p class="hidden text-lg font-black tracking-widest mb-4 text-gray-900">TELCOVANTAGE</p>
          <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
            The most trusted and innovative telecom service partner, empowering businesses with seamless,
            efficient, and sustainable connectivity solutions.
          </p>
        </div>

        <div>
          <h4 class="text-xs font-bold tracking-[0.2em] uppercase text-gray-500 mb-4">Quick Links</h4>
          <ul class="space-y-2.5 text-sm text-gray-700">
            <li><a href="#home" class="hover:text-primary transition-colors">Home</a></li>
            <li><a href="#about" class="hover:text-primary transition-colors">About Us</a></li>
            <li><a href="#services" class="hover:text-primary transition-colors">Services</a></li>
            <li><a href="#projects" class="hover:text-primary transition-colors">Our Projects</a></li>
            <li><a href="#contact" class="hover:text-primary transition-colors">Contact Us</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-xs font-bold tracking-[0.2em] uppercase text-gray-500 mb-4">Services</h4>
          <ul class="space-y-2.5 text-sm text-gray-700">
            <li>Connectivity Solutions</li>
            <li>Infrastructure Management</li>
            <li>Digital Innovation</li>
            <li>Network Security</li>
            <li>Managed Services</li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-200 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
        <p>&copy; 2026 TelcoVantage Philippines. All rights reserved.</p>
        <p>Empowering businesses through connectivity.</p>
      </div>
    </div>
  </footer>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    const header = document.getElementById('site-header');
    const menuBtn = document.getElementById('menu-btn');
    const menuOpenIcon = document.getElementById('menu-open');
    const menuCloseIcon = document.getElementById('menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    let menuOpen = false;

    window.addEventListener('scroll', () => {
      if (window.scrollY > 24) {
        header.classList.add('nav-scrolled');
      } else {
        header.classList.remove('nav-scrolled');
      }
    });

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      gsap.to(mobileMenu, {
        height: menuOpen ? 'auto' : 0,
        opacity: menuOpen ? 1 : 0,
        duration: 0.35,
        ease: 'power2.out'
      });
      menuOpenIcon.classList.toggle('hidden', menuOpen);
      menuCloseIcon.classList.toggle('hidden', !menuOpen);
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        menuOpen = false;
        gsap.to(mobileMenu, { height: 0, opacity: 0, duration: 0.3, ease: 'power2.out' });
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
      });
    });

    gsap.set(['.reveal', '.reveal-left', '.reveal-right'], { opacity: 1 });

    gsap.utils.toArray('.reveal').forEach((el) => {
      gsap.from(el, {
        y: 30,
        opacity: 0,
        duration: 0.9,
        ease: 'power3.out',
        clearProps: 'all',
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          once: true
        }
      });
    });

    gsap.utils.toArray('.reveal-left').forEach((el) => {
      gsap.from(el, {
        x: -50,
        opacity: 0,
        duration: 1,
        ease: 'power3.out',
        clearProps: 'all',
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          once: true
        }
      });
    });

    gsap.utils.toArray('.reveal-right').forEach((el) => {
      gsap.from(el, {
        x: 50,
        opacity: 0,
        duration: 1,
        ease: 'power3.out',
        clearProps: 'all',
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          once: true
        }
      });
    });

    gsap.to('#hero-img', {
      y: -10,
      duration: 2.6,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut',
      overwrite: 'auto'
    });

    new Splide('#projects-splide', {
      type: 'loop',
      perPage: 3,
      perMove: 1,
      gap: '1.5rem',
      pagination: true,
      arrows: true,
      breakpoints: {
        1280: { perPage: 3 },
        1024: { perPage: 2 },
        640: { perPage: 1 }
      }
    }).mount();

    document.getElementById('contact-form').addEventListener('submit', function (e) {
      e.preventDefault();
      const btn = document.getElementById('submit-btn');
      btn.textContent = 'Message Sent';
      btn.classList.add('opacity-90');
      setTimeout(() => {
        btn.textContent = 'Send Message';
        btn.classList.remove('opacity-90');
        e.target.reset();
      }, 2200);
    });
  </script>
</body>
</html>
