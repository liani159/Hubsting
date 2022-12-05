@extends('layout.layout')
 
 @section('content')
<!-- header -->
<div class="section text-light p-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex">
            <div><h1 class="text-light my-5"> Save <span class="text-success">-Backup</span> </h1>
                <p class="lead my-4 ">Hubsting is a newlly company created created with the aim 
                of facilitating accessibility to your data regardless of your location. 
                indeed hubsting is a site that allows you to save and retrieve your dat
                with great ease, allowing you to be able to move around without having tons 
                of external storage devices with you. everything is done in the cloud and
                you will no longer have this terrible fear of losing track of your information.
                you'll be definetly approve.            
                </p>
                @auth
                <a href="#" class="btn btn-primary">Start using Now</a>
                @else
                <a href="#" class="btn btn-primary">Start using Now</a>
                @endauth
            </div>
            <img src="images/Uploading-cuate.svg" alt="globo" class="img-fluid w-50 ms-auto  d-none d-md-block">
            
        </div>
    </div>
</div>

<!-- our product -->
<section class="p-3">
    <div class="container text-center p-4">
        <h2 class="text-center">Ours Specificities</h2>
        <p class="lead text-center p-3"> what you have to use hubsting</p>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="cont">
                    <em>your files , not ours</em>
                    <p><br> with hubsting , yours files are all yours, we'll never sell it</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="cont">
                    <em>All your files on the same place</em>
                    <p><br> you can to save and find all your files on the same place</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="cont">
                    <em>Special funtionalities</em>
                    <p><br>synchronise all your files, and store all type of data</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="cont">
                    <em>Ease to use and secure</em>
                    <p><br>very easy to use in addition to having almost perfect security </p>
                </div>
            </div>
            
        </div>
    </div>  
</section>

<!-- usage -->
<section class="p-2">
    <div class="container">
    <h2 class="text-center p-2">how you plan to use hubsting</h2>
            <div class="d-sm-flex">
                <div class="row text-dark">
                    <div class="col-md-6 p-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Personal Usage</h5>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Professional Usage</h5>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                                    animi exercitationem alias quaerat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>

 <!-- rated -->
<section class="text-dark p-5">
    <div class="container text-center">
    <h2 class="text-center text-dark">Users Reviews</h2>
                <p class="text-dark text-center">read what think our users of ours products</p>
        <div class="row ">
            <div class="col-md-3 col-sm-6 mb-3"> 
                <div class="card text-dark">
                    <div class="card-body">
                        <img src="images/globe-7510104_1920.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Liani M</h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                            animi exercitationem alias quaerat. 
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-dark">
                    <div class="card-body ">
                        <img src="images/flower-7108507_1920.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Vitale D</h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                            animi exercitationem alias quaerat. 
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 "><div class="card text-dark">
                    <div class="card-body">
                        <img src="images/bird-7102006_1920.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">John Doe</h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                            animi exercitationem alias quaerat. 
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3"><div class="card text-dark">
                    <div class="card-body">
                        <img src="images/rottweiler-7510724_1920.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Nicklaus</h3>
                        <p class="card-text ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam enim 
                            animi exercitationem alias quaerat. 
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
