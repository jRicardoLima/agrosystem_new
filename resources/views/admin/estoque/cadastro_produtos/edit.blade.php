@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/select2/css/select2.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'))}}">
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
                <li class="pt-1 px-3"><h3>Editar produto</h3></li>

                <li class="nav-item">
                    <a class="nav-link" id="tab_product_information" data-toggle="pill"
                       href="#product_information" role="tab" aria-controls="product_information"
                       aria-selected="true">Informações</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="tab_add_companies" data-toggle="pill"
                       href="#add_companies" role="tab" aria-controls="add_companies" aria-selected="false">Adicionar fornecedor</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="tab_remove_companies" data-toggle="pill"
                        href="#remove_companies" role="tab" aria-controls="remove_companies" aria-selected="false">Remover fornecedor</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background-color: lightslategray">
            <div  class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="product_information" role="tabpanel" aria-labelledby="product_information">
                    <form action="{{route('source.products.update',['product' => $product->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nome</label>
                                    <input name="name" id="name" class="form-control input-sm
                                           {{(!empty($errors->messages()['name'])? MessagesInputs::isInvalid($errors->messages()['name']) : '')}}"
                                           value="{{old('name') ?? $product->name}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="type">Tipo</label>
                                    <select name="type" id="type" class="form-control select2">
                                        <option value="pct" {{(old('type') == 'pct' ? 'selected' : ($product->type == 'pct' ? 'selected': ''))}}>Pacote</option>
                                        <option value="cx" {{(old('type') == 'cx' ? 'selected' : ($product->type == 'cx' ? 'selected': ''))}}>Caixa</option>
                                        <option value="un" {{(old('type') == 'un' ? 'selected' : ($product->type == 'un' ? 'selected': ''))}}>Unidade</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="minimum_quantity">Quantidade minima</label>
                                    <input name="minimum_quantity" id="minimum_quantity" class="form-control input-sm
                                           {{(!empty($errors->messages()['minimum_quantity'])? MessagesInputs::isInvalid($errors->messages()['minimum_quantity']) : '')}}"
                                           value="{{old('minimum_quantity') ?? $product->minimum_quantity}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="add_companies" role="tabpanel" aria-labelledby="add_companies">
                    <form action="{{route('source.products.add-company',['product'=> $product->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                   <label for="company">Fornecedores</label>
                                    <select name="companies[]" id="company" class="form-control companies" multiple="multiple" disabled>
                                        @foreach($companies as $company)
                                            @foreach($company->companiesProductsRelation()->get() as $item)
                                                @if($item->pivot->products_id == $product->id)
                                                    <option value="{{$company->id}}" selected>{{$company->fantasy_name}}</option>
                                                @endif
                                            @endforeach

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="aviable_companies">Fornecedores disponiveis</label>
                                    <select name="aviable_companies[]" id="aviable_companies" class="form-control" multiple="multiple">
                                        @if($companiesAviable != null)
                                            @foreach($companiesAviable as $company)
                                                <option value="{{$company->get('id')}}">{{$company->get('name')}}</option>
                                            @endforeach

                                        @else
                                            <option>Não há fornecedores disponiveis</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="remove_companies" role="tabpanel" aria-labelledby="remove_companies">
                    <form action="{{route('source.products.delete-supplier',['product' => $product->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="company_remove">Fornecedores(<i>Deixe somente o fornecedor que sera removido</i>>)</label>
                                    <select name="companies[]" id="company_remove" class="form-control companies" multiple="multiple">
                                        @foreach($companies as $company)
                                            @foreach($company->companiesProductsRelation()->get() as $item)
                                                @if($item->pivot->products_id == $product->id)
                                                    <option value="{{$company->id}}" selected>{{$company->fantasy_name}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Excluir</button>
                            </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'))}}"></script>

    <script type="module">
        import {SelectTwo} from './../../front/assets/scripts/SelectTwo.js';

        new SelectTwo(null,'.select2');
        new SelectTwo(null,'.companies');
        new SelectTwo('#aviable_companies',null);
    </script>
@endsection