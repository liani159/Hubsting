<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <title>hubsting</title>
@livewireStyles
</head>

<body> 
  <nav class="navbar navbar-expand-md bg-light">
      <div class="container-fluid">
        <a href="{{route('home.index')}}" class="navbar-brand"> <span class="hub">hub</span><span class="text-warning">sting</span></a>
      
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto ">
          @auth 
            @if(auth()->user()->is_admin)
              <li class="nav-item">
                <a href="{{route('home.admin')}}" class="nav-link ps">{{__('Dashboard')}}</a>
              </li>
            @else
              <li class="nav-item">
                <a href="{{route('home.user')}}" class="nav-link">{{__('My section')}}</a>
              </li>
            @endif
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('user.logout')}}">Log out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('user.login')}}">Log in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.registration')}}">Register</a>
            </li>
          @endauth
        </ul>
    </div>
  </div>
</nav>
@yield('content')

<!-- footer mt-auto -->
<footer class="bg-dark text-white text-center">
    <p> copyright 2022 &copy Liani Mopi </p>
</footer>

<!-- JavaScript Bundle with Popper -->
@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="{{url('javascript/functionalities.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="script.js"></script>
</body>
</html>