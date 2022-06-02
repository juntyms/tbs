<div>
  Dear Mr./Ms./Dr.  {{$req->AvaliableCourse->tutor->gettutorname->fullname}}
  <br>
  A new tutorial has been requested on the TBS as shown below.

  <br>
  <br>

  @if($req->accepted==1)
  <table style="width:100%;">

        <thead>
            <tr>
                <th style="border: 1px solid black;">Tutor </th>
                <th style="border: 1px solid black;">Course</th>
                <th style="border: 1px solid black;">Date </th>
                <th style="border: 1px solid black;">Time </th>
                <th style="border: 1px solid black;">Location</th>
                <th style="border: 1px solid black;">Status</th>
                
            </tr>
        </thead>
            <tbody>
          
                <tr>
                    <td style="border: 1px solid black;">{{$req->AvaliableCourse->tutor->gettutorname->fullname}}</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->course->name}}</td>
                   <td style="border: 1px solid black;">{{$req->date}}</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->time}}:00</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->location}}</td>
                   <td style="border: 1px solid black;"> Approved</td>
                </tr>
            </tbody>
    </table>

    <br>
    <br>

    <a href="http://www.sct.edu.om/tbs/public/"> Click here View</a>
    

  @endif

  @if($req->accepted==0)
  <table style="width:100%;">

        <thead>
            <tr>
                <th style="border: 1px solid black;">Student </th>
                <th style="border: 1px solid black;">Course</th>
                <th style="border: 1px solid black;">Date </th>
                <th style="border: 1px solid black;">Time </th>
                <th style="border: 1px solid black;">Location</th>
                <th style="border: 1px solid black;">Status</th>
                
            </tr>
        </thead>
            <tbody>
          
                <tr>
                    <td style="border: 1px solid black;">{{$req->Student->fullname}}</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->course->name}}</td>
                   <td style="border: 1px solid black;">{{$req->date}}</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->time}}:00</td>
                   <td style="border: 1px solid black;">{{$req->AvaliableCourse->location}}</td>
                   <td style="border: 1px solid black;">Wating Approval</td>
                </tr>
            </tbody>
    </table>

    <br>
    <br>

    <a href="http://www.sct.edu.om/tbs/public/"> Click here for approval</a>
    

  @endif
 
   
  
 
</div>