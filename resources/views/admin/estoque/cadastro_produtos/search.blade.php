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

    <div class="card card-gray">
        <div class="card-header">
           <ul class="nav nav-tabs" id="card_navigation" role="tablist">
               <li class="pt-1 px-3"><h3>Produtos</h3></li>
               <li class="nav-item">
                   <a class="nav-link" id="tab_products_list" data-toggle="pill"
                      href="#products_list" role="tab" aria-controls="products_list"
                      aria-selected="true">Lista de produtos</a>
               </li>
           </ul>
        </div>

        <div class="card-body" style="background-color: lightslategray">
            <div class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="products_list" role="tabpanel" aria-labelledby="products_list">
                    <table id="products_list_data" class="table table-bordered table-hover" style="background-color: darkgrey">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Fornecedores</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr scope="row">
                                    <td><b>{{$product->name}}</b></td>
                                    <td><b>{{$product->type}}</b></td>
                                    <td><b><a class="btn btn-block bg-gradient-info btn-sm showCompanies" href="{{route('source.products.show-companies',['product' => $product->id])}}" identity="{{$product->id}}">Ver fornecedores</a></b></td>
                                    <td><b><a class="btn btn-block bg-gradient-danger btn-sm" href="javascript:void(0)" >Excluir</a></b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="loadModal"></div>
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
        import {ShowCompanies} from './../front/assets/scripts/ShowCompanies.js';
        new DataTable('#products_list_data');
        new ShowCompanies('showCompanies');
    </script>
@endsection
