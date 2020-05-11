@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'))}}">
@endsection
@section('content')

    <div class="card card-gray">
        <div class="card-header">
            <ul class="nav nav-tabs" id="card_navigation" role="tablist">
                <li class="pt-1 px-3"><h3>Estoque</h3></li>
                <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link" id="tab_stock" data-toggle="pill"
                       href="#stock" role="tab" aria-controls="stock"
                       aria-selected="true">Lista de produtos</a>
                </li>
                </li>
            </ul>
        </div>

        <div class="card-body" style="background-color: lightslategray">
            <div class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="stock" role="tabpanel" aria-labelledby="stock">
                    <table id="stock_table" class="table table-bordered table-hover" style="background-color: darkgrey">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Quantidade minima</th>
                                <th>Quantidade em estoque</th>
                                <th>Data de entrada</th>
                                <th>Data da ultima saida</th>
                                <th>Fornecedores</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><b>{{$product['nameProduct']}}</b></td>
                                    <td><b>{{$product['type']}}</b></td>
                                    <td><b>{{$product['minimum_quantity']}}</b></td>
                                    <td><b>{{$product['current_quantity']}}</b></td>
                                    <td><b>{{$product['last_entry']}}</b></td>
                                    @if($product['last_output'] != null)
                                        <td><b>{{$product['last_output']}}</b></td>
                                    @else
                                        <td><b>Não Hove saida deste produto</b></td>
                                    @endif
                                    <td><a class="btn btn-block bg-gradient-info btn-sm showCompanies" href="{{route('source.products.show-companies',['product' => $product['id']])}}">Ver fornecedores</a></td>
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

        new DataTable('#stock_table');
        new ShowCompanies('showCompanies');

    </script>
@endsection
