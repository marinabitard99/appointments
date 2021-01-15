<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Autorizācija</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    @include('layouts.head')
</head>
<body>
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="red" data-image="{{asset('img/full-screen-image-1.jpg')}}">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                      <form class="" method="POST" action="{{ route('login') }}" autocomplete="off">
                        {{ csrf_field() }}
                             <div class="card card-hidden">
                                <div class="header text-center"><b>Angel Nails</b></div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Epasts</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Parole</label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                           <div class="checkbox">
						  							  	<input id="checkbox32" name="remember" {{ old('remember') ? 'checked' : '' }}  type="checkbox">
						  							  	<label for="checkbox32">Atceries</label>
						  						  	</div>
                                        </div>
                                     @if ($errors->has('email'))
                                           <div class="form-group text-center">
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                           </div>
                                            
                                        @endif
                                    
                                </div>
                                <div class="footer text-center">
                                   <div class="form-group">
                                        <button type="submit" class="btn btn-fill btn-danger btn-wd">
                                            Ieiet
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <u>
                                            <a style="color:#888888" class="" href="{{ route('password.request') }}">
                                            Aizmirsa parole?
                                        </a>
                                        </u>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

    
    @include('layouts.scripts')
    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>

</html>