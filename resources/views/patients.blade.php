@extends('layouts.master')
@section('title') Visie Klienti @endsection
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
                                <h4 class="title">Visie Klienti <b>({{count($patients)}})</b></h4>
                            </div><hr>
                            <div class="content ">
                            <form method='get'>
                            <div class='row'>
                            	<div class='col-md-6'>
                            	<div class='form-group'>
                            	<input class='form-control' type='text' name='q' placeholder='Ievadiet Klienta Vārds, lai sākt meklēt' value='@isset($q){{$q}}@endisset'/>
                            	</div>
                            	</div>
                            	<div class='col-md-6'>
                            	<div class='form-group'>
                            		<input class='btn btn-primary btn-fill' type='submit' value='Meklēt'/>
                            	</div>
                            	</div>
                            </div>
                            </form>
                               <table id="" class="table table-hover table-striped">
                                    <thead>
                                        <th>Vārds</th>
                                    	<th>Dzimšanas Datums</th>
                                    	<th>Vecums</th>
                                    	<th>Darbība</th>
                                    </thead>
                                    <tbody>
                                       @foreach($patients as $patient)
                                         <tr>
                                             <td>{{ ucfirst($patient['firstname']) }} {{ ucfirst($patient['lastname']) }}</td>
                                             <td>{{ $patient['dob'] }}</td>
                                             <td>{{ date_diff(date_create($patient['dob']), date_create('today'))->y }} Years</td>
                                             <td>
                                             
                                             <a href="{{route('patientdetails', $patient['id'])}}" class="btn btn-success btn-xs btn-fill"><i class="fa fa-info"></i>Vairāk Info</a>
                                             <a href="{{route('patienteditview', $patient['id'])}}" class="btn btn-primary btn-xs btn-fill"><i class="fa fa-pencil"></i>Rediģēt Profilu</a>
                                             @if(Auth::user()->role=='superadmin')
                                             <a onclick="return confirm('Vai tiešām vēlaties dzēst šo klientu?');" href="{{route('removepatient', $patient['id'])}}" class="btn btn-danger btn-xs btn-fill"><i class="fa fa-trash"></i>Dzēst</a>
                                             @endif
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class='pull-right'>
                                {{$patients->links()}}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('js')
<script>
        $(document).ready(function(){
            $('#table').DataTable({ "oLanguage": { "sSearch": "" } });
        });
        $(document).ready(function(){
         $('.dataTables_filter input').addClass('form-control');
         $('.dataTables_filter input').css('width','400px');
         $('.dataTables_filter input').attr('placeholder', 'Search');
        });
</script>
@endsection