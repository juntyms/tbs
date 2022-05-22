@extends('layouts.dashboard')
@section('title')
Departments Report statistics
@endsection
@section('customcss')

@endsection
@section('PageTitle')
<h3>Departments Report statistics</h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
  </ol>
</nav>

@endsection
@section('content')
<div class="text-right">
<button  type="button" class="btn btn-lg m-1"><i class="ri-printer-line"></i>

</button>
</div>

    
   <section class="section">
      <div class="row" >

        @foreach($deps as $dep)
          <a class="col-md-6 col-xl-3" href="{{route('Report.eachDepartmentReport',$dep->id)}}">
            <div class="card  order-card" style="background-color:#084C61; height:100px;">
              <div class="card-block">
                  <h6 class="m-b-20"><strong>{{$dep->name}} </strong></h6>
                  <h4 class="text-right"><i class="bi bi-journal-text f-left"></i></h4>
                
              </div>
            </div>
          </a>
   
        @endforeach
      </div>
      <div class="row" >

        <div class="col-lg-7">
          <div class="card" style="background: #f6f9ff;">
            <div class="card-body">

              <h5 class="card-title">Departments Avaliable courses</h5>

              <!-- Donut Chart -->
              <div id="donutChart" style="min-height:300px;" class="echart"></div>

              <script>
              document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#donutChart")).setOption({
                  tooltip: {
                      trigger: 'item'
                  },
                  legend: {
                      top: '1%',
                      left: 'left'
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

                             
                                  {
                                      value: {{$dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count()}},
                                      name: '{{$dep->name}}'
                                  },
                            
                          @endforeach
                    
                      ]
                  }]
                  }).render();
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
                  <div id="donutChart3" style="min-height: 300px;" class="echart"></div>

                  <script>
                  document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#donutChart3")).setOption({
                      tooltip: {
                          trigger: 'item'
                      },
                      legend: {
                          top: '1%',
                          left: 'center'
                      },
                      series: [{
                          name: 'Users',
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
                      }).render();
                  });
                  </script>
                  <!-- End Donut Chart -->

              </div>

            </div>
          </div>
        
      


          <div class="col-lg-5">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tutorials Requested Chart</h5>

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
                        enabled: true
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
         <div class="col-lg-7">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Summery</h5>

                <div class="table-responsive">
                  <table class="table table-hover table-bordered">

                    <thead>
                      <tr>
                        <th>Department</th>
                        <th>#Courses</th>
                        <th>#Requests </th>
                        <th>Wating Approval</th>
                        <th>Approved</th>
                        <th>completed</th>
                        <th>incompleted</th>
                        <th>Rejected</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($deps as $dep)
                      <tr>
                          @if($ay)
                            @if($dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count() > 0)
                              <td>{{$dep->name}}</td>
                              <td>{{$dep->Available()->where('available_courses.active',1)->count()}}</td>
                              <td>{{$dep->RequestDep()->count()}}</td>
                              <td>{{$dep->requestDep()->where('tutorial_requests.accepted',0)->count()}}</td>
                              <td>{{$dep->requestDep()->where('tutorial_requests.accepted',1)->count()}}</td>
                              <td>{{$dep->requestDep()->where('tutorial_requests.accepted',3)->count()}}</td>
                              <td>{{$dep->requestDep()->where('tutorial_requests.accepted',4)->count()}}</td>
                              <td>{{$dep->requestDep()->where('tutorial_requests.accepted',2)->count()}}</td>
                              @endif
                            @else
                              <td>{{$dep->name}}</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td> 
                            @endif


                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


       
      </div>
    </section>

  



@endsection
@section('customjs')

@endsection