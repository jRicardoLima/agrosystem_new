@extends('admin.master.template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><b>Total de vencimentos</b></span>
                        <p>R$ 1850,25</p>
                        <span class="info-box-text">{{date('d/m/Y')}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><b>Proximas contas para vencer</b></span>
                        <span class="info-box-content">Contas</span>
                        <span class="info-box-text">{{date('d/m/Y')}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="info-box bg-info">

                </div>
            </div>
        </div>
    </div>
@endsection
