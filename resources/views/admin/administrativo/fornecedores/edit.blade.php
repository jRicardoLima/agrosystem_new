@extends('admin.master.template')
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
                <li class="pt-1 px-3"><h3>Editar fornecedor</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_company_information_private" data-toggle="pill"
                       href="#company_information_private" role="tab" aria-controls="company_information_private"
                       aria-selected="true">Informações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_company_address_information" data-toggle="pill"
                       href="#company_address_information" role="tab" aria-controls="company_address_information"
                       aria-selected="false">Endereço</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background-color: lightslategray">
            <form action="{{route('source.companies.update',['company' => $company->id])}}" method="POST">
                @csrf
                <div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="company_information_private" role="tabpanel" aria-labelledby="company_information_private">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="fantasy_name">Nome fantasia</label>
                                    <input type="text" name="fantasy_name" id="fantasy_name"
                                           class="form-control input-sm {{(!empty($errors->messages()['fantasy_name'])? MessagesInputs::isInvalid($errors->messages()['fantasy_name']) : '')}}"
                                           value="{{old('fantasy_name') ?? $company->fantasy_name}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="company_name">Razão social</label>
                                    <input type="text" name="company_name" id="company_name"
                                           class="form-control input-sm {{(!empty($errors->messages()['company_name'])? MessagesInputs::isInvalid($errors->messages()['company_name']) : '')}}"
                                           value="{{old('company_name') ?? $company->company_name}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="physic_person">Tipo de empresa</label>
                                    <select name="physic_person" id="physic_person" class="form-control">
                                        <option>-----------</option>
                                        <option value="0" {{($company->physic_person == 0 ? 'selected' : '')}}>CNPJ</option>
                                        <option value="1" {{($company->physic_person == 1 ? 'selected' : '')}}>CPF</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="document_company_identification">CNPJ</label>
                                    <input type="text" name="document_company_identification" id="document_company_identification"
                                           class="form-control input-sm {{(!empty($errors->messages()['document_company_identification'])? MessagesInputs::isInvalid($errors->messages()['document_company_identification']) : '')}}"
                                           value="{{old('document_company_identification') ?? $company->document_company_identification}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="document_primary">CPF</label>
                                    <input type="text" name="document_primary" id="document_primary"
                                           class="form-control input-sm {{(!empty($errors->messages()['document_primary'])? MessagesInputs::isInvalid($errors->messages()['document_primary']) : '')}}"
                                           value="{{old('document_primary') ?? $company->document_primary}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="company_address_information" role="tabpanel" aria-labelledby="company_address_information">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="zipcode">CEP</label>
                                    <input type="text" name="zipcode" id="zipcode"
                                           class="form-control input-sm {{(!empty($errors->messages()['zipcode'])? MessagesInputs::isInvalid($errors->messages()['zipcode']) : '')}}"
                                           value="{{old('zipcode') ?? $company->zipcode}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="state">Estado</label>
                                    <input type="text" name="state" id="state"
                                           class="form-control input-sm {{(!empty($errors->messages()['state'])? MessagesInputs::isInvalid($errors->messages()['state']) : '')}}"
                                           value="{{old('state') ?? $company->state}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="city">Cidade</label>
                                    <input type="text" name="city" id="city"
                                           class="form-control input-sm {{(!empty($errors->messages()['city'])? MessagesInputs::isInvalid($errors->messages()['city']) : '')}}"
                                           value="{{old('city') ?? $company->city}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="street">Rua</label>
                                    <input type="text" name="street" id="street"
                                           class="form-control input-sm {{(!empty($errors->messages()['street'])? MessagesInputs::isInvalid($errors->messages()['street']) : '')}}"
                                           value="{{old('street') ?? $company->street}}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" name="neighborhood" id="neighborhood"
                                           class="form-control input-sm {{(!empty($errors->messages()['neighborhood'])? MessagesInputs::isInvalid($errors->messages()['neighborhood']) : '')}}"
                                           value="{{old('neighborhood') ?? $company->neighborhood}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="contact_one">Telefone 1</label>
                                    <input type="text" name="contact_one" id="contact_one"
                                           class="form-control input-sm {{(!empty($errors->messages()['contact_one'])? MessagesInputs::isInvalid($errors->messages()['contact_one']) : '')}}"
                                           value="{{old('contact_one') ?? $company->contact_one}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="contact_two">Telefone 2</label>
                                    <input type="text" name="contact_two" id="contact_two"
                                           class="form-control input-sm {{(!empty($errors->messages()['contact_two'])? MessagesInputs::isInvalid($errors->messages()['contact_two']) : '')}}"
                                           value="{{old('contact_two') ?? $company->contact_two}}">
                                </div>

                                <div class="col-md-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email"
                                           class="form-control input-sm {{(!empty($errors->messages()['email'])? MessagesInputs::isInvalid($errors->messages()['email']) : '')}}"
                                           value="{{old('email') ?? $company->email}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4 py-4">
                                    <button type="submit" class="btn btn-block bg-gradient-success">Atualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/jquery-mask/src/jquery.mask.js'))}}"></script>
    <script type="module">
        import {zipcodeSearch} from "./../../front/assets/scripts/zipcodeSearch.js";
        import {Mask} from './../../front/assets/scripts/Mask.js';
        import {GeneralFunction} from './../../front/assets/scripts/GeneralFunction.js';

        const zipcode = new zipcodeSearch('zipcode');
        zipcode.find('state','city','street','neighborhood');
        new Mask('#zipcode',null,'00000-000');
        new Mask('#document_primary',null,'000.000.000-00');
        new Mask('#document_company_identification',null,'00.000.000/0000-00');
        new Mask('#contact_one',null,'(00)00000-0000');
        new Mask('#contact_two',null,'(00)00000-0000');

        const cpfCnpj = new GeneralFunction();

        cpfCnpj.cpfCnpjField('physic_person','document_company_identification','document_primary');

        let valueCpf = $("#document_primary").val();

        if(valueCpf){
            $("#document_primary").removeAttr('disabled');
        } else {
            $("#document_company_identification").removeAttr('disabled');
        }
    </script>
@endsection
