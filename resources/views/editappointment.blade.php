<?php use App\Http\Controllers\HomeController;use Illuminate\Support\Facades\DB; ?>
@extends('layouts.master')

@section('title')
Rediģēt Vizīte
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.css" />
<style>
#timeslot option[value="booked"] {
  background: red;
  color: white;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="header">
                Rediģēt Vizīti: <b>{{date('F, d Y', strtotime($appointment->date))}} - {{date('h:ia', strtotime($appointment->time))}}</b>
                 <br><a href="{{route('doctorappointments', ['id'=>$appointment->doctorid])}}" class="btn btn-xs btn-primary btn-fill">Atpakaļ</a>
            </div>
            <hr>
            <div class="content">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                
                @if(Session::has('danger'))
                <div class="alert alert-danger">
                    {{ Session::get('danger') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all(':message')) !!}
                </div>
                @endif
                <form id="myform" method="post" action="{{route('updateappointment')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Atlasiet Klientu</label>
                                <select style="width:100%;height:45px" required name="patientid" id="" class="selectjs form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Atlasiet Procedūru</label>
                                <select style="width:100%;height:45px" required name="diagnosisid" class="selectdiagnosis form-control">
                                    <option></option>
                                    @foreach($diagnosis as $d)
                                    <option @if($appointment->diagnosis==$d->id) selected @endif  value="{{$d->id}}">{{ucwords($d->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Atlasiet Rezervēšanas Datumu</label>
                                <input type="text" class="datepicker form-control" name="date" placeholder="Atlasiet Datumu Rezervēšanai" value="{{$appointment->date}}">
                            </div>
                        </div>
                    </div>
                    <?php
                    $slots = HomeController::getSlots();
                    $appointment = DB::table('appointments');
                    $bookedslots = HomeController::getBookedSlots($appointment->doctorid, $appointment->date);
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Select Time Slot</label>
                                <select name="time" class="form-control" id="timeslot">
                                    @foreach($slots as $slot)
                                      
                                        @if(in_array($slot, $bookedslots))
                                            @if($slot==date('g:ia', strtotime($appointment->time)))
                                            <option selected value="{{$slot}}">{{$slot}} </option>
                                            @else
                                            <option disabled value="booked">{{$slot}} - Rezervēts</option>
                                            @endif
                                        @else
                                          <option value="{{$slot}}">{{$slot}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="appointmentid" value="{{ $appointment->id }}">
                                <input type="hidden" name="doctorid" value="{{ $appointment->doctorid }}">
                                <button name="submit" type="submit" class="btn btn-fill btn-primary btn-block"> Atjaunināt</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.js"></script>
<script>
    $(document).ready(function() {

        $('.selectjs').select2({
            placeholder: "Ierakstiet vārdu vai uzvārdu",
            ajax: {
                url: '{{route('ajaxPatients')}}',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function(data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },

            minimumInputLength: 2
        });

    });
    
    var option = new Option("{{$patient->firstname.' '.$patient->lastname.' | '.$patient->phone.' | '.$patient->email}}", "{{$patient->id}}");
    $(".selectjs").append(option);

    $('.selectdiagnosis').select2({
        placeholder: 'Meklēt Procedūru',
    });

    $(".book").click(function(e) {
        e.preventDefault();
        $("#time").html($(this).attr('data-time'));
        $("#timeinput").val($(this).attr('data-time'));
        $("#booking").modal('show');
    });

    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });


    var count = 0;
    $(".datepicker").on("dp.change", function(e) {
        if (count != 0) {
            window.location.href = "{{route('doctorappointments', ['id'=>$appointment->doctorid])}}?date=" + e.date.format('YYYY-MM-DD');
        } else {
            count++;
        }
    });


    $(document).ready(function() {

        $('#table').DataTable({
            "oLanguage": {
                "sSearch": ""
            }
        });

    });

    $(document).ready(function() {

        $('.dataTables_filter input').addClass('form-control');

        $('.dataTables_filter input').css('width', '400px');

        $('.dataTables_filter input').attr('placeholder', 'Meklēt');

    });

    $(document).ready(function() {
        $('.tooltips').tooltipster({
            delay: 10,
            contentAsHTML: true,

            trigger: 'hover',
        });
    });
</script>
@endsection