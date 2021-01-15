{{--@extends('layouts.master')--}}

{{--@section('title')--}}
{{--Vizītes--}}
{{--@endsection--}}

{{--@section('style')--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-8">--}}

{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                Vizītes--}}
{{--                            </div><hr>--}}
{{--                            <div class="content">--}}
{{--                                @if(Session::has('success'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                  {{ Session::get('success') }}--}}
{{--                                </div>--}}
{{--                                @elseif(Session::has('danger'))--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                  {{ Session::get('danger') }}--}}
{{--                                </div>--}}
{{--                                @endif--}}

{{--                                @if ($errors->any())--}}
{{--                                       <div class="alert alert-danger">--}}
{{--                                        {{ implode('\n', $errors->all(':message')) }}--}}
{{--                                       </div>--}}
{{--                                @endif--}}
{{--                               <form method="post" action="{{route('addappointment')}}">--}}
{{--                                  {{csrf_field()}}--}}
{{--                                  <div class="row">--}}
{{--                                  <div class="col-md-12">--}}
{{--                                      <div class="form-group">--}}
{{--                                       <label for="">Atlasiet Klientu</label>--}}
{{--                                        <select required name="patientid" id="" class="selectjs form-control">--}}
{{--                                            <option></option>--}}
{{--                                            @foreach($patients as $patient)--}}
{{--                                            <option value="{{$patient->id}}">{{$patient->firstname.' '.$patient->lastname.' |  '.$patient->phone.' | '.$patient->email}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                   </div>--}}
{{--                                  </div>--}}
{{--                                   </div>--}}
{{--                                   <div class="row">--}}
{{--                                   <div class="col-md-12">--}}
{{--                                       <div class="form-group">--}}
{{--                                       <label for="">Atlasiet Procedūru</label>--}}
{{--                                       <select required name="diagnosisid" class="selectjsdiagnosis form-control">--}}
{{--                                            <option></option>--}}
{{--                                            @foreach($diagnosis as $d)--}}
{{--                                            <option value="{{$d->id}}">{{ucwords($d->name)}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                                   <div class="row">--}}
{{--                                   <div class="col-md-12">--}}
{{--                                       <div class="form-group">--}}
{{--                                       <label for="">Atlasiet Meistare</label>--}}
{{--                                       <select required name="doctorid" class="selectjsd form-control">--}}
{{--                                            <option></option>--}}
{{--                                            @foreach($doctors as $doctor)--}}
{{--                                            <option value="{{$doctor->id}}">{{$doctor->firstname.' '.$doctor->lastname.' | '.$doctor->email}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                                   <div class="row">--}}
{{--                                   <div class="col-md-12">--}}
{{--                                       <div class="form-group">--}}
{{--                                           <label for="">Atlasiet Datumu</label>--}}
{{--                                           <input required type="text" name="date" class="form-control datepicker" placeholder="Select Date">--}}
{{--                                       </div>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                                   <div class="row">--}}
{{--                                   <div class="col-md-12">--}}
{{--                                       <div class="form-group">--}}
{{--                                           <label for="">Select Time</label>--}}
{{--                                           <input required type="text" name="time" class="form-control timepicker" placeholder="Select Date">--}}
{{--                                       </div>--}}
{{--                                   </div>--}}
{{--                                   </div><hr>--}}
{{--                                   <div class="row">--}}
{{--                                   <div class="col-md-12">--}}
{{--                                       <div class="form-group">--}}
{{--                                           <input type="submit" class="btn btn-primary btn-fill btn-block">--}}
{{--                                       </div>--}}
{{--                                   </div>--}}
{{--                                   </div>--}}
{{--                               </form>--}}
{{--                               </div>--}}
{{--                            </div>--}}
{{--                        </div> --}}
{{--                    </div> --}}
{{--@endsection--}}
{{--@section('js')--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function(){--}}
{{--        $('.selectjs').select2({--}}
{{--        placeholder: "Ierakstiet vārdu vai uzvārdu",--}}
{{--        ajax: {--}}
{{--            url: '<?php echo e(route('ajaxpatients')); ?>',--}}
{{--            dataType: 'json',--}}
{{--            type: 'GET',--}}
{{--            delay: 250,--}}
{{--            data: function (params) {--}}
{{--              return {--}}
{{--                q: params.term, // search term--}}
{{--              };--}}
{{--            },--}}
{{--            processResults: function (data) {--}}
{{--            // parse the results into the format expected by Select2.--}}
{{--            // since we are using custom formatting functions we do not need to--}}
{{--            // alter the remote JSON data--}}
{{--            return {--}}
{{--                results: data--}}
{{--            };--}}
{{--        },--}}
{{--            cache: true--}}
{{--        },--}}

{{--        minimumInputLength: 2--}}
{{--    });--}}

{{--        $('.selectjs').select2({--}}
{{--          placeholder: 'Meklēt klientu pēc vārda, tālruņa vai e-pasta adreses',--}}
{{--        });--}}

{{--        $('.selectjsd').select2({--}}
{{--          placeholder: 'Meklēt meistaru pēc vārda vai e-pasta adreses',--}}
{{--        });--}}

{{--        $('.selectjsdiagnosis').select2({--}}
{{--          placeholder: 'Meklēt procedūru',--}}
{{--        });--}}

{{--                $('.datetimepicker').datetimepicker({--}}
{{--                    icons: {--}}
{{--                        time: "fa fa-clock-o",--}}
{{--                        date: "fa fa-calendar",--}}
{{--                        up: "fa fa-chevron-up",--}}
{{--                        down: "fa fa-chevron-down",--}}
{{--                        previous: 'fa fa-chevron-left',--}}
{{--                        next: 'fa fa-chevron-right',--}}
{{--                        today: 'fa fa-screenshot',--}}
{{--                        clear: 'fa fa-trash',--}}
{{--                        close: 'fa fa-remove'--}}
{{--                    }--}}
{{--                });--}}

{{--                $('.datepicker').datetimepicker({--}}
{{--                    format: 'YYYY-MM-DD',--}}
{{--                    icons: {--}}
{{--                        time: "fa fa-clock-o",--}}
{{--                        date: "fa fa-calendar",--}}
{{--                        up: "fa fa-chevron-up",--}}
{{--                        down: "fa fa-chevron-down",--}}
{{--                        previous: 'fa fa-chevron-left',--}}
{{--                        next: 'fa fa-chevron-right',--}}
{{--                        today: 'fa fa-screenshot',--}}
{{--                        clear: 'fa fa-trash',--}}
{{--                        close: 'fa fa-remove'--}}
{{--                    }--}}
{{--                });--}}

{{--                $('.timepicker').datetimepicker({--}}
{{--                    //          format: 'H:mm',    // use this format if you want the 24hours timepicker--}}
{{--                    format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle--}}
{{--                    icons: {--}}
{{--                        time: "fa fa-clock-o",--}}
{{--                        date: "fa fa-calendar",--}}
{{--                        up: "fa fa-chevron-up",--}}
{{--                        down: "fa fa-chevron-down",--}}
{{--                        previous: 'fa fa-chevron-left',--}}
{{--                        next: 'fa fa-chevron-right',--}}
{{--                        today: 'fa fa-screenshot',--}}
{{--                        clear: 'fa fa-trash',--}}
{{--                        close: 'fa fa-remove'--}}
{{--                    }--}}
{{--                });--}}
{{--    });--}}

{{--</script>--}}
{{--@endsection--}}