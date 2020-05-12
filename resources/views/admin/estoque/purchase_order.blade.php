@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/summernote/summernote-bs4.css'))}}">
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
            <li class="pt-1 px-3"><h3>Ordem de compra</h3></li>
            <li class="nav-item">
                <a class="nav-link" id="tab_purchase_order" data-toggle="pill"
                   href="#purchase_order" role="tab" aria-controls="purchase_order"
                   aria-selected="true">Gerar requisição</a>
            </li>
        </ul>
    </div>

    <div class="card-body" style="background-color: lightslategray">
        <div class="tab-content" id="tab_content">
            <div class="tab-pane fade show active" id="purchase_order" role="tabpanel" aria-labelledby="purchase_order">
                <form action="{{route('source.purchase-orders.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Solicitante</label>
                                <select name="requesting_user" id="requesting_user" class="form-control">
                                    <option>Selecione um funcionario</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Autorizador</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option>Selecione um funcionario</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="justification">Digite as informações</label>
                                <textarea class="textarea" name="justification" id="justification" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 py-4">
                            <button type="submit" class="btn btn-block bg-gradient-success">Gerar requisição</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/summernote/summernote-bs4.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script type="module">
        import {SelectTwo} from './../front/assets/scripts/SelectTwo.js';

        new SelectTwo('#requesting_user',null);
        new SelectTwo('#employee_id',null);
        $('#justification').summernote();
    </script>
@endsection