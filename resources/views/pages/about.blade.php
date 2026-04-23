@extends('layouts.app')

@section('title', 'À propos — '.setting('site_name', 'Maison Aminata'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">À propos de nous</h1>
    @if(isset($page) && $page)
    <div class="bg-white rounded-2xl shadow-sm p-8 prose max-w-none">{!! $page->content !!}</div>
    @else
    <div class="bg-white rounded-2xl shadow-sm p-8 prose max-w-none">
        <p class="text-gray-600">Bienvenue chez Maison Aminata, votre destination pour la mode africaine authentique.</p>
    </div>
    @endif
</div>
@endsection
