@extends('layouts.app')

@section('title', setting('site_name', 'Maison Aminata').' — '.setting('site_tagline', 'Mode africaine authentique'))

@section('content')

{{-- Hero --}}
@if($banners->isNotEmpty())
@php $banner = $banners->first(); @endphp
<section class="relative bg-gray-900 h-[80vh] min-h-[500px] flex items-center overflow-hidden">
    @if($banner->image)
    <img src="{{ asset('storage/'.$banner->image) }}" alt="{{ $banner->title }}"
         class="absolute inset-0 w-full h-full object-cover opacity-60">
    @endif
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $banner->title }}</h1>
        @if($banner->subtitle)
        <p class="text-xl md:text-2xl mb-8 text-gray-200">{{ $banner->subtitle }}</p>
        @endif
        @if($banner->button_text)
        <a href="{{ $banner->button_link ?? route('shop.index') }}"
           class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-full text-lg font-medium transition-colors inline-block">
            {{ $banner->button_text }}
        </a>
        @endif
    </div>
</section>
@else
<section class="bg-gradient-to-r from-amber-900 to-amber-700 text-white py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ setting('hero_title', 'Bienvenue chez Maison Aminata') }}</h1>
        <p class="text-xl mb-8">{{ setting('hero_subtitle', 'Mode africaine authentique') }}</p>
        <a href="{{ route('shop.index') }}"
           class="bg-white text-amber-800 px-8 py-4 rounded-full font-medium hover:bg-amber-50 transition-colors inline-block">
            {{ setting('hero_button_text', 'Découvrir la boutique') }}
        </a>
    </div>
</section>
@endif

{{-- Categories --}}
@if($featuredCategories->isNotEmpty())
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-900">Nos catégories</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($featuredCategories as $category)
            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
               class="group bg-white rounded-2xl p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}"
                     class="w-16 h-16 rounded-full mx-auto mb-3 object-cover">
                @else
                <div class="w-16 h-16 rounded-full bg-amber-100 mx-auto mb-3 flex items-center justify-center">
                    <span class="text-2xl">🛍️</span>
                </div>
                @endif
                <span class="text-sm font-medium text-gray-700 group-hover:text-amber-700">{{ $category->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featuredProducts->isNotEmpty())
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Produits vedettes</h2>
            <a href="{{ route('shop.index', ['featured' => 1]) }}" class="text-amber-600 hover:text-amber-700 font-medium">Voir tout →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Collections --}}
@if($collections->isNotEmpty())
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Nos collections</h2>
            <a href="{{ route('collections.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">Voir tout →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($collections as $collection)
            <a href="{{ route('collections.show', $collection->slug) }}"
               class="group relative bg-gray-200 rounded-2xl overflow-hidden h-48 block">
                @if($collection->cover_image)
                <img src="{{ asset('storage/'.$collection->cover_image) }}" alt="{{ $collection->name }}"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                    <h3 class="text-white font-bold text-lg">{{ $collection->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- New Arrivals --}}
@if($newArrivals->isNotEmpty())
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Nouvelles arrivées</h2>
            <a href="{{ route('shop.index', ['new' => 1]) }}" class="text-amber-600 hover:text-amber-700 font-medium">Voir tout →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($newArrivals as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if($testimonials->isNotEmpty())
<section class="py-16 bg-amber-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-900">Ce que disent nos clients</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <p class="text-gray-600 italic mb-4">"{{ $testimonial->content }}"</p>
                <div class="flex items-center space-x-3">
                    @if($testimonial->image)
                    <img src="{{ asset('storage/'.$testimonial->image) }}" alt="{{ $testimonial->name }}"
                         class="w-10 h-10 rounded-full object-cover">
                    @else
                    <div class="w-10 h-10 rounded-full bg-amber-200 flex items-center justify-center">
                        <span class="text-amber-800 font-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                    </div>
                    @endif
                    <div>
                        <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                        @if($testimonial->role)
                        <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
