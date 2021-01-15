@extends('layouts.master')
@section('title', 'Angel Nails')
@section('content')
            @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">
                                Paziņojumi
                            </h4>
                        </div>
                        <hr>
                        <div class="content">

                        </div>
                    </div>
                </div>
            </div>
@endsection