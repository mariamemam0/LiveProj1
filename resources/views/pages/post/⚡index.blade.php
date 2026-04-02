<?php
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

new #[Title('All Posts')] class extends Component
{
  
   public string $sort = 'newst';

   #[Computed]
    public function posts()
    {
        sleep(1);
        return Post::query()
            ->tap(fn ($q) => match ($this->sort) {
                'oldest' => $q->orderBy('created_at', 'asc'),
                'popular' => $q->orderBy('views', 'desc'),
                default => $q->latest(),
            })
            ->get();
    }

    public function delete(Post $post)
    {
        $post->delete();
    }

};
?>



<div>
  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <flux:heading size="xl">Posts</flux:heading>
      <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
    </div>

    <div class="flex gap-2">
      <div class="max-lg:hidden flex justify-start items-center gap-2">
        <flux:subheading class="whitespace-nowrap">Sort by:</flux:subheading>
        <flux:select size="sm" wire:model.live="sort">
          <option value="newest">Newest</option>
          <option value="oldest">Oldest</option>
          <option value="popular">Most popular</option>
        </flux:select>
      </div>

      <flux:separator vertical class="max-lg:hidden mx-2 my-2" />

      <flux:button variant="primary" icon="plus" size="sm" href="/post/create">New post</flux:button>
    </div>
  </div>

  {{-- Posts grid --}}
  <div class="mt-8 grid grid-cols-3 gap-6">
    @foreach ($this->posts as $post)
      <flux:card class="flex flex-col justify-between p-4 rounded-lg" variant="filled">
        <div>
          <flux:heading size="lg">{{ $post->title }}</flux:heading>
          <flux:text class="mt-1 text-xs text-zinc-500">{{ $post->created_at->format('M d, Y') }}</flux:text>
          <flux:text class="mt-4 line-clamp-3">{{ $post->content }}</flux:text>
        </div>

        <div class="mt-6 flex justify-between">
          <flux:button variant="filled" href="/post/{{ $post->slug }}/edit" size="xs">Edit</flux:button>
<flux:button variant="danger" href="/post/{{ $post->slug }}/delete" size="xs">Delete</flux:button>
        </div>
      </flux:card>
    @endforeach
  </div>
</div>