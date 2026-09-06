@extends('layouts.app')

@section('title', 'Undangan Saya')

@section('content')

    <div class="max-w-5xl mx-auto py-12">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-black">Undangan Saya</h1>
            <a href="{{ route('weddings.create') }}" class="rounded-xl bg-rose-500 px-4 py-2 text-white">Buat Baru</a>
        </div>

        @if($weddings->isEmpty())
            <div class="rounded-xl border border-slate-100 bg-white p-6 text-center">
                <p class="text-slate-600">Anda belum memiliki undangan. Mulai dengan memilih template.</p>
                <a href="{{ route('templates.index') }}" class="mt-4 inline-block rounded-xl bg-rose-500 px-4 py-2 text-white">Pilih Template</a>
            </div>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($weddings as $w)
                    <div class="rounded-xl border bg-white p-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-0 w-24 h-24 rounded-lg bg-slate-100 flex items-center justify-center"> 
                                @if($w->background_value)
                                    <img src="{{ asset('storage/' . $w->background_value) }}" class="object-cover w-full h-full rounded-lg" alt="bg">
                                @else
                                    <div class="text-xs text-slate-500">Preview</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="text-lg font-bold">{{ $w->groom_name }} &amp; {{ $w->bride_name }}</h3>
                                <p class="text-xs text-slate-500">Template: {{ $w->template?->name ?? '—' }}</p>
                                <p class="text-xs text-slate-400 mt-2">Status: {{ $w->status }}</p>
                            </div>

                            <div class="flex flex-col items-end gap-2">
                                <a href="{{ route('weddings.show', $w) }}" class="text-sm text-rose-600 font-bold">Lihat</a>
                                <a href="{{ route('weddings.edit', $w) }}" class="text-sm text-slate-600">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>

@endsection
