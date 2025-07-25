<?php

use Agenciafmd\Testimonies\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/testimonies', Pages\Testimony\Index::class)
    ->name('admix.testimonies.index');
Route::get('/testimonies/trash', Pages\Testimony\Index::class)
    ->name('admix.testimonies.trash');
Route::get('/testimonies/create', Pages\Testimony\Component::class)
    ->name('admix.testimonies.create');
Route::get('/testimonies/{testimony}/edit', Pages\Testimony\Component::class)
    ->name('admix.testimonies.edit');
