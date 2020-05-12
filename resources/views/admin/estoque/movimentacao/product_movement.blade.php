@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/select2/css/select2.min.css'))}}">
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
                <li class="pt-1 px-3"><h3>Movimentação de produtos</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_product_entry" data-toggle="pill"
                       href="#product_entry" role="tab" aria-controls="product_entry"
                       aria-selected="true">Entrada</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_output_products" data-toggle="pill"
                       href="#output_products" role="tab" aria-controls="output_products"
                       aria-selected="false">Saida</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background-color: lightslategray">
            <div class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="product_entry" role="tabpanel" aria-labelledby="product_entry">
                    <form action="{{route('source.products.product-moviment-entry')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="products">Produto</label>
                                    <select name="products" id="products_entry" class="form-control">
                                        <option>Selecione um produto</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="minimum_quantity">Quantidade minima</label>
                                    <input type="text" name="minimum_quantity" id="minimum_quantity" class="form-control input-sm {{(!empty($errors->messages()['minimum_quantity'])? MessagesInputs::isInvalid($errors->messages()['minimum_quantity']) : '')}}" value="{{old('minimum_quantity')}}">
                                </div>


                                <div class="col-md-3">
                                    <label for="quantity">Quantidade de entrada</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control input-sm {{(!empty($errors->messages()['quantity'])? MessagesInputs::isInvalid($errors->messages()['quantity']) : '')}}" value="{{old('quantity')}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>DANFE(NFe)</label>
                                    <input type="file" name="invoice" id="invoice" class="form-control input-sm {{(!empty($errors->messages()['invoice'])? MessagesInputs::isInvalid($errors->messages()['invoice']) : '')}}" value="{{old('invoice')}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Chave de acesso</label>
                                    <input type="text" name="access_key" id="access_key" class="form-control input-sm {{(!empty($errors->messages()['access_key'])? MessagesInputs::isInvalid($errors->messages()['access_key']) : '')}}" value="{{old('access_key')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Entrada</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="output_products" role="tabpanel" aria-labelledby="output_products">
                    <form action="{{route('source.products.product-moviment-output')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="products">Produto</label>
                                    <select name="products" id="products_output" class="form-control">
                                        <option>Selecione um produto</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="minimum_quantity">Quantidade minima</label>
                                    <input type="text" name="minimum_quantity" id="minimum_quantity_output" class="form-control input-sm {{(!empty($errors->messages()['minimum_quantity'])? MessagesInputs::isInvalid($errors->messages()['minimum_quantity']) : '')}}" value="{{old('minimum_quantity')}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="quantity">Quantidade de saida</label>
                                    <input type="text" name="quantity" id="quantity_output" class="form-control input-sm {{(!empty($errors->messages()['quantity'])? MessagesInputs::isInvalid($errors->messages()['quantity']) : '')}}" value="{{old('quantity')}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="unity_id">Unidade</label>
                                   <select name="unity_id" id="unity_id" class="form-control">
                                       <option>Selecione uma unidade</option>
                                       @foreach($unities as $unity)
                                           <option value="{{$unity->id}}">{{$unity->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Saida</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/jquery-mask/src/jquery.mask.js'))}}"></script>
    <script type="module">
        import {SelectTwo} from './../front/assets/scripts/SelectTwo.js';
        import {GeneralFunction} from './../front/assets/scripts/GeneralFunction.js'

        new SelectTwo('#products',null);
        const generalFunction = new GeneralFunction();

        generalFunction.searchProductQuantityInformation('products_entry','minimum_quantity');
        generalFunction.searchProductQuantityInformation('products_output','minimum_quantity_output');

    </script>
@endsection
