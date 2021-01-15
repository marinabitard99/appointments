@extends('layouts.master')

@section('title')
@if(!isset($subadmin)) Pievienot Jaunu Administratoru @else Rediģēt Administratoru Profilu: {{ $subadmin->name }} @endif
@endsection

@section('content')
                <div class="row">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="header">
                            @if(!isset($subadmin)) Pievienot Jaunu Administratoru @else Rediģēt Administratoru Profilu: {{ $subadmin->name }}
                            <br><a href="{{route('subadmins')}}" class="btn btn-fill btn-primary btn-xs">Atpakaļ</a>
                            @endif
                            </div><hr>
                            <div class="content">
                               @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif

                                @if ($errors->any())
                                       <div class="alert alert-danger">
                                        {{ implode('\n', $errors->all(':message')) }}
                                       </div>
                                @endif
                               <form method="post" action="@if(isset($subadmin)){{route('editsubadmin')}} @else{{route('addnewsubadmin')}}@endif">
                                        {{ csrf_field() }}
                                       <div class="row">
                                           <div class="col-md-12">
                                              <div class="form-group">
                                                   <label>Vārds*</label>
                                                   <input required type="text" placeholder="Ievadiet Vārdu" name="name" class="form-control" value="@if(isset($subadmin)){{ ucfirst($subadmin->name) }}@else{{old('name')}}@endif">
                                              </div>
                                           </div>
                                           
                                       </div>
                                       
                                       
                                       
                                       <div class="row">
                                           <div class="col-md-12">
                                              <div class="form-group">
                                                   <label>Epasta Adrese*</label>
                                                   <input required type="email" placeholder="Ievadiet Epasta Adrese" name="email" class="form-control" value="@if(isset($subadmin)){{ $subadmin->email}}@else{{old('email')}}@endif">
                                              </div>
                                           </div>
                                           
                                       </div>
                                       @if(!isset($subadmin))
                                       <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <label>Parole*</label>
                                                   <input required type="password" placeholder="Ievadiet Paroli" name="password" class="form-control">
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Apstipriniet Paroli*</label>
                                                  <input required type="password" placeholder="Apstipriniet Paroli" name="password_confirmation" class="form-control">
                                              </div>
                                           </div>
                                       </div>
                                       @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                           @if(isset($subadmin))
                                            <input type="hidden" name="subadminid" value="{{ $subadmin->id }}">
                                           @endif
                                            <div class="form-group">
                                           <button name="submit" type="submit" class="btn btn-fill btn-primary btn-block">@if(!isset($subadmin)) Iesniegt @else Atjaunināt @endif</button>
                                           </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div> 
                </div>
                @if(isset($subadmin))
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Mainīt Parole</h4><hr>
                            </div>
                            <div class="content">
                             <form onSubmit="return submitForm();" id="pass-change" method="post">
                                           <div id="msg"></div>
                                           {{csrf_field()}}
                                           <div class="form-group">
                                                <label>Jauna Parole</label>
                                                <input required name="password" type="password" class="form-control" placeholder="Ievadiet Jaunu Paroli">
                                            </div>
                                            <div class="form-group">
                                                <label>Apstipriniet Paroli</label>
                                                <input required name="password_confirmation" type="password" class="form-control" placeholder="Apstipriniet Paroli">
                                                <input type="hidden" value="{{$subadmin->id}}" name="subadminid">
                                            </div>
                                        
                                    <button id="submit-btn" type="submit" class="btn btn-primary btn-fill pull-right">Change Password</button>
                                    <div class="clearfix"></div>
                                </form>
                                </div>
                        </div>
                    </div>
                </div>
                @endif
@endsection
@section('js')
<script>
    function submitForm() {
        $("#msg").empty();
        $("#submit-btn").html('Please Wait');
        $("#submit-btn").attr('disabled',true);
        setTimeout(function(){
        $.ajax({
            type:'POST', url:'{{route('changesubadminpassword')}}', 
            data: $('#pass-change').serialize(),
            success: function(response) {
               $('#msg').html(response).show();
               $("#submit-btn").html('Submit');
               $("#submit-btn").attr('disabled',false);
               $('#pass-change')[0].reset();
            }});
            },1000);
            return false;
        }     
</script>
@endsection