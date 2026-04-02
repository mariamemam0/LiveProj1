<?php

use Livewire\Component;

new class extends Component
{
    public Post $post;

    public function mount()
    {
        usleep(100*1000);
    }
};
?>

<div>
    {{-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria Skłodowska-Curie --}}
</div>