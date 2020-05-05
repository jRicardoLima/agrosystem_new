@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/select2/css/select2.min.css'))}}">
@endsection
@section('content')
    <div class="">
        <div class="card card-gray">
            @include('admin.includes.errors')

            @if(session()->exists('messageInfo'))
                @component('admin.components.message',['type' => session()->get('messageInfo')])
                    {{session()->get('messageInfo')}}
                @endcomponent
            @endif
            <div class="card-header">
                <h4>Usuario</h4>
            </div>
            <div class="card-body" style="background-color: lightslategray">
                <form action="{{route('source.users.store')}}" method="POST"  enctype="multipart/form-data" id="formCadUserSystem" >
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control input-sm {{(!empty($errors->messages()['name'])? MessagesInputs::isInvalid($errors->messages()['name']) : '')}}" value="{{old('name')}}">
                            </div>

                            <div class="col-md-6">
                                <label for="name_user">Nome de usuário</label>
                                <input type="text" name="name_user" id="name_user" class="form-control input-sm {{(!empty($errors->messages()['name_user'])? MessagesInputs::isInvalid($errors->messages()['name_user']) : '')}}" value="{{old('name_user')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="document_primary">CPF</label>
                                <input type="text" name="document_primary" id="document_primary" class="form-control input-sm {{(!empty($errors->messages()['document_primary'])? MessagesInputs::isInvalid($errors->messages()['document_primary']) : '')}}" value="{{old('document_primary')}}">
                            </div>

                            <div class="col-md-6">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control input-sm {{(!empty($errors->messages()['password'])? MessagesInputs::isInvalid($errors->messages()['password']) : '')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="occupation_id" class="form-control select2" style="width: 100%;">
                                    <option value="0" >Selecione a função</option>
                                    @foreach($occupations as $occupation)
                                        <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6">
                                <select name="unity_id" class="form-control select2" style="width: 100%;">
                                    <option value="0" >Selecione a unidade</option>
                                    @foreach($unities as $unity)
                                        <option value="{{$unity->id}}" {{(old($unity->name) == $unity->name ? 'selected' : '')}}>{{$unity->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="avatar_user">Foto do usuário</label>
                                <input type="file" name="avatar" class="form-control {{(!empty($errors->messages()['avatar'])? MessagesInputs::isInvalid($errors->messages()['avatar']) : '')}}" id="avatar_user">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block bg-gradient-success">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/jquery-mask/src/jquery.mask.js'))}}"></script>
    <script type="module">
        import {SelectTwo} from './../front/assets/scripts/SelectTwo.js';
        import {Mask} from './../front/assets/scripts/Mask.js';

        new SelectTwo(null,'.select2');
        new Mask('#document_primary',null,'000.000.000-00');
    </script>
@endsection
