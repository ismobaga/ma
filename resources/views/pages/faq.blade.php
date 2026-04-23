@extends('layouts.app')

@section('title', 'FAQ — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Questions fréquentes</h1>

    @if($faqs->isEmpty())
    <p class="text-center text-gray-500">Aucune question disponible pour le moment.</p>
    @else
    <div class="space-y-4" x-data="{ open: null }">
        @foreach($faqs as $index => $faq)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <button @click="open = open === {{ $index }} ? null : {{ $index }}"
                    class="w-full text-left px-6 py-4 flex justify-between items-center">
                <span class="font-semibold text-gray-900">{{ $faq->question }}</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform flex-shrink-0 ml-4"
                     :class="{ 'rotate-180': open === {{ $index }} }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open === {{ $index }}" x-cloak class="px-6 pb-4 text-gray-600 prose">
                {!! $faq->answer !!}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if(setting('whatsapp_number'))
    <div class="mt-12 text-center bg-amber-50 rounded-2xl p-8">
        <p class="text-gray-700 font-medium mb-4">Vous avez d'autres questions ?</p>
        <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank"
           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-medium transition-colors inline-flex items-center space-x-2">
            <span>Contactez-nous sur WhatsApp</span>
        </a>
    </div>
    @endif
</div>
@endsection
