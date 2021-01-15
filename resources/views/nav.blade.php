{{-- <div class="sidebar" data-color="black" data-image="assets/img/full-screen-image-3.jpg">--}}
{{--        <div class="logo">--}}
{{--            <a href="/dashboard.html" class="simple-text logo-mini">--}}
{{--                <img src="https://nextgenrpm.com/assets/img/nextgen-icon.svg" width="55" alt=""/>--}}
{{--            </a>--}}

{{--			<a href="/dashboard.html" class="simple-text logo-normal">--}}
{{--				<img src="https://nextgenrpm.com/assets/img/nextgen-logo.svg" width="150"alt=""/>--}}
{{--			</a>--}}
{{--        </div>--}}

{{--    	<div class="sidebar-wrapper">--}}
{{--			<div class="topdate">--}}
{{--			<div class="info">--}}
{{--			<div id="dater"></div>--}}
{{--			</div>--}}
{{--			</div>            --}}
{{--			<ul class="nav">--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('home') }}">--}}
{{--						<i class="pe-7s-keypad"></i>--}}
{{--						<p>Sākumlapa</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				@if(Auth::user()->role == 'superadmin')--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('doctors') }}">--}}
{{--						<i class="pe-7s-users"></i>--}}
{{--						<p>Meistari</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('adddoctor') }}">--}}
{{--						<i class="pe-7s-add-user"></i>--}}
{{--						<p>Pievienot Jaunu Meistari</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				@endif--}}
{{--				@if(Auth::user()->role == 'superadmin' OR Auth::user()->role == 'doctor')--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('patients') }}">--}}
{{--						<i class="pe-7s-users"></i>--}}
{{--						<p>Klienti</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				@endif--}}
{{--				@if(Auth::user()->role == 'superadmin')--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('addpatient') }}">--}}
{{--						<i class="pe-7s-add-user"></i>--}}
{{--						<p>Pievienot Jaunus Klientus</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--                @endif--}}
{{--			    @if(Auth::user()->role == 'patient')--}}
{{--				<li class="">--}}
{{--					<a href="{{ route('dailyentries') }}">--}}
{{--						<i class="pe-7s-date"></i>--}}
{{--						<p>Daily Entries</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				@endif	--}}
{{--				 <li class="">--}}
{{--					<a href="{{ route('messages') }}">--}}
{{--						<i class="pe-7s-chat"></i>--}}
{{--						<p>Messages</p>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--			</ul>--}}
{{--			<div class="user">--}}
{{--				<div class="info">--}}
{{--					<div class="photo">--}}
{{--	                    <img src="{{asset('img/user.png')}}" />--}}
{{--	                </div>--}}

{{--					<a data-toggle="collapse" href="#collapseExample" class="collapsed">--}}
{{--						<span>--}}
{{--							{{ ucwords(Auth::user()->name) }}--}}
{{--	                        <b class="caret"></b>--}}
{{--						</span>--}}
{{--                    </a>--}}

{{--					<div class="collapse" id="collapseExample">--}}
{{--						<ul class="nav">--}}
{{--							<li>--}}
{{--								<a href="#pablo">--}}
{{--									<i class="pe-7s-id"></i>--}}
{{--									<span class="sidebar-normal">My Profile</span>--}}
{{--								</a>--}}
{{--							</li>--}}

{{--							<li>--}}
{{--								<a href="{{'myprofile'}}">--}}
{{--									<i class="pe-7s-tools"></i>--}}
{{--									<span class="sidebar-normal">Edit Profile</span>--}}
{{--								</a>--}}
{{--							</li>--}}

{{--							<li>--}}
{{--								<a href="#pablo">--}}
{{--									<i class="pe-7s-config"></i>--}}
{{--									<span class="sidebar-normal">Settings</span>--}}
{{--								</a>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--                    </div>--}}
{{--				</div>--}}
{{--            </div>--}}
{{--    	</div>--}}
{{--    </div>--}}

{{--    <div class="main-panel">--}}
{{--		<nav class="navbar navbar-default">--}}
{{--			<div class="container-fluid">--}}
{{--				<div class="navbar-minimize">--}}
{{--					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">--}}
{{--						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>--}}
{{--						<i class="fa fa-navicon visible-on-sidebar-mini"></i>--}}
{{--					</button>--}}
{{--				</div>--}}
{{--				<div class="navbar-header">--}}
{{--					<button type="button" class="navbar-toggle" data-toggle="collapse">--}}
{{--						<span class="sr-only">Toggle navigation</span>--}}
{{--						<span class="icon-bar"></span>--}}
{{--						<span class="icon-bar"></span>--}}
{{--						<span class="icon-bar"></span>--}}
{{--					</button>--}}
{{--					<a class="navbar-brand" href="#">Welcome, {{ ucwords(Auth::user()->name) }}</a>--}}
{{--				</div>--}}
{{--				<div class="collapse navbar-collapse">--}}

{{--					<form class="navbar-form navbar-left navbar-search-form" role="search">--}}
{{--						<div class="input-group">--}}
{{--							<span class="input-group-addon"><i class="fa fa-search"></i></span>--}}
{{--							<input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--						</div>--}}
{{--					</form>--}}

{{--					<ul class="nav navbar-nav navbar-right">--}}
{{--						--}}

{{--						--}}

{{--						<li class="dropdown">--}}
{{--							<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--								<i class="fa fa-envelope-o"></i>--}}
{{--								<span class="notification">5</span>--}}
{{--								<p class="hidden-md hidden-lg">--}}
{{--									Notifications--}}
{{--									<b class="caret"></b>--}}
{{--								</p>--}}
{{--							</a>--}}
{{--							<ul class="dropdown-menu">--}}
{{--								<li><a href="#">Notification 1</a></li>--}}
{{--								<li><a href="#">Notification 2</a></li>--}}
{{--								<li><a href="#">Notification 3</a></li>--}}
{{--								<li><a href="#">Notification 4</a></li>--}}
{{--								<li><a href="#">Another notification</a></li>--}}
{{--							</ul>--}}
{{--						</li>--}}

{{--						<li class="dropdown dropdown-with-icons">--}}
{{--							<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--								<i class="fa fa-list"></i>--}}
{{--								<p class="hidden-md hidden-lg">--}}
{{--									More--}}
{{--									<b class="caret"></b>--}}
{{--								</p>--}}
{{--							</a>--}}
{{--							<ul class="dropdown-menu dropdown-with-icons">--}}
{{--								<li>--}}
{{--									<a href="#">--}}
{{--										<i class="pe-7s-mail"></i> Messages--}}
{{--									</a>--}}
{{--								</li>--}}
{{--								<li>--}}
{{--									<a href="#">--}}
{{--										<i class="pe-7s-help1"></i> Help Center--}}
{{--									</a>--}}
{{--								</li>--}}
{{--								<li>--}}
{{--									<a href="#">--}}
{{--										<i class="pe-7s-tools"></i> Settings--}}
{{--									</a>--}}
{{--								</li>--}}
{{--								<li class="divider"></li>--}}
{{--								<li>--}}
{{--									<a href="#">--}}
{{--										<i class="pe-7s-lock"></i> Lock Screen--}}
{{--									</a>--}}
{{--								</li>--}}
{{--								<li>--}}
{{--                                        <a class="text-danger" href="{{ route('logout') }}"--}}
{{--                                            onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                            <i class="pe-7s-close-circle"></i>--}}
{{--                                            Logout--}}
{{--                                        </a>--}}

{{--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                            {{ csrf_field() }}--}}
{{--                                        </form>--}}
{{--                                    </li>--}}
{{--							</ul>--}}
{{--						</li>--}}

{{--					</ul>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</nav>--}}
{{--	</div>--}}


{{--		<script>--}}
{{--var d = new Date();--}}
{{--document.getElementById("dater").innerHTML = d.toDateString();--}}
{{--</script>--}}