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
 <flux:input
        label="Title"
        placeholder="Enter post title"
        wire:model="title"
></flux:input>
        <flux:textarea
            label="Content"
            placeholder="Enter post content"
            wire:model="content"
        ></flux:textarea>

        @error('content')
            <div class="mt-1 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</div>
        @enderror
    

    <flux:button type="submit" variant="primary">
        Save
    </flux:button>

</form>