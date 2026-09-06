<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Javanese Heritage Traditional — The Wedding of Arjuna & Sekar</title>

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
            background: #f4efe4;
            color: #2d2118;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .opening-screen {
            background:
                radial-gradient(circle at center, rgba(184, 134, 11, .08), transparent 35%),
                linear-gradient(
                    135deg,
                    #20150f 0%,
                    #302018 45%,
                    #1d130e 100%
                );
        }

        .opening-pattern {
            background-image:
                linear-gradient(45deg, rgba(184,134,11,.04) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(184,134,11,.04) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(184,134,11,.04) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(184,134,11,.04) 75%);
            background-size: 50px 50px;
            background-position: 0 0, 0 25px, 25px -25px, -25px 0;
        }

        .gold-text {
            color: #c49a45;
        }

        .gold-border {
            border-color: #b88a35;
        }

        .gold-line {
            background: linear-gradient(
                to right,
                transparent,
                #b88a35,
                transparent
            );
        }

        .batik-pattern {
            background-color: #3a281d;
            background-image:
                radial-gradient(circle at 20% 20%, rgba(196,154,69,.13) 0 2px, transparent 3px),
                radial-gradient(circle at 80% 80%, rgba(196,154,69,.13) 0 2px, transparent 3px),
                linear-gradient(45deg, transparent 45%, rgba(196,154,69,.07) 46%, rgba(196,154,69,.07) 54%, transparent 55%),
                linear-gradient(-45deg, transparent 45%, rgba(196,154,69,.07) 46%, rgba(196,154,69,.07) 54%, transparent 55%);
            background-size: 35px 35px;
        }

        .hero-pattern {
            background:
                linear-gradient(rgba(39, 28, 20, .72), rgba(39, 28, 20, .72)),
                url("https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1800&q=85")
                center / cover;
        }

        .wood-card {
            background:
                linear-gradient(
                    135deg,
                    #fffaf0,
                    #eee2cc
                );
            box-shadow:
                0 20px 50px rgba(48, 31, 18, .12);
        }

        .heritage-card {
            position: relative;
            overflow: hidden;
        }

        .heritage-card::before,
        .heritage-card::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 70px;
            border-color: rgba(184, 138, 53, .45);
            pointer-events: none;
        }

        .heritage-card::before {
            top: 14px;
            left: 14px;
            border-top: 1px solid;
            border-left: 1px solid;
        }

        .heritage-card::after {
            bottom: 14px;
            right: 14px;
            border-bottom: 1px solid;
            border-right: 1px solid;
        }

        .ornament {
            color: #b88a35;
            opacity: .65;
        }

        .javanese-title {
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .photo-frame {
            border: 8px solid #3b2a1f;
            outline: 1px solid #b88a35;
            outline-offset: 5px;
            background: #ded1bb;
        }

        .photo-frame img {
            filter: sepia(.15);
        }

        .section-label {
            letter-spacing: .35em;
            text-transform: uppercase;
            font-size: 11px;
            color: #8d6930;
        }

        .traditional-button {
            border: 1px solid #b88a35;
            background: #3b2a1f;
            color: #f7ecd8;
            transition: .3s ease;
        }

        .traditional-button:hover {
            background: #4c3525;
            transform: translateY(-2px);
        }

        .cream-button {
            border: 1px solid #8d6930;
            color: #4a3425;
            background: #f8f0e2;
            transition: .3s ease;
        }

        .cream-button:hover {
            background: #eee0c8;
        }

        .opening-content {
            animation: openingReveal 1.3s ease forwards;
        }

        @keyframes openingReveal {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 1s ease forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .divider-line {
            width: 70px;
            height: 1px;
            background: #b88a35;
        }

        .guest-entry {
            border-bottom: 1px solid rgba(141, 105, 48, .25);
        }

        .mobile-nav {
            backdrop-filter: blur(12px);
            background: rgba(48, 32, 24, .95);
        }

        .music-button {
            position: fixed;
            right: 20px;
            bottom: 90px;
            z-index: 60;
            width: 46px;
            height: 46px;
            border-radius: 999px;
            background: #3b2a1f;
            border: 1px solid #c49a45;
            color: #e7c879;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
        }

        .music-spin {
            animation: spinMusic 3s linear infinite;
        }

        @keyframes spinMusic {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

@php
    $musicPath = data_get($wedding->data, 'music');
    $gallery = data_get($wedding->data, 'gallery', []);
    $groomPhoto = data_get($wedding->data, 'groom.photo');
    $bridePhoto = data_get($wedding->data, 'bride.photo');
    $rsvpData = $wedding->rsvps->map(fn ($rsvp) => [
        'id' => $rsvp->id,
        'name' => $rsvp->name,
        'attendance' => $rsvp->attendance,
        'message' => $rsvp->message,
        'date' => $rsvp->created_at?->toDateString(),
    ])->values();
    $countdownDate = $wedding->reception_date ?? $wedding->akad_date ?? '2026-12-12';
    $countdownTime = substr((string) ($wedding->reception_start_time ?? $wedding->akad_start_time ?? '08:00'), 0, 5);
@endphp

<div
    x-data="javaneseWedding()"
    x-init="init()"
    class="min-h-screen"
>

    <!-- =====================================================
         OPENING
    ====================================================== -->

    <section
        x-show="!opened"
        x-transition:leave="transition duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="opening-screen opening-pattern fixed inset-0 z-[100] flex items-center justify-center px-6"
    >

        <div class="opening-content text-center max-w-xl">

            <div class="mb-7">
                <p class="section-label text-[#c49a45] mb-4">
                    Undangan Pernikahan
                </p>

                <div class="divider">
                    <div class="divider-line"></div>

                    <span class="text-[#c49a45] text-2xl">
                        ❖
                    </span>

                    <div class="divider-line"></div>
                </div>
            </div>

            <div class="mb-8">

                <p class="text-[#dfcda9] text-sm tracking-[.25em] uppercase mb-4">
                    The Wedding of
                </p>

                <h1 class="text-5xl md:text-7xl text-[#f5e8cf] font-serif leading-tight">
                    Arjuna
                </h1>

                <div class="flex items-center justify-center gap-4 my-3">
                    <div class="w-14 h-px bg-[#b88a35]"></div>
                    <span class="text-[#c49a45] text-xl">
                        &
                    </span>
                    <div class="w-14 h-px bg-[#b88a35]"></div>
                </div>

                <h1 class="text-5xl md:text-7xl text-[#f5e8cf] font-serif leading-tight">
                    Sekar
                </h1>
            </div>

            <div class="mb-8">

                <div class="inline-block border border-[#b88a35]/50 px-7 py-4">

                    <p class="text-[#dfcda9] text-xs tracking-[.25em] uppercase">
                        Sabtu
                    </p>

                    <p class="text-[#c49a45] text-3xl font-serif my-1">
                        12.12.2026
                    </p>

                    <p class="text-[#dfcda9] text-xs tracking-[.25em] uppercase">
                        Yogyakarta
                    </p>

                </div>

            </div>

            <p class="text-[#bcae95] text-sm mb-2">
                Kepada Yth.
            </p>

            <p class="text-[#f5e8cf] font-serif text-lg mb-7">
                Bapak / Ibu / Saudara / i
            </p>

            <button
                @click="openInvitation()"
                class="traditional-button inline-flex items-center gap-3 px-8 py-3 text-sm tracking-[.18em] uppercase"
            >
                <span>✦</span>
                Buka Undangan
                <span>✦</span>
            </button>

        </div>
    </section>


    <!-- =====================================================
         MUSIC
    ====================================================== -->

    <audio
        id="backgroundMusic"
        loop
        preload="auto"
    >
        <source
            src="{{ $musicPath ? asset('storage/' . $musicPath) : asset('music/gending-jawa.mp3') }}"
            type="audio/mpeg"
        >
    </audio>

    <button
        x-show="opened"
        x-cloak
        @click="toggleMusic()"
        class="music-button"
        title="Musik"
    >
        <span
            x-show="musicPlaying"
            class="music-spin"
        >
            ♪
        </span>

        <span x-show="!musicPlaying">
            ♫
        </span>
    </button>


    <!-- =====================================================
         MAIN INVITATION
    ====================================================== -->

    <main
        x-show="opened"
        x-cloak
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
    >

        <!-- HERO -->

        <section class="hero-pattern min-h-screen flex items-center justify-center px-6 text-center">

            <div class="max-w-4xl text-[#f7ecd8]">

                <p class="section-label text-[#d9bb75] mb-6">
                    Pawiwahan
                </p>

                <h2 class="text-6xl md:text-8xl font-serif leading-none">
                    Arjuna
                </h2>

                <div class="flex justify-center items-center gap-5 my-5">

                    <div class="w-16 h-px bg-[#c49a45]"></div>

                    <span class="text-[#c49a45] text-3xl">
                        &
                    </span>

                    <div class="w-16 h-px bg-[#c49a45]"></div>

                </div>

                <h2 class="text-6xl md:text-8xl font-serif leading-none">
                    Sekar
                </h2>

                <p class="mt-8 text-[#dfcda9] tracking-[.25em] uppercase text-sm">
                    12 Desember 2026 · Yogyakarta
                </p>

                <div class="mt-10 flex justify-center">
                    <button
                        @click="scrollTo('couple')"
                        class="border border-[#c49a45] px-7 py-3 text-xs tracking-[.2em] uppercase hover:bg-[#c49a45] hover:text-[#2b1c14] transition"
                    >
                        Lihat Undangan
                    </button>
                </div>

            </div>

        </section>


        <!-- INTRO -->

        <section class="bg-[#f7f0e4] py-24 px-6">

            <div class="max-w-3xl mx-auto text-center">

                <p class="section-label mb-5">
                    Assalamu'alaikum Warahmatullahi Wabarakatuh
                </p>

                <div class="divider mb-7">
                    <div class="divider-line"></div>
                    <span class="gold-text">❖</span>
                    <div class="divider-line"></div>
                </div>

                <p class="text-lg md:text-xl leading-loose text-[#574536]">
                    Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa,
                    kami bermaksud menyelenggarakan acara pernikahan putra
                    dan putri kami.
                </p>

            </div>

        </section>


        <!-- COUPLE -->

        <section
            id="couple"
            class="py-24 px-6 bg-[#eee2cf]"
        >

            <div class="max-w-5xl mx-auto">

                <div class="text-center mb-14">

                    <p class="section-label mb-3">
                        Mempelai
                    </p>

                    <h3 class="text-4xl md:text-5xl font-serif">
                        Kedua Mempelai
                    </h3>

                </div>


                <div class="grid md:grid-cols-2 gap-16 items-center">

                    <!-- GROOM -->

                    <div class="text-center">

                        <div class="photo-frame w-64 h-80 mx-auto mb-9">

                            <img
                                src="{{ $groomPhoto ? asset('storage/' . $groomPhoto) : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=700&q=80' }}"
                                class="w-full h-full object-cover"
                                alt="Mempelai Pria"
                            >

                        </div>

                        <p class="section-label mb-3">
                            Mempelai Pria
                        </p>

                        <h4 class="text-4xl font-serif mb-3">
                            Raden Mas Arjuna
                        </h4>

                        <p class="text-[#6e5a45]">
                            Putra dari
                        </p>

                        <p class="font-semibold mt-1">
                            Bapak Suryanto & Ibu Sri Lestari
                        </p>

                    </div>


                    <!-- BRIDE -->

                    <div class="text-center">

                        <div class="photo-frame w-64 h-80 mx-auto mb-9">

                            <img
                                src="{{ $bridePhoto ? asset('storage/' . $bridePhoto) : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=700&q=80' }}"
                                class="w-full h-full object-cover"
                                alt="Mempelai Wanita"
                            >

                        </div>

                        <p class="section-label mb-3">
                            Mempelai Wanita
                        </p>

                        <h4 class="text-4xl font-serif mb-3">
                            Raden Ayu Sekar
                        </h4>

                        <p class="text-[#6e5a45]">
                            Putri dari
                        </p>

                        <p class="font-semibold mt-1">
                            Bapak Wijaya & Ibu Rahayu
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- HERITAGE ORNAMENT -->

        <section class="batik-pattern py-20 px-6">

            <div class="max-w-3xl mx-auto text-center text-[#f2e2c3]">

                <div class="text-6xl mb-7 ornament">
                    ꦲꦤ꧀ꦠꦸꦁ
                </div>

                <p class="section-label text-[#d6b76d] mb-4">
                    Filosofi
                </p>

                <h3 class="text-4xl md:text-5xl font-serif mb-6">
                    Rukun, Tresna, Langgeng
                </h3>

                <p class="text-[#d9c7a7] leading-loose">
                    Semoga perjalanan dua insan ini menjadi keluarga yang
                    senantiasa diliputi kasih sayang, ketenteraman,
                    kebersamaan, dan keberkahan.
                </p>

            </div>

        </section>


        <!-- STORY -->

        <section class="py-24 px-6 bg-[#f8f1e5]">

            <div class="max-w-4xl mx-auto">

                <div class="text-center mb-14">

                    <p class="section-label mb-3">
                        Kisah Kami
                    </p>

                    <h3 class="text-4xl md:text-5xl font-serif">
                        Sebuah Perjalanan
                    </h3>

                </div>

                <div class="space-y-12">

                    <div class="grid md:grid-cols-[130px_1fr] gap-6">

                        <div class="text-center md:text-right">
                            <span class="text-[#b88a35] font-serif text-2xl">
                                2021
                            </span>
                        </div>

                        <div class="heritage-card wood-card p-8">
                            <h4 class="font-serif text-2xl mb-3">
                                Pertama Bertemu
                            </h4>

                            <p class="text-[#675341] leading-relaxed">
                                Berawal dari sebuah pertemuan sederhana
                                yang kemudian menjadi awal dari perjalanan
                                panjang kami.
                            </p>
                        </div>

                    </div>


                    <div class="grid md:grid-cols-[130px_1fr] gap-6">

                        <div class="text-center md:text-right">
                            <span class="text-[#b88a35] font-serif text-2xl">
                                2024
                            </span>
                        </div>

                        <div class="heritage-card wood-card p-8">
                            <h4 class="font-serif text-2xl mb-3">
                                Menyatukan Langkah
                            </h4>

                            <p class="text-[#675341] leading-relaxed">
                                Kami menyadari bahwa perjalanan ini ingin
                                kami lanjutkan bersama, dalam suka maupun duka.
                            </p>
                        </div>

                    </div>


                    <div class="grid md:grid-cols-[130px_1fr] gap-6">

                        <div class="text-center md:text-right">
                            <span class="text-[#b88a35] font-serif text-2xl">
                                2026
                            </span>
                        </div>

                        <div class="heritage-card wood-card p-8">
                            <h4 class="font-serif text-2xl mb-3">
                                Pawiwahan
                            </h4>

                            <p class="text-[#675341] leading-relaxed">
                                Hari ketika dua keluarga dipertemukan dan
                                dua hati mengikat janji untuk selamanya.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- EVENT -->

        <section
            id="event"
            class="py-24 px-6 bg-[#e9dcc8]"
        >

            <div class="max-w-5xl mx-auto">

                <div class="text-center mb-14">

                    <p class="section-label mb-3">
                        Waktu & Tempat
                    </p>

                    <h3 class="text-4xl md:text-5xl font-serif">
                        Acara Pawiwahan
                    </h3>

                </div>


                <div class="grid md:grid-cols-2 gap-8">

                    <!-- AKAD -->

                    <div class="heritage-card bg-[#f8f0e2] p-10 text-center border border-[#b88a35]/30">

                        <div class="text-[#b88a35] text-4xl mb-5">
                            ❖
                        </div>

                        <p class="section-label mb-3">
                            Acara Pertama
                        </p>

                        <h4 class="text-3xl font-serif mb-6">
                            Akad Nikah
                        </h4>

                        <p class="text-[#66523f] mb-2">
                            Sabtu, 12 Desember 2026
                        </p>

                        <p class="font-semibold text-lg mb-5">
                            08.00 WIB
                        </p>

                        <div class="w-16 h-px bg-[#b88a35] mx-auto mb-5"></div>

                        <p class="font-serif text-xl">
                            Pendopo Agung Yogyakarta
                        </p>

                        <p class="text-sm text-[#75634f] mt-2">
                            Jl. Malioboro No. 12, Yogyakarta
                        </p>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query=Pendopo+Agung+Yogyakarta"
                            target="_blank"
                            class="cream-button inline-block mt-7 px-6 py-3 text-xs tracking-[.15em] uppercase"
                        >
                            Buka Peta
                        </a>

                    </div>


                    <!-- RECEPTION -->

                    <div class="heritage-card bg-[#3b2a1f] text-[#f5e8cf] p-10 text-center border border-[#b88a35]/50">

                        <div class="text-[#c49a45] text-4xl mb-5">
                            ✦
                        </div>

                        <p class="section-label text-[#d0ae64] mb-3">
                            Acara Kedua
                        </p>

                        <h4 class="text-3xl font-serif mb-6">
                            Resepsi
                        </h4>

                        <p class="text-[#dbc8a7] mb-2">
                            Sabtu, 12 Desember 2026
                        </p>

                        <p class="font-semibold text-lg mb-5">
                            11.00 – 14.00 WIB
                        </p>

                        <div class="w-16 h-px bg-[#b88a35] mx-auto mb-5"></div>

                        <p class="font-serif text-xl">
                            Pendopo Agung Yogyakarta
                        </p>

                        <p class="text-sm text-[#c8b69a] mt-2">
                            Jl. Malioboro No. 12, Yogyakarta
                        </p>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query=Pendopo+Agung+Yogyakarta"
                            target="_blank"
                            class="inline-block mt-7 border border-[#c49a45] px-6 py-3 text-xs tracking-[.15em] uppercase hover:bg-[#c49a45] hover:text-[#302018] transition"
                        >
                            Buka Peta
                        </a>

                    </div>

                </div>

            </div>

        </section>


        <!-- COUNTDOWN -->

        <section class="batik-pattern py-24 px-6">

            <div class="max-w-4xl mx-auto text-center text-[#f3e5ca]">

                <p class="section-label text-[#d0ae64] mb-4">
                    Menuju Hari Bahagia
                </p>

                <h3 class="text-4xl md:text-5xl font-serif mb-12">
                    Menghitung Hari
                </h3>


                <div class="grid grid-cols-4 gap-3 md:gap-6">

                    <div class="border border-[#b88a35]/50 py-5">
                        <div
                            class="text-3xl md:text-5xl font-serif text-[#d7b866]"
                            x-text="days"
                        ></div>
                        <p class="text-[9px] md:text-xs tracking-[.2em] uppercase text-[#bfae90] mt-2">
                            Hari
                        </p>
                    </div>

                    <div class="border border-[#b88a35]/50 py-5">
                        <div
                            class="text-3xl md:text-5xl font-serif text-[#d7b866]"
                            x-text="hours"
                        ></div>
                        <p class="text-[9px] md:text-xs tracking-[.2em] uppercase text-[#bfae90] mt-2">
                            Jam
                        </p>
                    </div>

                    <div class="border border-[#b88a35]/50 py-5">
                        <div
                            class="text-3xl md:text-5xl font-serif text-[#d7b866]"
                            x-text="minutes"
                        ></div>
                        <p class="text-[9px] md:text-xs tracking-[.2em] uppercase text-[#bfae90] mt-2">
                            Menit
                        </p>
                    </div>

                    <div class="border border-[#b88a35]/50 py-5">
                        <div
                            class="text-3xl md:text-5xl font-serif text-[#d7b866]"
                            x-text="seconds"
                        ></div>
                        <p class="text-[9px] md:text-xs tracking-[.2em] uppercase text-[#bfae90] mt-2">
                            Detik
                        </p>
                    </div>

                </div>

            </div>

        </section>


        <!-- GALLERY -->

        <section class="py-24 px-6 bg-[#f8f1e5]">

            <div class="max-w-6xl mx-auto">

                <div class="text-center mb-14">

                    <p class="section-label mb-3">
                        Galeri
                    </p>

                    <h3 class="text-4xl md:text-5xl font-serif">
                        Potret Perjalanan
                    </h3>

                </div>


                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    @foreach($gallery as $image)
                        <div class="photo-frame aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('storage/' . $image) }}" class="h-full w-full object-cover" alt="Galeri">
                        </div>
                    @endforeach

                    <div class="photo-frame aspect-[3/4]">
                        <img
                            src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=700&q=80"
                            class="w-full h-full object-cover"
                            alt="Galeri 1"
                        >
                    </div>

                    <div class="photo-frame aspect-[3/4] mt-8">
                        <img
                            src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=700&q=80"
                            class="w-full h-full object-cover"
                            alt="Galeri 2"
                        >
                    </div>

                    <div class="photo-frame aspect-[3/4]">
                        <img
                            src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=700&q=80"
                            class="w-full h-full object-cover"
                            alt="Galeri 3"
                        >
                    </div>

                    <div class="photo-frame aspect-[3/4] mt-8">
                        <img
                            src="https://images.unsplash.com/photo-1606800052052-a08af7148866?auto=format&fit=crop&w=700&q=80"
                            class="w-full h-full object-cover"
                            alt="Galeri 4"
                        >
                    </div>

                </div>

            </div>

        </section>


        <!-- GUESTBOOK -->

        <section
            id="guestbook"
            class="py-24 px-6 bg-[#e9dcc8]"
        >

            <div class="max-w-5xl mx-auto">

                <div class="text-center mb-14">

                    <p class="section-label mb-3">
                        Buku Tamu Digital
                    </p>

                    <h3 class="text-4xl md:text-5xl font-serif">
                        Doa & Ucapan
                    </h3>

                    <p class="max-w-xl mx-auto mt-5 text-[#685442] leading-relaxed">
                        Tinggalkan doa, ucapan, dan pesan terbaik
                        untuk perjalanan rumah tangga kami.
                    </p>

                </div>


                <div class="grid md:grid-cols-2 gap-10">

                    <!-- FORM -->

                    <div class="heritage-card bg-[#f8f0e2] p-8 md:p-10">

                        <form
                            @submit.prevent="addGuestbook($event)"
                            action="{{ route('weddings.rsvps.store', $wedding) }}"
                        >

                            @csrf

                            <div class="mb-5">

                                <label class="block text-xs uppercase tracking-[.15em] text-[#80623c] mb-2">
                                    Nama
                                </label>

                                <input
                                    x-model="guestName"
                                    name="name"
                                    type="text"
                                    required
                                    placeholder="Nama Anda"
                                    class="w-full bg-transparent border-b border-[#b88a35]/40 px-0 py-3 outline-none focus:border-[#8d6930]"
                                >

                            </div>


                            <div class="mb-5">

                                <label class="block text-xs uppercase tracking-[.15em] text-[#80623c] mb-2">
                                    Kehadiran
                                </label>

                                <select
                                    x-model="guestAttendance"
                                    name="attendance"
                                    required
                                    class="w-full bg-transparent border-b border-[#b88a35]/40 px-0 py-3 outline-none"
                                >
                                    <option value="">
                                        Pilih konfirmasi
                                    </option>

                                    <option value="Hadir">
                                        Saya akan hadir
                                    </option>

                                    <option value="Tidak Hadir">
                                        Maaf, tidak dapat hadir
                                    </option>
                                </select>

                            </div>


                            <div class="mb-7">

                                <label class="block text-xs uppercase tracking-[.15em] text-[#80623c] mb-2">
                                    Ucapan
                                </label>

                                <textarea
                                    x-model="guestMessage"
                                    name="message"
                                    required
                                    rows="4"
                                    placeholder="Tulis doa dan ucapan..."
                                    class="w-full bg-transparent border-b border-[#b88a35]/40 px-0 py-3 outline-none resize-none focus:border-[#8d6930]"
                                ></textarea>

                            </div>


                            <button
                                type="submit"
                                class="traditional-button w-full py-3 text-xs tracking-[.18em] uppercase"
                            >
                                Kirim Ucapan
                            </button>

                        </form>

                    </div>


                    <!-- GUEST LIST -->

                    <div>

                        <template x-if="guestbooks.length === 0">

                            <div class="text-center py-16 text-[#77644e]">
                                <div class="text-4xl mb-4">
                                    ❖
                                </div>

                                <p class="font-serif text-xl">
                                    Jadilah yang pertama
                                </p>

                                <p class="text-sm mt-2">
                                    Kirim doa dan ucapan untuk kedua mempelai.
                                </p>
                            </div>

                        </template>


                        <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">

                            <template
                                x-for="guest in guestbooks"
                                :key="guest.id"
                            >

                                <div class="guest-entry pb-5">

                                    <div class="flex items-start justify-between gap-4">

                                        <div>

                                            <h4
                                                class="font-serif text-xl"
                                                x-text="guest.name"
                                            ></h4>

                                            <p
                                                class="text-xs text-[#9a7a4c] mt-1"
                                                x-text="guest.attendance"
                                            ></p>

                                        </div>

                                        <span class="text-[#b88a35]">
                                            ✦
                                        </span>

                                    </div>

                                    <p
                                        class="text-sm text-[#66523f] mt-3 leading-relaxed"
                                        x-text="guest.message"
                                    ></p>

                                </div>

                            </template>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- RSVP -->

        <section class="py-24 px-6 bg-[#f8f1e5]">

            <div class="max-w-3xl mx-auto text-center">

                <p class="section-label mb-4">
                    Konfirmasi Kehadiran
                </p>

                <h3 class="text-4xl md:text-5xl font-serif mb-6">
                    Sampai Jumpa
                </h3>

                <p class="text-[#66523f] leading-loose mb-9">
                    Kehadiran dan doa restu Anda merupakan kebahagiaan
                    bagi kami dan keluarga.
                </p>

                <button
                    @click="scrollTo('guestbook')"
                    class="traditional-button px-8 py-4 text-xs tracking-[.2em] uppercase"
                >
                    Isi Buku Tamu
                </button>

            </div>

        </section>


        <!-- CLOSING -->

        <section class="batik-pattern py-28 px-6 text-center">

            <div class="max-w-3xl mx-auto text-[#f5e8cf]">

                <div class="text-[#c49a45] text-5xl mb-8">
                    ❖
                </div>

                <p class="text-[#d7c5a5] text-sm tracking-[.2em] uppercase mb-6">
                    Matur Nuwun
                </p>

                <h3 class="text-5xl md:text-7xl font-serif mb-8">
                    Arjuna & Sekar
                </h3>

                <p class="text-[#d0bea0] leading-loose max-w-xl mx-auto">
                    Terima kasih telah menjadi bagian dari cerita
                    dan hari bahagia kami.
                </p>

                <div class="divider mt-10">
                    <div class="divider-line"></div>
                    <span class="text-[#c49a45]">✦</span>
                    <div class="divider-line"></div>
                </div>

            </div>

        </section>


        <!-- FOOTER -->

        <footer class="bg-[#241811] text-[#a9987e] text-center py-8 px-6">

            <p class="text-xs tracking-[.18em] uppercase">
                Javanese Heritage Traditional
            </p>

            <p class="text-xs mt-2">
                Digital Wedding Invitation
            </p>

        </footer>


        <!-- MOBILE NAV -->

        <nav class="mobile-nav fixed bottom-0 left-0 right-0 z-50 md:hidden border-t border-[#b88a35]/30">

            <div class="grid grid-cols-4">

                <button
                    @click="scrollTo('couple')"
                    class="py-3 text-[#dbc89f]"
                >
                    <div class="text-lg">♙</div>
                    <div class="text-[9px] uppercase tracking-wider">
                        Mempelai
                    </div>
                </button>

                <button
                    @click="scrollTo('event')"
                    class="py-3 text-[#dbc89f]"
                >
                    <div class="text-lg">❖</div>
                    <div class="text-[9px] uppercase tracking-wider">
                        Acara
                    </div>
                </button>

                <button
                    @click="scrollTo('guestbook')"
                    class="py-3 text-[#dbc89f]"
                >
                    <div class="text-lg">✎</div>
                    <div class="text-[9px] uppercase tracking-wider">
                        Ucapan
                    </div>
                </button>

                <button
                    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="py-3 text-[#dbc89f]"
                >
                    <div class="text-lg">⌂</div>
                    <div class="text-[9px] uppercase tracking-wider">
                        Home
                    </div>
                </button>

            </div>

        </nav>

    </main>

</div>


<script>
function javaneseWedding() {

    return {

        opened: false,

        musicPlaying: false,

        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',

        target: new Date(@json($countdownDate . 'T' . $countdownTime . ':00+07:00')).getTime(),

        guestName: '',
        guestAttendance: '',
        guestMessage: '',

        guestbooks: @json($rsvpData),


        init() {

            this.updateCountdown();

            setInterval(() => {
                this.updateCountdown();
            }, 1000);


        },


        openInvitation() {

            this.opened = true;

            document.body.style.overflow = 'auto';

            this.$nextTick(() => {

                const music =
                    document.getElementById(
                        'backgroundMusic'
                    );

                if (music) {

                    music.volume = 0.35;

                    music.play()
                        .then(() => {

                            this.musicPlaying = true;

                        })
                        .catch(() => {

                            this.musicPlaying = false;

                        });

                }

            });

        },


        toggleMusic() {

            const music =
                document.getElementById(
                    'backgroundMusic'
                );

            if (!music) return;


            if (music.paused) {

                music.play()
                    .then(() => {

                        this.musicPlaying = true;

                    })
                    .catch(() => {});

            } else {

                music.pause();

                this.musicPlaying = false;

            }

        },


        updateCountdown() {

            const now = new Date().getTime();

            const difference =
                this.target - now;


            if (difference <= 0) {

                this.days = '00';
                this.hours = '00';
                this.minutes = '00';
                this.seconds = '00';

                return;

            }


            this.days = Math.floor(
                difference /
                (1000 * 60 * 60 * 24)
            )
            .toString()
            .padStart(2, '0');


            this.hours = Math.floor(
                (difference %
                    (1000 * 60 * 60 * 24)) /
                (1000 * 60 * 60)
            )
            .toString()
            .padStart(2, '0');


            this.minutes = Math.floor(
                (difference %
                    (1000 * 60 * 60)) /
                (1000 * 60)
            )
            .toString()
            .padStart(2, '0');


            this.seconds = Math.floor(
                (difference %
                    (1000 * 60)) /
                1000
            )
            .toString()
            .padStart(2, '0');

        },


        scrollTo(id) {

            const element =
                document.getElementById(id);

            if (!element) return;

            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        },


        async addGuestbook(event) {

            if (
                !this.guestName ||
                !this.guestAttendance ||
                !this.guestMessage
            ) {

                return;

            }


            const form = event.currentTarget;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    },
                    body: new URLSearchParams({
                        name: this.guestName.trim(),
                        attendance: this.guestAttendance,
                        message: this.guestMessage.trim(),
                    }),
                });

                if (!response.ok) {
                    const errorResult = await response.json().catch(() => ({}));
                    const validationMessage = Object.values(errorResult.errors ?? {})
                        .flat()
                        .join(' ');

                    throw new Error(validationMessage || 'RSVP request failed');
                }

                const result = await response.json();
                const guest = {
                    id: result.rsvp.id,
                    name: result.rsvp.name,
                    attendance: result.rsvp.attendance,
                    message: result.rsvp.message,
                    date: new Date(result.rsvp.created_at).toLocaleDateString('id-ID'),
                };


            this.guestbooks.unshift(guest);


            } catch (error) {
                alert(error.message || 'Konfirmasi gagal disimpan. Silakan coba lagi.');
                return;
            }

            this.guestName = '';
            this.guestAttendance = '';
            this.guestMessage = '';

        }

    };

}
</script>

</body>
</html>
