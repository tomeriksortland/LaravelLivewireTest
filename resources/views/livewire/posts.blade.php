<div class="flex justify-center">
    <div class="w-6/12">
    <h1 class="my-10 text-3x1">Comments</h1>
    {{-- wire:submit.prevent, her lager man en form somm blir bindt til en metode i App/Http/Livewire/Posts. Når formen blir submittet så kaller den automatisk metoden som ligger i "controlleren".
    .prevent betyr at den ikke laster siden på nytt etter at formen blir submitted. --}}
    @error('newPost')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror

    <div>
        @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
            {{ session('message') }}
        </div>
        @endif
    </div>
    

    <form class="my-4 flex" wire:submit.prevent='addPostToDB'>
        <input 
        type="text" 
        class="w-full rounded border shadow p-2 mr-2 my-2" 
        placeholder="What's on your mind?"
        {{-- wire:model.lazy, her binder man det som blir skrevet til en public variabel i Livewire/Posts controlleren. 
            .lazy betyr at det ikke blir gjort ajax request før man klikker seg ut av inputfeltet.
            .debounce betyr at ajax request blir ikke sendt før det har gått i dette tilfellet 500 millisekunder --}}
        wire:model.debounce.500ms="newPost"
        >
        <div class="py-2">
            <button
            {{-- type="submit", her må man han med at denne button skal submitte formen. --}}
            type="submit"
            class="p-2 bg-blue-500 w-20 rounded shadow text-white"
            >Add</button>
            
    </form>
    </div>
    {{-- Looper igjennom $posts, som er et globalt array som ligger i Livewire/Posts controlleren. Det er en "in memory database" som holder på alle lagde poster. --}}
    @foreach($posts as $post)
    <div class="rounded border shadow p-3 my-2">
        <div class="flex justify-between my-2">
        <div class="flex justify-start my-2">
            <p class="font-bold text-lg">{{ $post->creator->name }}</p>
            <p class="mx-3 py-1 text-xs text-gray-500 front-semibold">{{ $post->created_at->diffForHumans() }}</p>
        </div>
        <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer"
             wire:click="deletePost({{ $post }})"></i>
    </div>
        <p class="text-gray-800">{{ $post->body }}</p>
    </div>
    @endforeach

    {{ $posts->links('pagination-links') }}
    </div>
</div>

