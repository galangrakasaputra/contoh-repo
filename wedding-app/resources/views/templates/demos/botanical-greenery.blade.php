<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Romeo & Juliet — Botanical Wedding</title>

    <script src="https://cdn.tailwindcss.com"></script>

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
        }

        /* =====================================================
           OPENING
        ===================================================== */

        .opening-screen {

            background:
                radial-gradient(
                    circle at 50% 20%,
                    rgba(255,255,255,.95),
                    transparent 38%
                ),
                linear-gradient(
                    135deg,
                    #f7faf5 0%,
                    #e8efe3 50%,
                    #d9e4d3 100%
                );

        }


        /* Botanical decoration */

        .leaf-decoration {

            position: absolute;

            font-size: 90px;

            opacity: .13;

            color: #526b52;

            pointer-events: none;

        }

        .leaf-left {

            left: -15px;
            top: 15%;

            transform: rotate(-25deg);

        }

        .leaf-right {

            right: -20px;
            bottom: 15%;

            transform: rotate(25deg);

        }


        /* Opening content */

        .opening-content {

            animation:
                openingFade
                1.2s
                ease
                forwards;

        }


        @keyframes openingFade {

            from {

                opacity: 0;

                transform:
                    translateY(30px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        /* Invitation */

        .invitation-enter {

            animation:
                invitationEnter
                1.4s
                cubic-bezier(.22,1,.36,1)
                forwards;

        }


        @keyframes invitationEnter {

            from {

                opacity: 0;

                transform:
                    scale(1.05);

            }

            to {

                opacity: 1;

                transform:
                    scale(1);

            }

        }


        /* Gold line */

        .gold-line {

            width: 90px;

            height: 1px;

            background:
                linear-gradient(
                    to right,
                    transparent,
                    #b99a5d,
                    transparent
                );

        }


        /* Botanical background */

        .botanical-bg {

            background:

                radial-gradient(
                    circle at 10% 10%,
                    rgba(229,238,224,.8),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 90% 90%,
                    rgba(219,231,211,.7),
                    transparent 30%
                ),

                #fbfcf9;

        }


        /* Floating leaves */

        .float-leaf {

            animation:
                floating
                5s
                ease-in-out
                infinite;

        }


        @keyframes floating {

            0%,
            100% {

                transform:
                    translateY(0)
                    rotate(0deg);

            }

            50% {

                transform:
                    translateY(-12px)
                    rotate(3deg);

            }

        }


        /* Image placeholder */

        .gallery-item {

            background:

                linear-gradient(
                    135deg,
                    #dce7d7,
                    #edf3e9
                );

        }

    </style>

</head>


<body>

@php
    $musicPath = data_get($wedding->data, 'music');
    $gallery = data_get($wedding->data, 'gallery', []);
    $groomPhoto = data_get($wedding->data, 'groom.photo');
    $bridePhoto = data_get($wedding->data, 'bride.photo');
    $coupleMessage = $wedding->message ?? data_get($wedding->data, 'message');
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
                    .getElementById('invitation')
                    ?.scrollIntoView({
                        behavior: 'smooth'
                    });

            }, 700);

        }

    }"
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

        class="
            opening-screen
            fixed
            inset-0
            z-50
            min-h-screen
            flex
            items-center
            justify-center
            overflow-hidden
        "
    >


        {{-- Botanical Decoration --}}

        <div class="leaf-decoration leaf-left">

            ❧

        </div>


        <div class="leaf-decoration leaf-right">

            ❧

        </div>


        {{-- Main Content --}}

        <div
            class="
                opening-content
                relative
                z-10
                text-center
                px-6
                max-w-lg
            "
        >

            <p
                class="
                    text-xs
                    tracking-[.4em]
                    uppercase
                    text-emerald-700
                    mb-6
                "
            >

                The Wedding Of

            </p>


            <h1
                class="
                    text-5xl
                    sm:text-6xl
                    font-serif
                    text-slate-800
                    leading-tight
                "
            >

                Romeo

                <span
                    class="
                        block
                        text-3xl
                        my-2
                        text-emerald-600
                    "
                >

                    &

                </span>

                Juliet

            </h1>


            <div
                class="
                    gold-line
                    mx-auto
                    my-7
                "
            ></div>


            <p
                class="
                    text-sm
                    text-slate-500
                    mb-10
                "
            >

                Sabtu, 12 Desember 2026

            </p>


            {{-- Guest Card --}}

            <div
                class="
                    bg-white/75
                    backdrop-blur-md
                    border
                    border-white
                    rounded-3xl
                    p-7
                    shadow-xl
                    shadow-emerald-900/10
                    mb-8
                "
            >

                <p
                    class="
                        text-xs
                        text-slate-400
                        mb-2
                    "
                >

                    Kepada Yth.

                </p>


                <p
                    class="
                        text-lg
                        font-semibold
                        text-slate-800
                    "
                >

                    Tamu Undangan

                </p>


                <p
                    class="
                        text-xs
                        text-slate-400
                        mt-3
                        leading-6
                    "
                >

                    Tanpa mengurangi rasa hormat,
                    kami mengundang Anda untuk hadir
                    di hari bahagia kami.

                </p>

            </div>


            {{-- Open Button --}}

            <button

                @click="openInvitation()"

                class="
                    group
                    inline-flex
                    items-center
                    gap-3
                    px-8
                    py-4
                    rounded-full
                    bg-emerald-700
                    hover:bg-emerald-800
                    text-white
                    font-semibold
                    text-sm
                    shadow-xl
                    shadow-emerald-700/25
                    transition-all
                    duration-300
                    hover:-translate-y-1
                "
            >

                <svg
                    class="
                        w-5
                        h-5
                        transition-transform
                        group-hover:rotate-12
                    "
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


            <p
                class="
                    text-[10px]
                    text-slate-400
                    mt-6
                "
            >

                Mohon maaf apabila terdapat kesalahan
                penulisan nama

            </p>

        </div>

    </section>



    {{-- =====================================================
         INVITATION
    ====================================================== --}}

    <main

        id="invitation"

        x-show="opened"

        x-cloak

        class="
            botanical-bg
            min-h-screen
            invitation-enter
        "
    >


        {{-- =================================================
             HERO
        ================================================== --}}

        <section
            class="
                min-h-screen
                flex
                items-center
                justify-center
                px-6
                py-20
                text-center
                relative
                overflow-hidden
            "
        >

            <div
                class="
                    absolute
                    top-12
                    left-8
                    text-emerald-700/20
                    text-7xl
                    float-leaf
                "
            >

                ❧

            </div>


            <div
                class="
                    absolute
                    bottom-12
                    right-8
                    text-emerald-700/20
                    text-8xl
                    float-leaf
                "
            >

                ❧

            </div>


            <div
                class="
                    relative
                    z-10
                    max-w-3xl
                "
            >

                <p
                    class="
                        text-xs
                        tracking-[.4em]
                        uppercase
                        text-emerald-700
                        mb-6
                    "
                >

                    The Wedding Of

                </p>


                <h1
                    class="
                        text-6xl
                        sm:text-8xl
                        font-serif
                        text-slate-800
                    "
                >

                    Romeo

                    <span
                        class="
                            block
                            text-4xl
                            sm:text-5xl
                            text-emerald-600
                            my-4
                        "
                    >

                        &

                    </span>

                    Juliet

                </h1>


                <div
                    class="
                        gold-line
                        mx-auto
                        my-8
                    "
                ></div>


                <p
                    class="
                        text-sm
                        tracking-widest
                        text-slate-500
                    "
                >

                    SABTU · 12 DESEMBER 2026

                </p>


                <button

                    onclick="
                        document
                        .getElementById('couple')
                        .scrollIntoView({
                            behavior:'smooth'
                        })
                    "

                    class="
                        mt-12
                        px-6
                        py-3
                        border
                        border-emerald-700/30
                        text-emerald-700
                        rounded-full
                        text-sm
                        hover:bg-emerald-700
                        hover:text-white
                        transition
                    "
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
            class="
                py-24
                px-6
                bg-white/70
            "
        >

            <div
                class="
                    max-w-5xl
                    mx-auto
                    text-center
                "
            >

                <p
                    class="
                        text-xs
                        tracking-[.3em]
                        uppercase
                        text-emerald-700
                        mb-3
                    "
                >

                    Assalamu'alaikum

                </p>


                <h2
                    class="
                        text-3xl
                        sm:text-4xl
                        font-serif
                        text-slate-800
                    "
                >

                    Dengan penuh kebahagiaan

                </h2>


                <p
                    class="
                        max-w-2xl
                        mx-auto
                        mt-6
                        text-sm
                        leading-7
                        text-slate-500
                    "
                >

                    Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa,
                    kami bermaksud menyelenggarakan pernikahan kami
                    dan mengundang Bapak/Ibu/Saudara untuk hadir
                    serta memberikan doa restu.

                </p>


                <div
                    class="
                        grid
                        md:grid-cols-2
                        gap-12
                        mt-16
                    "
                >


                    {{-- Groom --}}

                    <div>

                        <div
                            class="
                                w-44
                                h-44
                                mx-auto
                                rounded-full
                                overflow-hidden
                                bg-emerald-50
                                border-8
                                border-white
                                shadow-xl
                                flex
                                items-center
                                justify-center
                            "
                        >

                            @if($groomPhoto)
                                <img src="{{ asset('storage/' . $groomPhoto) }}" class="h-full w-full rounded-full object-cover" alt="Mempelai pria">
                            @else
                            <span
                                class="
                                    font-serif
                                    text-5xl
                                    text-emerald-700
                                "
                            >

                                R

                            </span>
                            @endif

                        </div>


                        <h3
                            class="
                                mt-6
                                text-3xl
                                font-serif
                                text-slate-800
                            "
                        >

                            Romeo

                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                            "
                        >

                            Romeo Montague

                        </p>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >

                            Putra dari Bapak Montague
                            & Ibu Montague

                        </p>

                    </div>



                    {{-- Bride --}}

                    <div>

                        <div
                            class="
                                w-44
                                h-44
                                mx-auto
                                rounded-full
                                overflow-hidden
                                bg-emerald-50
                                border-8
                                border-white
                                shadow-xl
                                flex
                                items-center
                                justify-center
                            "
                        >

                            @if($bridePhoto)
                                <img src="{{ asset('storage/' . $bridePhoto) }}" class="h-full w-full rounded-full object-cover" alt="Mempelai wanita">
                            @else
                            <span
                                class="
                                    font-serif
                                    text-5xl
                                    text-emerald-700
                                "
                            >

                                J

                            </span>
                            @endif

                        </div>


                        <h3
                            class="
                                mt-6
                                text-3xl
                                font-serif
                                text-slate-800
                            "
                        >

                            Juliet

                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                            "
                        >

                            Juliet Capulet

                        </p>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >

                            Putri dari Bapak Capulet
                            & Ibu Capulet

                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =================================================
             COUNTDOWN
        ================================================== --}}

        <section
            class="
                py-24
                px-6
                bg-emerald-50/70
            "
        >

            <div
                class="
                    max-w-4xl
                    mx-auto
                    text-center
                "
                x-data="{

                    target: new Date(@json($countdownDate . 'T' . $countdownTime . ':00+07:00')).getTime(),

                    days: 0,

                    hours: 0,

                    minutes: 0,

                    seconds: 0,

                    updateCountdown() {

                        const now =
                            new Date().getTime();

                        const distance =
                            this.target - now;

                        if (distance <= 0) {

                            this.days = 0;
                            this.hours = 0;
                            this.minutes = 0;
                            this.seconds = 0;

                            return;

                        }

                        this.days =
                            Math.floor(
                                distance /
                                (1000 * 60 * 60 * 24)
                            );

                        this.hours =
                            Math.floor(
                                (distance %
                                (1000 * 60 * 60 * 24)) /
                                (1000 * 60 * 60)
                            );

                        this.minutes =
                            Math.floor(
                                (distance %
                                (1000 * 60 * 60)) /
                                (1000 * 60)
                            );

                        this.seconds =
                            Math.floor(
                                (distance %
                                (1000 * 60)) /
                                1000
                            );

                    }

                }"

                x-init="
                    updateCountdown();

                    setInterval(
                        () => updateCountdown(),
                        1000
                    )
                "
            >

                <p
                    class="
                        text-xs
                        tracking-[.3em]
                        uppercase
                        text-emerald-700
                    "
                >

                    Counting Down

                </p>


                <h2
                    class="
                        text-4xl
                        font-serif
                        text-slate-800
                        mt-3
                    "
                >

                    Menuju Hari Bahagia

                </h2>


                <div
                    class="
                        grid
                        grid-cols-4
                        gap-3
                        sm:gap-6
                        mt-12
                        max-w-xl
                        mx-auto
                    "
                >


                    <div
                        class="
                            bg-white
                            rounded-2xl
                            p-5
                            shadow-sm
                        "
                    >

                        <div
                            class="
                                text-3xl
                                sm:text-4xl
                                font-black
                                text-emerald-700
                            "
                            x-text="days"
                        ></div>

                        <div
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >

                            Hari

                        </div>

                    </div>


                    <div
                        class="
                            bg-white
                            rounded-2xl
                            p-5
                            shadow-sm
                        "
                    >

                        <div
                            class="
                                text-3xl
                                sm:text-4xl
                                font-black
                                text-emerald-700
                            "
                            x-text="hours"
                        ></div>

                        <div
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >

                            Jam

                        </div>

                    </div>


                    <div
                        class="
                            bg-white
                            rounded-2xl
                            p-5
                            shadow-sm
                        "
                    >

                        <div
                            class="
                                text-3xl
                                sm:text-4xl
                                font-black
                                text-emerald-700
                            "
                            x-text="minutes"
                        ></div>

                        <div
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >

                            Menit

                        </div>

                    </div>


                    <div
                        class="
                            bg-white
                            rounded-2xl
                            p-5
                            shadow-sm
                        "
                    >

                        <div
                            class="
                                text-3xl
                                sm:text-4xl
                                font-black
                                text-emerald-700
                            "
                            x-text="seconds"
                        ></div>

                        <div
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >

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
            class="
                py-24
                px-6
                bg-white
            "
        >

            <div
                class="
                    max-w-6xl
                    mx-auto
                "
            >

                <div
                    class="
                        text-center
                        mb-12
                    "
                >

                    <p
                        class="
                            text-xs
                            tracking-[.3em]
                            uppercase
                            text-emerald-700
                        "
                    >

                        Our Moments

                    </p>


                    <h2
                        class="
                            text-4xl
                            font-serif
                            text-slate-800
                            mt-3
                        "
                    >

                        Galeri Foto

                    </h2>


                    <p
                        class="
                            text-sm
                            text-slate-500
                            mt-4
                        "
                    >

                        Cerita kecil dari perjalanan
                        cinta kami.

                    </p>

                </div>


                <div
                    class="
                        grid
                        grid-cols-2
                        md:grid-cols-4
                        gap-4
                    "
                >

                    @if(count($gallery) > 0)
                        @foreach($gallery as $image)
                            <div class="gallery-item aspect-square overflow-hidden rounded-2xl border border-emerald-100">
                                <img src="{{ asset('storage/' . $image) }}" class="h-full w-full object-cover" alt="Galeri">
                            </div>
                        @endforeach
                    @else
                    @foreach(range(1, 8) as $image)

                        <div
                            class="
                                gallery-item
                                aspect-square
                                rounded-2xl
                                overflow-hidden
                                border
                                border-emerald-100
                                flex
                                items-center
                                justify-center
                                hover:scale-[1.02]
                                transition
                            "
                        >

                            <div class="text-center">

                                <svg
                                    class="
                                        w-8
                                        h-8
                                        mx-auto
                                        text-emerald-700/40
                                        mb-2
                                    "
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-10h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />

                                </svg>


                                <span
                                    class="
                                        text-xs
                                        text-emerald-700/60
                                    "
                                >

                                    Foto {{ $image }}

                                </span>

                            </div>

                        </div>

                    @endforeach
                    @endif

                </div>

            </div>

        </section>



        {{-- =================================================
             LOCATION
        ================================================== --}}

        <section
            class="
                py-24
                px-6
                bg-emerald-50/60
            "
        >

            <div
                class="
                    max-w-5xl
                    mx-auto
                "
            >

                <div
                    class="
                        text-center
                        mb-12
                    "
                >

                    <p
                        class="
                            text-xs
                            tracking-[.3em]
                            uppercase
                            text-emerald-700
                        "
                    >

                        Wedding Location

                    </p>


                    <h2
                        class="
                            text-4xl
                            font-serif
                            text-slate-800
                            mt-3
                        "
                    >

                        Peta Lokasi

                    </h2>

                </div>


                <div
                    class="
                        bg-white
                        rounded-3xl
                        overflow-hidden
                        shadow-xl
                        border
                        border-emerald-100
                    "
                >

                    {{-- Google Maps Embed --}}

                    <div
                        class="
                            aspect-video
                            bg-slate-200
                        "
                    >

                        <iframe

                            src="https://www.google.com/maps?q=Jakarta&output=embed"

                            class="
                                w-full
                                h-full
                                border-0
                            "

                            loading="lazy"

                            allowfullscreen

                        ></iframe>

                    </div>


                    <div
                        class="
                            p-7
                            text-center
                        "
                    >

                        <h3
                            class="
                                text-xl
                                font-bold
                                text-slate-800
                            "
                        >

                            Gedung Pernikahan Bahagia

                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                leading-6
                            "
                        >

                            Jl. Mawar No. 123<br>
                            Jakarta

                        </p>


                        <a
                            href="https://www.google.com/maps/search/?api=1&query=Gedung+Pernikahan+Bahagia+Jakarta"
                            target="_blank"
                            class="
                                inline-flex
                                items-center
                                gap-2
                                mt-6
                                px-6
                                py-3
                                bg-emerald-700
                                hover:bg-emerald-800
                                text-white
                                rounded-full
                                text-sm
                                font-semibold
                                transition
                            "
                        >

                            Buka Google Maps

                        </a>

                    </div>

                </div>

            </div>

        </section>



        <section id="rsvp" class="border-t border-emerald-100 bg-emerald-50/60 px-6 py-24">
            <div class="mx-auto max-w-3xl">
                <div class="mb-10 text-center">
                    <p class="text-xs uppercase tracking-[.3em] text-emerald-700">RSVP & Ucapan</p>
                    <h2 class="mt-3 font-serif text-4xl text-slate-800">Konfirmasi Kehadiran</h2>
                </div>

                <form action="{{ route('weddings.rsvps.store', $wedding) }}" onsubmit="submitBotanicalRsvp(event)" class="rounded-3xl border border-emerald-100 bg-white p-7 shadow-xl sm:p-10">
                    @csrf
                    <div class="space-y-5">
                        <input name="name" type="text" required placeholder="Nama Anda" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500">
                        <select name="attendance" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-emerald-500">
                            <option value="">Pilih konfirmasi</option>
                            <option value="Hadir">Saya akan hadir</option>
                            <option value="Tidak Hadir">Saya tidak dapat hadir</option>
                        </select>
                        <textarea name="message" required rows="4" placeholder="Tuliskan ucapan untuk kedua mempelai..." class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500"></textarea>
                        <button type="submit" class="w-full rounded-xl bg-emerald-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-800">Kirim Konfirmasi & Ucapan</button>
                    </div>
                </form>

                <div id="botanicalGuestMessages" class="mt-10 space-y-4">
                    @forelse($rsvps as $rsvp)
                        <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                            <p class="font-semibold text-slate-800">{{ $rsvp->name }}</p>
                            <p class="mt-1 text-xs text-emerald-700">{{ $rsvp->attendance }}</p>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $rsvp->message }}</p>
                        </article>
                    @empty
                        <p class="text-center text-sm text-slate-500">Belum ada ucapan.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- =================================================
             CLOSING
        ================================================== --}}

        <section
            class="
                min-h-[70vh]
                flex
                items-center
                justify-center
                px-6
                py-20
                bg-white
                text-center
            "
        >

            <div>

                <p
                    class="
                        text-xs
                        tracking-[.3em]
                        uppercase
                        text-emerald-700
                    "
                >

                    Thank You

                </p>


                <h2
                    class="
                        text-5xl
                        sm:text-6xl
                        font-serif
                        text-slate-800
                        mt-5
                    "
                >

                    Romeo

                    <span class="text-emerald-600">

                        &

                    </span>

                    Juliet

                </h2>


                <div
                    class="
                        gold-line
                        mx-auto
                        my-8
                    "
                ></div>


                <p
                    class="
                        text-sm
                        text-slate-500
                        max-w-md
                        mx-auto
                        leading-7
                    "
                >

                    Merupakan suatu kehormatan dan kebahagiaan
                    bagi kami apabila Bapak/Ibu/Saudara/i
                    berkenan hadir dan memberikan doa restu.

                </p>


                <p
                    class="
                        mt-10
                        font-serif
                        text-2xl
                        text-emerald-700
                    "
                >

                    Sampai jumpa di hari bahagia kami.

                </p>

            </div>

        </section>


    </main>

</div>

<script>
    async function submitBotanicalRsvp(event) {
        event.preventDefault();

        const form = event.currentTarget;
        const button = form.querySelector('button[type="submit"]');
        button.disabled = true;

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
            card.className = 'rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm';
            card.innerHTML = `<p class="font-semibold text-slate-800">${escapeHtml(rsvp.name)}</p><p class="mt-1 text-xs text-emerald-700">${escapeHtml(rsvp.attendance)}</p><p class="mt-3 text-sm leading-6 text-slate-600">${escapeHtml(rsvp.message)}</p>`;
            document.getElementById('botanicalGuestMessages').prepend(card);
            form.reset();
        } catch (error) {
            alert(error.message || 'Konfirmasi gagal disimpan.');
        } finally {
            button.disabled = false;
        }
    }

    function escapeHtml(value) {
        const element = document.createElement('span');
        element.textContent = value;
        return element.innerHTML;
    }
</script>


</body>

</html>
