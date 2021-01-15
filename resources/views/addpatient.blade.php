@extends('layouts.master')

@section('title')
@if(!isset($patient)) Pievienot Jaunu Klientu @else Rediģēt Klienta Profilu: {{ ucfirst($patient->firstname) }} {{ ucfirst($patient->lastname) }} @endif
@endsection

@section('content')
                <div class="row">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="header">
                            @if(!isset($patient)) Pievienot Jaunu Klientu @else Rediģēt Klienta Profilu: <b>{{ ucfirst($patient->firstname) }} {{ ucfirst($patient->lastname) }}</b> <br><a href="{{route('patients')}}" class="btn btn-xs btn-primary btn-fill">Atpakaļ</a> @endif
                             </div><hr>
                              <div class="content">
                               @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif

                                @if ($errors->any())
                                       <div class="alert alert-danger">
                                        {!! implode('<br>', $errors->all(':message')) !!}
                                       </div>
                                @endif
                               <form id="myform" method="post" action="@if(isset($patient)){{route('editpatient')}} @else{{route('addnewpatient')}}@endif">
                                        {{ csrf_field() }}
                                       <div class="row">
                                           <div class="col-md-6">
                                              <div class="form-group">
                                                   <label>Vārds*</label>
                                                   <input required type="text" placeholder="Ievadiet Vārdu" name="firstname" class="form-control" value="@if(isset($patient)){{ ucfirst($patient->firstname) }}@else{{old('firstname')}}@endif">
                                              </div>
                                              </div>
                                              <div class="col-md-6">
                                              <div class="form-group">
                                                  <label>Uzvārds*</label>
                                                  <input required type="text" placeholder="Ievadiet Uzvārdu" name="lastname" class="form-control" value="@if(isset($patient)){{ ucfirst($patient->lastname) }}@else{{ old('lastname') }}@endif">
                                              </div>
                                              
                                               </div>
                                            </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                   <label>Dzimšanas Datums*</label>
                                                   <input id="datepicker" required type="text" placeholder="Atlasiet Dzimšanas Datums" name="dob" class="form-control" value="@if(isset($patient)){{date('m/d/Y', strtotime($patient->dob))}}@else{{ old('dob') }}@endif">
                                                   </div>
                                                  
                                               </div>

                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label>Epasta Adrese</label>
                                                       <input required type="text" placeholder="Ievadiet Epasta Adrese" name="email" class="form-control" value="@if(isset($patient)){{ $patient->email }}@else{{ old('email') }}@endif">
                                                   </div>
                                               </div>
                                               
                                           </div>


                                              
                                          <div class="row">
                                            <div class="col-md-6">
                                             <div class="form-group">
                                                      <label>Telefona Numurs*</label>
                                                      <input required type="text" placeholder="Ievadiet Telefona Numurs" name="phonenumber" class="form-control" value="@if(isset($patient)){{ $patient->phone }}@else{{ old('phonenumber') }}@endif"  >
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                   <label>Dzimums*</label>
                                                   <select required class="form-control" name="gender">
                                                        <option value="">Izvēlieties dzimumu</option>
                                                        @if(!isset($patient))
                                                        <option {{ old('gender')=='Male' ? 'selected="selected"' : '' }} value="Male">Vīrietis</option>
                                                        <option {{ old('gender')=='Female' ? 'selected="selected"' : '' }} value="Female">Sieviete</option>
                                                        <option {{ old('gender')=='Other' ? 'selected="selected"' : '' }} value="Other">Cits</option>
                                                        @else
                                                        <option {{ $patient->gender=='Male' ? 'selected="selected"' : '' }} value="Male">Vīrietis</option>
                                                        <option {{ $patient->gender=='Female' ? 'selected="selected"' : '' }} value="Female">Sieviete</option>
                                                        <option {{ $patient->gender=='Other' ? 'selected="selected"' : '' }} value="Other">Cits</option>
                                                        @endif
                                                        
                                                    </select>
                                              </div>
                                              </div>
                                           </div>

                                   
                                   <hr>
                                   <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                           @if(isset($patient))
                                            <input type="hidden" name="patientid" value="{{ $patient->id }}">
                                           @endif
                                           <button name="submit" type="submit" class="btn btn-fill btn-primary btn-block">@if(!isset($patient)) Iesniegt @else Atjaunināt @endif</button>
                                          </div>
                                      </div>
                                   </div>     
                                </form>
                            </div>
                        </div> <!-- end card -->

                    </div> <!--  end col-md-6  -->
                </div> <!-- end row -->
  @endsection
  @section('js')
  <script>
     $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2015",
            altFormat: "yy-mm-dd",
            altField: "#savedate"
        });
    });
   </script>
  @endsection