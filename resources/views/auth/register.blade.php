@extends('layout.layout')

@section('content')
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="registration text-center" method="POST" action="#">
            {{ csrf_field() }}
            
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" placeholder="Your name" class="form-control" id="email" name="name">
                <div class="form-error">
                    @error('name')
                        {{$message}}
                    @enderror
                </div> 
            </div>
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
                <input type="password" class="form-control" placeholder="password" id="password" name="password">
                <div class="form-error">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>   
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="confirm your password" id="password_confirmation" name="password_confirmation">
                <div class="form-error">
                    @error('password_confirmation')
                        {{$message}}
                    @enderror
                </div> 
            </div>

            <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('Register') }}</button>
            </form>

        </div>
        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
            class="img-fluid" alt="Sample image">

        </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
