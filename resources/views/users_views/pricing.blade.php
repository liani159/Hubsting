@extends('layout.layout')
@section('content')
<div class="container pr">
  <div class="row text-center py-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          free
        </div>
        <div class="card-body">
              <h1 class="card-title pricing-card-title">0£<small class="text-muted fw-light">/yr</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
              <li>5 files</li>
              <li>no shared files</li>
              <li>Help center access</li>
              </ul>
              <a href="{{route('myPlan')}}">
              <button type="button" class="w-100 btn btn-lg btn-primary" >Access</button>
              </a>  
            </div> 
      </div>
    </div>

    <div class="col-md-6 col-sm-6">
      <div class="card">
        <div class="card-header">
          Premium
        </div>
        <div class="card-body">
              <h1 class="card-title pricing-card-title">49.99£<small class="text-muted fw-light">/yr</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>unlimited files</li>
                <li>Teams and file sharing option unlocked</li>
                <li>Help center access</li>
              </ul>
              <a href="{{route('myPlan')}}">
              <button type="button" class="w-100 btn btn-lg btn-primary" >Buy and access</button>
              </a>
            </div>
      </div>
    </div>
  </div>

<!-- FAQ -->
  <h1 class="text-center py-2">FAQ</h1>
  <div class="row">
  <div class="accordion " id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Is Hubsting secure ?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Protecting your files is our top priority. For starters, Hubsting protects all files in transit between your devices and our servers. Any files you add to Hubsting are stored entirely in your own personal location within our distributed and secure cloud infrastructure.
          Hubsting does not sell your data. Our privacy policy describes what information we collect, why, and the steps we take to protect your data.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Will Hubsting work on my device?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        being a web application ,Hubsting works on all platforms, windows, linux, mac, mobiles and others
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          
          I deleted a file by mistake
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        If you deleted your files by mistake, please contact customer service who will hurry to assist you as soon as it is possible to recover your files. this is not always possible, so be careful what you delete.
        we are working to offer you better experience on this point
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection



