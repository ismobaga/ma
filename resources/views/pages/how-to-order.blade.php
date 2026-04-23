@extends('layouts.app')

@section('title', 'Comment commander — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Comment commander</h1>
    @if(isset($page) && $page)
    <div class="bg-white rounded-2xl shadow-sm p-8 prose max-w-none">{!! $page->content !!}</div>
    @else
    <div class="bg-white rounded-2xl shadow-sm p-8">
        <div class="space-y-6">
            @foreach([['1','Choisissez votre produit','Parcourez notre boutique et trouvez le produit qui vous convient.'],['2','Cliquez sur "Commander sur WhatsApp"','Un message pré-rempli sera envoyé à notre équipe.'],['3','Confirmez votre commande','Notre équipe vous confirmera la disponibilité et les détails de livraison.']] as [$step, $title, $text])
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-amber-800 font-bold">{{ $step }}</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">{{ $title }}</h3>
                    <p class="text-gray-600">{{ $text }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
