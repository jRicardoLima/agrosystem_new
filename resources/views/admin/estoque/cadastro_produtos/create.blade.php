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
           <h3>Cadastro de produtos</h3>
        </div>
        <div class="card-body" style="background-color: lightslategray">
            <form action="{{route('source.products.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="name">Nome</label>
                            <input name="name" id="name" class="form-control input-sm
                              {{(!empty($errors->messages()['name'])? MessagesInputs::isInvalid($errors->messages()['name']) : '')}}"
                              value="{{old('name')}}">
                        </div>

                        <div class="col-md-2">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control select2">
                                <option value="pct" {{(old('type') == 'pct' ? 'selected' : '')}}>Pacote</option>
                                <option value="cx" {{(old('type') == 'cx' ? 'selected' : '')}}>Caixa</option>
                                <option value="un" {{(old('type') == 'un' ? 'selected' : '')}}>Unidade</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="minimum_quantity">Quantidade minima</label>
                            <input name="minimum_quantity" id="minimum_quantity" class="form-control input-sm
                              {{(!empty($errors->messages()['minimum_quantity'])? MessagesInputs::isInvalid($errors->messages()['minimum_quantity']) : '')}}"
                                   value="{{old('minimum_quantity')}}">
                        </div>
                        <div class="col-md-5">
                            <label for="companies">Fornecedores</label>
                            <select name="companies[]" class="form-control companies" multiple="multiple">
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->fantasy_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 py-4">
                        <button type="submit" class="btn btn-block bg-gradient-success">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'))}}"></script>

    <script type="module">
        import {SelectTwo} from './../front/assets/scripts/SelectTwo.js';

        new SelectTwo(null,'.select2');
        new SelectTwo(null,'.companies');
    </script>
@endsection
