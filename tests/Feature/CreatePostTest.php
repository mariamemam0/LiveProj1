<?php

use Livewire\Livewire;

test('example', function () {
    Livewire::test('pages::post.create')
    ->set('title','Test title')
    ->set('content','Test content')
    ->call('save')
    ->assertRedirect('/');
    $this->assertDatabaseHas('posts', [  // check data is in DB
        'title' => 'Test title',
        'content'=>'Test content',
    ]);
    
});
