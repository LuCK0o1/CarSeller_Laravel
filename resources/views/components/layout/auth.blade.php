@props(['title'=>'' , 'bodyClass'=>'' ,'method'=>'' , 'action'=>''])

<x-base-layout title="{{$title}}" bodyClass="{{$bodyClass}}" >
    <main>
        <div class="container-small page-login">
            <div class="text-center">
                <a href="/" class="m-auto">
                    <img src="/img/logoipsum-265.svg" alt="" />
                </a>
            </div>
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    
                    <h1 class="auth-page-title">{{$title}}</h1>

                    <form 
                        action="{{$action}}" 
                        method="{{$method}}"
                        id="signupForm"
                    >
                    @csrf

                        {{$slot}}

                        <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                            <button
                            class="btn btn-default flex justify-center items-center gap-1"
                            >
                            <img src="/img/google.png" alt="" style="width: 20px" />
                            Google
                            </button>
                            <button
                            class="btn btn-default flex justify-center items-center gap-1"
                            >
                            <img src="/img/facebook.png" alt="" style="width: 20px" />
                            Facebook
                            </button>
                        </div>

                        {{--Custom footer slot--}}
                        {{$footerLinks}}
                        
                    </form>
                </div>
                
                {{--Custom Side Image slot--}}
                {{$sideImage}}
                
            </div>
        </div>
    </main>
</x-base-layout>