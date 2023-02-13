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
                    <a href="{{route('myPlan')}}" class="btn btn-primary">Start using Now</a>
                @else
                    <a href="{{route('pricing')}}" class="btn btn-primary">Start using Now</a>
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
<h2 class="text-center">Functionalities</h2>
<div class="container border my-4 px-4 py-2">
    <div class="row">
        <div class="col-md-6 text-center">
            <h5 class="card-title">Personal Usage</h5>

            <p>
                you could choice to use our application to back up your files without
                stress, recover them whenever you want regardless of your device.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <h5 class="card-title">Professional Usage</h5>
            <p>
                with the My team functionality you can also choose to use our 
                application to share your files with your relatives/colleagues and
                thus work in perfect symbiosis in your company.
            </p>
        </div>
    </div>
    <div class="row text-center">
        <a href="{{route('pricing')}}" class="btn btn-primary prix m-auto">Select a pack</a>
    </div>
</div>


<!-- <section class="p-2 text-center">
    <div class="container">
    <h2>Functionalities</h2>
            <div class="d-sm-flex text-center">
                <div class="row text-dark">
                    <div class="col-md-12 p-2 ">
                        <div class="card">
                            <div class="card-body ">
                                <div class="d-flex flex-row">
                                    <div>
                                    <h5 class="card-title">Personal Usage</h5>

                                        <p>
                                            <br> Hubsting is a safety and secured app that gives the possibility to it 
                                            <br> users to storefiles(Musics,files,images...etc) and get it back very easily
                                        </p>
                                    </div>
                                    <div>

                                        <h5 class="card-title">Professional Usage</h5>
                                        <p>
                                            <br>Hubsting is an app that gives the possibility to a group of person or a company to work in a sinchronized manner

                                            <br> having access to the same files(Musics,files,images...etc).The files could be shared and gotten back very easily
                                        </p>
                                                                            </div>
                                </div>
                            </div>
                               
                            <div class="flexbox2">
                                <a href="{{route('pricing')}}">
                            <button type="button" class="btn btn-primary" >Select a pack</button>
                            </a>       
                        </div>                 
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section> -->

 <!-- rated -->
<section class="text-dark p-5">
    <div class="container text-center">
        <h2 class="text-center text-dark">Users Reviews</h2>
        <p class="text-dark text-center">read what think our users of ours products</p>
        <div class="row ">
            <div class="col-md-3 col-sm-6 mb-3 tof"> 
                <div class="card h-100 text-dark">
                    <div class="card-body">
                        <img src="images/justin.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Liani M</h3>
                        <p class="card-text">
                            A top quality App,it's very responsive and a good and safe place to keep
                            your documents
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 tof">
                <div class="card h-100 text-dark">
                    <div class="card-body ">
                        <img src="images/download.jpeg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Jordi</h3>
                        <p class="card-text">
                            I like the web app,it permits to get your files very easile and rapidly and it's well
                            organised
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 tof">
                <div class="card h-100 text-dark">   
                    <div class="card-body">
                        <img src="images/xaviera.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Xaviera</h3>
                        <p class="card-text">
                            I was a bit sceptic at the begining but i opted for th professional option i am very satisfied with my team
                            i'm very happy of what i can do here we can easily share files securely among us and it's a great chance 
                        </p>
                        <a href="#"> <i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"> <i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 tof">
                <div class="card h-100 text-dark">        
                    <div class="card-body">
                        <img src="images/Andrea.jpg" class="img-fluid rounded-circle mb-2" alt="globo">
                        <h3 class="card-title mb-2">Andrea</h3>
                        <p class="card-text ">
                            I think there are thinks that need to be added to the app and for the price i pay there should be much more 
                            options
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