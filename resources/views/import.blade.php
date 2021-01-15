{{--@extends('layouts.master')--}}

{{--@section('title') Import Patients @endsection--}}

{{--@section('content')--}}

{{--<div class="row">--}}
{{--                    <div class="col-md-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h4 class="title">Import Patients</h4>--}}
{{--                            </div><hr>--}}
{{--                            <div class="content">--}}
{{--                                @if(Session::has('success'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                  {{ Session::get('success') }}--}}
{{--                                </div>--}}
{{--                                @endif--}}

{{--                                @if ($errors->any())--}}
{{--                                       <div class="alert alert-danger">--}}
{{--                                        {!! implode('<br>', $errors->all(':message')) !!}--}}
{{--                                       </div>--}}
{{--                                @endif--}}
{{--                                <form method="post" action="{{route('import')}}" enctype="multipart/form-data">--}}
{{--                                       {{ csrf_field() }}--}}
{{--                                       <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                           <div class="form-group">--}}
{{--                                                <label>Select File (File must be: xls, xlsx, csv)</label>--}}
{{--                                                <input required name="file" type="file" class="form-control">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    --}}
{{--                                    <button name="update" type="submit" class="btn btn-primary btn-fill pull-right">Import</button>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @if(isset($output))--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h4 class="title">Import Patients</h4>--}}
{{--                            </div><hr>--}}
{{--                            <div class="content">--}}
{{--                               {!!$output!!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endif--}}
{{--@endsection--}}