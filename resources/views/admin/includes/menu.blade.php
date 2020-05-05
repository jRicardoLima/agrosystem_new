<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="{{(\Illuminate\Support\Facades\Storage::url('logo/logo.jpg'))}}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Agro-System</span>
    </a>
    @php
        $user = \App\User::find(\Illuminate\Support\Facades\Auth::user()->id);
        $menusUnlocked = $user->menusRelation()->where('authorization','=',1)->get()
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(\App\User::avatar(\Illuminate\Support\Facades\Auth::user()->id)->get()->first()->avatar != null && \App\User::avatar(\Illuminate\Support\Facades\Auth::user()->id)->get()->first()->avatar !="")
                    <img src="{{\Illuminate\Support\Facades\Storage::url(\App\User::avatar(\Illuminate\Support\Facades\Auth::user()->id)->get()->first()->avatar)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{\Illuminate\Support\Facades\Storage::url('avatar/imagemPadrao.jpg')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{lengthName(\Illuminate\Support\Facades\Auth::user()->name)}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p>Administrativo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Funcionarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($menusUnlocked as $menus)
                                    @if($menus->name_sub_module == 'cadastrar' && $menus->name_module == 'administrativo_funcionarios')
                                        <li class="nav-item">
                                            <a href="{{route('source.employees.create')}}" class="nav-link  {{isActive('source.employees.create')}}">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Cadastar</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                @foreach($menusUnlocked as $menus)
                                   @if($menus->name_sub_module == 'pesquisar' && $menus->name_module == 'administrativo_funcionarios')
                                        <li class="nav-item">
                                            <a href="{{route('source.employees.search')}}" class="nav-link {{isActive('source.employees.search')}}">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Pesquisar</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                    <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Fornecedores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($menusUnlocked as $menus)
                                    @if($menus->name_sub_module == 'cadastrar' && $menus->name_module == 'administrativo_fornecedores')
                                        <li class="nav-item">
                                            <a href="{{route('source.companies.create')}}" class="nav-link {{isActive('source.companies.create')}}">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Cadastar</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                    @foreach($menusUnlocked as $menus)
                                        @if($menus->name_sub_module == 'pesquisar' && $menus->name_module == 'administrativo_fornecedores')
                                            <li class="nav-item">
                                                <a href="{{route('source.companies.search')}}" class="nav-link {{isActive('source.companies.search')}}">
                                                    <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                    <p>Pesquisar</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>



                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Finaceiro
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($menusUnlocked as $menus)
                                    @if($menus->name_sub_module == 'cadastrar_contas' && $menus->name_module == 'administrativo_financeiro' )
                                        <li class="nav-item">

                                            <a href="{{route('source.accounts.create')}}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Cadastrar contas</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                @foreach($menusUnlocked as $menus)
                                    @if($menus->name_sub_module == 'contas_a_pagar' && $menus->name_module == 'administrativo_financeiro')
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Contas a pagar</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                    @foreach($menusUnlocked as $menus)
                                        @if($menus->name_sub_module == 'contas_a_receber' && $menus->name_module == 'administrativo_financeiro')
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                    <p>Contas a receber</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @foreach($menusUnlocked as $menus)
                                        @if($menus->name_sub_module == 'caixa' && $menus->name_module == 'administrativo_financeiro')
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                    <p>Caixa</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Estoque -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p>Estoque
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                     @foreach($menusUnlocked as $menus)
                       @if($menus->name_sub_module == 'ordens_de_compra' && $menus->name_module == 'estoque_ordens_compra')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon text-danger"></i>
                                    <p>Ordens de compra</p>
                                </a>
                            </li>
                       @endif
                     @endforeach
                         <hr style="border: 2px solid darkgrey"/>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Cadastro de produtos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($menusUnlocked as $menus)
                                 @if($menus->name_sub_module == 'cadastrar' && $menus->name_module == 'estoque_cadastro_produtos')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Cadastar</p>
                                        </a>
                                    </li>
                                 @endif
                                @endforeach

                              @foreach($menusUnlocked as $menus)
                                  @if($menus->name_sub_module == 'pesquisar' && $menus->name_module == 'estoque_cadastro_produtos')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Pesquisar</p>
                                        </a>
                                    </li>
                                @endif
                              @endforeach
                                    <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Movimentação
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                             @foreach($menusUnlocked as $menus)
                               @if($menus->name_sub_module == 'entrada' && $menus->name_module == 'estoque_movimentacao')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Entrada</p>
                                        </a>
                                    </li>
                               @endif
                             @endforeach


                             @foreach($menusUnlocked as $menus)
                              @if($menus->name_sub_module == 'saida' && $menus->name_module == 'estoque_movimentacao')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Saida</p>
                                        </a>
                                    </li>
                              @endif
                             @endforeach
                                 <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>
                </li>


                <!-- Propriedades -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p>Propriedades
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Gestão de propriedades
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                             @foreach($menusUnlocked as $menus)
                               @if($menus->name_sub_module == 'cadastrar' && $menus->name_module == 'propriedades_gestao_de_propriedades')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                               @endif
                             @endforeach

                                @foreach($menusUnlocked as $menus)
                                 @if($menus->name_sub_module == 'cadastrar_pastos' && $menus->name_module == 'propriedades_gestao_de_propriedades')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Cadastrar pastos</p>
                                        </a>
                                    </li>
                                 @endif
                                @endforeach

                                 @foreach($menusUnlocked as $menus)
                                     @if($menus->name_sub_module == 'pesquisar' && $menus->name_module == 'propriedades_gestao_de_propriedades')
                                         <li class="nav-item">
                                             <a href="#" class="nav-link">
                                                 <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                 <p>Pesquisar</p>
                                             </a>
                                         </li>
                                     @endif
                                 @endforeach
                                 <hr style="border: 2px solid darkgrey"/>
                            </ul>

                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    <p>Animais</p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>

                            <ul class="nav nav-treeview">
                                @foreach($menusUnlocked as $menus)
                                    @if($menus->name_sub_module == 'cadastro_de_rebanho' && $menus->name_module == 'propriedades_animais')
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                <p>Cadastro de rebanho</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                <hr style="border: 2px solid darkgrey"/>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Movimentação</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        @foreach($menusUnlocked as $menus)
                                            @if($menus->name_sub_module == 'entrada' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                        <p>Entrada</p>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'saida' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Saida</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'manejo' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Manejo</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'pesagens' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Pesagens</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'compra' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Compra</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'venda' && $menus->name_module == 'propriedades_animais_movimentacao')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Venda</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                    </ul>
                                </li>
                                <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>
                    </ul>

                    <!-- Vacinas-->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Vacinas</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                              @foreach($menusUnlocked as $menus)
                                @if($menus->name_sub_module == 'cadastro_de_lotes' && $menus->name_module == 'propriedades_vacinas')
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Cadastro de lotes</p>
                                        </a>
                                    </li>
                                @endif
                              @endforeach
                                  <hr style="border: 2px solid darkgrey"/>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Estoque</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach($menusUnlocked as $menus)
                                            @if($menus->name_sub_module == 'entrada' && $menus->name_module == 'propriedades_estoque_vacinas')
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                        <p>Entrada</p>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                            @foreach($menusUnlocked as $menus)
                                                @if($menus->name_sub_module == 'saida' && $menus->name_module == 'propriedades_estoque_vacinas')
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                            <p>Saida</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                    </ul>
                                    <hr style="border: 2px solid darkgrey"/>
                                </li>

                            </ul>

                        </li>
                    </ul>
                </li>

                <!-- Sistema-->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p>Sistema
                            <i class="right fas fa-angle-left"></i>
                        </p>

                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Gestão de usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                             @foreach($menusUnlocked as $menus)
                               @if($menus->name_sub_module == 'cadastrar' && $menus->name_module == 'sistema_gestao_usuario')
                                    <li class="nav-item">
                                        <a href="{{route('source.users.create')}}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon text-danger"></i>
                                            <p>Cadastrar</p>
                                        </a>
                                    </li>
                               @endif
                             @endforeach

                                 @foreach($menusUnlocked as $menus)
                                     @if($menus->name_sub_module == 'pesquisar' && $menus->name_module == 'sistema_gestao_usuario')
                                         <li class="nav-item">
                                             <a href="{{route('source.users.search')}}" class="nav-link">
                                                 <i class="far fa-dot-circle nav-icon text-danger"></i>
                                                 <p>Pesquisar</p>
                                             </a>
                                         </li>
                                     @endif
                                 @endforeach
                                 <hr style="border: 2px solid darkgrey"/>
                            </ul>
                        </li>

                        @foreach($menusUnlocked as $menus)
                            @if($menus->name_sub_module == 'permissoes' && $menus->name_module == 'sistema_permissoes')
                                <li class="nav-item">
                                    <a href="{{route('source.menus.permissions')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon text-danger"></i>
                                        <p>Permissões</p>
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        @foreach($menusUnlocked as $menus)
                            @if($menus->name_sub_module == 'parametrizacao' && $menus->name_module == 'sistema_parametrizacao')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon text-danger"></i>
                                        <p>Parametrização</p>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

