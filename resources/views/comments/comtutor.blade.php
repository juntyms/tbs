<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="frame">
            <div class="content">
                <div class="contact-profile">
                    <img src="{{ URL::asset('/storage/images/'.$list->student->photo)}}" alt="" />
                    <p>{{$list->student->fullname}}</p>
                </div>
        
                <div class="messages">
                    <ul>
                        @php ($x=0)
                        @php ($y=0)
                        @php($countt=0)
                        @php($counts=0)
                        @php($countxy=0)
                        @php($indexS=array())
                        @php($scon=null)
                        @php($tcon=null)
                       
               
                        @foreach($studentcomments as $scon)
                            @if($scon->tutorial_request_id == $list->id)
                                @php($x=$x+1)
                            @endif
                        @endforeach
                       
                        @foreach($tutcomments as $tcon)
                            @if($tcon->tutorial_request_id == $list->id)
                                @php($y=$y+1)
                            @endif
                        @endforeach

                       
                        @foreach($studentcomments as $scon)
                            @for($i=0; $i < sizeof($tutcomments);$i++)

                                @if($tutcomments[$i]->tutorial_request_id == $list->id)
                            
                                    @if($tutcomments[$i]->created_at < $scon->created_at)
                                   
                                        @if(!(in_array($i, $indexS)))

                                            <li class="sent">
                                                <img src="{{ URL::asset('/storage/images/'.Auth::user()->photo)}}" alt="" />
                                                <p>{{$tutcomments[$i]->description}}</p>
                                                <span class="time_date">{{$tutcomments[$i]->created_at}}</span>
                                                @php($countt=$countt+1)
                                                @php(array_push($indexS, $i))
                                            </li>
                    
                                        @endif
                                    @endif
                                @endif
                            @endfor
                            @if($scon->tutorial_request_id == $list->id)
                                <li class="replies">
                                    <img src="{{ URL::asset('/storage/images/'.$list->student->photo)}}" alt="" />
                                    <p>{{$scon->description}}</p>
                                    <span class="time_date"> {{$scon->created_at}}</span>
                                    @php($counts=$counts+1)
                                </li>
                            @endif
                          
                                
                        @endforeach
                        
                        @if(sizeof($tutcomments) >= sizeof($studentcomments))
                            @for($i=$countt-1; $i < sizeof($tutcomments) ; $i++)
                           
                                @if($tutcomments[$i]->tutorial_request_id == $list->id)
                                    @if(!(in_array($i, $indexS)))
                                        <li class="sent">
                                                <img src="{{ URL::asset('/storage/images/'.Auth::user()->photo)}}" alt="" />
                                                <p>{{$tutcomments[$i]->description}}</p>
                                                <span class="time_date"> {{$tutcomments[$i]->created_at}}</span>
                                                
                                        </li>
                                    @endif
                                @endif
                            @endfor
                        @endif
                       
                    </ul>
                </div>
        
                <div class="message-input">
                    <div class="wrap">
                        <input type="text" id="inputT{{$list->id}}" placeholder="Write your message..." />
                        <button type="submit" class="submit" id="submitT{{$list->id}}" value={{$list->id}}><i class="ri-send-plane-fill" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            </div
        </div>
    </div>
</div>
<script type="text/javascript">
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  $("#inputT{{$list->id}}").animate({ scrollTop: $(document).height() }, "fast");

  function newMessageT{{$list->id}}() {
    message = $("#inputT{{$list->id}}").val();
    listid = $("#submitT{{$list->id}}").val();
    if($.trim(message) == '') {
      return false;
    }
    $('<li class="sent"><img src="{{ URL::asset('/storage/images/'.Auth::user()->photo)}}" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
    $("#inputT{{$list->id}}").val(null);
    $('.contact.active .preview').html('<span>You: </span>' + message);
   

    var url="{{route('autosendtutor')}}";
    var id= listid;
    var q= message;
    
    $.ajax({
        url:url,
        method:'POST',
        data:{
          id:id,
          q:q
        },
       
    });
  };

  $('#submitT{{$list->id}}').click(function() {
    newMessageT{{$list->id}}();

  });

  $(window).on('keydown', function(e) {
    if (e.which == 13) {
      newMessageT{{$list->id}}();
      return false;
    }
  });
  
</script>

