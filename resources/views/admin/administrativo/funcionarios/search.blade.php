@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'))}}">
@endsection
@section('content')
    @if(session()->exists('messageInfo'))
        @component('admin.components.message',['type' => session()->get('messageInfo')])
            {{session()->get('messageInfo')}}
        @endcomponent
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray">
                <div class="card-header">
                    <h4>Pesquisar funcionario</h4>
                </div>
                <div class="card-body" style="background-color: lightslategray">
                    <table id="employees_data" class="table table-bordered table-hover" style="background-color: darkgrey">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CPF</th>
                                <th>Estado</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Celular</th>
                                <th>Salario</th>
                                <th>Data de contratação</th>
                                <th>Função</th>
                                <th>Unidade</th>
                                <th>Editar/Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td><b>{{$employee->name}}</b></td>
                                    <td><b>{{$employee->document_primary}}</b></td>
                                    <td><b>{{$employee->state}}</b></td>
                                    <td><b>{{$employee->city}}</b></td>
                                    <td><b>{{$employee->neighborhood}}</b></td>
                                    <td><b>{{$employee->celphone}}</b></td>
                                    <td><b>{{$employee->salary}}</b></td>
                                    <td><b>{{$employee->contract_date}}</b></td>
                                    <td><b>{{$employee->occupationRelation()->first()->name}}</b></td>
                                    <td><b>{{$employee->unityRelation()->first()->name}}</b></td>
                                    <td><a class="btn btn-block bg-gradient-info btn-sm" href="{{route('source.employees.edit',['employee' => $employee->id])}}">Editar/Detalhes</a> <a class="btn btn-block bg-gradient-danger btn-sm" href="{{route('source.employees.delete',['employee' => $employee->id])}}">Demitir</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{url(asset('front/assets/plugins/datatables/jquery.dataTables.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'))}}"></script>

    <script type="module">
        import {DataTable} from './../front/assets/scripts/DataTable.js';
        new DataTable('#employees_data')
    </script>
@endsection