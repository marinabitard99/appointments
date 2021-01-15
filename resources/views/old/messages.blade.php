@extends('layouts.master')

@section('title') 
   Messages 
@endsection  
    
@section('style')
    <link href="{{asset('css/inbox.css')}}" rel="stylesheet" />
    <style>
        .unread a{
            font-weight:bold;
        }
    </style>
@endsection
           
@section('content')
            <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Messages</h3>
                      </div>
                      <div class="inbox-body">
                         
                          <table class="table table-inbox table-hover">
                            <tbody>
                             @if(Auth::user()->role=='patient')
                              <tr class="@if(!empty($doctormessage) && $doctormessage->readstatus == 0) unread @endif">
                                  <td class="inbox-small-cells">
                                      Doctor
                                  </td>
                                  <td class="inbox-small-cells"></td>
                                  <td class="view-message  dont-show"></td>
                                  <td class="view-message">
                                  @if(!empty($doctormessage))
                                      @if($doctormessage->senderid == Auth::user()->sessionid) 
                                          Me: 
                                      @endif
                                  <a href="{{route('doctormessage')}}" style="color:black;text-decoration:underline">{{strlen($doctormessage->message)>=90 ? substr($doctormessage->message,0,90).'.......' : $doctormessage->message}}
                                  </a>
                                  @else
                                  No Messages Right Now, <a href="{{route('doctormessage')}}" style="color:black;text-decoration: underline; ">Click Here to Send Message</a>
                                  @endif
                                  </td>
                                  <td class="view-message  inbox-small-cells"></td>
                                  <td class="view-message  text-right">
                                  @if(!empty($doctormessage))
                                  {{\Carbon\Carbon::parse($doctormessage->messagetime)->diffForHumans() }}
                                  @endif
                                  </td>
                              </tr>
                              @elseif(Auth::user()->role=='doctor')
                              @foreach($doctormessage as $message)
                              <tr class="@if($message->readstatus == 0 AND !empty($message->message)) unread @endif">
                                  <td class="inbox-small-cells">
                                      {{ucfirst($message->firstname)}}  {{ucfirst($message->lastname)}}
                                  </td>
                                  <td class="inbox-small-cells"></td>
                                  <td class="view-message  dont-show"></td>
                                  <td class="view-message">
                                  @if(!empty($doctormessage) AND !empty($message->message))
                                      @if($message->senderid == Auth::user()->sessionid) 
                                          Me: 
                                      @endif
                                  <a href="{{route('showpatientmessages', $message->id)}}" style="color:black;text-decoration:underline">{{strlen($message->message)>=90 ? substr($message['message'],0,90).'.......' : $message->message}}
                                  </a>
                                  @else
                                  No Messages Right Now, <a href="{{route('showpatientmessages', $message->id)}}" style="color:black;text-decoration: underline; ">Click Here to Send Message</a>
                                  @endif
                                  </td>
                                  <td class="view-message  inbox-small-cells"></td>
                                  <td class="view-message  text-right">
                                  @if(!empty($doctormessage) AND !empty($message->messagetime))
                                  {{\Carbon\Carbon::parse($message->messagetime)->diffForHumans() }}
                                  @endif
                                  </td>
                              </tr>
                              @endforeach
                              @endif
                              
                              @if(Auth::user()->role!='admin' AND Auth::user()->role!='superadmin')
                              <tr class="@if(!empty($nextgenmessage) && $nextgenmessage->readstatus == 0) unread @endif">
                                  <td class="inbox-small-cells">
                                      NextGen
                                  </td>
                                  <td class="inbox-small-cells"></td>
                                  <td class="view-message dont-show"></td>
                                  <td class="view-message">
                                   @if(!empty($nextgenmessage))
                                       @if($nextgenmessage->senderid == Auth::user()->sessionid) 
                                          Me: 
                                       @endif
                                    <a href="{{route('nextgenmessage')}}" style="color:black;text-decoration:underline">{{strlen($nextgenmessage->message)>=90 ? substr($nextgenmessage->message,0,90).'.......' : $nextgenmessage->message}}</a>
                                    @else
                                    No Messages Right Now, <a href="{{route('nextgenmessage')}}" style="color:black;text-decoration: underline; ">Click Here to Send Message</a>
                                    @endif
                                  <u><a style="color:black" href=""></a></u>
                                  </td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">
                                  @if(!empty($nextgenmessage))
                                  {{\Carbon\Carbon::parse($nextgenmessage->messagetime)->diffForHumans() }}
                                  @endif
                                  </td>
                              </tr>
                              @else
                              @if(isset($nextgenpatientmessages))
                              @foreach($nextgenpatientmessages as $message)
                              <tr class="@if($message->readstatus == 0 AND !empty($message->message)) unread @endif">
                                  <td class="inbox-small-cells">
                                      {{ucfirst($message->firstname)}}  {{ucfirst($message->lastname)}}
                                  </td>
                                  <td>Patient</td>
                                  <td class="inbox-small-cells"></td>
                                  <td class="view-message  dont-show"></td>
                                  <td class="view-message">
                                  @if(!empty($nextgenpatientmessages) AND !empty($message->message))
                                      @if($message->senderid == Auth::user()->sessionid) 
                                          Me:
                                      @endif
                                  <a href="{{route('showpatientmessages', $message->id)}}" style="color:black;text-decoration:underline">{{strlen($message->message)>=90 ? substr($message['message'],0,90).'.......' : $message->message}}
                                  </a>
                                  @else
                                  No Messages Right Now, <a href="{{route('showpatientmessages', $message->id)}}" style="color:black;text-decoration: underline; ">Click Here to Send Message</a>
                                  @endif
                                  </td>
                                  <td class="view-message  inbox-small-cells"></td>
                                  <td class="view-message  text-right">
                                  @if(!empty($nextgenpatientmessages) AND !empty($message->messagetime))
                                  {{\Carbon\Carbon::parse($message->messagetime)->diffForHumans() }}
                                  @endif
                                  </td>
                              </tr>
                              @endforeach
                              elseif(isset($nextgendoctormessages))
                              @foreach($nextgendoctormessages as $message)
                              <tr class="@if($message->readstatus == 0 AND !empty($message->message)) unread @endif">
                                  <td class="inbox-small-cells">
                                      {{ucfirst($message->firstname)}}  {{ucfirst($message->lastname)}}
                                  </td>
                                  <td>Doctor</td>
                                  <td class="inbox-small-cells"></td>
                                  <td class="view-message  dont-show"></td>
                                  <td class="view-message">
                                  @if(!empty($nextgendoctormessages) AND !empty($message->message))
                                      @if($message->senderid == Auth::user()->sessionid) 
                                          Me:
                                      @endif
                                  <a href="{{route('showdoctormessages', $message->id)}}" style="color:black;text-decoration:underline">{{strlen($message->message)>=90 ? substr($message['message'],0,90).'.......' : $message->message}}
                                  </a>
                                  @else
                                  No Messages Right Now, <a href="{{route('showdoctormessages', $message->id)}}" style="color:black;text-decoration: underline; ">Click Here to Send Message</a>
                                  @endif
                                  </td>
                                  <td class="view-message  inbox-small-cells"></td>
                                  <td class="view-message  text-right">
                                  @if(!empty($nextgendoctormessages) AND !empty($message->messagetime))
                                  {{\Carbon\Carbon::parse($message->messagetime)->diffForHumans() }}
                                  @endif
                                  </td>
                              </tr>
                              @endforeach
                              @endif
                              @endif
                            </tbody>
                          </table>
                      </div>
                  </aside>
              </div>
@endsection