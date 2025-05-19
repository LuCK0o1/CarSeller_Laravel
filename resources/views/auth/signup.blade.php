<x-layout.auth 
    title="Signup" 
    bodyClass="page-signup"
    method='POST'
    action="{{route('signup.verify')}}">


    {{--Form Content--}}

    <div class="form-group">
        <input name="email" type="email" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input name="password" type="password" placeholder="Your Password" />
    </div>
    <div class="form-group">
        <input name="check_password" type="password" placeholder="Repeat Password" />
    </div>
    <hr />
    <div class="form-group">
        <input name="first_name" type="text" placeholder="First Name" />
    </div>
    <div class="form-group">
        <input name="last_name" type="text" placeholder="Last Name" />
    </div>
    <div class="form-group">
        <input name="phone" type="text" placeholder="Phone" />
    </div>
    <button type="button" class="btn btn-primary btn-login w-full" id="signupBtn">Register</button>

    {{-- Footer slot content --}}
    
    <x-slot:footerLinks>
        <div class="login-text-dont-have-account">
            Already have an account? -
            <a href="/login"> Click here to login </a>
        </div>
    </x-slot:footerLinks>

    {{-- SideImage slot content --}}
    <x-slot:sideImage>
        <div class="auth-page-image">
            <img src="/img/signup/4957136.jpg" alt="" class="img-responsive" />
        </div>
    </x-slot:sideImage>
    
</x-layout.auth>


{{-- 
<x-base-layout title="Signup" bodyClass="page-signup" >
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="/">
                            <img src="/img/logoipsum-265.svg" alt="" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">Signup</h1>

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Your Password" />
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Repeat Password" />
                        </div>
                        <hr />
                        <div class="form-group">
                            <input type="text" placeholder="First Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone" />
                        </div>
                        <button class="btn btn-primary btn-login w-full">Register</button>

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
                        <div class="login-text-dont-have-account">
                            Already have an account? -
                            <a href="/login"> Click here to login </a>
                        </div>
                    </form>
                </div>
                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
        </div>
    </main>
</x-base-layout>
 --}}
