@extends('layouts.app')

@section('title', ($page->meta_title ?? $page->title).' — '.setting('site_name', 'Maison Aminata'))
@section('meta_description', $page->meta_description ?? $page->excerpt ?? '')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ $page->title }}</h1>
    <div class="bg-white rounded-2xl shadow-sm p-8 prose max-w-none">
        {!! $page->content !!}
    </div>
</div>
@endsection
