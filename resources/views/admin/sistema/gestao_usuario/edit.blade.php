@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/select2/css/select2.min.css'))}}">
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/pretty-checkbox/dist/pretty-checkbox.min.css'))}}">
@endsection
@section('content')
    <div class="">
        @include('admin.includes.errors')

        @if(session()->exists('messageInfo'))

            @component('admin.components.message',['type' => session()->get('messageInfo')])
                {{session()->get('messageInfo')}}
            @endcomponent
        @endif
        <div class="card card-gray card-tabs">
            <div class="card-header p-0 pt-1 ">
                <ul class="nav nav-tabs" id="card_navigation" role="tablist">
                    <li class="pt-1 px-3"><h3>Editar usuário</h3></li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab_user_password" data-toggle="pill" href="#user_password" role="tab" aria-controls="user_password" aria-selected="true">Usuario e senha</a>
                    </li>
                    <li>
                        <a class="nav-link" id="tab_user_full_info" data-toggle="pill" href="#user_full_info" role="tab" aria-controls="user_full_info" aria-selected="false">Outras informações</a>
                    </li>
                    <li>
                        <a class="nav-link" id="tab_permissions_user" data-toggle="pill" href="#permissions_user" role="tab" aria-controls="permissions_user" aria-selected="false">Permissões</a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="background-color: lightslategray">
                <div class="tab-content" id="content_tabs">
                    <div class="tab-pane fade show active" id="user_password" role="tabpanel" aria-labelledby="user_password">
                        <form action="{{route('source.users.updatePassword',['user' => $user->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name_user">Nome de usuário</label>
                                        <input type="text" name="name_user_edit" id="name_user_name" class="form-control input-sm {{(!empty($errors->messages()['name_user_edit'])? MessagesInputs::isInvalid($errors->messages()['name_user_edit']) : '')}}" value="{{old('name_user') ?? $user->name_user}}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password">Senha</label>
                                        <input type="password" name="password" id="password" class="form-control input-sm {{(!empty($errors->messages()['password'])? MessagesInputs::isInvalid($errors->messages()['password']) : '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-block bg-gradient-success">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Outras informações-->
                    <div class="tab-pane fade" id="user_full_info" role="tabpanel" aria-labelledby="user_full_info">
                        <form action="{{route('source.users.update',['user' => $user->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Nome</label>
                                        <input type="text" name="name" id="name" class="form-control input-sm {{(!empty($errors->messages()['name'])? MessagesInputs::isInvalid($errors->messages()['name']) : '')}}" value="{{old('name') ?? $user->name}}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="name_user">Nome de usuário</label>
                                        <input type="text" name="name_user" id="name_user_other" class="form-control input-sm {{(!empty($errors->messages()['name_user'])? MessagesInputs::isInvalid($errors->messages()['name_user']) : '')}}" value="{{old('name_user') ?? $user->name_user}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="document_primary">CPF</label>
                                        <input type="text" name="document_primary" id="document_primary" class="form-control input-sm {{(!empty($errors->messages()['document_primary'])? MessagesInputs::isInvalid($errors->messages()['document_primary']) : '')}}" value="{{old('document_primary') ?? $user->document_primary}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="occupation_id" class="form-control select2" style="width: 100%;">
                                            <option value="0" >Selecione a função</option>
                                            @foreach($occupations as $occupation)
                                                <option value="{{$occupation->id}}" {{($occupation->id == $user->occupation_id ? 'selected' : '')}}>{{$occupation->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select name="unity_id" class="form-control select2" style="width: 100%;">
                                            <option value="0" >Selecione a unidade</option>
                                            @foreach($unities as $unity)
                                                <option value="{{$unity->id}}" {{($unity->id == $user->unity_id ? 'selected' : '')}}>{{$unity->name}}</option>
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
                                    <button type="submit" class="btn btn-block bg-gradient-success">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Permissoes -->
                    <!-- Administrativo -->
                    <div class="tab-pane fade" id="permissions_user" role="tabpanel" aria-labelledby="permissions_user">
                        <div class="card card-green">
                            <div class="card-header">
                                <h5 class="card-title">Administrativo</h5>
                                <div class="row">
                                    <div class="col-md-10">

                                    </div>

                                    <div class="col-md-2 px-5">
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_adm').hide('slow')"><i class="fas fa-minus"></i></button>
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_adm').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="card_adm">
                                <form action="{{route('source.menus.updatePermission',['user' => $user->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Funcionarios</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Cadastrar</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="funcionarios_cadastrar_ativo" name="administrativo_funcionarios@cadastrar" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_funcionarios','cadastrar') == true ? 'checked' : '')}}>
                                                                    <label for="funcionarios_cadastrar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="funcionarios_cadastrar_inativo" name="administrativo_funcionarios@cadastrar" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_funcionarios','cadastrar') == false ? 'checked' : '')}}>
                                                                    <label for="funcionarios_cadastrar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Pesquisar</i></span>
                                                                </div>
                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="funcionarios_pesquisar_ativo" name="administrativo_funcionarios@pesquisar" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_funcionarios','pesquisar') == true ? 'checked' : '')}}>
                                                                    <label for="funcionarios_pesquisar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="funcionarios_pesquisar_inativo" name="administrativo_funcionarios@pesquisar" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_funcionarios','pesquisar') == false ? 'checked' : '')}}>
                                                                    <label for="funcionarios_pesquisar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Fornecedores</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Cadastrar</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="fornecedores_cadastrar_ativo" name="administrativo_fornecedores@cadastrar" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_fornecedores','cadastrar') == true ? 'checked' : '')}}>
                                                                    <label for="fornecedores_cadastrar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="fornecedores_cadastrar_inativo" name="administrativo_fornecedores@cadastrar" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_fornecedores','cadastrar') == false ? 'checked' : '')}}>
                                                                    <label for="fornecedores_cadastrar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary">Pesquisar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="fornecedores_pesquisar_ativo" name="administrativo_fornecedores@pesquisar" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_fornecedores','pesquisar') == true ? 'checked' : '')}}>
                                                                    <label for="fornecedores_pesquisar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2 ">
                                                                    <input type="radio" class="custom-control-input" id="fornecedores_pesquisar_inativo" name="administrativo_fornecedores@pesquisar" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_fornecedores','pesquisar') == false ? 'checked' : '')}}>
                                                                    <label for="fornecedores_pesquisar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Financeiro</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Contas a pagar</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_contas_a_pagar_ativo" name="administrativo_financeiro@contas_a_pagar" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','contas_a_pagar') == true ? 'checked' : '')}}>
                                                                    <label for="financeiro_contas_a_pagar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_contas_a_pagar_inativo" name="administrativo_financeiro@contas_a_pagar" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','contas_a_pagar') == false ? 'checked' : '')}}>
                                                                    <label for="financeiro_contas_a_pagar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>

                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Contas a receber</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_contas_a_receber_ativo" name="administrativo_financeiro@contas_a_receber" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','contas_a_receber') == true ? 'checked' : '')}}>
                                                                    <label for="financeiro_contas_a_receber_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_contas_a_receber_inativo" name="administrativo_financeiro@contas_a_receber" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','contas_a_receber') == false ? 'checked' : '')}}>
                                                                    <label for="financeiro_contas_a_receber_inativo" class="custom-control-label">Inativo</label>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Caixa</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_caixa_ativo" name="administrativo_financeiro@caixa" value="ativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','caixa') == true ? 'checked' : '')}}>
                                                                    <label for="financeiro_caixa_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="financeiro_caixa_inativo" name="administrativo_financeiro@caixa" value="inativo" {{($menus->editCheckboxMenu($user->id,'administrativo_financeiro','caixa') == false ? 'checked' : '')}}>
                                                                    <label for="financeiro_caixa_inativo" class="custom-control-label">Inativo</label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- Estoque -->
                        <div class="card card-green">
                            <div class="card-header">
                                <h5 class="card-title">Estoque</h5>
                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2 px-5">
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_estoque').hide('slow')"><i class="fas fa-minus"></i></button>
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_estoque').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="card_estoque">
                                <form action="{{route('source.menus.updatePermission',['user' => $user->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Estoque</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary"><i>Ordens de compra</i></span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="estoque_ordens_compra_ativo" name="estoque_ordens_compra@ordens_de_compra" value="ativo" {{($menus->editCheckboxMenu($user->id,'estoque_ordens_compra','ordens_de_compra') == true ? 'checked' : '')}}>
                                                                    <label for="estoque_ordens_compra_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="estoque_ordens_compra_inativo" name="estoque_ordens_compra@ordens_de_compra" value="inativo" {{($menus->editCheckboxMenu($user->id,'estoque_ordens_compra','ordens_de_compra') == false ? 'checked' : '')}}>
                                                                    <label for="estoque_ordens_compra_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Cadastro de produtos</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary">Cadastrar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="estoque_cadastro_produtos_ativo" name="estoque_cadastro_produtos@cadastrar" value="ativo" {{($menus->editCheckboxMenu($user->id,'estoque_cadastro_produtos','cadastrar') == true ? 'checked' : '')}}>
                                                                    <label for="estoque_cadastro_produtos_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="estoque_cadastro_produtos_inativo" name="estoque_cadastro_produtos@cadastrar" value="inativo" {{($menus->editCheckboxMenu($user->id,'estoque_cadastro_produtos','cadastrar') == false ? 'checked' : '')}}>
                                                                    <label for="estoque_cadastro_produtos_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary">Pesquisar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="estoque_pesquisa_produtos_ativo" name="estoque_cadastro_produtos@pesquisar" value="ativo" {{($menus->editCheckboxMenu($user->id,'estoque_cadastro_produtos','pesquisar') == true ? 'checked' : '')}}>
                                                                    <label for="estoque_pesquisa_produtos_ativo" class="custom-control-label">pesquisar</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="estoque_pesquisa_produtos_inativo" name="estoque_cadastro_produtos@pesquisar" value="inativo" {{($menus->editCheckboxMenu($user->id,'estoque_cadastro_produtos','pesquisar') == false ? 'checked' : '')}}>
                                                                    <label for="estoque_pesquisa_produtos_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Movimentação</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary">Entrada</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="estoque_movimentacao_entrada_ativo" name="estoque_movimentacao@entrada" value="ativo" {{($menus->editCheckboxMenu($user->id,'estoque_movimentacao','entrada') == true ? 'checked' : '')}}>
                                                                    <label for="estoque_movimentacao_entrada_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="estoque_movimentacao_entrada_inativo" name="estoque_movimentacao@entrada" value="inativo" {{($menus->editCheckboxMenu($user->id,'estoque_movimentacao','entrada') == false ? 'checked' : '')}}>
                                                                    <label for="estoque_movimentacao_entrada_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2 ml-3">
                                                                    <span class="text-primary">Pesquisar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="estoque_movimentacao_saida_ativo" name="estoque_movimentacao@saida" value="ativo" {{($menus->editCheckboxMenu($user->id,'estoque_movimentacao','saida') == true ? 'checked' : '')}}>
                                                                    <label for="estoque_movimentacao_saida_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="estoque_movimentacao_saida_inativo" name="estoque_movimentacao@saida" value="inativo" {{($menus->editCheckboxMenu($user->id,'estoque_movimentacao','saida') == false ? 'checked' : '')}}>
                                                                    <label for="estoque_movimentacao_saida_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Propriedades -->
                        <div class="card card-green">
                            <div class="card-header">
                                <h5 class="card-title">Propriedades</h5>
                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2 px-5">
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_properties').hide('slow')"><i class="fas fa-minus"></i></button>
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_properties').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="card_properties">
                                <form action="{{route('source.menus.updatePermission',['user' => $user->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 h-50">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Gestão de propriedades</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div style="width: 135px">
                                                                    <span class="text-primary">Cadastrar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-5">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_cadastrar_ativo" name="propriedades_gestao_de_propriedades@cadastrar" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','cadastrar') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_cadastrar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_cadastrar_inativo" name="propriedades_gestao_de_propriedades@cadastrar" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','cadastrar') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_cadastrar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row w-70">
                                                                <div class="col-md-3">
                                                                    <span class="text-primary">Cadastar pastos</span>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_cadastrar_pastos_ativo" name="propriedades_gestao_de_propriedades@cadastrar_pastos" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','cadastrar_pastos') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_cadastrar_pastos_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_cadastrar_pastos_inativo" name="propriedades_gestao_de_propriedades@cadastrar_pastos" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','cadastrar_pastos') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_cadastrar_pastos_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row w-70">
                                                                <div style="width: 165px">
                                                                    <span class="text-primary">Pesquisar</span>
                                                                </div>

                                                                <div class="col-md-2 ml-3">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_pesquisar_ativo" name="propriedades_gestao_de_propriedades@pesquisar" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','pesquisar') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_pesquisar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_gestao_de_propriedades_pesquisar_inativo" name="propriedades_gestao_de_propriedades@pesquisar" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_gestao_de_propriedades','pesquisar') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_gestao_de_propriedades_pesquisar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 h-50">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Animais</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="text-primary">Cadastro de rebanho</span>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_ativo" name="propriedades_animais@cadastro_de_rebanho" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais','cadastro_de_rebanho') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_inativo" name="propriedades_animais@cadastro_de_rebanho" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais','cadastro_de_rebanho') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_inativo" class="custom-control-label">Inativo</label>
                                                                </div>

                                                            </div>
                                                            <hr style="border: 2px solid darkgrey"/>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="font-italic font-weight-bold">Movimentação</span>
                                                                </div>
                                                            </div>
                                                            <div class="p-2"></div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Entrada</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_entrada_ativo" name="propriedades_animais_movimentacao@entrada" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','entrada') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_entrada_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_entrada_inativo" name="propriedades_animais_movimentacao@entrada" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','entrada') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_entrada_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Saida</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_saida_ativo" name="propriedades_animais_movimentacao@saida" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','saida') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_saida_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_saida_inativo" name="propriedades_animais_movimentacao@saida" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','saida') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_saida_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Manejo</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_manejo_ativo" name="propriedades_animais_movimentacao@manejo" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','manejo') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_manejo_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_manejo_inativo" name="propriedades_animais_movimentacao@manejo" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','manejo') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_manejo_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Pesagens</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_pesagens_ativo" name="propriedades_animais_movimentacao@pesagens" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','pesagens') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_pesagens_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_pesagens_inativo" name="propriedades_animais_movimentacao@pesagens" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','pesagens') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_pesagens_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Compra</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_compra_ativo" name="propriedades_animais_movimentacao@compra" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','compra') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_compra_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_compra_inativo" name="propriedades_animais_movimentacao@compra" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','compra') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_compra_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Venda</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_venda_ativo" name="propriedades_animais_movimentacao@venda" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','venda') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_venda_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_animais_movimentacao_venda_inativo" name="propriedades_animais_movimentacao@venda" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_animais_movimentacao','venda') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_animais_movimentacao_venda_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Vacinas</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Cadastro de lotes</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_vacinas_ativo" name="propriedades_vacinas@cadastro_de_lotes" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_vacinas','cadastro_de_lotes') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_vacinas_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_vacinas_inativo" name="propriedades_vacinas@cadastro_de_lotes" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_vacinas','cadastro_de_lotes') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_vacinas_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                            <hr style="border: 2px solid darkgrey"/>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="font-italic font-weight-bold">Estoque</span>
                                                                </div>
                                                            </div>
                                                            <div class="p-2"></div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Entrada</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_estoque_vacinas_entrada_ativo" name="propriedades_estoque_vacinas@entrada" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_estoque_vacinas','entrada') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_estoque_vacinas_entrada_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_estoque_vacinas_entrada_inativo" name="propriedades_estoque_vacinas@entrada" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_estoque_vacinas','entrada') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_estoque_vacinas_entrada_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Saida</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_estoque_vacinas_saida_ativo" name="propriedades_estoque_vacinas@saida" value="ativo" {{($menus->editCheckboxMenu($user->id,'propriedades_estoque_vacinas','saida') == true ? 'checked' : '')}}>
                                                                    <label for="propriedades_estoque_vacinas_saida_ativo" class="custom-control-label">Ativo</label>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="propriedades_estoque_vacinas_saida_inativo" name="propriedades_estoque_vacinas@saida" value="inativo" {{($menus->editCheckboxMenu($user->id,'propriedades_estoque_vacinas','saida') == false ? 'checked' : '')}}>
                                                                    <label for="propriedades_estoque_vacinas_saida_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card card-green">
                            <div class="card-header">
                                <h5 class="card-title">Sistema</h5>
                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2 px-5">
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_system').hide('slow')"><i class="fas fa-minus"></i></button>
                                        <button class="btn btn-sm btn-warning botao" onclick="$('#card_system').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="card_system">
                                <form action="{{route('source.menus.updatePermission',['user' => $user->id])}}" method="POST" >
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                               <div class="card-header">
                                                   <h6>Gestão de usuarios</h6>
                                               </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Cadastrar</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_gestao_usuario_cadastrar_ativo" name="sistema_gestao_usuario@cadastrar" value="ativo" {{($menus->editCheckboxMenu($user->id,'sistema_gestao_usuario','cadastrar') == true ? 'checked' : '')}}>
                                                                    <label for="sistema_gestao_usuario_cadastrar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_gestao_usuario_cadastrar_inativo" name="sistema_gestao_usuario@cadastrar" value="inativo" {{($menus->editCheckboxMenu($user->id,'sistema_gestao_usuario','cadastrar') == false ? 'checked' : '')}}>
                                                                    <label for="sistema_gestao_usuario_cadastrar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">pesquisar</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_gestao_usuario_pesquisar_ativo" name="sistema_gestao_usuario@pesquisar" value="ativo" {{($menus->editCheckboxMenu($user->id,'sistema_gestao_usuario','pesquisar') == true ? 'checked' : '')}}>
                                                                    <label for="sistema_gestao_usuario_pesquisar_ativo" class="custom-control-label">Ativo</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_gestao_usuario_pesquisar_inativo" name="sistema_gestao_usuario@pesquisar" value="inativo" {{($menus->editCheckboxMenu($user->id,'sistema_gestao_usuario','pesquisar') == false ? 'checked' : '')}}>
                                                                    <label for="sistema_gestao_usuario_pesquisar_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Permissões</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Permissões</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_permissoes_ativo" name="sistema_permissoes@permissoes" value="ativo" {{($menus->editCheckboxMenu($user->id,'sistema_permissoes','permissoes') == true ? 'checked' : '')}}>
                                                                    <label for="sistema_permissoes_ativo" class="custom-control-label">Ativo</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_permissoes_inativo" name="sistema_permissoes@permissoes" value="inativo" {{($menus->editCheckboxMenu($user->id,'sistema_permissoes','permissoes') == false ? 'checked' : '')}}>
                                                                    <label for="sistema_permissoes_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-blue">
                                                <div class="card-header">
                                                    <h6>Parametrização</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <span class="text-primary">Parametrização</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_parametrizacao_ativo" name="sistema_parametrizacao@parametrizacao" value="ativo" {{($menus->editCheckboxMenu($user->id,'sistema_parametrizacao','parametrizacao') == true ? 'checked' : '')}}>
                                                                    <label for="sistema_parametrizacao_ativo" class="custom-control-label">Ativo</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="radio" class="custom-control-input" id="sistema_parametrizacao_inativo" name="sistema_parametrizacao@parametrizacao" value="inativo" {{($menus->editCheckboxMenu($user->id,'sistema_parametrizacao','parametrizacao') == false ? 'checked' : '')}}>
                                                                    <label for="sistema_parametrizacao_inativo" class="custom-control-label">Inativo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script src="{{url(asset('front/assets/plugins/select2/js/select2.full.min.js'))}}"></script>
    <script src="{{url(asset('front/assets/plugins/jquery-mask/src/jquery.mask.js'))}}"></script>

    <script type="module">
        import {SelectTwo} from './../../front/assets/scripts/SelectTwo.js'
        import {Mask} from './../../front/assets/scripts/Mask.js';


        new SelectTwo(null,'.select2');
        new Mask('#document_primary',null,"000.000.000-00");


    </script>
@endsection
