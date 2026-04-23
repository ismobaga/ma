@extends('layouts.app')

@section('title', 'Boutique — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Boutique</h1>
    <div class="flex flex-col lg:flex-row gap-8">

        <aside class="lg:w-64 flex-shrink-0">
            <form method="GET" action="{{ route('shop.index') }}" class="bg-white rounded-2xl p-6 shadow-sm">
                <h2 class="font-bold text-gray-900 mb-4">Filtres</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nom du produit..."
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Toutes</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Collection</label>
                    <select name="collection" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Toutes</option>
                        @foreach($collections as $col)
                        <option value="{{ $col->slug }}" {{ request('collection') == $col->slug ? 'selected' : '' }}>{{ $col->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                    <select name="sort" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Plus récent</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    </select>
                </div>

                <div class="mb-4 space-y-2">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ request('featured') ? 'checked' : '' }}
                               class="rounded text-amber-600 focus:ring-amber-500">
                        <span class="text-sm text-gray-700">Produits vedettes</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="new" value="1" {{ request('new') ? 'checked' : '' }}
                               class="rounded text-amber-600 focus:ring-amber-500">
                        <span class="text-sm text-gray-700">Nouvelles arrivées</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-amber-700 transition-colors">
                    Appliquer
                </button>
                @if(request()->hasAny(['category', 'collection', 'search', 'sort', 'featured', 'new']))
                <a href="{{ route('shop.index') }}" class="block text-center text-sm text-gray-500 hover:text-gray-700 mt-2">
                    Effacer les filtres
                </a>
                @endif
            </form>
        </aside>

        <div class="flex-1">
            <p class="text-gray-500 text-sm mb-4">{{ $products->total() }} produit(s)</p>

            @if($products->isEmpty())
            <div class="text-center py-16 text-gray-500">
                <p class="text-lg">Aucun produit trouvé.</p>
                <a href="{{ route('shop.index') }}" class="text-amber-600 hover:text-amber-700 mt-2 inline-block">Voir tous les produits</a>
            </div>
            @else
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
