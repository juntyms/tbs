@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
<h3>Booking Tutorial: Select Department </h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
  </ol>
</nav>

@endsection
@section('content')
  <div class="row">
    @foreach($deps as $dep)

      @if($dep->Available()->where('available_courses.active',1)->count()>0)

        <a class="col-md-6 col-xl-3" href="{{route('booking.option',$dep)}}">
          <div class="card  order-card" style="background-color:#084C61;">
            <div class="card-block">
                <h6 class="m-b-20"><strong>{{$dep->name}} </strong></h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span>Tutorials</span></h4>
                <p class="m-b-0"><span class="f-right">{{$dep->Available()->where('available_courses.active',1)->count()}}</span></p>
            </div>
          </div>
        </a>
      @endif
    @endforeach


    
  <section class="section">
      <div class="row">

      <div class="col-lg-7">
        <div class="card" style="background: #f6f9ff;">
        <div class="card-body">
            <h5 class="card-title">Departments Avaliable courses</h5>

            <!-- Donut Chart -->
            <div id="donutChart" style="min-height:400px;" class="echart"></div>

            <script>
            document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#donutChart")).setOption({
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Total Avaliable Courses',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                    show: false,
                    position: 'center'
                    },
                    emphasis: {
                    label: {
                        show: true,
                        fontSize: '14',
                        fontWeight: 'bold'
                    }
                    },
                    labelLine: {
                    show: false
                    },
                

                    data: [
                        @foreach($deps as $dep)

                            @if($dep->Available()->where('available_courses.active',1)->count()>0)
                                {
                                    value: {{$dep->Available()->where('available_courses.active',1)->count()}},
                                    name: '{{$dep->name}}'
                                },
                            @endif
                        @endforeach
                   
                    ]
                }]
                });
            });
            </script>
            <!-- End Donut Chart -->

        </div>

        </div>
        </div>



















          <div class="col-lg-5">
            <div class="card" style="background: #f6f9ff;">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>

            <!-- Donut Chart -->
            <div id="donutChart3" style="min-height: 200px;" class="echart"></div>

            <script>
            document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#donutChart3")).setOption({
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Total Users',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                    show: false,
                    position: 'center'
                    
                    },
                    emphasis: {
                    label: {
                        show: true,
                        fontSize: '14',
                        fontWeight: 'bold'
                    }
                    },
                    labelLine: {
                    show: false
                    },
                

                    data: [
                       
                    {
                        value: {{$totalS}},
                        name: 'Student'
                    },
                    {
                        value: {{$totalT}},
                        name: 'Tutor'
                    },
                           
                   
                    ]
                }]
                });
            });
            </script>
            <!-- End Donut Chart -->

        </div>

        </div>
        </div>
      
     


        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Requested Chart</h5>

              <!-- Line Chart -->
              <div id="lineChart"></div>

              <script>
            
                

                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#lineChart"), {
                    series: [{
                      name: "Requested",
                      
                      data: {{$countR}},
                    }],
                    chart: {
                      height: 350,
                      type: 'line',
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    grid: {
                      row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                      },
                    },
                    xaxis: {

                  
                      categories:{!! $months !!}

                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>
          </div>
        </div>


       
        </div>
        </section>



@endsection