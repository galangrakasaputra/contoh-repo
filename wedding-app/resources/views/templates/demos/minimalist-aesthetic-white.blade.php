<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Adrian & Clara — Wedding Invitation</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>


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
            background: #fafafa;
            color: #1f1f1f;
        }


        /* =====================================================
           FONT
        ===================================================== */

        .font-editorial {
            font-family: Georgia, 'Times New Roman', serif;
        }


        /* =====================================================
           OPENING
        ===================================================== */

        .opening {
            background: #f8f7f4;
        }


        .opening-content {
            animation: openingIn .8s ease forwards;
        }


        @keyframes openingIn {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .page-enter {
            animation: pageEnter .9s ease forwards;
        }


        @keyframes pageEnter {

            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

        }


        /* =====================================================
           VIDEO
        ===================================================== */

        .video-wrapper {
            background: #111;
        }


        /* =====================================================
           SIMPLE LINE
        ===================================================== */

        .minimal-line {
            width: 50px;
            height: 1px;
            background: #222;
        }


        /* =====================================================
           IMAGE PLACEHOLDER
        ===================================================== */

        .photo-placeholder {
            background:
                linear-gradient(
                    135deg,
                    #eeeeec,
                    #f8f8f6
                );
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .minimal-button {
            transition:
                background-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .minimal-button:hover {
            transform: translateY(-1px);
        }


        /* =====================================================
           RSVP
        ===================================================== */

        .rsvp-card {
            background: #f4f3ef;
        }


        /* =====================================================
           NAV
        ===================================================== */

        .mobile-nav {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }


        /* =====================================================
           PLAY BUTTON
        ===================================================== */

        .play-button {
            transition: transform .25s ease;
        }


        .play-button:hover {
            transform: scale(1.05);
        }

    </style>

</head>


<body>

@php
    $musicPath = data_get($wedding->data, 'music');
    $rsvps = $wedding->rsvps ?? collect();
    $countdownDate = $wedding->reception_date ?? $wedding->akad_date ?? '2026-12-12';
    $countdownTime = substr((string) ($wedding->reception_start_time ?? $wedding->akad_start_time ?? '08:00'), 0, 5);
@endphp

<audio id="backgroundMusic" loop preload="auto">
    <source src="{{ $musicPath ? asset('storage/' . $musicPath) : asset('music/wedding-romantic.mp3') }}" type="audio/mpeg">
</audio>


<div
    x-data="{
        opened: false,

        openInvitation() {

            this.opened = true;

            document.body.style.overflow = 'auto';

            document.getElementById('backgroundMusic')?.play().catch(() => {});

            setTimeout(() => {

                document
                    .getElementById('mainInvitation')
                    ?.scrollIntoView({
                        behavior: 'smooth'
                    });

            }, 500);

        }
    }"
>


    {{-- =========================================================
        OPENING SCREEN
    ========================================================== --}}

    <section

        x-show="!opened"

        x-cloak

        x-transition:enter="transition ease-out duration-500"

        x-transition:enter-start="opacity-0"

        x-transition:enter-end="opacity-100"

        x-transition:leave="transition ease-in duration-500"

        x-transition:leave-start="opacity-100"

        x-transition:leave-end="opacity-0"

        class="opening fixed inset-0 z-50 min-h-screen flex items-center justify-center px-6"
    >

        <div class="opening-content w-full max-w-xl text-center">


            {{-- Small Label --}}

            <p class="text-[10px] tracking-[.45em] uppercase text-slate-400 mb-10">
                The Wedding Invitation
            </p>


            {{-- Names --}}

            <h1
                class="font-editorial text-6xl sm:text-8xl font-normal tracking-tight text-slate-900"
            >

                Adrian

            </h1>


            <div class="flex items-center justify-center gap-5 my-5">

                <div class="w-12 h-px bg-slate-300"></div>

                <span class="text-sm text-slate-400">
                    &
                </span>

                <div class="w-12 h-px bg-slate-300"></div>

            </div>


            <h1
                class="font-editorial text-6xl sm:text-8xl font-normal tracking-tight text-slate-900"
            >

                Clara

            </h1>


            {{-- Date --}}

            <p class="mt-10 text-xs tracking-[.3em] text-slate-500 uppercase">
                12 · 12 · 2026
            </p>


            {{-- Guest --}}

            <div class="mt-12">

                <p class="text-xs text-slate-400">
                    Kepada Yth.
                </p>

                <p class="mt-2 text-sm font-medium text-slate-800">
                    Tamu Undangan
                </p>

            </div>


            {{-- Open --}}

            <button

                @click="openInvitation()"

                class="minimal-button mt-10 inline-flex items-center justify-center px-8 py-3.5 bg-slate-900 text-white text-xs tracking-[.15em] uppercase hover:bg-slate-700"
            >

                Buka Undangan

            </button>


            <p class="mt-5 text-[10px] text-slate-400">
                Mohon maaf apabila terdapat kesalahan penulisan nama
            </p>


        </div>

    </section>



    {{-- =========================================================
        MAIN INVITATION
    ========================================================== --}}

    <main

        id="mainInvitation"

        x-show="opened"

        x-cloak

        class="page-enter bg-white"
    >


        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <header
            class="min-h-screen flex items-center justify-center px-6 py-20"
        >

            <div class="max-w-5xl w-full">


                <div class="grid lg:grid-cols-2 gap-12 items-center">


                    {{-- Text --}}

                    <div class="order-2 lg:order-1">


                        <p class="text-[10px] tracking-[.4em] uppercase text-slate-400 mb-8">
                            Wedding Invitation
                        </p>


                        <h1
                            class="font-editorial text-6xl sm:text-8xl leading-[.9] font-normal text-slate-900"
                        >

                            Adrian

                            <span class="block text-4xl sm:text-5xl text-slate-400 my-5">
                                &
                            </span>

                            Clara

                        </h1>


                        <div class="minimal-line mt-10 mb-7"></div>


                        <p class="text-sm text-slate-500 leading-7 max-w-md">

                            Dengan penuh kebahagiaan,
                            kami mengundang Anda untuk
                            menjadi bagian dari hari istimewa kami.

                        </p>


                        <div class="mt-8">

                            <p class="text-xs tracking-[.2em] uppercase text-slate-400">
                                Saturday
                            </p>

                            <p class="text-lg font-medium text-slate-900 mt-1">
                                12 December 2026
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                Jakarta, Indonesia
                            </p>

                        </div>


                        <button

                            onclick="scrollToSection('couple')"

                            class="mt-10 inline-flex items-center gap-3 text-xs tracking-[.15em] uppercase text-slate-800 border-b border-slate-300 pb-2 hover:border-slate-900 transition"
                        >

                            Lihat Undangan

                            <span>
                                ↓
                            </span>

                        </button>


                    </div>



                    {{-- Hero Image --}}

                    <div class="order-1 lg:order-2">

                        <div
                            class="aspect-[4/5] photo-placeholder flex items-center justify-center"
                        >

                            <div class="text-center">

                                <div class="font-editorial text-7xl text-slate-300">
                                    A
                                </div>

                                <p class="text-[10px] tracking-[.3em] uppercase text-slate-400 mt-4">
                                    Wedding Photo
                                </p>

                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </header>



        {{-- =====================================================
            COUPLE
        ====================================================== --}}

        <section

            id="couple"

            class="py-28 px-6 bg-[#f8f7f4]"
        >

            <div class="max-w-5xl mx-auto">


                <div class="max-w-2xl">

                    <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                        The Couple
                    </p>

                    <h2
                        class="font-editorial text-5xl sm:text-6xl font-normal text-slate-900 mt-5"
                    >
                        Two people,
                        <br>
                        one story.
                    </h2>

                </div>


                <div class="grid md:grid-cols-2 gap-12 mt-16">


                    {{-- Groom --}}

                    <div>

                        <div
                            class="aspect-[4/5] photo-placeholder flex items-center justify-center"
                        >

                            <span class="font-editorial text-7xl text-slate-300">
                                A
                            </span>

                        </div>


                        <div class="mt-6">

                            <h3 class="font-editorial text-3xl text-slate-900">
                                Adrian
                            </h3>

                            <p class="text-xs tracking-[.2em] uppercase text-slate-400 mt-2">
                                Adrian Pratama
                            </p>

                            <p class="text-sm text-slate-500 mt-4 leading-6">

                                Putra dari Bapak Pratama
                                & Ibu Pratama

                            </p>

                        </div>

                    </div>



                    {{-- Bride --}}

                    <div>

                        <div
                            class="aspect-[4/5] photo-placeholder flex items-center justify-center"
                        >

                            <span class="font-editorial text-7xl text-slate-300">
                                C
                            </span>

                        </div>


                        <div class="mt-6">

                            <h3 class="font-editorial text-3xl text-slate-900">
                                Clara
                            </h3>

                            <p class="text-xs tracking-[.2em] uppercase text-slate-400 mt-2">
                                Clara Wijaya
                            </p>

                            <p class="text-sm text-slate-500 mt-4 leading-6">

                                Putri dari Bapak Wijaya
                                & Ibu Wijaya

                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </section>



        {{-- =====================================================
            STORY
        ====================================================== --}}

        <section class="py-28 px-6">

            <div class="max-w-3xl mx-auto text-center">


                <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                    Our Story
                </p>


                <h2
                    class="font-editorial text-5xl sm:text-6xl text-slate-900 mt-5"
                >
                    It started with a hello.
                </h2>


                <div class="minimal-line mx-auto mt-8 mb-8"></div>


                <p class="text-sm leading-8 text-slate-500">

                    Berawal dari sebuah pertemuan sederhana,
                    dua orang yang tidak pernah menyangka
                    akan berjalan sejauh ini akhirnya menemukan
                    rumah satu sama lain.

                </p>


                <p class="text-sm leading-8 text-slate-500 mt-5">

                    Hari demi hari menjadi cerita,
                    hingga akhirnya kami memutuskan
                    untuk melanjutkan perjalanan ini
                    dalam sebuah ikatan pernikahan.

                </p>


            </div>

        </section>



        {{-- =====================================================
            VIDEO
        ====================================================== --}}

        <section

            id="video"

            class="py-28 px-6 bg-[#f8f7f4]"
        >

            <div class="max-w-5xl mx-auto">


                <div class="text-center mb-12">

                    <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                        Our Moments
                    </p>


                    <h2
                        class="font-editorial text-5xl sm:text-6xl text-slate-900 mt-5"
                    >
                        A Little Film
                    </h2>


                    <p class="text-sm text-slate-500 mt-5">
                        Sebuah cerita kecil dalam bentuk video.
                    </p>

                </div>



                {{-- VIDEO --}}

                <div
                    class="video-wrapper relative aspect-video overflow-hidden"
                >

                    <video

                        id="weddingVideo"

                        class="w-full h-full object-cover"

                        controls

                        preload="metadata"

                        poster="{{ asset('images/wedding-video-cover.jpg') }}"
                    >

                        <source
                            src="{{ asset('videos/prewedding.mp4') }}"
                            type="video/mp4"
                        >

                        Browser Anda tidak mendukung video.

                    </video>


                    {{-- Overlay Info --}}

                    <div
                        id="videoPlaceholder"
                        class="absolute inset-0 pointer-events-none flex items-center justify-center"
                    >

                        <div class="text-center text-white">

                            <div class="play-button w-16 h-16 mx-auto rounded-full border border-white/60 flex items-center justify-center">

                                <svg
                                    class="w-6 h-6 ml-1"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path d="M8 5v14l11-7z"/>

                                </svg>

                            </div>


                            <p class="text-[10px] tracking-[.3em] uppercase mt-5">
                                Our Wedding Film
                            </p>

                        </div>

                    </div>

                </div>


                <p class="text-[10px] text-center text-slate-400 mt-5">
                    Video dapat diputar langsung dari undangan.
                </p>


            </div>

        </section>



        {{-- =====================================================
            EVENT
        ====================================================== --}}

        <section

            id="event"

            class="py-28 px-6"
        >

            <div class="max-w-5xl mx-auto">


                <div class="max-w-xl">

                    <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                        Save The Date
                    </p>


                    <h2
                        class="font-editorial text-5xl sm:text-6xl text-slate-900 mt-5"
                    >
                        When & Where
                    </h2>

                </div>



                <div class="grid md:grid-cols-2 gap-10 mt-16">


                    {{-- Ceremony --}}

                    <div class="border-t border-slate-200 pt-8">

                        <p class="text-[10px] tracking-[.3em] uppercase text-slate-400">
                            Ceremony
                        </p>


                        <h3 class="font-editorial text-3xl text-slate-900 mt-4">
                            Akad Nikah
                        </h3>


                        <p class="text-sm text-slate-500 mt-6">
                            Sabtu, 12 Desember 2026
                        </p>


                        <p class="text-sm font-medium text-slate-900 mt-2">
                            08.00 WIB
                        </p>


                        <p class="text-sm text-slate-500 mt-6 leading-7">

                            Gedung Pernikahan Bahagia<br>
                            Jl. Mawar No. 123<br>
                            Jakarta

                        </p>


                        <a

                            href="https://www.google.com/maps/search/?api=1&query=Gedung+Pernikahan+Bahagia+Jakarta"

                            target="_blank"

                            class="inline-block mt-7 text-xs tracking-[.15em] uppercase border-b border-slate-300 pb-2 hover:border-slate-900 transition"
                        >

                            Buka Google Maps

                        </a>

                    </div>



                    {{-- Reception --}}

                    <div class="border-t border-slate-200 pt-8">

                        <p class="text-[10px] tracking-[.3em] uppercase text-slate-400">
                            Reception
                        </p>


                        <h3 class="font-editorial text-3xl text-slate-900 mt-4">
                            Resepsi
                        </h3>


                        <p class="text-sm text-slate-500 mt-6">
                            Sabtu, 12 Desember 2026
                        </p>


                        <p class="text-sm font-medium text-slate-900 mt-2">
                            11.00 WIB
                        </p>


                        <p class="text-sm text-slate-500 mt-6 leading-7">

                            Gedung Pernikahan Bahagia<br>
                            Jl. Mawar No. 123<br>
                            Jakarta

                        </p>


                        <a

                            href="https://www.google.com/maps/search/?api=1&query=Gedung+Pernikahan+Bahagia+Jakarta"

                            target="_blank"

                            class="inline-block mt-7 text-xs tracking-[.15em] uppercase border-b border-slate-300 pb-2 hover:border-slate-900 transition"
                        >

                            Buka Google Maps

                        </a>

                    </div>


                </div>

            </div>

        </section>



        {{-- =====================================================
            COUNTDOWN
        ====================================================== --}}

        <section

            x-data="minimalCountdown()"

            x-init="start()"

            class="py-24 px-6 bg-slate-900 text-white"
        >

            <div class="max-w-4xl mx-auto text-center">


                <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                    Counting Down
                </p>


                <h2
                    class="font-editorial text-5xl sm:text-6xl mt-5"
                >
                    Until We Say
                    <br>
                    I Do.
                </h2>


                <div class="grid grid-cols-4 gap-3 sm:gap-8 max-w-2xl mx-auto mt-14">


                    <div>

                        <div
                            class="text-3xl sm:text-5xl font-light"
                            x-text="days"
                        >
                            00
                        </div>

                        <p class="text-[9px] tracking-[.2em] uppercase text-slate-400 mt-3">
                            Days
                        </p>

                    </div>


                    <div>

                        <div
                            class="text-3xl sm:text-5xl font-light"
                            x-text="hours"
                        >
                            00
                        </div>

                        <p class="text-[9px] tracking-[.2em] uppercase text-slate-400 mt-3">
                            Hours
                        </p>

                    </div>


                    <div>

                        <div
                            class="text-3xl sm:text-5xl font-light"
                            x-text="minutes"
                        >
                            00
                        </div>

                        <p class="text-[9px] tracking-[.2em] uppercase text-slate-400 mt-3">
                            Minutes
                        </p>

                    </div>


                    <div>

                        <div
                            class="text-3xl sm:text-5xl font-light"
                            x-text="seconds"
                        >
                            00
                        </div>

                        <p class="text-[9px] tracking-[.2em] uppercase text-slate-400 mt-3">
                            Seconds
                        </p>

                    </div>


                </div>

            </div>

        </section>



        {{-- =====================================================
            RSVP WHATSAPP
        ====================================================== --}}

        <section

            id="rsvp"

            class="py-28 px-6"
        >

            <div class="max-w-2xl mx-auto">


                <div class="text-center">

                    <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                        RSVP
                    </p>


                    <h2
                        class="font-editorial text-5xl sm:text-6xl text-slate-900 mt-5"
                    >
                        Will you join us?
                    </h2>


                    <p class="text-sm text-slate-500 mt-5 leading-7">

                        Mohon konfirmasi kehadiran Anda
                        melalui WhatsApp.

                    </p>

                </div>



                <div
                    class="rsvp-card mt-12 p-7 sm:p-10"
                >


                    <form
                        onsubmit="sendMinimalistRsvp(event)"
                        action="{{ route('weddings.rsvps.store', $wedding) }}"
                    >

                        @csrf


                        {{-- Name --}}

                        <div>

                            <label class="block text-[10px] tracking-[.15em] uppercase text-slate-500 mb-3">
                                Nama
                            </label>


                            <input

                                id="guestName"
                                name="name"

                                type="text"

                                required

                                placeholder="Nama Anda"

                                class="w-full bg-white border border-slate-200 px-4 py-4 text-sm outline-none focus:border-slate-900 transition"
                            >

                        </div>



                        {{-- Attendance --}}

                        <div class="mt-6">

                            <label class="block text-[10px] tracking-[.15em] uppercase text-slate-500 mb-3">
                                Kehadiran
                            </label>


                            <select

                                id="guestAttendance"
                                name="attendance"

                                required

                                class="w-full bg-white border border-slate-200 px-4 py-4 text-sm outline-none focus:border-slate-900 transition"
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



                        {{-- Number --}}

                        <div class="mt-6">

                            <label class="block text-[10px] tracking-[.15em] uppercase text-slate-500 mb-3">
                                Jumlah Tamu
                            </label>


                            <select

                                id="guestCount"

                                class="w-full bg-white border border-slate-200 px-4 py-4 text-sm outline-none focus:border-slate-900 transition"
                            >

                                <option value="1">
                                    1 Orang
                                </option>

                                <option value="2">
                                    2 Orang
                                </option>

                                <option value="3">
                                    3 Orang
                                </option>

                                <option value="4">
                                    4 Orang
                                </option>

                            </select>

                        </div>



                        {{-- Message --}}

                        <div class="mt-6">

                            <label class="block text-[10px] tracking-[.15em] uppercase text-slate-500 mb-3">
                                Ucapan
                            </label>


                            <textarea

                                id="guestMessage"
                                name="message"
                                required

                                rows="4"

                                placeholder="Tuliskan ucapan untuk kedua mempelai..."

                                class="w-full bg-white border border-slate-200 px-4 py-4 text-sm outline-none focus:border-slate-900 transition resize-none"
                            ></textarea>

                        </div>



                        {{-- Submit --}}

                        <button

                            type="submit"

                            class="minimal-button w-full mt-7 bg-slate-900 text-white py-4 text-xs tracking-[.15em] uppercase hover:bg-slate-700"
                        >

                            Konfirmasi via WhatsApp

                        </button>


                    </form>

                    <div id="minimalistGuestMessages" class="mt-10 space-y-4">
                        @forelse($rsvps as $rsvp)
                            <article class="border border-slate-200 bg-white p-5">
                                <p class="font-semibold text-slate-800">{{ $rsvp->name }}</p>
                                <p class="mt-1 text-xs uppercase tracking-wider text-slate-500">{{ $rsvp->attendance }}</p>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $rsvp->message }}</p>
                            </article>
                        @empty
                            <p class="text-center text-sm text-slate-500">Belum ada ucapan.</p>
                        @endforelse
                    </div>


                </div>



                <p class="text-[10px] text-slate-400 text-center mt-5">
                    Anda akan diarahkan ke WhatsApp untuk mengirim konfirmasi.
                </p>


            </div>

        </section>



        {{-- =====================================================
            CLOSING
        ====================================================== --}}

        <section

            class="min-h-[80vh] flex items-center justify-center px-6 py-24 bg-[#f8f7f4]"
        >

            <div class="text-center">


                <p class="text-[10px] tracking-[.4em] uppercase text-slate-400">
                    Thank You
                </p>


                <h2
                    class="font-editorial text-6xl sm:text-8xl text-slate-900 mt-6"
                >

                    Adrian

                    <span class="text-slate-400">
                        &
                    </span>

                    Clara

                </h2>


                <div class="minimal-line mx-auto mt-10 mb-8"></div>


                <p class="max-w-md mx-auto text-sm text-slate-500 leading-7">

                    Merupakan kebahagiaan bagi kami
                    apabila Anda berkenan hadir dan
                    memberikan doa restu.

                </p>


                <p class="mt-10 font-editorial text-2xl text-slate-800">
                    See you on our special day.
                </p>


                <p class="mt-5 text-[10px] tracking-[.3em] uppercase text-slate-400">
                    12 · 12 · 2026
                </p>


            </div>

        </section>



        {{-- =====================================================
            MOBILE NAVIGATION
        ====================================================== --}}

        <nav

            class="mobile-nav fixed bottom-0 left-0 right-0 z-40 bg-white/90 border-t border-slate-200 md:hidden"
        >

            <div class="grid grid-cols-4">


                <button

                    onclick="scrollToSection('couple')"

                    class="py-3 text-[9px] tracking-[.1em] uppercase text-slate-500"
                >

                    Couple

                </button>


                <button

                    onclick="scrollToSection('video')"

                    class="py-3 text-[9px] tracking-[.1em] uppercase text-slate-500"
                >

                    Video

                </button>


                <button

                    onclick="scrollToSection('event')"

                    class="py-3 text-[9px] tracking-[.1em] uppercase text-slate-500"
                >

                    Event

                </button>


                <button

                    onclick="scrollToSection('rsvp')"

                    class="py-3 text-[9px] tracking-[.1em] uppercase text-slate-500"
                >

                    RSVP

                </button>


            </div>

        </nav>


    </main>

</div>



{{-- =========================================================
    JAVASCRIPT
========================================================== --}}

<script>


    /* =========================================================
       SCROLL
    ========================================================== */

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
    ========================================================== */

    function minimalCountdown() {

        return {

            days: '00',

            hours: '00',

            minutes: '00',

            seconds: '00',


            target:
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


                const difference =
                    this.target - now;


                if (difference <= 0) {

                    this.days = '00';

                    this.hours = '00';

                    this.minutes = '00';

                    this.seconds = '00';

                    return;

                }


                this.days =
                    Math.floor(
                        difference /
                        (1000 * 60 * 60 * 24)
                    )
                    .toString()
                    .padStart(2, '0');


                this.hours =
                    Math.floor(
                        (
                            difference %
                            (1000 * 60 * 60 * 24)
                        ) /
                        (1000 * 60 * 60)
                    )
                    .toString()
                    .padStart(2, '0');


                this.minutes =
                    Math.floor(
                        (
                            difference %
                            (1000 * 60 * 60)
                        ) /
                        (1000 * 60)
                    )
                    .toString()
                    .padStart(2, '0');


                this.seconds =
                    Math.floor(
                        (
                            difference %
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
       RSVP WHATSAPP
    ========================================================== */

    async function sendMinimalistRsvp(event) {

        event.preventDefault();

        const form = event.currentTarget;


        const name =
            document
                .getElementById('guestName')
                .value
                .trim();


        const attendance =
            document
                .getElementById('guestAttendance')
                .value;


        const count =
            document
                .getElementById('guestCount')
                .value;


        const message =
            document
                .getElementById('guestMessage')
                .value
                .trim();


        if (!name || !attendance) {

            return;

        }

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
                throw new Error('Konfirmasi gagal disimpan.');
            }

            const result = await response.json();
            const rsvp = result.rsvp;
            const card = document.createElement('article');
            card.className = 'border border-slate-200 bg-white p-5';
            card.innerHTML = `<p class="font-semibold text-slate-800">${escapeMinimalistHtml(rsvp.name)}</p><p class="mt-1 text-xs uppercase tracking-wider text-slate-500">${escapeMinimalistHtml(rsvp.attendance)}</p><p class="mt-3 text-sm leading-6 text-slate-600">${escapeMinimalistHtml(rsvp.message)}</p>`;
            document.getElementById('minimalistGuestMessages').prepend(card);
        } catch (error) {
            alert(error.message || 'Konfirmasi gagal disimpan.');
            return;
        }


        /*
         * GANTI NOMOR INI
         *
         * Format:
         * 628xxxxxxxxxx
         *
         * Jangan gunakan:
         * +62
         * 08
         */

        const phoneNumber =
            '6281234567890';


        let text =
            `Halo Romeo & Juliet,%0A%0A`;


        text +=
            `Saya ingin mengonfirmasi kehadiran untuk acara pernikahan.%0A%0A`;


        text +=
            `Nama: ${encodeURIComponent(name)}%0A`;


        text +=
            `Kehadiran: ${encodeURIComponent(attendance)}%0A`;


        text +=
            `Jumlah tamu: ${encodeURIComponent(count)} orang%0A`;


        if (message) {

            text +=
                `Ucapan: ${encodeURIComponent(message)}%0A`;

        }


        text +=
            `%0ATerima kasih.`;


        const whatsappUrl =
            `https://wa.me/${phoneNumber}?text=${text}`;


        window.open(
            whatsappUrl,
            '_blank'
        );

    }

    function escapeMinimalistHtml(value) {
        const element = document.createElement('span');
        element.textContent = value;
        return element.innerHTML;
    }



    /* =========================================================
       VIDEO OVERLAY
    ========================================================== */

    const weddingVideo =
        document.getElementById(
            'weddingVideo'
        );


    const videoPlaceholder =
        document.getElementById(
            'videoPlaceholder'
        );


    if (weddingVideo && videoPlaceholder) {

        weddingVideo.addEventListener(
            'play',
            function () {

                videoPlaceholder.style.display =
                    'none';

            }
        );


        weddingVideo.addEventListener(
            'pause',
            function () {

                videoPlaceholder.style.display =
                    'none';

            }
        );

    }

</script>


</body>

</html>
