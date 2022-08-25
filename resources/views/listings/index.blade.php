<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="bg-gray-50 border border-gray-200 rounded p-6">

    @if(count($listings) == 0)
        <p>No listings found</p>
    @endif
    @foreach($listings as $listing)
        <x-listing-card :listing="$listing" />
        
    @endforeach
    </div>
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</x-layout>
