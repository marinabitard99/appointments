@extends('layouts.master')

@section('title') Rediģēt Profilu @endsection

@section('content')

<div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Rediģēt Profilu</h4>
                            </div>
                            <div class="content">
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif

                                @if ($errors->any())
                                       <div class="alert alert-danger">
                                        {!! implode('<br>', $errors->all(':message')) !!}
                                       </div>
                                @endif
                                <form method="post" action="{{route('updateemail')}}">
                                       {{ csrf_field() }}
                                       <div class="row">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <label>Email</label>
                                                <input required name="email" type="email" class="form-control" placeholder="Email" value="{{$mydetails->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button name="update" type="submit" class="btn btn-primary btn-fill pull-right">Atjaunināt Epastu</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                <label>Pašreizējā Parole</label>
                                                <input required name="currentpassword" type="password" class="form-control" placeholder="Ievadīt Pašreizējā Parole">
                                            </div>
                                            <div class="form-group">
                                                <label>Jauna Parole</label>
                                                <input required name="password" type="password" class="form-control" placeholder="Ievadīt Jaunu Parole">
                                            </div>
                                       
                                   
                                            <div class="form-group">
                                                <label>Apstipriniet Paroli</label>
                                                <input required name="password_confirmation" type="password" class="form-control" placeholder="Apstipriniet Paroli">
                                            </div>
                                        
                                    <button id="submit-btn" type="submit" class="btn btn-primary btn-fill pull-right">Mainīt Parole</button>
                                    <div class="clearfix"></div>
                                </form>
                                </div>
                        </div>
                    </div>
                </div>

@endsection
@section('js')
<script>
    function submitForm() {
        $("#msg").empty();
        $("#submit-btn").html('Lūdzu gaidīt');
        $("#submit-btn").attr('disabled',true);
        setTimeout(function(){
        $.ajax({
            type:'POST', url:'{{route('changepassword')}}', 
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