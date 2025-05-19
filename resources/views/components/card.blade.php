<!-- This is Anonymous component cause we don't have Card.php file in app.View.Components -->


{{-- passing attributes to anonymous components. --}}

@props(['color' , 'bgColor'=>'black'])
{{-- Recomended to define properties like this so we can know what props are passed down in components --}} 
{{-- props outside of this array are not defined here. --}}
{{-- Also we can give default values here in @props --}}

<div class="card card-text-{{$color}} card-bg-{{$bgColor}}">
    <div class="card-header">{{ $title }}</div>
    @if ($slot->isEmpty())
        <p>Please Provide Some Content.</p>
    @else
        {{ $slot }}
    @endif
    <div class="card-footer">{{ $footer }}</div>
</div>
