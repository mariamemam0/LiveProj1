<?php

use App\Models\Post;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('example', function () {
    assertDatabaseMissing(Post::class,[
        'title' => 'Test title',
        'content' => 'Test content'
    ]);
   visit('/post/create')
    ->type('[wire\:model="title"]','Test title')
    ->type('[wire\:model="content"]','Test content')
    ->press('Save')
    ->assertPathIs('/');
    assertDatabaseHas(Post::class,[
        'title' => 'Test title',
        'content' => 'Test content'
    ]);
    
    
});
