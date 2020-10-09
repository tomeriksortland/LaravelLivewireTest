<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Posts extends Component
{
    public $newPost;
    public $posts = [
        [
            'body' => 'Dette er en laravel livewire test',
            'creator' => 'Tom Erik Sortland',
            'created_at' => '3 min ago'
        ]
    ];

    public function addPost()
    {
        if ($this->newPost == '') return;
        array_unshift($this->posts, [
            'body' => $this->newPost,
            'creator' => 'Tom Erik Sortland',
            'created_at' => Carbon::now()->diffForHumans()
        ]);
        $this->newPost = "";
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
