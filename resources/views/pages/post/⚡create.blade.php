<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

new #[Layout('layouts::app',['title' =>'Create Post'])] class extends Component
{
    public string $title = '';
    public string $content = '';

    public function save()
    {
        Post::create($this->validate([
            'title'   => 'required|min:3',
            'content' => 'required|min:10',
        ]));

        $this->redirect('/');
    }
};
?>

<form wire:submit.prevent="save" class="space-y-6">

    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700 dark:text-white">Title</label>
        <input
            type="text"
            wire:model="title"
            class="block p-3 w-full shadow-xs disabled:shadow-none border rounded-lg bg-white dark:bg-zinc-800 text-sm leading-6 text-gray-700 dark:text-white"
        >
        @error('title')
            <div class="mt-1 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</div>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700 dark:text-white">Content</label>
        <textarea
            wire:model="content"
            rows="6"
            class="block p-3 w-full shadow-xs disabled:shadow-none border rounded-lg bg-white dark:bg-zinc-800 text-sm leading-6 text-gray-700 dark:text-white"
        ></textarea>
        @error('content')
            <div class="mt-1 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</div>
        @enderror
    </div>

    <button
        type="submit"
        class="relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-70"
    >
        Save
    </button>

</form>