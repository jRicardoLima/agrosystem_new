@extends('admin.master.template')
@section('css')
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/Jquery-switch/dist/css/bootstrap4/bootstrap-switch.min.css'))}}">
@endsection
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                @include('admin.includes.errors')
                <div class="card card-gray">
                    <div class="card-header">
                        <h4>Menus</h4>
                    </div>

                    <!-- Administrativo -->
                    <div class="card-body" style="background-color: lightslategray">
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->exists('messageInfo'))
                                    @component('admin.components.message',['type' => session()->get('messageInfo')])
                                        {{session()->get('messageInfo')}}
                                    @endcomponent
                                @endif
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
                                          <form action="{{route('source.menus.storePermissions')}}" method="POST">
                                              @csrf
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="card card-blue">
                                                        <div class="card-header">
                                                            <h6>Funcionarios</h6>
                                                        </div>

                                                        <div class="card-body">
                                                           <div class="form-group">
                                                               <div class="row">
                                                                   <div class="col-md-12">

                                                                       <span class="text-primary"> <i>Cadastrar</i> : <input type="checkbox" name="administrativo_funcionarios@cadastrar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                       <span class="text-primary"> <i>Pesquisar</i> :  <input type="checkbox" name="administrativo_funcionarios@pesquisar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                                <div class="row">
                                                                    <div class="col-md-12">

                                                                        <span class="text-primary"> <i>Cadastrar</i> : <input type="checkbox" name="administrativo_fornecedores@cadastrar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Pesquisar</i> :  <input type="checkbox" name="administrativo_fornecedores@pesquisar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                                 <div class="row">
                                                                     <div class="col-md-12">

                                                                         <span class="text-primary"> <i>Cadastrar contas</i> : <input type="checkbox" name="administrativo_financeiro@cadastrar_contas" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                         <div class="py-2"></div>
                                                                         <span class="text-primary"> <i>Contas a pagar</i> : <input type="checkbox" name="administrativo_financeiro@contas_a_pagar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                         <div class="py-2"></div>
                                                                         <span class="text-primary"> <i>Contas a receber</i> :  <input type="checkbox" name="administrativo_financeiro@contas_a_receber" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                         <div class="py-2"></div>
                                                                         <span class="text-primary"> <i>Caixa</i> :  <input type="checkbox" name="administrativo_financeiro@caixa" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <input type="text" name="name_user" id="name_user" class="form-control" placeholder="Nome de usuario">
                                                  </div>
                                                  <div class="col-md-4"></div>
                                                  <div class="col-md-4">
                                                      <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                                  </div>
                                              </div>
                                          </form>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <!-- Estoque -->
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->exists('messageInfo'))
                                    @component('admin.components.message',['type' => 'success'])
                                        {{session()->get('messageInfo')}}
                                    @endcomponent
                                @endif
                                <div class="card card-green">
                                    <div class="card-header">
                                        <h5 class="card-title">Estoque</h5>
                                        <div class="row">
                                            <div class="col-md-10">

                                            </div>

                                            <div class="col-md-2 px-5">
                                                <button class="btn btn-sm btn-warning" onclick="$('#card_estoque').hide('slow')"><i class="fas fa-minus"></i></button>
                                                <button class="btn btn-sm btn-warning" onclick="$('#card_estoque').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body" id="card_estoque">
                                        <form action="{{route('source.menus.storePermissions')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-blue">
                                                        <div class="card-header">
                                                            <h6>Estoque</h6>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span class="text-primary"> <i>Ordens de compra</i> : <input type="checkbox" name="estoque_ordens_compra@ordens_de_compra" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                               <div class="row">
                                                                   <div class="col-md-12">
                                                                       <span class="text-primary"> <i>Cadastrar</i> : <input type="checkbox" name="estoque_cadastro_produtos@cadastrar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                       <div class="py-2"></div>
                                                                       <span class="text-primary"> <i>Pesquisar</i> :  <input type="checkbox" name="estoque_cadastro_produtos@pesquisar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                        <div class="card card-header">
                                                            <h6>Movimentação</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <span class="text-primary"> <i>Entrada/Saida</i> : <input type="checkbox" name="estoque_movimentacao@movimentacao_produto" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                <div class="py-2"></div>
                                                                <span class="text-primary"> <i>Estoque</i> :  <input type="checkbox" name="estoque_movimentacao@estoque" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="name_user" id="name_user" class="form-control" placeholder="Nome de usuario">
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Propriedade -->
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->exists('messageInfo'))
                                    @component('admin.components.message',['type' => 'success'])
                                        {{session()->get('messageInfo')}}
                                    @endcomponent
                                @endif
                                <div class="card card-green">
                                    <div class="card-header">
                                        <h5 class="card-title">Propriedades</h5>
                                        <div class="row">
                                            <div class="col-md-10">

                                            </div>

                                            <div class="col-md-2 px-5">
                                                <button class="btn btn-sm btn-warning" onclick="$('#card_propriedades').hide('slow')"><i class="fas fa-minus"></i></button>
                                                <button class="btn btn-sm btn-warning" onclick="$('#card_propriedades').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body" id="card_propriedades">
                                        <form action="{{route('source.menus.storePermissions')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="card card-blue">
                                                            <div class="card-header">
                                                                <h6>Gestão de priopriedades</h6>

                                                            </div>

                                                            <div class="card-body">
                                                              <div class="form-group">

                                                                  <div class="row">
                                                                      <div class="col-md-12">
                                                                          <span class="text-primary"> <i>Cadastrar</i> : <input type="checkbox" name="propriedades_gestao_de_propriedades@cadastrar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                          <div class="py-2"></div>
                                                                          <span class="text-primary"> <i>Cadastrar pastos</i> :  <input type="checkbox" name="propriedades_gestao_de_propriedades@cadastrar_pastos" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                          <div class="py-2"></div>
                                                                          <span class="text-primary"> <i>Pesquisar</i> :  <input type="checkbox" name="propriedades_gestao_de_propriedades@pesquisar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                      </div>
                                                                  </div>

                                                              </div>
                                                            </div>
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card card-blue">
                                                        <div class="card-header">
                                                            <h6>Animais</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span class="text-primary"> <i>Cadastrar rebanho</i> : <input type="checkbox" name="propriedades_animais@cadastro_de_rebanho" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                    </div>
                                                                </div>
                                                                <hr style="border: 2px solid darkgrey"/>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p class="font-italic font-weight-bold"><ins>Movimentação</ins></p>

                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Entrada</i> : <input type="checkbox" name="propriedades_animais_movimentacao@entrada" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Saida</i> :  <input type="checkbox" name="propriedades_animais_movimentacao@saida" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Manejo</i> :  <input type="checkbox" name="propriedades_animais_movimentacao@manejo" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Pesagens</i> :  <input type="checkbox" name="propriedades_animais_movimentacao@pesagens" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Compra</i> :  <input type="checkbox" name="propriedades_animais_movimentacao@compra" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Venda</i> :  <input type="checkbox" name="propriedades_animais_movimentacao@venda" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <span class="text-primary"> <i>Cadastro de lotes</i> : <input type="checkbox" name="propriedades_vacinas@cadastro_de_lotes" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr style="border: 2px solid darkgrey"/>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <p class="font-italic font-weight-bold"><ins>Estoque de vacinas</ins></p>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Entrada</i> : <input type="checkbox" name="propriedades_estoque_vacinas@entrada" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Saida</i> :  <input type="checkbox" name="propriedades_estoque_vacinas@saida" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="name_user" id="name_user" class="form-control" placeholder="Nome de usuario">
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-block bg-gradient-success">Liberar acesso</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sistema -->
                        <div class="row">
                           <div class="col-md-12">
                               @if(session()->exists('messageInfo'))
                                   @component('admin.components.message',['type' => 'success'])
                                       {{session()->get('messageInfo')}}
                                   @endcomponent
                               @endif
                               <div class="card card-green">
                                   <div class="card-header">
                                       <h5 class="card-title">Sistema</h5>
                                       <div class="row">
                                           <div class="col-md-10">

                                           </div>

                                           <div class="col-md-2 px-5">
                                               <button class="btn btn-sm btn-warning" onclick="$('#card_sistema').hide('slow')"> <i class="fas fa-minus"></i></button>
                                               <button class="btn btn-sm btn-warning" onclick="$('#card_sistema').show('slow')"><i class="fas fa-window-maximize"></i></button>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body" id="card_sistema">
                                        <form action="{{route('source.menus.storePermissions')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-blue">
                                                        <div class="card-header">
                                                            <h6>Gestão de usuarios</h6>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span class="text-primary"> <i>Cadastrar</i> : <input type="checkbox" name="sistema_gestao_usuario@cadastrar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                        <span class="text-primary"> <i>Pesquisar</i> :  <input type="checkbox" name="sistema_gestao_usuario@pesquisar" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                        <div class="py-2"></div>
                                                                    </div>
                                                                </div>
                                                               </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                <div class="col-md-6">
                                                    <div class="card card-blue">
                                                        <div class="card-header">
                                                            <h6>Parametrização</h6>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span class="text-primary"> <i>Parametrização</i> : <input type="checkbox" name="sistema_parametrizacao@parametrizacao" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
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
                                                            <h6>Permições</h6>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span class="text-primary"> <i>Permições</i> : <input type="checkbox" name="sistema_permissoes@permissoes" data-bootstrap-switch data-off-color="danger" data-on-color="success"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="name_user" id="name_user" class="form-control" placeholder="Nome de usuario">
                                                </div>
                                                <div class="col-md-4"></div>
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
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{url(asset('front/assets/plugins/Jquery-switch/dist/js/bootstrap-switch.min.js'))}}"></script>

    <script type="module">
        import {SwitchToogle} from './../front/assets/scripts/SwitchToogle.js';

        $('#card_adm').hide();
        $('#card_estoque').hide();
        $('#card_propriedades').hide();
        $('#card_sistema').hide();

        new SwitchToogle();
    </script>
@endsection
