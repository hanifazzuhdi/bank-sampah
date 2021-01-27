@extends('layouts.auth', ['title' => 'Forgot Password'])

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                        and we'll send you a link to reset your password!</p>
                                </div>

                                <form class="user mb-4" action="{{route('password.email')}}" method="POST">
                                    <div class="form-group">

                                        <input id="email" type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                    @csrf
                                </form>

                                <hr>
                                <div class="text-center mt-4">
                                    <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
