@extends('layout.layout')

@section('content')
<section class="vh-100 gradient-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        
        <div class="card bg-ligth text-dark" style="border-radius: 1rem;">

          <div class="card-body p-5 text-center">

            <!-- ico -->
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image">
            </div>

            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
            <p class="text-dark-50 mb-5">Please enter your login and password!</p>
            <form class="login" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" placeholder="Enter your email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div class="form-error">
                        @error('email')
                            {{$message}}
                        @enderror
                    </div> 
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="password"id="password" name="password">
                    <div class="form-error">
                        @error('password')
                                {{$message}}
                        @enderror
                    </div>
                </div>

                
                <div class="mb-3">
    
                    <div class="form-check ">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label pe-5" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
               

                @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
                @endif
            
                <button type="submit" class="btn btn-outline-primary btn-lg px-5 m-2">{{ __('Login') }}</button>

                <div>
                    <p class="mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-dark-50 fw-bold">Sign Up</a>
                    </p>
                </div>
                </form>
                

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
