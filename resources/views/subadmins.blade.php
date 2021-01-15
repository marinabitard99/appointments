@extends('layouts.master')
@section('title') Visie Administratori @endsection
@section('content')
                <div class="row">
                               @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif
                    <div class="col-md-12">
                        <div class="card">
                                
                            <div class="header">
                                <h4 class="title">Visie Administratori</h4>
                            </div><hr>
                            <div class="content table-responsive table-full-width">
                                
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Vārds</th>
                                    	<th>Epasts</th>
                                    	<th>Darbība</th>
                                    </thead>
                                    <tbody>
                                       @foreach($subadmins as $subadmin)
                                         <tr>
                                             <td>{{ ucwords($subadmin['name']) }}</td>
                                             <td>{{ $subadmin['email'] }}</td>
                                             <td><a href="{{route('subadmineditview', $subadmin['id'])}}" class="btn btn-primary btn-xs btn-fill"><i class="fa fa-pencil"></i>Rediģēt Profilu</a> @if(Auth::user()->role=='superadmin')<a onclick="return confirm('Vai tiešām vēlaties dzēst šo Administratoru?');" href="{{route('removesubadmin', $subadmin['id'])}}" class="btn btn-danger btn-xs btn-fill"><i class="fa fa-trash"></i>Dzēst</a>@endif</td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection