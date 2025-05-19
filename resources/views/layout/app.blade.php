@props(['title'=>'' ,'bodyClass'=>null, 'footerLinks'=>''])

<x-base-layout :$title :$bodyClass >
    {{-- @include('layout.partials.header') --}}
    <x-layout.header />
    {{ $slot }}
    <footer>

        
        {{-- <a href="#">Link 1</a>
        <a href="#">Link 2</a> --}}
        {{ $footerLinks }}
        
        {{-- @section('footerLinks')
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            {{-- If we provide this section in another page than that will overide this two links.
        @@show --}}
    </footer>
</x-base-layout>


    
