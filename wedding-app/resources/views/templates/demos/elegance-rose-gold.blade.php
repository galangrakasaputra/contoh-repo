<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $wedding->groom_name ?? 'Romeo' }} &amp; {{ $wedding->bride_name ?? 'Juliet' }} — The Wedding</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            overflow-x: hidden;
        }

        /* =========================================================
           OPENING SCREEN
        ========================================================= */

        .opening-screen {
            background:
                radial-gradient(
                    circle at 50% 30%,
                    rgba(255,255,255,.95),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #fff7f8 0%,
                    #fce7eb 45%,
                    #f9d8df 100%
                );
        }


        /* =========================================================
           ORNAMENT
        ========================================================= */

        .ornament {
            position: absolute;
            border: 1px solid rgba(180, 83, 96, .25);
            border-radius: 999px;
        }

        .ornament-1 {
            width: 280px;
            height: 280px;
            top: -100px;
            left: -100px;
        }

        .ornament-2 {
            width: 350px;
            height: 350px;
            bottom: -160px;
            right: -150px;
        }


        /* =========================================================
           OPENING ANIMATION
        ========================================================= */

        .opening-content {
            animation: openingFade 1.2s ease forwards;
        }

        @keyframes openingFade {

            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* =========================================================
           INVITATION ENTRANCE
        ========================================================= */

        .invitation-enter {
            animation: invitationEnter 1.5s cubic-bezier(.22,1,.36,1) forwards;
        }

        @keyframes invitationEnter {

            from {
                opacity: 0;
                transform: scale(1.08);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }

        }


        /* =========================================================
           FLOATING DECORATION
        ========================================================= */

        .float {
            animation: float 5s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

        }


        /* =========================================================
           GOLD LINE
        ========================================================= */

        .gold-line {
            width: 80px;
            height: 1px;

            background: linear-gradient(
                to right,
                transparent,
                #b88a44,
                transparent
            );
        }


        /* =========================================================
           ROSE GOLD
        ========================================================= */

        .rose-gold {
            color: #a65d68;
        }


        /* =========================================================
           INVITATION BACKGROUND
        ========================================================= */

        .invitation-bg {
            background:
                radial-gradient(
                    circle at 20% 10%,
                    rgba(255,255,255,.9),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 80% 90%,
                    rgba(246,210,216,.6),
                    transparent 30%
                ),
                #fffafb;
        }


        /* =========================================================
           MUSIC BUTTON
        ========================================================= */

        .music-button {
            animation: musicPulse 2.5s ease-in-out infinite;
        }

        @keyframes musicPulse {

            0%,
            100% {
                box-shadow:
                    0 10px 30px rgba(225, 29, 72, .20);
            }

            50% {
                box-shadow:
                    0 10px 35px rgba(225, 29, 72, .40);
            }

        }


        /* =========================================================
           PHOTO HOVER
        ========================================================= */

        .gallery-item {
            transition:
                transform .4s ease,
                box-shadow .4s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow:
                0 15px 35px rgba(225, 29, 72, .12);
        }


        /* =========================================================
           GIFT CARD
        ========================================================= */

        .gift-card {
            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .gift-card:hover {
            transform: translateY(-4px);
            box-shadow:
                0 20px 40px rgba(225, 29, 72, .10);
        }


        /* =========================================================
           HEART
        ========================================================= */

        .heart-float {
            animation: heartFloat 4s ease-in-out infinite;
        }

        @keyframes heartFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(5deg);
            }

        }


        /* =========================================================
           COUNTDOWN
        ========================================================= */

        .countdown-box {
            transition: transform .3s ease;
        }

        .countdown-box:hover {
            transform: translateY(-4px);
        }


        /* =========================================================
           NAVIGATION
        ========================================================= */

        .bottom-navigation {
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }


        /* =========================================================
           SCROLLBAR
        ========================================================= */

        ::-webkit-scrollbar {
            width: 7px;
        }

        ::-webkit-scrollbar-track {
            background: #fff5f7;
        }

        ::-webkit-scrollbar-thumb {
            background: #e9a8b2;
            border-radius: 999px;
        }

    </style>
</head>


<body>

    @php
        $groom = $wedding->groom_name ?? 'Romeo';
        $bride = $wedding->bride_name ?? 'Juliet';
        $groom_nick = $wedding->groom_nickname ?? '';
        $bride_nick = $wedding->bride_nickname ?? '';
        $akad_display = $wedding->akad_date ? \Carbon\Carbon::parse($wedding->akad_date)->translatedFormat('l, d F Y') : 'Sabtu, 12 Desember 2026';
        $musicPath = data_get($wedding->data, 'music');
        $gallery = data_get($wedding->data, 'gallery', []);
        $groomPhoto = data_get($wedding->data, 'groom.photo');
        $bridePhoto = data_get($wedding->data, 'bride.photo');
        $coupleMessage = $wedding->message ?? data_get($wedding->data, 'message');
        $groomPayment = data_get($wedding->data, 'payment.groom', []);
        $bridePayment = data_get($wedding->data, 'payment.bride', []);
        $rsvps = $wedding->rsvps ?? collect();
        $groomAccountNumber = $groomPayment['account_number'] ?? $wedding->account_number;
        $groomAccountName = $groomPayment['account_name'] ?? $wedding->account_name;
        $brideAccountNumber = $bridePayment['account_number'] ?? $wedding->account_number_alt;
        $brideAccountName = $bridePayment['account_name'] ?? $wedding->account_name_alt;
        $countdownDate = $wedding->reception_date ?? $wedding->akad_date ?? '2026-12-12';
        $countdownTime = substr((string) ($wedding->reception_start_time ?? $wedding->akad_start_time ?? '08:00'), 0, 5);
    @endphp

    {{-- =========================================================
        BACKGROUND MUSIC
    ========================================================== --}}

    <audio
        id="backgroundMusic"
        loop
        preload="auto"
    >
        <source
            src="{{ $musicPath ? asset('storage/' . $musicPath) : asset('music/wedding-romantic.mp3') }}"
            type="audio/mpeg"
        >
    </audio>


    {{-- =========================================================
        ALPINE ROOT
    ========================================================== --}}

    <div
        x-data="{
            opened: false,

            openInvitation() {

                this.opened = true;

                document.body.style.overflow = 'auto';

                setTimeout(() => {

                    const music =
                        document.getElementById('backgroundMusic');

                    if (music) {

                        music.volume = 0.35;

                        music.play()
                            .then(() => {
                                updateMusicButton(true);
                            })
                            .catch(() => {
                                console.log(
                                    'Musik tidak dapat diputar otomatis.'
                                );
                            });

                    }

                }, 500);


                setTimeout(() => {

                    document
                        .getElementById('invitation')
                        ?.scrollIntoView({
                            behavior: 'smooth'
                        });

                }, 700);

            }
        }"

        class="min-h-screen"
    >


        {{-- =====================================================
            OPENING SCREEN
        ====================================================== --}}

        <section

            x-show="!opened"

            x-cloak

            x-transition:enter="transition ease-out duration-700"

            x-transition:enter-start="opacity-0"

            x-transition:enter-end="opacity-100"

            x-transition:leave="transition ease-in duration-700"

            x-transition:leave-start="opacity-100"

            x-transition:leave-end="opacity-0"

            class="opening-screen fixed inset-0 z-50 min-h-screen flex items-center justify-center overflow-hidden"
        >


            {{-- Decorative Circle --}}

            <div class="ornament ornament-1"></div>

            <div class="ornament ornament-2"></div>


            {{-- Decorative Flowers --}}

            <div class="absolute top-16 left-10 text-rose-200 text-5xl float">
                ❀
            </div>

            <div class="absolute bottom-20 right-10 text-rose-200 text-6xl float">
                ❀
            </div>


            {{-- Opening Content --}}

            <div class="opening-content relative z-10 text-center px-6 max-w-lg">


                <p class="text-xs tracking-[.35em] uppercase text-rose-500 mb-6">
                    The Wedding Of
                </p>


                <h1 class="text-5xl sm:text-6xl font-serif text-slate-800 leading-tight">

                    {{ $groom }}

                    <span class="block text-3xl my-2 text-rose-400">
                        &
                    </span>

                    {{ $bride }}

                </h1>


                <div class="gold-line mx-auto my-7"></div>


                <p class="text-sm text-slate-500 mb-10">
                    {{ $akad_display }}
                </p>
                <div
                    class="bg-white/70 backdrop-blur-md border border-white/80 rounded-2xl p-6 shadow-xl shadow-rose-200/30 mb-8"
                >

                    <p class="text-xs text-slate-400 mb-2">
                        Kepada Yth.
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        Tamu Undangan
                    </p>

                    <p class="text-xs text-slate-400 mt-2 leading-5">
                        Tanpa mengurangi rasa hormat,
                        kami mengundang Anda untuk hadir
                        di hari bahagia kami.
                    </p>

                </div>


                {{-- Open Button --}}

                <button

                    @click="openInvitation()"

                    class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-xl shadow-rose-600/30 transition-all duration-300 hover:-translate-y-1"
                >

                    <svg
                        class="w-5 h-5 transition-transform group-hover:rotate-12"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />

                    </svg>

                    Buka Undangan

                </button>


                <p class="text-[10px] text-slate-400 mt-6">
                    Mohon maaf apabila terdapat kesalahan penulisan nama
                </p>


                {{-- Music Info --}}

                <div class="mt-8 flex items-center justify-center gap-2 text-[10px] text-rose-400">

                    <span>♫</span>

                    <span>
                        Musik akan diputar setelah undangan dibuka
                    </span>

                </div>

            </div>

        </section>



        {{-- =====================================================
            INVITATION
        ====================================================== --}}

        <main

            id="invitation"

            x-show="opened"

            x-cloak

            class="invitation-bg min-h-screen invitation-enter"
        >


            {{-- =================================================
                MUSIC BUTTON
            ================================================== --}}

            <button

                id="musicButton"

                onclick="toggleMusic()"

                class="music-button fixed bottom-6 right-6 z-[60] w-12 h-12 rounded-full bg-rose-600 text-white flex items-center justify-center transition hover:scale-110"

                aria-label="Toggle Music"
            >

                {{-- Music On --}}

                <svg

                    id="musicOnIcon"

                    xmlns="http://www.w3.org/2000/svg"

                    class="w-5 h-5"

                    fill="none"

                    viewBox="0 0 24 24"

                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 19V6l12-3v13M9 19c0 1.657-1.567 3-3.5 3S2 20.657 2 19s1.567-3 3.5-3S9 17.343 9 19zm12-3c0 1.657-1.567 3-3.5 3S14 17.657 14 16s1.567-3 3.5-3S21 14.343 21 16z"
                    />

                </svg>


                {{-- Music Off --}}

                <svg

                    id="musicOffIcon"

                    xmlns="http://www.w3.org/2000/svg"

                    class="w-5 h-5 hidden"

                    fill="none"

                    viewBox="0 0 24 24"

                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9 19V6l12-3v13M9 19c0 1.657-1.567 3-3.5 3S2 20.657 2 19s1.567-3 3.5-3S9 17.343 9 19zM4 4l16 16"
                    />

                </svg>

            </button>



            {{-- =================================================
                HERO
            ================================================== --}}

            <section

                class="min-h-screen flex items-center justify-center px-6 py-20 text-center relative overflow-hidden"
            >

                <div class="absolute inset-0 pointer-events-none">

                    <div class="absolute top-10 left-10 text-rose-200 text-6xl float">
                        ❀
                    </div>

                    <div class="absolute bottom-20 right-10 text-rose-200 text-7xl float">
                        ❀
                    </div>

                    <div class="absolute top-1/2 right-5 text-rose-100 text-4xl heart-float">
                        ♡
                    </div>

                    <div class="absolute top-1/3 left-5 text-rose-100 text-4xl heart-float">
                        ♡
                    </div>

                </div>


                <div class="relative z-10 max-w-2xl">

                    <p class="text-xs tracking-[.4em] uppercase text-rose-500 mb-6">
                        The Wedding Of
                    </p>


                    <h1 class="font-serif text-6xl sm:text-8xl text-slate-800">

                        {{ $groom }}

                        <span class="block text-4xl sm:text-5xl text-rose-400 my-4">
                            &
                        </span>

                        {{ $bride }}

                    </h1>


                    <div class="gold-line mx-auto my-8"></div>


                    <p class="text-sm tracking-widest text-slate-500">
                        {{ strtoupper($akad_display) }}
                    </p>


                    <button

                        onclick="scrollToSection('couple')"

                        class="mt-12 px-6 py-3 border border-rose-300 text-rose-600 rounded-full text-sm hover:bg-rose-600 hover:text-white transition"
                    >

                        Scroll untuk melihat undangan

                    </button>

                </div>

            </section>



            {{-- =================================================
                COUPLE
            ================================================== --}}

            <section

                id="couple"

                class="py-24 px-6 bg-white/70"
            >

                <div class="max-w-4xl mx-auto text-center">

                    <p class="text-xs tracking-[.3em] uppercase text-rose-500 mb-3">
                        Assalamu'alaikum
                    </p>


                    <h2 class="text-3xl sm:text-4xl font-serif text-slate-800">
                        Dengan penuh kebahagiaan
                    </h2>


                    <p class="max-w-2xl mx-auto mt-6 text-sm leading-7 text-slate-500">

                        Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa,
                        kami bermaksud menyelenggarakan pernikahan kami
                        dan mengundang Bapak/Ibu/Saudara untuk hadir
                        serta memberikan doa restu.

                    </p>


                    <div class="grid md:grid-cols-2 gap-10 mt-16">


                        {{-- Groom --}}

                        <div class="text-center">

                            <div
                                class="w-40 h-40 mx-auto rounded-full overflow-hidden bg-rose-100 border-8 border-white shadow-xl flex items-center justify-center"
                            >

                                @if($groomPhoto)
                                    <img src="{{ asset('storage/' . $groomPhoto) }}" class="h-full w-full object-cover" alt="Mempelai pria">
                                @else
                                    <span class="font-serif text-4xl text-rose-400">R</span>
                                @endif

                            </div>


                            <h3 class="mt-6 text-3xl font-serif text-slate-800">
                                {{ $groom }}
                            </h3>


                            <p class="text-sm text-slate-500 mt-2">
                                {{ $groom_nick ? $groom_nick : $groom }}
                            </p>


                            <p class="text-xs text-slate-400 mt-1">
                                {{ $wedding->groom_father ? 'Putra dari ' . $wedding->groom_father : '' }} {{ $wedding->groom_mother ? ' & ' . $wedding->groom_mother : '' }}
                            </p>

                        </div>



                        {{-- Bride --}}

                        <div class="text-center">

                            <div
                                class="w-40 h-40 mx-auto rounded-full overflow-hidden bg-rose-100 border-8 border-white shadow-xl flex items-center justify-center"
                            >

                                @if($bridePhoto)
                                    <img src="{{ asset('storage/' . $bridePhoto) }}" class="h-full w-full object-cover" alt="Mempelai wanita">
                                @else
                                    <span class="font-serif text-4xl text-rose-400">J</span>
                                @endif

                            </div>


                            <h3 class="mt-6 text-3xl font-serif text-slate-800">
                                {{ $bride }}
                            </h3>


                            <p class="text-sm text-slate-500 mt-2">
                                {{ $bride_nick ? $bride_nick : $bride }}
                            </p>


                            <p class="text-xs text-slate-400 mt-1">
                                {{ $wedding->bride_father ? 'Putra dari ' . $wedding->bride_father : '' }} {{ $wedding->bride_mother ? ' & ' . $wedding->bride_mother : '' }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                EVENT
            ================================================== --}}

            <section class="py-24 px-6">

                <div class="max-w-5xl mx-auto">


                    <div class="text-center mb-14">

                        <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                            Save The Date
                        </p>

                        <h2 class="text-4xl font-serif text-slate-800 mt-3">
                            Waktu & Tempat
                        </h2>

                    </div>



                    <div class="grid md:grid-cols-2 gap-8">


                        {{-- Akad --}}

                        <div
                            class="bg-white rounded-3xl p-8 text-center shadow-xl shadow-rose-100/50 border border-rose-100"
                        >

                            <div class="text-rose-500 text-3xl mb-5">
                                ♡
                            </div>


                            <h3 class="text-2xl font-serif text-slate-800">
                                Akad Nikah
                            </h3>


                            <p class="text-sm text-slate-500 mt-5">
                                {{ $akad_display }}
                            </p>


                            <p class="text-2xl font-bold text-rose-600 mt-2">
                                {{ $wedding->akad_start_time ? \Carbon\Carbon::parse($wedding->akad_start_time)->format('H:i') . ' WIB' : '08.00 WIB' }}
                            </p>


                            <p class="text-sm text-slate-500 mt-5 leading-6">
                                {{ $wedding->akad_address ?? 'Gedung Pernikahan Bahagia\nJl. Mawar No. 123\nJakarta' }}
                            </p>

                            <a
                                href="{{ $wedding->akad_maps_url ?? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($wedding->akad_address ?? 'Gedung Pernikahan Bahagia Jakarta') }}"
                                target="_blank"
                                class="inline-block mt-7 px-5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-full text-xs font-semibold transition"
                            >
                                Lihat Lokasi
                            </a>

                        </div>



                        {{-- Resepsi --}}

                        <div
                            class="bg-white rounded-3xl p-8 text-center shadow-xl shadow-rose-100/50 border border-rose-100"
                        >

                            <div class="text-rose-500 text-3xl mb-5">
                                ♡
                            </div>


                            <h3 class="text-2xl font-serif text-slate-800">
                                Resepsi
                            </h3>


                            <p class="text-sm text-slate-500 mt-5">
                                {{ $wedding->reception_date ? \Carbon\Carbon::parse($wedding->reception_date)->translatedFormat('l, d F Y') : 'Sabtu, 12 Desember 2026' }}
                            </p>


                            <p class="text-2xl font-bold text-rose-600 mt-2">
                                {{ $wedding->reception_start_time ? \Carbon\Carbon::parse($wedding->reception_start_time)->format('H:i') . ' WIB' : '11.00 WIB' }}
                            </p>


                            <p class="text-sm text-slate-500 mt-5 leading-6">
                                {{ $wedding->reception_address ?? 'Gedung Pernikahan Bahagia\nJl. Mawar No. 123\nJakarta' }}
                            </p>


                            <a
                                href="{{ $wedding->reception_maps_url ?? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($wedding->reception_address ?? 'Gedung Pernikahan Bahagia Jakarta') }}"
                                target="_blank"
                                class="inline-block mt-7 px-5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-full text-xs font-semibold transition"
                            >
                                Lihat Lokasi
                            </a>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                COUNTDOWN
            ================================================== --}}

            <section

                class="py-24 px-6 bg-rose-50/70"

                x-data="countdown()"

                x-init="start()"
            >

                <div class="max-w-4xl mx-auto text-center">

                    <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                        Counting Down
                    </p>


                    <h2 class="text-4xl font-serif text-slate-800 mt-3">
                        Menuju Hari Bahagia
                    </h2>


                    <p class="text-sm text-slate-500 mt-5">
                        {{ $akad_display }}
                    </p>


                    <div class="grid grid-cols-4 gap-3 sm:gap-6 mt-12 max-w-xl mx-auto">


                        {{-- Hari --}}

                        <div class="countdown-box bg-white rounded-2xl p-4 sm:p-5 shadow-sm">

                            <div
                                class="text-3xl sm:text-4xl font-black text-rose-600"
                                x-text="days"
                            >
                                00
                            </div>

                            <div class="text-xs text-slate-400 mt-2">
                                Hari
                            </div>

                        </div>


                        {{-- Jam --}}

                        <div class="countdown-box bg-white rounded-2xl p-4 sm:p-5 shadow-sm">

                            <div
                                class="text-3xl sm:text-4xl font-black text-rose-600"
                                x-text="hours"
                            >
                                00
                            </div>

                            <div class="text-xs text-slate-400 mt-2">
                                Jam
                            </div>

                        </div>


                        {{-- Menit --}}

                        <div class="countdown-box bg-white rounded-2xl p-4 sm:p-5 shadow-sm">

                            <div
                                class="text-3xl sm:text-4xl font-black text-rose-600"
                                x-text="minutes"
                            >
                                00
                            </div>

                            <div class="text-xs text-slate-400 mt-2">
                                Menit
                            </div>

                        </div>


                        {{-- Detik --}}

                        <div class="countdown-box bg-white rounded-2xl p-4 sm:p-5 shadow-sm">

                            <div
                                class="text-3xl sm:text-4xl font-black text-rose-600"
                                x-text="seconds"
                            >
                                00
                            </div>

                            <div class="text-xs text-slate-400 mt-2">
                                Detik
                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                GALLERY
            ================================================== --}}

            <section

                id="gallery"

                class="py-24 px-6 bg-white"
            >

                <div class="max-w-6xl mx-auto">


                    <div class="text-center mb-12">

                        <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                            Our Moments
                        </p>


                        <h2 class="text-4xl font-serif text-slate-800 mt-3">
                            Galeri Kami
                        </h2>


                        <p class="text-sm text-slate-500 mt-4">
                            Cerita kecil dari perjalanan cinta kami.
                        </p>

                    </div>



                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">


                        @if(count($gallery) > 0)
                            @foreach($gallery as $image)
                                <div class="gallery-item aspect-square rounded-2xl bg-rose-100 overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" class="h-full w-full object-cover" alt="Galeri">
                                </div>
                            @endforeach
                        @else
                        @foreach(range(1, 8) as $image)

                            <div
                                class="gallery-item aspect-square rounded-2xl bg-rose-100 flex items-center justify-center overflow-hidden"
                            >

                                <div class="text-center">

                                    <div class="text-rose-300 text-4xl">
                                        ♡
                                    </div>

                                    <span class="text-xs text-rose-400">
                                        Foto {{ $image }}
                                    </span>

                                </div>

                            </div>

                        @endforeach
                        @endif


                    </div>

                </div>

            </section>



            @if($coupleMessage)
                <section class="px-6 py-16 bg-white">
                    <div class="max-w-2xl mx-auto text-center">
                        <p class="text-xs tracking-[.3em] uppercase text-rose-500">Pesan Pengantin</p>
                        <p class="mt-5 text-lg leading-8 text-slate-600 italic">{{ $coupleMessage }}</p>
                    </div>
                </section>
            @endif

            {{-- =================================================
                RSVP & UCAPAN
            ================================================== --}}

            <section

                id="rsvp"

                class="py-24 px-6 bg-rose-50/60"
            >

                <div class="max-w-3xl mx-auto">


                    <div class="text-center mb-12">

                        <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                            RSVP & Ucapan
                        </p>


                        <h2 class="text-4xl font-serif text-slate-800 mt-3">
                            Konfirmasi Kehadiran
                        </h2>


                        <p class="text-sm text-slate-500 mt-5 leading-7 max-w-xl mx-auto">

                            Silakan konfirmasi kehadiran dan berikan
                            ucapan terbaik untuk kami.

                        </p>

                    </div>



                    {{-- RSVP FORM --}}

                    <form

                        onsubmit="submitRSVP(event)"

                        action="{{ route('weddings.rsvps.store', $wedding) }}"

                        class="bg-white rounded-3xl p-7 sm:p-10 shadow-xl shadow-rose-100/50 border border-rose-100"
                    >

                        @csrf

                        <div class="space-y-5">


                            {{-- Nama --}}

                            <div>

                                <label class="block text-xs font-semibold text-slate-600 mb-2">
                                    Nama
                                </label>

                                <input

                                    id="rsvpName"

                                    name="name"

                                    type="text"

                                    required

                                    placeholder="Masukkan nama Anda"

                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 outline-none text-sm transition"
                                >

                            </div>



                            {{-- Attendance --}}

                            <div>

                                <label class="block text-xs font-semibold text-slate-600 mb-2">
                                    Konfirmasi Kehadiran
                                </label>

                                <select

                                    id="rsvpAttendance"

                                    name="attendance"

                                    required

                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 outline-none text-sm transition"
                                >

                                    <option value="">
                                        Pilih konfirmasi
                                    </option>

                                    <option value="Hadir">
                                        Saya akan hadir
                                    </option>

                                    <option value="Tidak Hadir">
                                        Saya tidak dapat hadir
                                    </option>

                                </select>

                            </div>



                            {{-- Message --}}

                            <div>

                                <label class="block text-xs font-semibold text-slate-600 mb-2">
                                    Ucapan & Doa
                                </label>

                                <textarea

                                    id="rsvpMessage"

                                    name="message"

                                    rows="4"

                                    required

                                    placeholder="Tuliskan ucapan dan doa terbaik..."

                                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 outline-none text-sm transition resize-none"
                                ></textarea>

                            </div>

                        </div>



                        <button

                            type="submit"

                            class="w-full mt-6 py-4 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-semibold text-sm shadow-lg shadow-rose-600/20 transition-all hover:-translate-y-0.5"
                        >

                            Kirim Konfirmasi & Ucapan

                        </button>

                    </form>



                    {{-- GUESTBOOK --}}

                    <div class="mt-14">


                        <div class="text-center mb-7">

                            <p class="text-xs tracking-[.25em] uppercase text-rose-400">
                                Guestbook
                            </p>

                            <h3 class="text-2xl font-serif text-slate-800 mt-2">
                                Ucapan & Doa
                            </h3>

                        </div>



                        <div
                            id="guestMessages"
                            class="space-y-4"
                        >


                            @foreach($rsvps as $rsvp)
                                <div class="bg-white rounded-2xl p-5 border border-rose-100 shadow-sm">

                                <div class="flex items-start justify-between gap-4">

                                    <div>

                                        <p class="font-semibold text-slate-800 text-sm">{{ $rsvp->name }}</p>

                                        <p class="text-xs text-rose-500 mt-1">{{ $rsvp->attendance }}</p>

                                    </div>

                                    <span class="text-rose-300 text-xl">
                                        ♡
                                    </span>

                                </div>


                                    <p class="text-sm text-slate-500 leading-6 mt-3">{{ $rsvp->message }}</p>

                                </div>
                            @endforeach

                            @if($rsvps->isEmpty())
                                <p class="text-center text-sm text-slate-500">Belum ada ucapan.</p>
                            @endif

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                AMplOP DIGITAL
            ================================================== --}}

            <section

                id="gift"

                class="py-24 px-6 bg-white"
            >

                <div class="max-w-4xl mx-auto text-center">


                    <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                        Wedding Gift
                    </p>


                    <h2 class="text-4xl font-serif text-slate-800 mt-3">
                        Amplop Digital
                    </h2>


                    <p class="text-sm text-slate-500 mt-5 leading-7 max-w-xl mx-auto">

                        Doa dan kehadiran Anda merupakan hadiah terindah
                        bagi kami. Namun apabila ingin memberikan tanda kasih,
                        dapat melalui rekening berikut.

                    </p>



                    <div class="grid md:grid-cols-2 gap-6 mt-12">


                        {{-- BANK BCA --}}

                        <div
                            class="gift-card bg-rose-50 rounded-3xl p-8 border border-rose-100"
                        >

                            <div
                                class="w-14 h-14 mx-auto rounded-full bg-white flex items-center justify-center shadow-sm"
                            >

                                <svg

                                    xmlns="http://www.w3.org/2000/svg"

                                    class="w-6 h-6 text-rose-500"

                                    fill="none"

                                    viewBox="0 0 24 24"

                                    stroke="currentColor"
                                >

                                    <path

                                        stroke-linecap="round"

                                        stroke-linejoin="round"

                                        stroke-width="1.7"

                                        d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M12 3l9 5H3l9-5z"
                                    />

                                </svg>

                            </div>


                            <p class="text-xs text-slate-400 mt-5">
                                BANK BCA
                            </p>


                            <p class="text-2xl font-bold tracking-wider text-slate-800 mt-2">
                                {{ $groomAccountNumber ?: 'Belum diisi' }}
                            </p>


                            <p class="text-sm text-slate-500 mt-2">
                                a.n. {{ $wedding->account_name ?? $groom }}
                            </p>


                            <button
                                onclick="copyAccount('{{ $groomAccountNumber }}', this)"
                                class="mt-6 px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-full text-xs font-semibold transition"
                            >
                                Salin Rekening
                            </button>

                        </div>



                        {{-- DANA --}}

                        <div
                            class="gift-card bg-slate-50 rounded-3xl p-8 border border-slate-200"
                        >

                            <div
                                class="w-14 h-14 mx-auto rounded-full bg-white flex items-center justify-center shadow-sm"
                            >

                                <svg

                                    xmlns="http://www.w3.org/2000/svg"

                                    class="w-6 h-6 text-rose-500"

                                    fill="none"

                                    viewBox="0 0 24 24"

                                    stroke="currentColor"
                                >

                                    <path

                                        stroke-linecap="round"

                                        stroke-linejoin="round"

                                        stroke-width="1.7"

                                        d="M3 7h18v12H3zM3 7l2-4h14l2 4M16 13h2"
                                    />

                                </svg>

                            </div>


                            <p class="text-xs text-slate-400 mt-5">
                                DANA
                            </p>


                            <p class="text-2xl font-bold tracking-wider text-slate-800 mt-2">
                                {{ $brideAccountNumber }}
                            </p>


                            <p class="text-sm text-slate-500 mt-2">
                                a.n. {{ $brideAccountName }}
                            </p>


                            <button
                                onclick="copyAccount('{{ $brideAccountNumber }}', this)"
                                class="mt-6 px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-full text-xs font-semibold transition"
                            >
                                Salin Nomor
                            </button>

                        </div>

                    </div>


                    <p class="text-xs text-slate-400 mt-8">
                        Terima kasih atas doa dan tanda kasih yang diberikan.
                    </p>

                </div>

            </section>



            {{-- =================================================
                CLOSING
            ================================================== --}}

            <section

                class="min-h-[70vh] flex items-center justify-center px-6 py-20 bg-rose-50 text-center"
            >

                <div>


                    <p class="text-xs tracking-[.3em] uppercase text-rose-500">
                        Thank You
                    </p>


                    <h2 class="text-5xl sm:text-6xl font-serif text-slate-800 mt-5">

                        {{ $groom }}

                        <span class="text-rose-400">
                            &
                        </span>

                        {{ $bride }}

                    </h2>


                    <div class="gold-line mx-auto my-8"></div>


                    <p class="text-sm text-slate-500 max-w-md mx-auto leading-7">

                        Merupakan suatu kehormatan dan kebahagiaan
                        bagi kami apabila Bapak/Ibu/Saudara/i
                        berkenan hadir dan memberikan doa restu.

                    </p>


                    <p class="mt-10 font-serif text-2xl text-rose-600">
                        Sampai jumpa di hari bahagia kami.
                    </p>


                    <div class="mt-8 text-rose-300 text-3xl">
                        ♡
                    </div>

                </div>

            </section>



            {{-- =================================================
                BOTTOM NAVIGATION
            ================================================== --}}

            <div

                class="bottom-navigation fixed bottom-0 left-0 right-0 z-50 bg-white/85 border-t border-rose-100 shadow-lg md:hidden"
            >

                <div class="grid grid-cols-4 max-w-lg mx-auto">


                    <button

                        onclick="scrollToSection('couple')"

                        class="py-3 text-center text-[10px] text-slate-500 hover:text-rose-600"
                    >

                        <div class="text-lg mb-1">
                            ♡
                        </div>

                        Mempelai

                    </button>


                    <button

                        onclick="scrollToSection('gallery')"

                        class="py-3 text-center text-[10px] text-slate-500 hover:text-rose-600"
                    >

                        <div class="text-lg mb-1">
                            ♧
                        </div>

                        Galeri

                    </button>


                    <button

                        onclick="scrollToSection('rsvp')"

                        class="py-3 text-center text-[10px] text-slate-500 hover:text-rose-600"
                    >

                        <div class="text-lg mb-1">
                            ♡
                        </div>

                        RSVP

                    </button>


                    <button

                        onclick="scrollToSection('gift')"

                        class="py-3 text-center text-[10px] text-slate-500 hover:text-rose-600"
                    >

                        <div class="text-lg mb-1">
                            ✦
                        </div>

                        Gift

                    </button>


                </div>

            </div>


        </main>

    </div>



    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>


        /* =========================================================
           MUSIC
        ========================================================= */

        function toggleMusic() {

            const music =
                document.getElementById('backgroundMusic');


            if (!music) {
                return;
            }


            if (music.paused) {

                music.play()
                    .then(() => {

                        updateMusicButton(true);

                    })
                    .catch(() => {

                        alert(
                            'Musik belum tersedia atau file musik tidak ditemukan.'
                        );

                    });

            } else {

                music.pause();

                updateMusicButton(false);

            }

        }



        function updateMusicButton(isPlaying) {

            const onIcon =
                document.getElementById('musicOnIcon');

            const offIcon =
                document.getElementById('musicOffIcon');


            if (!onIcon || !offIcon) {
                return;
            }


            if (isPlaying) {

                onIcon.classList.remove('hidden');

                offIcon.classList.add('hidden');

            } else {

                onIcon.classList.add('hidden');

                offIcon.classList.remove('hidden');

            }

        }



        /* =========================================================
           SCROLL
        ========================================================= */

        function scrollToSection(id) {

            const element =
                document.getElementById(id);


            if (!element) {
                return;
            }


            element.scrollIntoView({
                behavior: 'smooth'
            });

        }



        /* =========================================================
           COUNTDOWN
        ========================================================= */

        function countdown() {

            return {

                days: '00',

                hours: '00',

                minutes: '00',

                seconds: '00',


                targetDate:
                    new Date(@json($countdownDate . 'T' . $countdownTime . ':00+07:00')).getTime(),


                start() {

                    this.update();


                    setInterval(() => {

                        this.update();

                    }, 1000);

                },


                update() {

                    const now =
                        new Date().getTime();


                    const distance =
                        this.targetDate - now;


                    if (distance <= 0) {

                        this.days = '00';

                        this.hours = '00';

                        this.minutes = '00';

                        this.seconds = '00';

                        return;

                    }


                    this.days =
                        Math.floor(
                            distance /
                            (1000 * 60 * 60 * 24)
                        )
                        .toString()
                        .padStart(2, '0');


                    this.hours =
                        Math.floor(
                            (distance %
                                (1000 * 60 * 60 * 24)
                            ) /
                            (1000 * 60 * 60)
                        )
                        .toString()
                        .padStart(2, '0');


                    this.minutes =
                        Math.floor(
                            (distance %
                                (1000 * 60 * 60)
                            ) /
                            (1000 * 60)
                        )
                        .toString()
                        .padStart(2, '0');


                    this.seconds =
                        Math.floor(
                            (distance %
                                (1000 * 60)
                            ) /
                            1000
                        )
                        .toString()
                        .padStart(2, '0');

                }

            };

        }



        /* =========================================================
           RSVP
        ========================================================= */

        async function submitRSVP(event) {

            event.preventDefault();

            const form = event.currentTarget;


            const name =
                document
                    .getElementById('rsvpName')
                    .value
                    .trim();


            const attendance =
                document
                    .getElementById('rsvpAttendance')
                    .value;


            const message =
                document
                    .getElementById('rsvpMessage')
                    .value
                    .trim();


            if (
                !name ||
                !attendance ||
                !message
            ) {

                return;

            }

            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    },
                    body: new FormData(form),
                });

                if (!response.ok) {
                    const errorResult = await response.json().catch(() => ({}));
                    const validationMessage = Object.values(errorResult.errors ?? {})
                        .flat()
                        .join(' ');

                    throw new Error(validationMessage || 'RSVP request failed');
                }

                const result = await response.json();


            const container =
                document.getElementById(
                    'guestMessages'
                );


            const card =
                document.createElement('div');


            card.className =
                'bg-white rounded-2xl p-5 border border-rose-100 shadow-sm';


            card.innerHTML = `

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="font-semibold text-slate-800 text-sm">

                            ${escapeHTML(result.rsvp.name)}

                        </p>

                        <p class="text-xs text-rose-500 mt-1">

                            ${escapeHTML(result.rsvp.attendance)}

                        </p>

                    </div>


                    <span class="text-rose-300 text-xl">
                        ♡
                    </span>

                </div>


                <p class="text-sm text-slate-500 leading-6 mt-3">

                    ${escapeHTML(result.rsvp.message)}

                </p>

            `;


            container.prepend(card);


            document.getElementById(
                'rsvpName'
            ).value = '';


            document.getElementById(
                'rsvpAttendance'
            ).value = '';


            document.getElementById(
                'rsvpMessage'
            ).value = '';


            alert(
                'Terima kasih atas konfirmasi dan ucapannya ❤️'
            );
            } catch (error) {
                alert(error.message || 'Konfirmasi gagal disimpan. Silakan coba lagi.');
            } finally {
                submitButton.disabled = false;
            }

        }



        /* =========================================================
           ESCAPE HTML
        ========================================================= */

        function escapeHTML(text) {

            const div =
                document.createElement('div');


            div.textContent = text;


            return div.innerHTML;

        }



        /* =========================================================
           COPY ACCOUNT
        ========================================================= */

        function copyAccount(number, button) {

            if (
                navigator.clipboard &&
                window.isSecureContext
            ) {

                navigator.clipboard
                    .writeText(number)
                    .then(() => {

                        showCopied(button);

                    })
                    .catch(() => {

                        fallbackCopy(number, button);

                    });

            } else {

                fallbackCopy(number, button);

            }

        }



        function fallbackCopy(number, button) {

            const textarea =
                document.createElement('textarea');


            textarea.value = number;

            textarea.style.position = 'fixed';

            textarea.style.opacity = '0';


            document.body.appendChild(
                textarea
            );


            textarea.focus();

            textarea.select();


            try {

                document.execCommand(
                    'copy'
                );

                showCopied(button);

            } catch (error) {

                alert(
                    'Nomor rekening: ' +
                    number
                );

            }


            document.body.removeChild(
                textarea
            );

        }



        function showCopied(button) {

            const originalText =
                button.innerText;


            button.innerText =
                '✓ Berhasil Disalin';


            button.classList.add(
                'scale-95'
            );


            setTimeout(() => {

                button.innerText =
                    originalText;

                button.classList.remove(
                    'scale-95'
                );

            }, 2000);

        }

    </script>

</body>

</html>
