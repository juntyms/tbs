@extends('layouts.dashboard')
@section('title')
{{$dep->name}} Report
@endsection
@section('PageTitle')
    <h3>{{$dep->name}} Report</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">
<section class="section">
      <div class="row" >

        <div class="col-lg-7">
          <div class="card" style="background: #f6f9ff;">
            <div class="card-body">

              <h5 class="card-title">Courses/Tutorials</h5>

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
                      name: 'Courses',
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
                        @if($ay)
                          
                            {
                                
                            value: {{$dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count()}},
                                
                            name: 'Tutorials'
                            },
                            {
                                value: {{$dep->courses()->where('courses.active',1)->count()}},
                                name: 'Courses'
                            },
                        @else
                            {
                                
                            value:0,
                            
                            name: 'Tutorials'
                            },
                            {
                                value: 0,
                                name: 'Courses'
                            },
                        @endif   
                         
                    
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
                    <h5 class="card-title">Tutors/Students</h5>

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
                              name: 'Students'
                          },
                          {
                              value: {{$totalT}},
                              name: 'Tutors'
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
                <h5 class="card-title">Summary</h5>

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
                   
                     
                      <tr>
                        
                        @if($ay)
                          @if($dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count() > 0)
                            <td>{{$dep->name}}</td>
                            <td>{{$dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count()}}</td>
                            <td>{{$dep->RequestDep()->count()}}</td>
                            <td>{{$dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',0)->count()}}</td>
                            <td>{{$dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',3)->count() + $dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',4)->count()}}</td>
                            <td>{{$dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',3)->count()}}</td>
                            <td>{{$dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',4)->count()}}</td>
                            <td>{{$dep->requestDep()->where('tutorial_requests.active',1)->where('tutorial_requests.accepted',2)->count()}}</td>
                         
                          @else
                            <td>{{$dep->name}}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            @endif
                        @else
                        <td>{{$dep->name}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        @endif

                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


       
      </div>
    </section>

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item mb-3 mt-3">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed text-white"style="background-color:#084C61;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Current Requests
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <div class="table-responsive">
                                    <table class="table datatable table-hover">
                                        <thead>
                                            <tr class="bg-warning text-white">
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Course</th>
                                                <th class="text-center">Tutor</th>
                                                <th class="text-center">Student</th>
                                                <th class="text-center">Day/Time</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Status</th>
                                                <th></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lists as $list)
                                                <tr>
                                                    <td>{{$list->id}}</td>
                                                    <td>{{$list->AvaliableCourse->course->name}}</td>
                                                    <td>{{$list->AvaliableCourse->tutor->gettutorname->fullname}}</td>
                                                    <td>{{$list->student->fullname}} </td>
                                                    <td>{{$list->AvaliableCourse->day}}-{{$list->AvaliableCourse->time}}:00</td>
                                                    <td>{{$list->date}}</td>
                                                    <td>{{$list->AvaliableCourse->location}}</td>
                                        
                                                    @if($list->accepted==0)
                                                    <td>Wating Approval</td>

                                                    @elseif($list->accepted==1)
                                                    <td>Approved</td>

                                                    @elseif($list->accepted==2)
                                                    <td>Rejected</td>

                                                    @elseif($list->accepted==3)
                                                    <td>completed</td>

                                                    @elseif($list->accepted==4)
                                                    <td>incompleted</td>
                                                    @endif

                                                    @if($list->accepted==0)
                                                        <td>
                                                        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#status{{$list->id}}" title="satus"><i class="ri-add-circle-line"></i></button>
                                                            <div class="modal fade" id="status{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                                @include('Tutors.status')
                                                            </div>
                                                        </td>
                                                    @elseif($list->accepted==1)
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#status{{$list->id}}" title="satus"><i class="ri-pencil-line"></i></button>
                                                            <div class="modal fade" id="status{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                                @include('Tutors.status')
                                                            </div>
                                                        </td>
                                                    @endif
                                                   
                                                    
                                                </tr>

                            

                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed text-white "style="background-color:#084C61;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            All Request
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table datatable table-hover">

                                    <thead>
                                        <tr class="bg-warning text-white">
                                            <th class="text-center">Tutorial ID</th>
                                            <th class="text-center">Course</th>
                                            <th class="text-center">Tutor</th>
                                            <th class="text-center">Student Name</th>
                                            <th class="text-center">Day/Time</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Location</th>
                                            <th class="text-center">Status</th>
                                        
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach($Alllists as $list)
                                                <tr>
                                                    <td>{{$list->id}}</td>
                                                    <td>{{$list->AvaliableCourse->course->name}}</td>
                                                    <td>{{$list->AvaliableCourse->tutor->gettutorname->fullname}}</td>
                                                    <td>{{$list->student->fullname}} </td>
                                                    <td>{{$list->AvaliableCourse->day}}-{{$list->AvaliableCourse->time}}:00</td>
                                                    <td>{{$list->date}}</td>
                                                    <td>{{$list->AvaliableCourse->location}}</td>

                                                    @if($list->accepted==0)
                                                    <td>Waiting Approval</td>
                                                    @elseif($list->accepted==1)
                                                    <td>Approved</td>
                                                    @elseif($list->accepted==2)
                                                    <td>Rejected</td>
                                                    @elseif($list->accepted==3)
                                                        <td>Completed</td>
                                                    @elseif($list->accepted==4)
                                                        <td>Incomplete</td>
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


    
            </div>
        </div>
    </div>
</div>
@endsection


                                        