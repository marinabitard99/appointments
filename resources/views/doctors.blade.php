@extends('layouts.master')

@section('title') Visi Meistari @endsection

@section('content')
                <div class="row">
                    <div class="col-md-12">
                               @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @elseif(Session::has('danger'))
                                <div class="alert alert-danger">
                                  {{ Session::get('danger') }}
                                </div>
                                @endif
                        <div class="card">
                                
                            <div class="header">
                                <h4 class="title">Visi Meistari</h4>
                            </div><hr>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Vārds</th>
                                    	<th>Tālrunis</th>
                                    	<th>Epasts</th>
                                    	<th>Darbība</th>
                                    </thead>
                                    <tbody>
                                       @foreach($doctors as $doctor)
                                         <tr>
                                            
                                             <td>{{ucfirst($doctor['firstname']) }} {{ ucfirst($doctor['lastname']) }}</td>
                                             <td>{{$doctor['mobilenumber']}}</td>
                                             <td>{{$doctor['email']}}</td>
                                             <td><a href="{{route('doctorappointments', $doctor['id'])}}" class="btn btn-xs btn-fill btn-default"><i class="fa fa-info"></i>Vizītes</a> <a href="{{route('doctordetails', $doctor['id'])}}" class="btn btn-xs btn-fill btn-success"><i class="fa fa-info"></i>Detaļas</a> <a href="{{route('doctoreditview', $doctor['id'])}}" class="btn btn-xs btn-fill btn-primary"><i class="fa fa-pencil"></i> Rediģēt</a> @if(Auth::user()->role=='superadmin') <a onclick="return confirm('Vai tiešām vēlaties dzēst šo meistare?');" href="{{route('removedoctor', $doctor['id'])}}" class="btn btn-danger btn-xs btn-fill"><i class="fa fa-trash"></i>Dzēst</a>@endif</td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
@endsection