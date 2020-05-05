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
                       aria-selected="true">Cadastro manual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_accounts_to_pay_xml" data-toggle="pill"
                       href="#accounts_to_pay_xml" role="tab" aria-controls="accounts_to_pay_xml"
                       aria-selected="true">Cadastro por xml</a>
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
                                        <option value="billet" {{(old('type_payment') == 'billet' ? 'selected' : '')}}>Boleto</option>
                                        <option value="bank_cheque" {{(old('type_payment') == 'bank_cheque' ? 'selected' : '')}}>Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="installments">Numero de parcelas</label>
                                    <input type="text" name="installments" id="installments" class="form-control input-sm {{(!empty($errors->messages()['installments'])? MessagesInputs::isInvalid($errors->messages()['installments']) : '')}}" value="{{old('installments')}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="value">Valor</label>
                                    <input type="text" name="value" id="value" class="form-control input-sm {{(!empty($errors->messages()['value'])? MessagesInputs::isInvalid($errors->messages()['value']) : '')}}" value="{{old('value')}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="due_date">Data de vencimento</label>
                                    <input type="text" name="due_date" id="due_date" class="form-control input-sm {{(!empty($errors->messages()['due_date'])? MessagesInputs::isInvalid($errors->messages()['due_date']) : '')}}" value="{{old('due_date')}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="employee_id">Autorizado por</label>
                                    <select name="employee_id" id="employee_id" class="form-control select2">
                                        <option>Selecione um usuario</option>
                                        @foreach($employees as $employ)
                                            <option value="{{$employ->id}}">{{$employ->name}} ({{$employ->document_primary}})</option>
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
                <div class="tab-pane fade " id="accounts_to_pay_xml" role="tabpanel" aria-labelledby="accounts_to_pay_xml">
                    <form action="{{route('source.accounts.store')}}" method="POST">
                        @csrf
                        <div class="row">

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
        import {Mask} from './../front/assets/scripts/Mask.js';

        new SelectTwo(null,'.select2');
        new Mask('#due_date',null,'00/00/0000');
        new Mask('#value',null,'##.##0,00',true);
    </script>
@endsection
