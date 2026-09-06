@extends('layouts.app')

@section('title', 'Tinjau Undangan')

@section('content')

    @if($wedding->template && view()->exists('templates.demos.' . $wedding->template->slug))

        {{-- If a demo template exists for this wedding's template, render it and pass the wedding data. --}}
        @includeIf('templates.demos.' . $wedding->template->slug, ['wedding' => $wedding])

    @else

        <div class="max-w-3xl mx-auto py-12">

            <div class="rounded-xl border bg-white p-6">

                <div class="mb-6">
                    <h1 class="text-2xl font-black">{{ $wedding->groom_name }} &amp; {{ $wedding->bride_name }}</h1>
                    <p class="text-sm text-slate-500">Template: {{ $wedding->template?->name ?? '—' }}</p>
                </div>

                @if($wedding->background_value)
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $wedding->background_value) }}" alt="background" class="w-full rounded-lg object-cover">
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <h3 class="text-sm font-bold">Data Mempelai</h3>
                        <p class="text-sm">{{ $wedding->groom_name }} ({{ $wedding->groom_nickname }}) &amp; {{ $wedding->bride_name }} ({{ $wedding->bride_nickname }})</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold">Orang Tua</h3>
                        <p class="text-sm">Ayah: {{ $wedding->groom_father ?? '—' }}, Ibu: {{ $wedding->groom_mother ?? '—' }}</p>
                        <p class="text-sm">Ayah: {{ $wedding->bride_father ?? '—' }}, Ibu: {{ $wedding->bride_mother ?? '—' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold">Pesan</h3>
                        <p class="text-sm">{{ $wedding->message ?? '—' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('weddings.edit', $wedding) }}" class="px-4 py-2 rounded-xl bg-rose-500 text-white">Edit</a>
                    <a href="{{ route('weddings.index') }}" class="px-4 py-2 rounded-xl border">Kembali</a>
                </div>

            </div>

        </div>

    @endif

@endsection
