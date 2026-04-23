@extends('layouts.app')

@section('title', $collection->name.' — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="relative bg-gray-100 rounded-2xl overflow-hidden h-48 mb-8">
        @if($collection->cover_image)
        <img src="{{ asset('storage/'.$collection->cover_image) }}" alt="{{ $collection->name }}"
             class="absolute inset-0 w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex items-center px-8">
            <div class="text-white">
                <h1 class="text-3xl font-bold">{{ $collection->name }}</h1>
                @if($collection->description)
                <p class="text-gray-200 mt-2">{{ $collection->description }}</p>
                @endif
            </div>
        </div>
    </div>

    @if($products->isEmpty())
    <div class="text-center py-16 text-gray-500">Aucun produit dans cette collection.</div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($products as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
    <div class="mt-8">{{ $products->links() }}</div>
    @endif
</div>
@endsection
