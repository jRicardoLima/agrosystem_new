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

use App\Product;

Route::get('/teste',function (){

   $companies = \App\Company::all();
   $employees = \App\Employee::all();
   $accounts = \App\Account::all();
  $arrayOne = ['a'=> 'a','b' => 'b', 'c' => 'c'];
  $arrayTwo = ['a1'=> 'a1','b2' => 'b2', 'c3' => 'c3'];
  $arrayThree = ['1'=> '1','2' => '2', '3' => '3'];
  //$objStorage = new SplObjectStorage();
  $collection = new \Doctrine\Common\Collections\ArrayCollection(['companies' => $companies,'employees' => $employees]);

  //$objStorage->attach($companies,\App\Company::all());
  //$objStorage->attach($employees,\App\Employee::all());
  //$collection->add($arrayOne);
  //$collection->add($arrayTwo);
  //$collection->add($arrayThree);
  //var_dump($collection->get('companies'));
    //var_dump($objStorage[$employees]);
  foreach ($collection['employees'] as $item){
      var_dump($item->name);
 }
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
        //Route::get('/products/delete/{product}','ProductController@delete')->name('products.delete');
        Route::get('/products/product-moviment','ProductController@productMoviment')->name('products.product-moviment');
        Route::get('/products/product-moviment-quantity/{id}','ProductController@productMovimentQuantity')->name('products.productMovimentQuantity');
        Route::post('/products/product-moviment-entry','ProductController@productMovimentEntry')->name('products.product-moviment-entry');
        Route::post('/products/product-moviment-output','ProductController@productMovimentOutput')->name('products.product-moviment-output');
        Route::get('/products/list-stock','ProductController@listStock')->name('products.list-stock');
        Route::put('/products/add-company/{product}','ProductController@addCompany')->name('products.add-company');
        Route::delete('/products/delete-supplier/{product}','ProductController@deleteSupplier')->name('products.delete-supplier');
        Route::resource('/products','ProductController');
        /** Fim dos produtos */
        /** Nota fiscal(DANFE) */
        Route::get('/invoices/download/{product_id}/{access_key}','InvoiceController@download')->name('invoices.download');
        Route::get('/invoices/show-nfe/{invoice}','InvoiceController@showNfe')->name('invoices.show-nfe');
        /** Fim da nota fisal */

        /** Ordens de compra */
        Route::resource('/purchase-orders','PurchaseOrderController');
        /** Fim das ordens de compra */
        Route::resource('/system','System');

    });
    /* Fim das rotas protegidas */
    Route::get('/logout','AuthController@logout')->name('logout');
});

Route::fallback(function(){
    return view('admin.http_errors.page_404');
});
