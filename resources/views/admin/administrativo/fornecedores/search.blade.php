@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'))}}">
@endsection
@section('content')
    @include('admin.includes.errors')
    @if(session()->exists('messageInfo'))
        @component('admin.components.message',['type' => session()->get('messageInfo')])
            {{session()->get('messageInfo')}}
        @endcomponent
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray">
                <div class="card-header">
                    <h4>Pesquisar fornecedores</h4>
                </div>

                <div class="card-body" style="background-color: lightslategray">
                    <table id="companies_data" class="table table-bordered table-hover" style="background-color: darkgrey">
                        <thead>
                            <tr>
                                <th>Nome fantasia</th>
                                <th>Razão social</th>
                                <th>CPF/CNPJ</th>
                                <th>Contato</th>
                                <th>Detalhes/Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td><b>{{$company->fantasy_name}}</b></td>
                                <td><b>{{$company->company_name}}</b></td>
                                @if($company->physic_person == 1 )
                                    <td><b>{{$company->document_primary}}</b></td>
                                 @else
                                    <td><b>{{$company->document_company_identification}}</b></td>
                                @endif
                                <td><b>{{$company->contact_one}}</b></td>
                                <td><a class="btn btn-block bg-gradient-info btn-sm" href="{{route('source.companies.edit',['company' => $company->id])}}">Editar/Detalhes</a> <a class="btn btn-block bg-gradient-danger btn-sm" href="{{route('source.companies.delete',['company' => $company->id])}}">Excluir</a></td>
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
        new DataTable('#companies_data');
    </script>
@endsection
