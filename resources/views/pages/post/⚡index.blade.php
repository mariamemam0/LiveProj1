<?php
use App\Models\Post;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Component;


new #[Lazy,Title('All Posts')] class extends Component
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

@placeholder
<div class="max-w-5xl">
    <div>
        <flux:heading size="xl">Posts</flux:heading>
        <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6">
        @foreach (range(1, 6) as $_)
            <flux:skeleton class="min-h-56 rounded-lg" animate="shimmer" />
        @endforeach
    </div>
</div>
@endplaceholder

{{-- ✅ Real content starts here --}}
<div class="max-w-5xl">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Posts</flux:heading>
            <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
        </div>
    </div>

    <div class="flex gap-2">
        <div class="flex justify-start items-center gap-2">
            <flux:subheading class="whitespace-nowrap">Sort by:</flux:subheading>
            <flux:select size="sm" wire:model.live="sort" data-dim-sorting>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="popular">Most popular</option>
            </flux:select>
        </div>
        <flux:separator vertical class="mx-lg:hidden mx-2" />
        <flux:button variant="primary" icon="plus" href="/posts/create" size="sm">New Post</flux:button>
    </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6 [*:has([data-dim-sorting][data-loading]]_:.opacity-50">
@foreach ($this->posts as $post)
    <livewire:pages::post.card :$post
      :wire:key="$post->id" />
@endforeach
</div>
</div>

















