@extends('layouts.app')

@section('title', 'Template Undangan Pernikahan Digital Elegan & Modern')

@section('content')

    {{-- Hero Section --}}
    <section class="relative py-12 lg:py-24 overflow-hidden bg-gradient-to-b from-rose-50/50 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                {{-- Text & CTA --}}
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700 border border-rose-200 mb-6">
                        ✨ Koleksi Template Wedding Terbaru 2026
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight sm:leading-tight mb-6">
                        Buat Momen Spesial Lebih Memesona dengan <span class="text-rose-600">Undangan Digital</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 mb-8 leading-relaxed">
                        Set desain template undangan pernikahan web yang siap pakai, siap edit, responsif, dan dilengkapi fitur eksklusif seperti RSVP, Musik Background, Amplop Digital, & Peta Lokasi.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        <a href="{{ route('templates.index') }}" class="px-7 py-3.5 text-base font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-lg shadow-rose-600/25 transition duration-200 text-center">
                            Lihat Katalog Template
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="mt-10 pt-8 border-t border-slate-200/80 grid grid-cols-3 gap-4 max-w-md mx-auto lg:mx-0">
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">50+</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Desain Elegan</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">1.200+</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pasangan Bahagia</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">100%</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Mudah Disesuaikan</p>
                        </div>
                    </div>
                </div>

                {{-- Mockup Tampilan HP Undangan --}}
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-[280px] sm:max-w-[320px]">
                        <div class="rounded-[40px] border-[8px] border-slate-900 bg-slate-900 p-2 shadow-2xl">
                            <div class="w-full h-[520px] bg-rose-50 rounded-[30px] overflow-hidden relative flex flex-col justify-between p-6 text-center border border-rose-100">
                                <div class="space-y-2 mt-8">
                                    <span class="text-xs tracking-widest text-rose-500 font-serif uppercase">The Wedding Of</span>
                                    <h3 class="text-2xl font-serif text-slate-800 font-bold">Romeo & Juliet</h3>
                                    <p class="text-xs text-slate-500">Sabtu, 12 Desember 2026</p>
                                </div>

                                <div class="my-auto py-6 bg-white/80 rounded-2xl backdrop-blur-sm border border-rose-100 shadow-sm">
                                    <p class="text-xs text-slate-500 mb-1">Kepada Yth:</p>
                                    <p class="text-sm font-bold text-slate-800">Tamu Undangan</p>
                                    <span class="inline-block mt-3 px-4 py-1 text-[10px] font-semibold text-white bg-rose-500 rounded-full">Buka Undangan</span>
                                </div>

                                <div class="text-[10px] text-slate-400">Preview Template Premium</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="fitur" class="py-16 lg:py-24 bg-white border-y border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-xs font-bold text-rose-600 tracking-widest uppercase mb-2">Kenapa Memilih Template Kami</h2>
                <p class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Fitur Lengkap untuk Momen Sekali Seumur Hidup
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl bg-rose-50/40 border border-rose-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-rose-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-md shadow-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">RSVP & Ucapan Real-time</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Tamu dapat mengonfirmasi kehadiran dan memberikan ucapan doa yang langsung tersimpan secara otomatis.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-rose-50/40 border border-rose-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-rose-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-md shadow-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1bM11 15h2m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Amplop & Hadiah Digital</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Memudahkan tamu memberikan hadiah berupa e-wallet atau nomor rekening bank dengan fitur sekali klik salin.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-rose-50/40 border border-rose-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-rose-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-md shadow-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Musik Background & Galeri</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Lengkapi suasana romantis dengan lagu pilihan serta penataan galeri foto prewedding yang menawan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('partials.cta')

@endsection
