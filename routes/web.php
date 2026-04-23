<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/boutique', [ShopController::class, 'index'])->name('shop.index');
Route::get('/produit/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('collections.show');

Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/comment-commander', [PageController::class, 'howToOrder'])->name('how-to-order');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/page/{page:slug}', [PageController::class, 'show'])->name('pages.show');
