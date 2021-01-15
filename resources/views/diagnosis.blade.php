@extends('layouts.master')

@section('title') {{isset($editdiagnosis)?'Edit: '.$editdiagnosis->name.' - Procedūra':'Procedūra'}} @endsection

@section('content')

<div class="row">
                   @if(Session::has('success'))
                                <div class="alert alert-success">
                                  {{ Session::get('success') }}
                                </div>
                                @endif
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{isset($editdiagnosis)?'Edit: '.$editdiagnosis->name.' - Procedūra':'Pievienot Jaunu Procedūru'}}
                                @isset($editdiagnosis)
                                    <br>
                                    <a href="{{route('diagnosis')}}" class="btn btn-primary btn-xs btn-fill">Pievienot Jaunu Procedūru</a>
                                @endisset
                                </h4>
                            </div><hr>
                            <div class="content">
                                

                                @if ($errors->any())
                                        <div class="alert alert-danger">
                                         {!! implode('<br>', $errors->all(':message')) !!}
                                        </div>
                                @endif
                                <form method="post" action="@if(isset($editdiagnosis)){{route('updatediagnosis')}}@else {{route('adddiagnosis')}} @endif">
                                       {{ csrf_field() }}
                                       <div class="row">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <label>Procedūra</label>
                                                <input required name="diagnosis" type="text" class="form-control" placeholder="Ievadīt Procedūru" value="@isset($editdiagnosis){{$editdiagnosis->name}}@endisset">
                                            </div>
                                        </div>
                                        </div>
                                        @isset($editdiagnosis)
                                            <input type="hidden" value="{{$editdiagnosis->id}}" name="diagnosisid">
                                        @endisset
                                    
                                    <button name="update" type="submit" class="btn btn-primary btn-fill pull-right">Apstiprināt</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Visu Procedūru Saraksts</h4><hr>
                            </div>
                            <div class="content">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        
                                    	<th>Nosaukums</th>
                                    	<th>Darbība</th>
                                    </thead>
                                    <tbody>
                                       @foreach($diagnosis as $d)
                                         <tr>
                                            
                                             <td>{{ $d->name }}</td>
                                             <td><a href="{{route('showeditdiagnosis', ['id'=>$d->id])}}" class="btn btn-xs btn-fill btn-success"><i class="fa fa-pencil"></i>Rediģēt</a>
                                             @if(Auth::user()->role=='superadmin')
                                             <a onclick="return confirm('Vai tiešām vēlaties dzēst šo procedūru?');"  href="{{route('removediagnosis', ['id' => $d->id])}}" class="btn btn-danger btn-xs btn-fill"><i class="fa fa-trash"></i>Dzēst</a>
                                             @endif
                                             </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection