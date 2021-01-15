 <div class="sidebar" data-color="red" data-image="{{asset('img/full-screen-image-2.jpg')}}">
        <div class="logo">
            
            <center>
			<a href="{{route('home')}}" class="simple-text logo-normal">
			    <img width="70" class="" src="{{asset('img/angel nail.png')}}" alt=""><br>
				Angel Nails
			</a>
           </center>
        </div>

    	<div class="sidebar-wrapper">
			         
			<ul class="nav">
				<li class="@if(Route::current()->getName()=='home') active @endif">
					<a href="{{ route('home') }}">
						<i class="pe-7s-home"></i>
						<p>Mājas Lapa</p>
					</a>
				</li>
				@if(Auth::user()->role == 'superadmin')
				<li>
					<a data-toggle="collapse" href="#subadmins">
                        <i class="pe-7s-users"></i>
                        <p>Administratori
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse @if(Route::current()->getName()=='addsubadmin' || Route::current()->getName()=='subadmins') in @endif" id="subadmins">
						<ul class="nav">
							<li class="@if(Route::current()->getName()=='addsubadmin') active @endif">
								<a href="{{ route('addsubadmin') }}">
									<span class="sidebar-mini"><i class="fa fa-plus"></i></span>
									<span class="sidebar-normal">Pievienot Jaunu Administratoru</span>
								</a>
							</li>
							<li class="@if(Route::current()->getName()=='subadmins') active @endif">
								<a href="{{ route('subadmins') }}">
									<span class="sidebar-mini"><i class="fa fa-eye"></i></span>
									<span class="sidebar-normal">Rādīt Visus Administratorus</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				@endif
				@if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')

				<li>
					<a data-toggle="collapse" href="#doctors">
                        <i class="pe-7s-users"></i>
                        <p>Meistari
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse @if(Route::current()->getName()=='adddoctor' || Route::current()->getName()=='doctors') in @endif" id="doctors">
						<ul class="nav">
							@if(Auth::user()->role === 'superadmin')
							<li class="@if(Route::current()->getName()=='adddoctor') active @endif">
								<a href="{{ route('adddoctor') }}">
									<span class="sidebar-mini"><i class="fa fa-plus"></i></span>
									<span class="sidebar-normal">Pievienot Jaunu Meistari</span>
								</a>
							</li>
							@endif
							<li class="@if(Route::current()->getName()=='doctors') active @endif">
								<a href="{{ route('doctors') }}">
									<span class="sidebar-mini"><i class="fa fa-eye"></i></span>
									<span class="sidebar-normal">Rādīt Visus Meistarus</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#patients">
                        <i class="pe-7s-users"></i>
                        <p>Klienti
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse @if(Route::current()->getName()=='addpatient' || Route::current()->getName()=='patients' || Route::current()->getName()=='showimportpatients') in @endif" id="patients">
						<ul class="nav">
							<li class="@if(Route::current()->getName()=='addpatient') active @endif">
								<a href="{{ route('addpatient') }}">
									<span class="sidebar-mini"><i class="fa fa-plus"></i></span>
									<span class="sidebar-normal">Pievienot Jaunus Klientus</span>
								</a>
							</li>

							<li class="@if(Route::current()->getName()=='patients') active @endif">
								<a href="{{ route('patients') }}">
									<span class="sidebar-mini"><i class="fa fa-eye"></i></span>
									<span class="sidebar-normal">Rādīt Visus Klientus</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

               <li class="@if(Route::current()->getName()=='diagnosis') active @endif">
					<a href="{{ route('diagnosis') }}">
						<i class="pe-7s-bandaid"></i>
						<p>Procedūras</p>
					</a>
				</li>
                @endif

            </ul>
			<div class="user">
				<div class="info">
					<div class="photo">
	                    <img src="{{asset('img/user.png')}}" />
	                </div>

					<a data-toggle="collapse" href="#collapseExample" class="collapsed">
						<span>
							{{ ucwords(Auth::user()->name) }}
	                        <b class="caret"></b>
						</span>
                    </a>

					<div class="collapse @if(Route::current()->getName()=='myprofile') in @endif" id="collapseExample">
						<ul class="nav">


							<li class="@if(Route::current()->getName()=='myprofile') active @endif">
								<a href="{{route('myprofile')}}">
									<i class="pe-7s-tools"></i>
									<span class="sidebar-normal">Rediģēt Profilu</span>
								</a>
							</li>
						</ul>
                    </div>
				</div>
            </div>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Pārslēgt navigāciju</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Laipni lūdzam, {{ ucwords(Auth::user()->name) }} <small>({{Auth::user()->role}})</small></a>
				</div>
				<div class="collapse navbar-collapse">

					<form class="navbar-form navbar-left navbar-search-form" role="search">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input type="text" value="" class="form-control" placeholder="Search...">
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">

						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-user"></i>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">

								<li>
                                        <a class="text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="pe-7s-close-circle"></i>
                                            Iziet
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>
		<script>
var d = new Date();
document.getElementById("dater").innerHTML = d.toDateString();
</script>