@extends('layouts.master')

@section('title')
    Informācija par Klientu: {{$patient->firstname}} {{$patient->lastname}}
@endsection

@section('content')
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Informācija par Klientu: <b>{{$patient->firstname}} {{$patient->lastname}}</b></h4>
                                 <a href="{{route('patients')}}" class="btn btn-xs btn-primary btn-fill">Atpakaļ</a>
                                 @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                 <a href="{{route('patienteditview',  $patient->id)}}" class="btn btn-xs btn-default btn-fill">Rediģēt</a>
                                 @endif
                            </div>
                            <div class="content">
                                <table class="table">
                                       <tr>
                                       <th>Vārds</th>
                                       <td>{{$patient->firstname}} {{$patient->lastname}}</td>
                                       </tr>
                                       <tr>
                                       <th>Vecums</th>
                                       <td>{{\Carbon\Carbon::parse($patient->dob)->age}} Years</td>
                                       </tr>
                                       <tr>
                                       <th>Dzimšanas Datums</th>
                                       <td>{{date('Y-m-d', strtotime($patient->dob))}}</td>
                                       </tr>
                                       <tr>
                                       <th>Dzimums</th>
                                       <td>{{$patient->gender}}</td>
                                       </tr>
                                       <tr>
                                       <th>Tālrunis</th>
                                       <td>{{$patient->phone}}</td>
                                       </tr>
                                       
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection