@extends('layout.layout')
@section('content')
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center price">
      <div class="col lp">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">0£<small class="text-muted fw-light">/yr</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
            <li>10 files</li>
            <li>no shared files</li>
            <li>Help center access</li>
            </ul>
            <a href="{{route('myPlan')}}">
            <button type="button" class="w-100 btn btn-lg btn-primary" >Access</button>
            </a>  
          </div>      
        </div>
      </div>
      <div class="col lp">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Premium</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">49.99£<small class="text-muted fw-light">/yr</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>unlimited files</li>
              <li>Teams and file sharing unlocked</li>
              <li>Help center access</li>
            </ul>
            <a href="{{route('myPlan')}}">
            <button type="button" class="w-100 btn btn-lg btn-primary" >Buy and access</button>
            </a>
          </div>
        </div>
      </div>
</div>

@endsection



