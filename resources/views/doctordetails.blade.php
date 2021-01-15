@extends('layouts.master')

@section('title')
	Meistare info: {{$doctor->firstname}} {{$doctor->lastname}}
@endsection

@section('content')
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Meistare info: <b>{{$doctor->firstname}} {{$doctor->lastname}}</b></h4>
                                 <a href="{{route('doctors')}}" class="btn btn-xs btn-primary btn-fill">Atpakaļ</a> <a href="{{route('doctoreditview',  $doctor->id)}}" class="btn btn-xs btn-default btn-fill">Rediģēt Detaļas</a>
                            </div>
                            <div class="content">
                                <table class="table">
                                       <tr>
                                       <th>Vārds</th>
                                       <td>{{$doctor->firstname}} {{$doctor->lastname}}</td>
                                       </tr>
                                       <tr>
                                       <th>Dzimums</th>
                                       <td>{{$doctor->gender}}</td>
                                       </tr>
                                       <tr>
                                       <th>Tālrunis</th>
                                       <td>{{$doctor->mobilenumber}}</td>
                                       </tr>
                                       <tr>
                                       <th>Epasts</th>
                                       <td>{{$doctor->email}}</td>
                                       </tr>
                                       <tr>
                                       <th>Specialitāte</th>
                                       <td>{{$doctor->speciality}}</td>
                                       </tr>
                                       <tr>
                                       <th>Reģistrācijas datums</th>
                                       <td>{{$doctor->dateadded}}</td>
                                       </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection