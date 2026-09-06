@extends('layouts.app')

@section('title', 'Katalog Template Undangan Pernikahan Digital')

@section('content')
        {{-- Templates datang dari database via route --}}
        @php
            $serverSelectedTemplate = null;
            $oldTemplateId = old('template_id') ?? null;

            if ($oldTemplateId && isset($templates) && is_array($templates)) {
                foreach ($templates as $t) {
                    if ((isset($t['id']) && $t['id'] == $oldTemplateId)) {
                        $serverSelectedTemplate = $t;
                        break;
                    }
                }
            }
        @endphp
    <script>
        // expose templates from server as a safe JS array
        window.templates = <?php echo json_encode($templates ?? []); ?>;

        function templatesData() {
            return {
                viewMode: 'card',
                weddingModal: <?php echo json_encode((bool) $serverSelectedTemplate); ?>,
                backgroundType: 'default',
                customBackgroundPreview: '',
                customBackgroundName: '',
                selectedTemplate: <?php echo json_encode($serverSelectedTemplate ?? ['id' => null, 'title' => '', 'category' => '', 'price' => '', 'features' => [], 'bg' => '']); ?>,
                openWeddingModal: function(template) {
                    this.selectedTemplate = template;
                    this.backgroundType = 'default';
                    this.customBackgroundPreview = '';
                    this.customBackgroundName = '';
                    this.weddingModal = true;
                    document.body.classList.add('overflow-hidden');
                },
                openWeddingModalById: function(id) {
                    const t = (window.templates || []).find(item => item.id == id);
                    if (t) {
                        this.openWeddingModal(t);
                    }
                },
                closeWeddingModal: function() {
                    this.weddingModal = false;
                    this.backgroundType = 'default';
                    this.customBackgroundPreview = '';
                    this.customBackgroundName = '';
                    document.body.classList.remove('overflow-hidden');
                }
            };
        }
    </script>

    <section
    class="py-12 lg:py-20 bg-slate-50 min-h-screen"
    x-data="templatesData()"
    x-on:open-wedding-modal.window="openWeddingModal($event.detail.template)"
    x-on:close-wedding-modal.window="closeWeddingModal()"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header & Switcher --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <span class="text-xs font-bold text-rose-600 tracking-widest uppercase mb-1 block">Katalog Terbaik</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Pilih Template Undangan</h1>
                <p class="text-slate-600 mt-2 text-sm sm:text-base">Temukan desain ideal yang sesuai dengan tema pernikahan Anda.</p>
            </div>

            {{-- Toggle Button View Mode --}}
            <div class="flex items-center gap-2 bg-slate-200/80 p-1 rounded-xl self-start md:self-auto border border-slate-300/60">
                <button
                    @click="viewMode = 'card'"
                    :class="viewMode === 'card' ? 'bg-white text-rose-600 shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Grid / Card
                </button>
                <button
                    @click="viewMode = 'list'"
                    :class="viewMode === 'list' ? 'bg-white text-rose-600 shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    List
                </button>
            </div>
        </div>



        {{-- 1. CARD VIEW MODE --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($templates as $item)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between">
                    <div>
                        {{-- Mockup Preview Gambar --}}
                        <div class="h-48 flex items-center justify-center p-6 border-b border-slate-100 relative" :class="selectedTemplate.bg">
                            <span class="text-xs font-semibold px-3 py-1 bg-white/90 rounded-full text-slate-700 shadow-sm border border-slate-200/60 absolute top-4 left-4">
                                {{ $item['category'] }}
                            </span>
                            <div class="text-center">
                                <p class="text-xs tracking-widest text-slate-500 font-serif uppercase">Preview Template</p>
                                <p class="font-serif text-lg font-bold text-slate-800 mt-1">{{ $item['name'] }}</p>
                            </div>
                        </div>

                        {{-- Deskripsi/Fitur --}}
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $item['name'] }}</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($item['features'] as $feature)
                                    <span class="text-[11px] bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md font-medium">
                                        ✓ {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Action --}}
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">

                        <div>
                            <span class="text-xs text-slate-400 block">Harga</span>
                            <span class="text-lg font-black text-rose-600">
                                {{ $item['price'] }}
                            </span>
                        </div>

                        <div class="flex gap-2">

                            {{-- Demo --}}
                            <a
                                href="
                                    @if($item['id'] == 1)
                                        {{ route('templates.elegance-rose-gold.demo') }}
                                    @elseif($item['id'] == 2)
                                        {{ route('templates.botanical-greenery.demo') }}
                                    @elseif($item['id'] == 3)
                                        {{ route('templates.minimalist-aesthetic-white.demo') }}
                                    @elseif($item['id'] == 4)
                                        {{ route('templates.javanese-heritage-traditional.demo') }}
                                    @else
                                        #
                                    @endif
                                "
                                class="px-3 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition"
                            >
                                Demo
                            </a>


                            {{-- Pilih Template --}}
                            @guest

                                <button
                                    type="button"
                                    @click="$dispatch('open-login-modal', {
                                        templateId: {{ $item['id'] }}
                                    })"
                                    class="rounded-xl bg-rose-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-rose-600"
                                >
                                    Pilih Template
                                </button>

                            @endguest


                            @auth

                                <button
                                    type="button"
                                    @click="openWeddingModalById({{ $item['id'] }})"
                                    class="rounded-xl bg-rose-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-rose-600"
                                >
                                    Pilih Template
                                </button>

                            @endauth

                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- 2. LIST VIEW MODE --}}
        <div class="space-y-4">
            @foreach($templates as $item)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition duration-200 flex flex-col md:flex-row md:items-center justify-between gap-6">

                    {{-- Info Kiri --}}
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl flex-shrink-0 flex items-center justify-center border border-slate-200/60" :class="selectedTemplate.bg">
                            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider block mb-1">{{ $item['category'] }}</span>
                            <h3 class="text-lg font-bold text-slate-900">{{ $item['name'] }}</h3>
                            <p class="text-xs text-slate-500 mt-1">Termasuk: {{ implode(', ', $item['features']) }}</p>
                        </div>
                    </div>

                    {{-- Aksi Kanan --}}
                    <div class="flex items-center justify-between md:justify-end gap-6 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <div class="text-left md:text-right">
                            <span class="text-xs text-slate-400 block">Harga</span>
                            <span class="text-lg font-black text-rose-600">{{ $item['price'] }}</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="#" class="px-4 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition">Live Demo</a>
                            <a href="#" class="px-4 py-2 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-sm">Pilih Template</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>

    {{-- ============================================================
        MODAL FORM UNDANGAN
    ============================================================= --}}
    <div
        x-show="weddingModal"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm"
    >
        {{-- Modal --}}
        <div
            x-show="weddingModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            @click.outside="closeWeddingModal()"
            class="relative flex w-full max-w-5xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl"
            style="max-height: calc(100dvh - 2rem);"
        >

            {{-- =====================================================
                HEADER
            ====================================================== --}}
            <div class="flex shrink-0 items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                <div class="min-w-0">

                    <div class="flex items-center gap-2">

                        <span class="rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-rose-600">
                            Buat Undangan
                        </span>

                    </div>

                    <h2
                        class="mt-1 truncate text-lg font-black text-slate-900 sm:text-xl"
                        x-text="selectedTemplate.title"
                    ></h2>

                    <p
                        class="text-xs text-slate-500"
                        x-text="selectedTemplate.category"
                    ></p>

                </div>


                <button
                    type="button"
                    @click="closeWeddingModal()"
                    class="ml-4 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>


            {{-- =====================================================
                BODY
            ====================================================== --}}
            <div class="min-h-0 flex-1 overflow-y-auto">

                <form
                    method="POST"
                    action="{{ route('weddings.store') }}"
                    enctype="multipart/form-data"
                    class="space-y-8 p-5 sm:p-6 lg:p-8"
                >
                    @csrf

                    {{-- TEMPLATE ID --}}
                    <input
                        type="hidden"
                        name="template_id"
                        :value="selectedTemplate.id"
                        value="{{ old('template_id', $serverSelectedTemplate['id'] ?? '') }}"
                    >

                    {{-- Tampilkan pesan error validasi di modal agar user tahu kenapa tidak tersimpan --}}
                    @if($errors->any())
                        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <div class="font-bold">Terdapat kesalahan pada pengisian:</div>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- =================================================
                        1. DATA MEMPELAI
                    ================================================== --}}
                    <section>

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                1. Data Mempelai
                            </h3>

                            <p class="text-xs text-slate-500">
                                Masukkan nama kedua mempelai yang akan ditampilkan pada undangan.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            {{-- Pria --}}
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Nama Lengkap Mempelai Pria
                                </label>

                                <input
                                    type="text"
                                    name="groom_name"
                                    placeholder="Contoh: Ahmad Fauzan"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                    required
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Nama Panggilan Mempelai Pria
                                </label>

                                <input
                                    type="text"
                                    name="groom_nickname"
                                    placeholder="Contoh: Ahmad"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            {{-- Wanita --}}
                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Nama Lengkap Mempelai Wanita
                                </label>

                                <input
                                    type="text"
                                    name="bride_name"
                                    placeholder="Contoh: Siti Aisyah"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                    required
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Nama Panggilan Mempelai Wanita
                                </label>

                                <input
                                    type="text"
                                    name="bride_nickname"
                                    placeholder="Contoh: Siti"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Foto Mempelai Pria
                                </label>
                                <input type="file" name="groom_photo" accept="image/*" class="block w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Foto Mempelai Wanita
                                </label>
                                <input type="file" name="bride_photo" accept="image/*" class="block w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        2. ORANG TUA
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                2. Nama Orang Tua
                            </h3>

                            <p class="text-xs text-slate-500">
                                Nama orang tua yang akan ditampilkan pada undangan.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Ayah Mempelai Pria
                                </label>

                                <input
                                    type="text"
                                    name="groom_father"
                                    placeholder="Nama ayah"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Ibu Mempelai Pria
                                </label>

                                <input
                                    type="text"
                                    name="groom_mother"
                                    placeholder="Nama ibu"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Ayah Mempelai Wanita
                                </label>

                                <input
                                    type="text"
                                    name="bride_father"
                                    placeholder="Nama ayah"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Ibu Mempelai Wanita
                                </label>

                                <input
                                    type="text"
                                    name="bride_mother"
                                    placeholder="Nama ibu"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        3. AKAD
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                3. Akad Nikah
                            </h3>

                            <p class="text-xs text-slate-500">
                                Informasi waktu dan lokasi akad nikah.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="akad_date"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Waktu Mulai
                                </label>

                                <input
                                    type="time"
                                    name="akad_start_time"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Waktu Selesai
                                </label>

                                <input
                                    type="time"
                                    name="akad_end_time"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                        </div>


                        <div class="mt-4 grid grid-cols-1 gap-4">

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Alamat Lengkap Lokasi Akad
                                </label>

                                <textarea
                                    name="akad_address"
                                    rows="3"
                                    placeholder="Contoh: Jl. Melati No. 10, Jakarta Selatan..."
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none resize-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                ></textarea>
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Link Google Maps Akad
                                </label>

                                <input
                                    type="url"
                                    name="akad_maps_url"
                                    placeholder="https://maps.google.com/..."
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        4. RESEPSI
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                4. Resepsi
                            </h3>

                            <p class="text-xs text-slate-500">
                                Informasi waktu dan lokasi resepsi.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="reception_date"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Waktu Mulai
                                </label>

                                <input
                                    type="time"
                                    name="reception_start_time"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Waktu Selesai
                                </label>

                                <input
                                    type="time"
                                    name="reception_end_time"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                        </div>


                        <div class="mt-4 grid grid-cols-1 gap-4">

                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Alamat Lengkap Lokasi Resepsi
                                </label>

                                <textarea
                                    name="reception_address"
                                    rows="3"
                                    placeholder="Contoh: Gedung Pernikahan Mawar, Jl. ..."
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none resize-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                ></textarea>
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                    Link Google Maps Resepsi
                                </label>

                                <input
                                    type="url"
                                    name="reception_maps_url"
                                    placeholder="https://maps.google.com/..."
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                                >
                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        5. PESAN
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                5. Pesan Pengantin
                            </h3>

                            <p class="text-xs text-slate-500">
                                Pesan pribadi dari kedua mempelai untuk para tamu.
                            </p>

                        </div>


                        <textarea
                            name="message"
                            rows="5"
                            placeholder="Tuliskan kata-kata atau pesan dari kedua mempelai..."
                            class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10"
                        ></textarea>

                    </section>


                    {{-- =================================================
                        6. GALERI
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                6. Galeri Foto
                            </h3>

                            <p class="text-xs text-slate-500">
                                Upload foto yang ingin ditampilkan pada undangan.
                            </p>

                        </div>


                        <input
                            type="file"
                            name="gallery[]"
                            multiple
                            accept="image/*"
                            class="block w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-600"
                        >

                    </section>


                    {{-- =================================================
                        7. AMPLOP DIGITAL
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">

                            <h3 class="text-base font-black text-slate-900">
                                7. Amplop Digital
                            </h3>

                            <p class="text-xs text-slate-500">
                                Masukkan rekening atau metode pembayaran digital.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <div>
                                <h4 class="mb-3 text-sm font-black text-slate-800">Rekening Mempelai Pria</h4>
                                <div class="space-y-3">
                                    <input type="text" name="groom_bank_name" placeholder="Nama bank / e-wallet" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                    <input type="text" name="groom_account_number" placeholder="Nomor rekening" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                    <input type="text" name="groom_account_name" placeholder="Atas nama" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                </div>
                            </div>

                            <div>
                                <h4 class="mb-3 text-sm font-black text-slate-800">Rekening Mempelai Wanita</h4>
                                <div class="space-y-3">
                                    <input type="text" name="bride_bank_name" placeholder="Nama bank / e-wallet" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                    <input type="text" name="bride_account_number" placeholder="Nomor rekening" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                    <input type="text" name="bride_account_name" placeholder="Atas nama" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-500/10">
                                </div>
                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        8. MUSIK
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">
                            <h3 class="text-base font-black text-slate-900">
                                8. Musik Undangan
                            </h3>

                            <p class="text-xs text-slate-500">
                                Masukkan link musik yang akan diputar pada undangan.
                            </p>
                        </div>

                        <input
                            type="file"
                            name="music"
                            accept="audio/mpeg,.mp3"
                            class="block w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-600"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            Format MP3, maksimal 10 MB.
                        </p>

                    </section>


                    {{-- =================================================
                        9. BACKGROUND
                    ================================================== --}}
                    <section class="border-t border-slate-100 pt-8">

                        <div class="mb-4">
                            <h3 class="text-base font-black text-slate-900">
                                8. Background Undangan
                            </h3>

                            <p class="text-xs text-slate-500">
                                Gunakan background bawaan template atau upload background sendiri.
                            </p>
                        </div>


                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- ================================================
                                BACKGROUND TEMPLATE
                            ================================================= --}}
                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="background_type"
                                    value="default"
                                    x-model="backgroundType"
                                    class="peer sr-only"
                                >

                                <div class="rounded-2xl border-2 border-slate-200 p-3 transition duration-200 peer-checked:border-rose-500 peer-checked:bg-rose-50">

                                    {{-- Preview --}}
                                    <div
                                        class="relative flex h-40 items-center justify-center overflow-hidden rounded-xl"
                                        :class="selectedTemplate.bg"
                                    >

                                        {{-- Overlay --}}
                                        <div class="absolute inset-0 bg-black/5"></div>

                                        {{-- Content --}}
                                        <div class="relative z-10 text-center">

                                            <span class="inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-slate-600 shadow-sm">
                                                Default
                                            </span>

                                            <p
                                                class="mt-2 px-3 font-serif text-lg font-bold text-slate-800"
                                                x-text="selectedTemplate.title"
                                            ></p>

                                        </div>

                                    </div>

                                    <div class="mt-3">
                                        <p class="text-sm font-bold text-slate-800">
                                            Background Template
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Gunakan background bawaan template.
                                        </p>
                                    </div>

                                </div>
                            </label>


                            {{-- ================================================
                                UPLOAD BACKGROUND SENDIRI
                            ================================================= --}}
                            <div>

                                <input
                                    type="radio"
                                    name="background_type"
                                    value="custom"
                                    x-model="backgroundType"
                                    id="background_custom"
                                    class="peer sr-only"
                                >

                                <label
                                    for="background_custom"
                                    class="block cursor-pointer"
                                >

                                    <div
                                        class="rounded-2xl border-2 border-slate-200 p-3 transition duration-200"
                                        :class="backgroundType === 'custom'
                                            ? 'border-rose-500 bg-rose-50'
                                            : 'hover:border-rose-300 hover:bg-rose-50/50'"
                                    >

                                        {{-- Preview Area --}}
                                        <div
                                            class="relative flex h-40 items-center justify-center overflow-hidden rounded-xl bg-slate-100"
                                        >

                                            {{-- Preview Background Default --}}
                                            <template x-if="!customBackgroundPreview">

                                                <div
                                                    class="absolute inset-0 flex items-center justify-center"
                                                    :class="selectedTemplate.bg"
                                                >

                                                    <div class="absolute inset-0 bg-black/5"></div>

                                                    <div class="relative z-10 text-center">

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="mx-auto h-8 w-8 text-slate-400"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M12 16.5V7.5m0 0L8.25 11.25M12 7.5l3.75 3.75M4.5 19.5h15"
                                                            />
                                                        </svg>

                                                        <p class="mt-2 text-xs font-bold text-slate-600">
                                                            Upload Background
                                                        </p>

                                                    </div>

                                                </div>

                                            </template>


                                            {{-- Preview Background Upload --}}
                                            <template x-if="customBackgroundPreview">

                                                <div class="absolute inset-0">

                                                    <img
                                                        :src="customBackgroundPreview"
                                                        alt="Preview Background"
                                                        class="h-full w-full object-cover"
                                                    >

                                                    {{-- Overlay --}}
                                                    <div class="absolute inset-0 bg-black/20"></div>

                                                    {{-- Label --}}
                                                    <div class="absolute bottom-3 left-3 right-3">

                                                        <div class="rounded-lg bg-white/90 px-3 py-2 shadow-sm backdrop-blur-sm">

                                                            <p class="text-xs font-bold text-slate-700">
                                                                Background Dipilih
                                                            </p>

                                                            <p
                                                                class="mt-0.5 truncate text-[10px] text-slate-500"
                                                                x-text="customBackgroundName"
                                                            ></p>

                                                        </div>

                                                    </div>

                                                </div>

                                            </template>

                                        </div>


                                        {{-- Text --}}
                                        <div class="mt-3">

                                            <p class="text-sm font-bold text-slate-800">
                                                Upload Background Sendiri
                                            </p>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                Gunakan gambar background pilihan Anda.
                                            </p>

                                        </div>

                                    </div>

                                </label>


                                {{-- File Input --}}
                                <input
                                    type="file"
                                    name="custom_background"
                                    accept="image/*"
                                    class="sr-only"
                                    x-ref="backgroundInput"

                                    @change="
                                        const file = $event.target.files[0];

                                        if (file) {
                                            backgroundType = 'custom';
                                            customBackgroundName = file.name;

                                            const reader = new FileReader();

                                            reader.onload = (e) => {
                                                customBackgroundPreview = e.target.result;
                                            };

                                            reader.readAsDataURL(file);
                                        } else {
                                            backgroundType = 'default';
                                            customBackgroundName = '';
                                            customBackgroundPreview = '';
                                        }
                                    "
                                >

                                {{-- Upload button --}}
                                <div class="mt-3">

                                    <button
                                        type="button"
                                        @click="$refs.backgroundInput.click()"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-600 transition hover:border-rose-300 hover:bg-rose-50 hover:text-rose-500"
                                    >
                                        Pilih File Background
                                    </button>

                                    {{-- Reset --}}
                                    <button
                                        type="button"
                                        x-show="customBackgroundPreview"
                                        x-cloak
                                        @click="
                                            $refs.backgroundInput.value = '';
                                            customBackgroundPreview = '';
                                            customBackgroundName = '';
                                            backgroundType = 'default';
                                        "
                                        class="mt-2 w-full rounded-xl px-4 py-2 text-xs font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                                    >
                                        Kembali ke Background Template
                                    </button>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        FOOTER BUTTON
                    ================================================== --}}
                    <div class="border-t border-slate-100 pt-6">

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

                            <button
                                type="button"
                                @click="closeWeddingModal()"
                                class="rounded-xl px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-100"
                            >
                                Batal
                            </button>

                            <button
                                type="submit"
                                class="rounded-xl bg-rose-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:bg-rose-600"
                            >
                                Simpan & Lanjutkan
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
</section>
    <script>
        // Backwards compatibility: provide global functions that dispatch Alpine events
        window.openWeddingModal = function(template) {
            window.dispatchEvent(new CustomEvent('open-wedding-modal', { detail: { template: template } }));
        };

        window.closeWeddingModal = function() {
            window.dispatchEvent(new CustomEvent('close-wedding-modal'));
        };
    </script>

@endsection
