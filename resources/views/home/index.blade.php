@props(['favCarIds'=>[]])

<x-app-layout title="Home">

    <!-- Home Slider -->
    <section class="hero-slider">
        <!-- Carousel wrapper -->
        <div class="hero-slides">
            <!-- Item 1 -->
            <div class="hero-slide">
                <div class="container">
                    <div class="slide-content">
                    <h1 class="hero-slider-title">
                        Buy <strong>The Best Cars</strong> <br />
                        in your region
                    </h1>
                    <div class="hero-slider-content">
                        <p>
                        Use powerful search tool to find your desired cars based on
                        multiple search criteria: Maker, Model, Year, Price Range, Car
                        Type, etc...
                        </p>

                        <button class="btn btn-hero-slider" id="findACarBtn">Find the car</button>
                    </div>
                    </div>
                    <div class="slide-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hero-slide">
                <div class="flex container">
                    <div class="slide-content">
                    <h2 class="hero-slider-title">
                        Do you want to <br />
                        <strong>sell your car?</strong>
                    </h2>
                    <div class="hero-slider-content">
                        <p>
                        Submit your car in our user friendly interface, describe it,
                        upload photos and the perfect buyer will find it...
                        </p>

                        <button class="btn btn-hero-slider" id="addACarBtn">Add Your Car</button>
                    </div>
                    </div>
                    <div class="slide-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>
            <button type="button" class="hero-slide-prev">
                <svg
                    style="width: 18px"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 6 10"
                >
                    <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1 1 5l4 4"
                    />
                </svg>
                <span class="sr-only">Previous</span>
            </button>
            <button type="button" class="hero-slide-next">
                <svg
                    style="width: 18px"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 6 10"
                >
                    <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                    />
                </svg>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </section>
    <!--/ Home Slider -->

    <main>
        <!-- Find a car form -->
        <x-search-form 
            action="{{route('car.search')}}" 
            method="GET"
            :$makers
            :$carTypes
            :$fuelTypes
            :$states 
        />
        <!--/ action and method are globad attriutes with default values because it's fine to don't give the pproperties. -->
        <!--/ Find a car form Component importd from views.components -->

        <!-- New Cars -->
        <section>
        <div class="container">
            <h2>Latest Added Cars</h2>
            <div class="car-items-listing">
                @foreach ($cars as $car)
                    <x-car-item :$car isInWatchList="{{in_array($car->id , $favCarIds)}}"/>
                @endforeach
            </div>
        </div>
        </section>
        <!--/ New Cars -->
    </main>

    {{-- <x-slot:footerLinks>
        <a href="#">Link 3</a>
        <a href="#">Link 4</a>
    </x-slot:footerLinks> --}}
    
    {{-- @section('footterLinks')
        @parent
            {{-- This Parent take content already defined in parent of the file that we exents to. --}}
            {{-- Here Parent is layout.app
            <a href="#">Link 3</a>
            <a href="#">Link 4</a>
    @endsection --}}

</x-app-layout>



