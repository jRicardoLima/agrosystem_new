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
                <li class="pt-1 px-3"><h3>Cadastrar contas</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_accounts _to_pay" data-toggle="pill"
                       href="#accounts_to_pay" role="tab" aria-controls="accounts_to_pay"
                       aria-selected="true">Despesas de produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_expenses" data-toggle="pill"
                       href="#expenses" role="tab" aria-controls="expenses"
                       aria-selected="false">Despesas fixas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="tab_fuel_expenses" data-toggle="pill"
                       href="#fuel_expenses" role="tab" aria-controls="fuel_expenses"
                       aria-selected="false">Combustiveis/lubrificantes</a>
                </li>
            </ul>
        </div>

        <div class="card-body" style="background-color: lightslategray">
            <div class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="accounts_to_pay" role="tabpanel" aria-labelledby="accounts_to_pay">
                    <form action="{{route('source.accounts.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="company_id">Fornecedor</label>
                                    <select name="company_id" id="company_id" class="form-control select2">
                                        <option>Selecione o fornecedor</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->fantasy_name}} ({{($company->physic_person == false ? $company->document_company_identification : $company->document_primary)}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="type_payment">Tipo de pagamento</label>
                                    <select name="type_payment" id="type_payment" class="form-control select2">
                                        <option value="money" {{(old('type_payment') == 'money' ? 'selected' : '')}}>Dinheiro</option>
                                        <option value="credit_card" {{(old('type_payment') == 'credit_card' ? 'selected' : '')}}>Cartão de crédito</option>
                                        <option value="debit_card" {{(old('type_payment') == 'debit_card' ? 'selected' : '')}}>Cartão de débito</option>
                                        <option value="billet" {{(old('type_payment') == 'billet' ? 'selected' : '')}}>Boleto/Duplicata</option>
                                        <option value="bank_cheque" {{(old('type_payment') == 'bank_cheque' ? 'selected' : '')}}>Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="access_key_id">Chave de acesso(NFe)</label>
                                    <input type="text" name="access_key_id" id="access_key_id" class="form-control input-sm {{(!empty($errors->messages()['access_key_id'])? MessagesInputs::isInvalid($errors->messages()['access_key_id']) : '')}}" value="{{old('access_key_id')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="request_number_id">Numero da requisição</label>
                                    <input type="text" name="request_number_id" id="request_number_id" class="form-control input-sm {{(!empty($errors->messages()['request_number_id'])? MessagesInputs::isInvalid($errors->messages()['request_number_id']) : '')}}" value="{{old('request_number_id')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 py-2">
                                    <label for="number_installment" style="margin-right: 80px">numero de parcelas</label> <button type="button" class="btn btn-outline-secondary btn-info btn-sm" id="add_installments" title="Adicionar parcelas"><i class="far fa-plus-square"></i></button>
                                    <input type="text" name="number_installment" id="number_installment" class="form-control input-sm">
                                </div>
                            </div>
                            <div id="generate_rows"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 py-4">
                                <button type="submit" class="btn btn-block bg-gradient-success">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade " id="expenses" role="tabpanel" aria-labelledby="expenses">
                    <form action="{{route('source.accounts.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="expenses_company_id">Fornecedor</label>
                                    <select name="company_id" id="expenses_company_id" class="form-control select2">
                                        <option>Selecione um fornecedor</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="expenses_product" style="margin-right: 125px">Tipo de conta</label> <button type="button" id="btn_add_product_expense_fixed" class="btn btn-outline-secondary btn-info btn-sm" title="adicionar novo produto"><i class="far fa-plus-square"></i></button>
                                    <select name="expenses_product" id="expenses_product" class="form-control">
                                        <option>Selecione um produto</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="expenses_type_payment">Tipo de pagamento</label>
                                    <select name="type_payment" id="expenses_type_payment" class="form-control">
                                        <option value="money" {{(old('type_payment') == 'money' ? 'selected' : '')}}>Dinheiro</option>
                                        <option value="credit_card" {{(old('type_payment') == 'credit_card' ? 'selected' : '')}}>Cartão de crédito</option>
                                        <option value="debit_card" {{(old('type_payment') == 'debit_card' ? 'selected' : '')}}>Cartão de débito</option>
                                        <option value="billet" {{(old('type_payment') == 'billet' ? 'selected' : '')}}>Boleto/Duplicata</option>
                                        <option value="bank_cheque" {{(old('type_payment') == 'bank_cheque' ? 'selected' : '')}}>Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="expenses_value">Valor</label>
                                    <input type="text" name="value" id="expenses_value" class="form-control input-sm">
                                </div>

                                <div class="col-md-2">
                                    <label for="expenses_date">Data de vencimento</label>
                                    <input type="text" name="due_date" id="expenses_date" class="form-control input-sm">
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

                <div class="tab-pane fade" id="fuel_expenses" role="tabpanel" aria-labelledby="fuel_expenses">
                    <form action="{{route('source.accounts.store')}}" method="POST">
                        @csrf
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
        import {Mask} from './../front/assets/scripts/Mask.js';
        import {AddInstallments} from './../front/assets/scripts/AddInstallments.js';

        new SelectTwo(null,'.select2');
        new Mask('#expenses_date',null,'00/00/0000');
        new AddInstallments('number_installment','add_installments');
    </script>
@endsection
