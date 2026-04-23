<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->is_active, 404);

        return view('pages.page', compact('page'));
    }

    public function about()
    {
        $page = Page::where('slug', 'a-propos')->where('is_active', true)->first();

        return view('pages.about', compact('page'));
    }

    public function howToOrder()
    {
        $page = Page::where('slug', 'comment-commander')->where('is_active', true)->first();

        return view('pages.how-to-order', compact('page'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
