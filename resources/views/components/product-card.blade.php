<div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
    <a href="{{ route('shop.show', $product->slug) }}" class="block">
        <div class="aspect-square bg-gray-100 overflow-hidden relative">
            @if($product->main_image)
            <img src="{{ asset('storage/'.$product->main_image) }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            @endif
            @if($product->is_new)
            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">Nouveau</span>
            @endif
            @if($product->is_featured)
            <span class="absolute top-2 right-2 bg-amber-500 text-white text-xs font-bold px-2 py-1 rounded-full">Vedette</span>
            @endif
        </div>
        <div class="p-4">
            <h3 class="font-semibold text-gray-900 group-hover:text-amber-700 transition-colors line-clamp-2">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $product->category->name ?? '' }}</p>
            <div class="flex items-center mt-2">
                <span class="font-bold text-amber-700">{{ $product->formatted_price }}</span>
                @if($product->compare_price)
                <span class="text-sm text-gray-400 line-through ml-2">{{ number_format((float)$product->compare_price, 0, ',', ' ') }} FCFA</span>
                @endif
            </div>
        </div>
    </a>
    <div class="px-4 pb-4">
        <a href="{{ $product->whatsapp_url }}" target="_blank"
           class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 rounded-lg flex items-center justify-center space-x-2 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            <span>Commander</span>
        </a>
    </div>
</div>
