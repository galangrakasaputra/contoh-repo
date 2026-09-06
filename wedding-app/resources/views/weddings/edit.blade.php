@extends('layouts.app')

@section('title', 'Edit Undangan')

@section('content')

    <div class="max-w-3xl mx-auto py-12">

        <h1 class="text-2xl font-black mb-6">Edit Undangan</h1>

        @if(session('success'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

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

        <form action="{{ route('weddings.update', $wedding) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-xl border">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Template (saat ini)</label>
                <div class="text-sm text-slate-700">{{ $wedding->template?->name ?? '— tidak ada —' }}</div>
                <input type="hidden" name="template_id" value="{{ old('template_id', $wedding->template_id) }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap Mempelai Pria</label>
                    <input type="text" name="groom_name" value="{{ old('groom_name', $wedding->groom_name) }}" class="w-full rounded-xl border px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Panggilan Mempelai Pria</label>
                    <input type="text" name="groom_nickname" value="{{ old('groom_nickname', $wedding->groom_nickname) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap Mempelai Wanita</label>
                    <input type="text" name="bride_name" value="{{ old('bride_name', $wedding->bride_name) }}" class="w-full rounded-xl border px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Panggilan Mempelai Wanita</label>
                    <input type="text" name="bride_nickname" value="{{ old('bride_nickname', $wedding->bride_nickname) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Ayah Mempelai Pria</label>
                    <input type="text" name="groom_father" value="{{ old('groom_father', $wedding->groom_father) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Ibu Mempelai Pria</label>
                    <input type="text" name="groom_mother" value="{{ old('groom_mother', $wedding->groom_mother) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Ayah Mempelai Wanita</label>
                    <input type="text" name="bride_father" value="{{ old('bride_father', $wedding->bride_father) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Ibu Mempelai Wanita</label>
                    <input type="text" name="bride_mother" value="{{ old('bride_mother', $wedding->bride_mother) }}" class="w-full rounded-xl border px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Pesan Pengantin</label>
                <textarea name="message" rows="4" class="w-full rounded-xl border px-3 py-2">{{ old('message', $wedding->message) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Background</label>
                <div class="flex items-center gap-4">
                    <label class="inline-flex items-center"><input type="radio" name="background_type" value="default" {{ old('background_type', $wedding->background_type) !== 'custom' ? 'checked' : '' }}> Default</label>
                    <label class="inline-flex items-center"><input type="radio" name="background_type" value="custom" {{ old('background_type', $wedding->background_type) === 'custom' ? 'checked' : '' }}> Custom</label>
                </div>
                <div class="mt-3">
                    <input type="file" name="custom_background" accept="image/*">
                </div>

                @if($wedding->background_value)
                    <div class="mt-3">
                        <p class="text-sm text-slate-600">Background saat ini:</p>
                        <img src="{{ asset('storage/' . $wedding->background_value) }}" alt="background" class="mt-2 rounded-lg max-h-40 object-cover">
                    </div>
                @endif
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl border">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-xl bg-rose-600 text-white">Simpan</button>
            </div>

        </form>

    </div>

@endsection
