@extends('layout.layout_due')
@section('content_due')
<!-- <div class="po">
    <h2>Hi {{auth()->user()->name}}</h2>
    <p>Only for admins</p>
</div> -->
<div class="main-container d-flex">
    <div class="sidebar" id=side_nav>
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <!-- <h1 class="fs-4">Hi {{auth()->user()->name}} </h1>  -->
            <h1 class="fs-3"> <span class="bg-white text-dark rounded shadow px-2 py-1 me-2">H_S</span>
            <span class="text-white"> <a href="{{route('home.index')}}" class="text-decoration-none text-white">HUBSTING </a></span>
            </h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white fs-4"><i class="bi bi-list"></i></button>  
        </div>
        <ul class="list-unstyled px-2 text-center ">
            <li class=""><a href="{{route('admin.show_user')}}" class="text-decoration-none plans">Users <i class="bi bi-people"></i></a></li>
            <li class=""><a href="{{route('admin.show_teams_user')}}" class="text-decoration-none plans">Users Teams <i class="bi bi-share text-white"></i></a> </li>
            <li class=""><a href="{{route('teams.index')}}" class="text-decoration-none plans">My teams <i class="bi bi-person-lines-fill text-white"></i></a> </li>
            <li class=""><a href="{{route('admin.space')}}" class="text-decoration-none plans"> My Space <i class="bi bi-bookmark text-white"></i></a> </li>
        </ul>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-md bg-light">
            <div class="container-fluid">

                <div class="d-flex justify-content-between d-md-none d-block">
                    <a href="{{route('home.index')}}" class="navbar-brand"> <span class="hub">hub</span><span class="text-warning">sting</span></a>
                    <button class="btn px-1 py-0 open-btn"><i class="bi bi-list"></i></button> 
                </div>
            
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}</a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                        </li> -->
                    @else
                        <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('login') }}">Log in</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                    @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container px-5 py-5">

            <div class="row ps-3 justify-content-between text-center"> 
                <div class="col-md-4 numUsers">
                    <h3>Num Users</h3>
                    <p>{{$total_users}}</p> 
                </div>
                <div class="col-md-4 storage">
                    <h3>Total storage used</h3>
                    <p> {{$total_storage}}</p>
                    
                </div>
                <div class="col-md-4 newUsers">
                    <h3>new User(s)</h3>
                    <p> + {{$num_news_users}}</p>
                </div>
            </div>

            <div class="row mt-5 ps-3 justify-content-between text-center flop"> 
                <div class="col-lg-6" >
                    <canvas id="myChart"></canvas> 
                </div>
                <div class="col-lg-6">
                    <canvas id="myChar"></canvas>
                </div>
                
            </div>

            
        </div>
<!-- fine content -->
</div>

    

</div>

<script type="application/javascript">

    //chart 1
    var xValues = ["Simple Users", "Premium Users", "Admins"];
    /* var yValues = [55, 40, 2]; */
    var yValues = <?php echo json_encode($lista) ?>;
    //console.log(yValues);
    var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    ];

    new Chart("myChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Reaprtition of users"
        }
    }
    });

    //chart 2
    const ctx = document.getElementById('myChar');
    var userCountByMonths = <?php echo json_encode($userCountByMonth) ?>;
    var months = [];
    var value = [];
    console.log(userCountByMonths);

    userCountByMonths.forEach(function(userCountByMonth) {
    //console.log(number);
        if(userCountByMonth.month == 1){
                months.push("January");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 2){
                months.push("Febuary");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 3){
                months.push("March");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 4){
                months.push("April");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 5){
                months.push("May");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 6){
                months.push("June");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 7){
                months.push("Jully");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 8){
                months.push("August");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 9){
                months.push("September");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 10){
                months.push("October");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 11){
                months.push("November");
                value.push(userCountByMonth.count);
            }
            else if(userCountByMonth.month == 12){
                months.push("December");
                value.push(userCountByMonth.count);
            }
});
    
    console.log(months);
    console.log(value);
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: months,
        datasets: [{
            label: 'Number of registration per months',
            data: value,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    //sidebar
    $(".sidebar ul li").on('click', function(e){
                //e.preventDefault();
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            });

            $(".open-btn").on("click", function(){
                $(".sidebar").addClass('active');
            });

            $(".close-btn").on("click", function(){
                $(".sidebar").removeClass('active');
            });
</script>
@endsection
