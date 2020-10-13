<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    //Variabler som ligger public er automatisk aksesser bare i "viewet" uten at man trenger å sende med variabelen.

    //variabel som holder på dataen fra input feltet i posts.blade.php.
    public $newPost;
    public $newImage;
    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected' => 'ticketSelected'
    ];


    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    //Gjør real time validation, det vil si at den validerer etter som man skriver men blokerer ikke en request om å lagre, det gjør man i validaten som ligger i 'addPostToDB()'
    public function updated($field)
    {
        $this->validateOnly($field, [
            'newPost' => 'required|max:255'
        ]);
    }

    //Lagrer posten som skal lages i databasen.
    //validate validerer at dataen man skal lagre ikke er null og at den ikke er mer enn 255.
    //man får ikke "submitta" en create hvis validaten ikke går mellom.
    public function addPostToDB()
    {
        $this->validate([
            'newPost' => 'required|max:255'
        ]);

        $createdPost = Post::create([
            'body' => $this->newPost,
            'user_id' => 1,
            'support_ticket_id' => $this->ticketId,
        ]);

        $this->newPost = "";
        session()->flash('message', 'Post added successfully.');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        session()->flash('message', 'Post successfully deleted.');
    }


    //gjør en spørring til databasen etter Postene som ligger i databasen. Den spør også etter en pagination med 2 "items" per page.
    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::where('support_ticket_id', $this->ticketId)->latest()->paginate(2),
        ]);
    }
}
