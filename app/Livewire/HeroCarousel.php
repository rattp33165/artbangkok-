<?php

namespace App\Livewire;

use App\Models\Slide;
use Livewire\Attributes\On;
use Livewire\Component;

class HeroCarousel extends Component
{
    #[On('slides-updated')]
    public function refresh(): void {}

    public function render()
    {
        return view('livewire.hero-carousel', [
            'slides' => Slide::active()->get(),
        ]);
    }
}
