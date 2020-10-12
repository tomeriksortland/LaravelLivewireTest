
@if($paginator->hasPages())

<ul class="flex justify-between">
    @if ($paginator->onFirstPage())

    <li class="w-16 px-2 py-1 text-center rounded border bg-gray-200">Prev</li>

    @else

    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer"
    wire:click="previousPage">Prev</li>

    @endif
    
    @if ($paginator->hasMorePages())
    
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer"
    wire:click="nextPage">Next</li>

    @else

    <li class="w-16 px-2 py-1 text-center rounded border bg-gray-200">Next</li>

    @endif
</ul>

@endif