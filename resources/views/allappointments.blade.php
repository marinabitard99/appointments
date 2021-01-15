<?php use App\Http\Controllers\HomeController; ?>
@extends('layouts.master')
@section('title')
Meistare: {{$doctor->firstname.' '.$doctor->lastname}} - Visi Vizītes
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.css" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="card">
            <div class="header">
                <h4 class="title">
                    Meistare: <b>{{$doctor->firstname.' '.$doctor->lastname}}</b> - Visas Pieejamās Vizītes
                    <br><a href="{{route('doctors')}}" class="btn btn-xs btn-fill btn-primary">Atpakaļ</a> <a href="#table" class="btn btn-xs btn-fill btn-primary">Paradīt Visas Vizītes</a>
                </h4>
            </div>
            <hr>
            <div class="content ">
                <?php
                    if(request()->has('date') && !empty(request()->date)){ 
                        $date = request()->date;
                    }else{ 
                        $date = date('Y-m-d'); 
                    }
                    $slots = HomeController::getSlots(); 
                    $bookedslots = HomeController::getBookedSlots($doctor->id, $date);
                    $count = 0;
                 ?>
                <table id="" class="table table-hover table-bordered">
                    <thead>
                        <th colspan="1">
                            <p style="color:black"><b>Datums: {{date('F d, Y', strtotime($date))}}</b></p>
                        </th>
                        <th colspan="2">
                            <input type="text" class="datepicker form-control" placeholder="Atlasiet Vizītes Datumu"></th>
                        <th colspan="3">
                            @if(request()->has('date'))
                            <a href="{{route('doctorappointments', ['id'=>$doctor->id])}}" class="btn btn-fill btn-primary">Šodien</a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($slots as $slot)
                            @if(in_array($slot, $bookedslots))
                            <td>{{$slot}}<button title="{{HomeController::getAppointmentInfo($date, $doctor->id, $slot)}}" class="tooltips btn btn-fill btn-xs btn-danger pull-right"><i class="fa fa-info"></i>Rezervēts</button></td>
                            @else
                            <td>{{$slot}}<button href="" data-time="{{$slot}}" class="book btn btn-fill btn-xs btn-success pull-right">Rezervēt</button></td>
                            @endif
                            <?php $count++; if($count==6){ echo "</tr><tr>"; $count=0; } ?>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                Visi Vizītes <b>{{date('F d, Y', strtotime($date))}}</b> Meisteram: <b>{{$doctor->firstname.' '.$doctor->lastname}}</b>
            </div>
            <hr>
            <div class="content ">
                <table id="table" class="table table-hover table-striped">
                    <thead>
                        <th>Klients</th>
                        <th>Procedūra</th>
                        <th>Laiks</th>
                        <th>Datums</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($appointments as $ap)
                        <tr>
                            <td>{{ HomeController::getPName($ap->patientid) }}</td>
                            <td>{{ HomeController::getDiagName($ap->diagnosis) }}</td>
                            <td>{{date('g:ia', strtotime($ap->time))}}</td>
                            <td>{{date('F d, Y', strtotime($ap->date))}}</td>
                            <td>
                                @if(Auth::user()->role=='superadmin')
                                <a href="{{route('editappointment', ['id' => $ap->id, 'doctorid'=>$doctor->id])}}" class="btn btn-primary btn-xs btn-fill"><i class="fa fa-pencil"></i>Rediģēt</a>
                                <a onclick="return confirm('Vai tiešām vēlaties dzēst šo vizīte?');" href="{{route('removeappointment', ['id' => $ap->id])}}" class="btn btn-danger btn-xs btn-fill"><i class="fa fa-trash"></i>Izdzēst</a>
                                @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="booking" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rezervēšana: <span id="time"></span> {{date('F d, Y', strtotime($date))}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('addappointment')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Atlasiet Klientu</label>
                                <select style="width:100%;height:45px" required name="patientid" id="" class="selectjs form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Atlasiet Procedūru</label>
                                <select style="width:100%;height:45px" required name="diagnosisid" class="selectdiagnosis form-control">
                                    <option></option>
                                    @foreach($diagnosis as $d)
                                    <option value="{{$d->id}}">{{ucwords($d->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="doctorid" value="{{$doctor->id}}">
                            <input type="hidden" name="date" value="{{$date}}">
                            <input type="hidden" name="time" id="timeinput">
                            <input type="submit" class="btn btn-fill btn-block btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Aizvērt</button>
            </div>
        </div>
    </div>
</div>
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

    $('.selectdiagnosis').select2({
        placeholder: 'Meklēt procedūru',
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
            window.location.href = "{{route('doctorappointments', ['id'=>$doctor->id])}}?date=" + e.date.format('YYYY-MM-DD');
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

        $('.dataTables_filter input').attr('placeholder', 'Search');

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