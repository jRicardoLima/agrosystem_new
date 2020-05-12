<?php

namespace App\Http\Controllers\Src;

use App\Account;
use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\AccountRequest;
use App\Invoice;
use App\PurchaseOrder;
use App\Utils\DocumentsValidator;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
       return view('admin.administrativo.financeiro.create')->with(['companies' => $companies,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {

       $validKeyAccess = (new DocumentsValidator())->invoiceAccessKey(cleanSpaceString($request->access_key_id));
       if($validKeyAccess){

           $newAccount = new Account();
           $newAccount->company_id = $request->company_id;
           $newAccount->type_payment = $request->type_payment;
           $newAccount->installments = $request->installments;
           $newAccount->value = $request->value;
           $newAccount->due_date = $request->due_date;
           $newAccount->status = $request->status;

           $keyAccess = Invoice::accessKey(cleanSpaceString($request->access_key_id))->get()->first();

           if($keyAccess){
               $newAccount->access_key_id = $keyAccess->id;
           } else {
               session()->flash('messageInfo','Warning@Nota fiscal não existe no banco de dados');
               return back()->withInput();
           }
           $requestNumber = PurchaseOrder::requestNumber(clearVars(['-',' ','.','*'],$request->request_number_id))->get()->first();

           if($requestNumber){
               $newAccount->request_number_id = $requestNumber->id;
           }

          $newAccount->save();
       }else{
           session()->flash('messageInfo','Warning@Chave de acesso invalido');
           return back()->withInput();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
