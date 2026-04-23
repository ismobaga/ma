@extends('layouts.app')

@section('title', 'Nos collections — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Nos collections</h1>
    @if($collections->isEmpty())
    <div class="text-center py-16 text-gray-500">Aucune collection disponible.</div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($collections as $collection)
        <a href="{{ route('collections.show', $collection->slug) }}"
           class="group relative bg-gray-100 rounded-2xl overflow-hidden h-64 block shadow-sm hover:shadow-md transition-shadow">
            @if($collection->cover_image)
            <img src="{{ asset('storage/'.$collection->cover_image) }}" alt="{{ $collection->name }}"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                <div>
                    <h2 class="text-white text-xl font-bold">{{ $collection->name }}</h2>
                    @if($collection->description)
                    <p class="text-gray-200 text-sm mt-1 line-clamp-2">{{ $collection->description }}</p>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
