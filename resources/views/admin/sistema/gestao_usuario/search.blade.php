@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'))}}">
@endsection
@section('content')
    <div class="">
        @if(session()->exists('messageInfo'))
            @component('admin.components.message',['type' => session()->get('messageInfo')])
                {{session()->get('messageInfo')}}
            @endcomponent
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <h4>Pesquisar usuário</h4>
                    </div>

                    <div class="card-body" style="background-color: lightslategray">
                        <table id="userData" class="table table-bordered table-hover" style="background-color: darkgrey">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nome de usuário</th>
                                <th>Função</th>
                                <th>Unidade</th>
                                <th>Editar\Excluir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><b>{{$user->name}}</b></td>
                                    <td><b>{{$user->name_user}}</b></td>
                                    <td><b>{{$user->occupationRelation()->first()->name}}</b></td>
                                    <td><b>{{$user->unityRelation()->first()->name}}</b></td>
                                    <td><a class="btn btn-block bg-gradient-info btn-sm" href="{{route('source.users.edit',['user' => $user->id])}}">Editar/Detalhes</a> <a class="btn btn-block bg-gradient-danger btn-sm" href="{{route('source.users.delete',['user' => $user->id])}}">Excluir</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
        new DataTable('#userData')
    </script>
@endsection
