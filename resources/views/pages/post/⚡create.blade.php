<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

new #[Layout('layouts::app',['title' =>'Create Post'])] class extends Component
{
    public string $title = '';
    public string $content = '';
    public string $status = 'draft';

    public function save()
    {
        Post::create($this->validate([
            'title'   => 'required|min:3',
            'content' => 'required|min:10',
            'status'=>'required|in:draft,published',
        ]));


        $this->redirect('/');
    }
};
?>
<div>
<form wire:submit="save" class="space-y-6">
    <flux:input
        label="Title"
        placeholder="Enter post title"
        wire:model="title"
    />

    <flux:textarea
        label="Content"
        placeholder="Enter post content"
        wire:model="content"
    />

    <flux:radio.group wire:model="status" label="Status" variant="cards" class="max-sm:flex-col">
        <flux:radio value="draft" label="Draft" description="Post will be saved as draft" checked/>
        <flux:radio value="published" label="Published" description="Post will be published immediately"/>
    </flux:radio.group>

   <div class="flex justify-end">
    <button type="submit" class="flex data-loading:opacity-50 items-center font-medium justify-center gap-2 whitespace-nowrap h-10 text-sm rounded-md px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 focus:outline-none">
        Create post
    </button>
    
    <flux:icon.loading variant="micro" wire:loading wire:target="save" />
</div>
</form>
</div>

