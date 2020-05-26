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
                <li class="pt-1 px-3"><h3>Contas a pagar</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_list_total_accounts" data-toggle="pill"
                       href="#list_total_accounts" role="tab" aria-controls="list_total_accounts">Contas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_list_accounts _to_pay" data-toggle="pill"
                       href="#list_accounts_to_pay" role="tab" aria-controls="list_accounts_to_pay"
                       aria-selected="true">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_list_expenses_fixed" data-toggle="pill"
                       href="#list_expenses_fixed" role="tab" aria-controls="list_expenses_fixed"
                       aria-selected="true">Despesas Fixa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_list_fuel_expenses" data-toggle="pill"
                       href="#list_fuel_expenses" role="tab" aria-controls="list_fuel_expenses"
                       aria-selected="true">Combustivel/lubrificantes</a>
                </li>
            </ul>
        </div>

        <div class="card-body" style="background-color: lightslategray">
            <div class="tab-content" id="tab_content">
                <div class="tab-pane fade show active" id="list_total_accounts" role="tabpanel" aria-labelledby="list_total_accounts">

                </div>
                <div class="tab-pane fade" id="list_accounts_to_pay" role="tabpanel" aria-labelledby="list_accounts_to_pay">

                </div>
                <div class="tab-pane fade" id="list_expenses_fixed" role="tabpanel" aria-labelledby="list_expenses_fixed">

                </div>

                <div class="tab-pane fade" id="list_fuel_expenses" role="tabpanel" aria-labelledby="list_fuel_expenses">

                </div>

            </div>
        </div>
    </div>
@endsection
