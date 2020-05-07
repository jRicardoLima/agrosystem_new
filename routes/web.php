<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/teste',function (){
//    $cnpj = convertCNPJ('61648289000144');
//    //61.648.289/0001-44
//    echo $cnpj;

   //$company = \App\Company::onlyTrashed()->where('id','=',5)->get()->first();

    //$company->restore();

    //var_dump(Route::currentRouteAction());
});

Route::group(['namespace' => 'Src', 'as' => 'source.'],function(){
    Route::get('/','AuthController@index')->name('source.index');
    Route::post('/login','AuthController@login')->name('source.login');

    /* Rotas protegidas*/
    Route::group(['middleware' => ['auth']],function (){
        Route::get('/dashboard','AuthController@home')->name('home');
        /** Usuarios */
        Route::get('/users/search','UserController@search')->name('users.search');
        Route::put('/users/update-password/{user}','UserController@updatePassword')->name('users.updatePassword');
        Route::get('/users/delete/{user}','UserController@delete')->name('users.delete');
        Route::resource('/users','UserController');
        /** Fim dos usuarios */

        /** Menus */
        Route::get('/menus/permissions','MenuController@permissions')->name('menus.permissions');
        Route::post('/menus/store-permissions','MenuController@storePermissions')->name('menus.storePermissions');
        Route::put('/menus/update-permissions/{user}','MenuController@updatePermission')->name('menus.updatePermission');
        /** Fim dos menus */
        /** Funcionarios */
        Route::get('/employees/search','EmployeeController@search')->name('employees.search');
        Route::get('/employees/delete/{employee}','EmployeeController@delete')->name('employees.delete');
        Route::resource('/employees','EmployeeController');
        /** Fim dos funcionarios */
        /** Fornecedores */
        Route::get('/companies/search','CompanyController@search')->name('companies.search');
        Route::get('/companies/delete/{company}','CompanyController@delete')->name('companies.delete');
        Route::resource('/companies','CompanyController');
        /** Fim dos fornecedores */

        /** Contas */
        Route::resource('/accounts','AccountController');
        /** Fim das contas */

        /** Produtos */
        Route::get('/products/search','ProductController@search')->name('products.search');
        Route::get('/products/show-companies/{product}','ProductController@showCompanies')->name('products.show-companies');
        Route::resource('/products','ProductController');
        /** Fim dos produtos */
        Route::resource('/system','System');

    });
    /* Fim das rotas protegidas */
    Route::get('/logout','AuthController@logout')->name('logout');
});

Route::fallback(function(){
    return view('admin.http_errors.page_404');
});
