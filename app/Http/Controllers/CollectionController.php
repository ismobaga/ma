<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.collections.index', compact('collections'));
    }

    public function show(Collection $collection)
    {
        abort_unless($collection->is_active, 404);
        $products = $collection->products()->where('is_active', true)->paginate(12);

        return view('pages.collections.show', compact('collection', 'products'));
    }
}
