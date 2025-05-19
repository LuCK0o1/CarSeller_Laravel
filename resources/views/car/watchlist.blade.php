<x-app-layout title="Car Wish List">
    <main>
    <!-- New Cars -->
    <section>
        <div class="container">
            <div class="flex justify-between items-center">
                <h2>My Favourite Cars</h2>
                @if ($cars->total() > 0)
                    <div class="pagination-summary">
                        <p>
                            Showing {{$cars->firstItem()}} to {{$cars->lastItem()}} of {{$cars->total()}}
                        </p>
                    </div>
                @endif
            </div>
        <div class="{{ $cars->count() != 0 ? 'car-items-listing' : 'text-center em-text'}}">
            @forelse ($cars as $car)
                <x-car-item :$car isInWatchList=true hide="{{'WLItem'.$car->id}}"/>
            @empty
                <h1>Wow So Empty 😲</h1>
            @endforelse
            
        </div>
        
        {{$cars->links()}}
        </div>
    </section>
    <!--/ New Cars -->
    </main>
</x-app-layout>