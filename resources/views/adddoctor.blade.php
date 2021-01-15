@extends('layouts.master')

@section('title')
@if(!isset($doctor)) Pievienot Jaunu Meistari @else Rediģēt Meistaru profilu: {{ ucfirst($doctor->firstname) }} {{ ucfirst($doctor->lastname) }} @endif
@endsection

@section('content')
                <div class="row">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="header">
                            @if(!isset($doctor)) Pievienot Jaunu Meistari @else Rediģēt Meistaru profilu: <b>{{ ucfirst($doctor->firstname) }} {{ ucfirst($doctor->lastname) }} </b>
                            <br><a href="{{route('doctors')}}" class="btn btn-fill btn-primary btn-xs">Atpakaļ</a>
                            @endif
                            </div><hr>
                            <div class="content">
                               @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif

                                @if ($errors->any())
                                       <div class="alert alert-danger">
                                        {{ implode('\n', $errors->all(':message')) }}
                                       </div>
                                @endif
                               <form method="post" action="@if(isset($doctor)){{route('editdoctor')}} @else{{route('addnewdoctor')}}@endif">
                                        {{ csrf_field() }}
                                       <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <label>Ievadiet Vārdu*</label>
                                                   <input required type="text" placeholder="Ievadiet Vārdu" name="firstname" class="form-control" value="@if(isset($doctor)){{ ucfirst($doctor->firstname) }}@else{{old('firstname')}}@endif">
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Ievadiet Uzvārdu*</label>
                                                  <input required type="text" placeholder="Ievadiet Uzvārdu" name="lastname" class="form-control" value="@if(isset($doctor)){{ ucfirst($doctor->lastname) }}@else{{old('lastname')}}@endif">
                                              </div>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <label>Telefona Numurs*</label>
                                                   <input required type="text" placeholder="Ievadiet Telefona Numurs" name="mobilenumber" class="form-control" value="@if(isset($doctor)){{ $doctor->mobilenumber }}@else{{old('mobilenumber')}}@endif">
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Specialitāte*</label>
                                                  <input  type="text" placeholder="Ievadiet Meistaru Specialitāti" name="speciality" class="form-control" value="@if(isset($doctor)){{ $doctor->speciality }}@else{{old('speciality')}}@endif">
                                              </div>
                                           </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                                  <div class="form-group">
                                                   <label>Dzimums*</label>
                                                   <select required class="form-control" name="gender">
                                                        <option value="">Izvēlieties Dzimumu</option>
                                                        @if(!isset($doctor))
                                                        <option {{ old('gender')=='Male' ? 'selected="selected"' : '' }} value="Male">Vīrietis</option>
                                                        <option {{ old('gender')=='Female' ? 'selected="selected"' : '' }} value="Female">Sieviete</option>
                                                        <option {{ old('gender')=='Other' ? 'selected="selected"' : '' }} value="Other">Cits</option>
                                                        @else
                                                        <option {{ $doctor->gender=='Male' ? 'selected="selected"' : '' }} value="Male">Vīrietis</option>
                                                        <option {{ $doctor->gender=='Female' ? 'selected="selected"' : '' }} value="Female">Sieviete</option>
                                                        <option {{ $doctor->gender=='Other' ? 'selected="selected"' : '' }} value="Other">Cits</option>
                                                        @endif
                                                        
                                                    </select>
                                              </div>
                                              </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <label>Epasta Adrese*</label>
                                                   <input required type="email" placeholder="Ievadiet Epasta Adrese" name="email" class="form-control" value="@if(isset($doctor)){{ $doctor->email }}@else{{old('email')}}@endif">
                                              </div>
                                           </div>
                                       </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                           @if(isset($doctor))
                                            <input type="hidden" name="doctorid" value="{{ $doctor->id }}">
                                           @endif
                                            <div class="form-group">
                                           <button name="submit" type="submit" class="btn btn-fill btn-primary btn-block">@if(!isset($doctor)) Iesniegt @else Atjaunināt @endif</button>
                                           </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div> 
                </div>
@endsection