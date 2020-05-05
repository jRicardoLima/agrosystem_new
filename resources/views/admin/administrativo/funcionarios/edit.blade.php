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
        <div class="card-header  p-0 pt-1">
            <ul class="nav nav-tabs" id="card_navigation" role="tablist">
                <li class="pt-1 px-3"><h3>Editar funcionario</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_employee_private_information" data-toggle="pill"
                       href="#employee_private_information" role="tab" aria-controls="employee_private_information"
                       aria-selected="true">Informações Pessoais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_employee_address_information" data-toggle="pill"
                       href="#employee_address_information" role="tab" aria-controls="employee_address_information"
                       aria-selected="false">Endereço</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_employee_job_information" data-toggle="pill"
                       href="#employee_job_information" role="tab" aria-controls="employee_job_information"
                       aria-selected="false">Informações do trabalho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_bank_data" data-toggle="pill" href="#bank_data" role="tab"
                       aria-controls="bank_data" aria-selected="false">Dados bancarios</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background-color: lightslategray">
            <form action="{{route('source.employees.update',['employee' => $employee->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="tab-content" id="content_tabs">
                    <div class="tab-pane fade show active" id="employee_private_information" role="tabpanel"
                         aria-labelledby="employee_private_information">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control input-sm {{(!empty($errors->messages()['name'])? MessagesInputs::isInvalid($errors->messages()['name']) : '')}}"
                                           value="{{old('name') ?? $employee->name}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="document_primary">CPF</label>
                                    <input type="text" name="document_primary" id="document_primary"
                                           class="form-control input-sm {{(!empty($errors->messages()['document_primary'])? MessagesInputs::isInvalid($errors->messages()['document_primary']) : '')}}"
                                           value="{{old('document_primary') ?? $employee->document_primary}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="document_secondary">RG</label>
                                    <input type="text" name="document_secondary" id="document_secondary"
                                           class="form-control input-sm {{(!empty($errors->messages()['document_secondary'])? MessagesInputs::isInvalid($errors->messages()['document_secondary']) : '')}}"
                                           value="{{old('document_secondary') ?? $employee->document_secondary}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="document_secondary_complement">Órgão emissor</label>
                                    <input type="text" name="document_secondary_complement"
                                           id="document_secondary_complement"
                                           class="form-control input-sm {{(!empty($errors->messages()['document_secondary_complement'])? MessagesInputs::isInvalid($errors->messages()['document_secondary_complement']) : '')}}"
                                           value="{{old('document_secondary_complement') ?? $employee->document_secondary_complement}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 py-2">
                                    <label>Casado</label>
                                    <select name="married" id="married" class="form-control select2">
                                        <option>-------------</option>
                                        <option value="1" {{old('married') == "1" ? 'selected' : ($employee->married == true ? 'selected' : '')}}>Sim</option>
                                        <option value="0" {{old('married') == "0" ? 'selected' : ($employee->married == false ? 'selected' : '')}}>Não</option>
                                    </select>
                                </div>
                                <div class="col-md-3  py-2">
                                    <label>Possui filhos</label>
                                    <select name="children" id="children" class="form-control select2">
                                        <option>-------------</option>
                                        <option value="1" {{old('children') == "1" ? 'selected' : ($employee->children == true ? 'selected' : '')}}>Sim</option>
                                        <option value="0" {{old('children') == "0" ? 'selected' : ($employee->children == false ? 'selected' : '')}}>Não</option>
                                    </select>
                                </div>
                                <div class="col-md-3 py-2">
                                    <label for="number_of_children">Quantos</label>
                                    <input type="text" name="number_of_children" id="number_of_children"
                                           class="form-control input-sm {{(!empty($errors->messages()['number_of_children'])? MessagesInputs::isInvalid($errors->messages()['number_of_children']) : '')}}"
                                           value="{{old('number_of_children') ?? $employee->number_of_children}}">
                                </div>
                                <div class="col-md-3 py-2">
                                    <label for="date_birth">Data de nascimento</label>
                                    <input type="text" name="date_birth" id="date_birth"
                                           class="form-control input-sm date {{(!empty($errors->messages()['date_birth'])? MessagesInputs::isInvalid($errors->messages()['date_birth']) : '')}}"
                                           value="{{old('date_birth') ?? $employee->date_birth}}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="employee_address_information" role="tabpanel"
                         aria-labelledby="employee_address_information">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="zipcode">CEP</label>
                                    <input type="text" name="zipcode" id="zipcode"
                                           class="form-control input-sm {{(!empty($errors->messages()['zipcode'])? MessagesInputs::isInvalid($errors->messages()['zipcode']) : '')}}"
                                           value="{{old('zipcode') ?? $employee->zipcode}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="state">Estado</label>
                                    <input type="text" name="state" id="state"
                                           class="form-control input-sm {{(!empty($errors->messages()['state'])? MessagesInputs::isInvalid($errors->messages()['state']) : '')}}"
                                           value="{{old('state') ?? $employee->state }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="city">Cidade</label>
                                    <input type="text" name="city" id="city"
                                           class="form-control input-sm {{(!empty($errors->messages()['city'])? MessagesInputs::isInvalid($errors->messages()['city']) : '')}}"
                                           value="{{old('city') ?? $employee->city}}"  >
                                </div>
                                <div class="col-md-3">
                                    <label for="street">Rua</label>
                                    <input type="text" name="street" id="street"
                                           class="form-control input-sm {{(!empty($errors->messages()['street'])? MessagesInputs::isInvalid($errors->messages()['street']) : '')}}"
                                           value="{{old('street') ?? $employee->street}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" name="neighborhood" id="neighborhood"
                                           class="form-control input-sm {{(!empty($errors->messages()['neighborhood'])? MessagesInputs::isInvalid($errors->messages()['neighborhood']) : '')}}"
                                           value="{{old('neighborhood') ?? $employee->neighborhood}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="telphone">Telefone</label>
                                    <input type="text" name="telphone" id="telphone"
                                           class="form-control input-sm {{(!empty($errors->messages()['telphone'])? MessagesInputs::isInvalid($errors->messages()['telphone']) : '')}}"
                                           value="{{old('telphone') ?? $employee->telphone}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="celphone">Celular</label>
                                    <input type="text" name="celphone" id="celphone"
                                           class="form-control input-sm {{(!empty($errors->messages()['celphone'])? MessagesInputs::isInvalid($errors->messages()['celphone']) : '')}}"
                                           value="{{old('celphone') ?? $employee->celphone}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email"
                                           class="form-control input-sm {{(!empty($errors->messages()['email'])? MessagesInputs::isInvalid($errors->messages()['email']) : '')}}"
                                           value="{{old('email') ?? $employee->email}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="employee_job_information" role="tabpanel"
                         aria-labelledby="employee_job_information">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="contract_date">Data da contratação</label>
                                    <input type="text" name="contract_date" id="contract_date"
                                           class="form-control input-sm date {{(!empty($errors->messages()['contract_date'])? MessagesInputs::isInvalid($errors->messages()['contract_date']) : '')}}"
                                           value="{{old('contract_date') ?? $employee->contract_date}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="salary">Salario</label>
                                    <input type="text" name="salary" id="salary"
                                           class="form-control input-sm {{(!empty($errors->messages()['salary'])? MessagesInputs::isInvalid($errors->messages()['salary']) : '')}}"
                                           value="{{old('salary') ?? $employee->salary}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="occupation_id">Função</label>
                                    <select name="occupation_id" id="occupation_id" class="form-control select2"
                                            style="width: 100%">
                                        <option value="0">Selecione a função</option>
                                        @foreach($occupations as $occupation)
                                            <option value="{{$occupation->id}}" {{($employee->occupation_id == $occupation->id ? 'selected' : '')}}>{{$occupation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="unity_id">Unidade</label>
                                    <select name="unity_id" id="unity_id" class="form-control select2"
                                            style="width: 100%">
                                        <option value="0">Selecione a unidade</option>
                                        @foreach($unities as $unity)
                                            <option value="{{$unity->id}}" {{($employee->unity_id == $unity->id ? 'selected' : '')}}>{{$unity->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="bank_data" role="tabpanel" aria-labelledby="bank_data">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="bank">Banco</label>
                                <input type="text" name="bank" id="bank"
                                       class="form-control input-sm {{(!empty($errors->messages()['bank'])? MessagesInputs::isInvalid($errors->messages()['bank']) : '')}}"
                                       value="{{old('bank') ?? $employee->bank}}">
                            </div>
                            <div class="col-md-3">
                                <label for="account">Conta</label>
                                <input type="text" name="account" id="account"
                                       class="form-control input-sm {{(!empty($errors->messages()['account'])? MessagesInputs::isInvalid($errors->messages()['account']) : '')}}"
                                       value="{{old('account') ?? $employee->account}}">
                            </div>
                            <div class="col-md-6">
                                <label for="agency">Agencia</label>
                                <input type="text" name="agency" id="agency"
                                       class="form-control input-sm {{(!empty($errors->messages()['agency'])? MessagesInputs::isInvalid($errors->messages()['agency']) : '')}}"
                                       value="{{old('agency') ?? $employee->agency}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/jquery-mask/src/jquery.mask.js'))}}"></script>
    <script type="module">
        import {zipcodeSearch} from "./../../front/assets/scripts/zipcodeSearch.js";
        import {SelectTwo} from './../../front/assets/scripts/SelectTwo.js'
        import {GeneralFunction} from './../../front/assets/scripts/GeneralFunction.js';
        import {Mask} from './../../front/assets/scripts/Mask.js';

        const zipCode = new zipcodeSearch('zipcode');
        zipCode.find('state', 'city', 'street', 'neighborhood');
        new SelectTwo(null, '.select2');
        new Mask(null, '.date', '00/00/0000');
        new Mask('#document_primary', null, '000.000.000-00');
        new Mask('#zipcode', null, '00000-000');
        new Mask('#telphone', null, '(00)0000-0000');
        new Mask('#celphone', null, '(00)0 0000-0000');
        new Mask('#salary', null, '##.##0,00', true)
        const generalFunction = new GeneralFunction();
        generalFunction.blockUnlockFields('children', 'number_of_children');

    </script>
@endsection
