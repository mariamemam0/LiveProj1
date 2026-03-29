<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/post/create','pages::post.create');

require __DIR__.'/settings.php';
