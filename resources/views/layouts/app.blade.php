<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('site_name', 'Maison Aminata'))</title>
    <meta name="description" content="@yield('meta_description', setting('site_tagline', 'Votre boutique de mode africaine'))">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-white text-gray-900 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-amber-700">
                    {{ setting('site_name', 'Maison Aminata') }}
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-amber-700 transition-colors">Accueil</a>
                    <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-amber-700 transition-colors">Boutique</a>
                    <a href="{{ route('collections.index') }}" class="text-gray-600 hover:text-amber-700 transition-colors">Collections</a>
                    <a href="{{ route('faq') }}" class="text-gray-600 hover:text-amber-700 transition-colors">FAQ</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-amber-700 transition-colors">Contact</a>
                </div>
                <a href="{{ route('shop.index') }}" class="bg-amber-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-amber-700 transition-colors">
                    Boutique
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-white text-xl font-bold mb-3">{{ setting('site_name', 'Maison Aminata') }}</h3>
                    <p class="text-gray-400 mb-4">{{ setting('site_tagline', 'Mode africaine authentique') }}</p>
                    <div class="flex space-x-4">
                        @if(setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" class="text-gray-400 hover:text-white">Instagram</a>
                        @endif
                        @if(setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" class="text-gray-400 hover:text-white">Facebook</a>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Boutique</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('shop.index') }}" class="hover:text-white transition-colors">Tous les produits</a></li>
                        <li><a href="{{ route('collections.index') }}" class="hover:text-white transition-colors">Collections</a></li>
                        <li><a href="{{ route('shop.index') }}?new=1" class="hover:text-white transition-colors">Nouvelles arrivées</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Aide</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                        @if(setting('whatsapp_number'))
                        <li><a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" class="hover:text-white transition-colors">Commander sur WhatsApp</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ setting('site_name', 'Maison Aminata') }}. Tous droits réservés.
            </div>
        </div>
    </footer>

    @if(setting('whatsapp_number'))
    <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank"
       class="fixed bottom-6 right-6 bg-green-500 text-white rounded-full p-4 shadow-lg hover:bg-green-600 transition-colors z-50"
       title="Commander sur WhatsApp">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
    @endif

</body>
</html>
