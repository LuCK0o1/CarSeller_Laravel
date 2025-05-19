<x-layout.auth 
    title="Login" 
    bodyClass="page-login"
    method='POST'
    action="{{route('loginConfirm')}}">

    {{--Form Content--}}
    <div class="form-group">
        <input name="email" type="email" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input name="password" type="password" placeholder="Your Password" />
    </div>
    <div class="text-right mb-medium">
        <a href="/password-reset.html" class="auth-page-password-reset"
        >Reset Password</a
        >
    </div>

    <button class="btn btn-primary btn-login w-full">Login</button>

    {{-- Footer slot content --}}
    <x-slot:footerLinks>
        <div class="login-text-dont-have-account">
            Don't have an account? -
            <a href="/signup"> Click here to create one</a>
        </div>
    </x-slot:footerLinks>

    {{-- SideImage slot content --}}
    <x-slot:sideImage>
        <div class="auth-page-image">
            <img src="/img/login/login.png" alt="" class="img-responsive" />
        </div>
    </x-slot:sideImage>

</x-layout.auth>


{{-- 
<x-base-layout title="Login" bodyClass="page-login" >
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="/">
                            <img src="/img/logoipsum-265.svg" alt="" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">Login</h1>

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Your Password" />
                        </div>
                        <div class="text-right mb-medium">
                            <a href="/password-reset.html" class="auth-page-password-reset"
                            >Reset Password</a
                            >
                        </div>

                        <button class="btn btn-primary btn-login w-full">Login</button>

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
                            Don't have an account? -
                            <a href="/signup"> Click here to create one</a>
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