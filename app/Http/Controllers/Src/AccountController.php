<?php

namespace App\Http\Controllers\Src;

use App\Account;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\AccountRequest;
use App\Installment;
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
            $accounts = Account::all();
            $hasKey = null;
            foreach ($accounts as $account){
                if($account->invoiceRelation()->get()->first()->access_key == cleanSpaceString($request->access_key_id)){
                    $hasKey = true;
                } else {
                    $hasKey = false;
                }
            }
            if($hasKey){
                session()->flash('messageInfo','Warning@Esta nota já está cadastrada');
                return redirect()->route('source.accounts.create');
            }
           $newAccount = new Account();
           $newAccount->company_id = $request->company_id;
           $newAccount->type_payment = $request->type_payment;

           $keyAccess = Invoice::accessKey(cleanSpaceString($request->access_key_id))->get()->first();

           if($keyAccess){
               $newAccount->access_key_id = $keyAccess->id;
           } else {
               session()->flash('messageInfo','Warning@Nota fiscal não existe no banco de dados');
               return back()->withInput();
           }
           $requestNumber = PurchaseOrder::requestNumber(clearVars(['-',' ','.','*'],$request->request_number_id))->get()->first();

           if($requestNumber != null){
               $newAccount->request_number_id = $requestNumber->id;
           }

          $newAccount->save();
           $newInstallments = new Installment();
           $result = $newInstallments->searchNullValues($request->data);

           $value = null;
           $dueDate = null;
           $status = null;
           if($result){
               $cont = 3;
               foreach ($request->data as $key => $data){

                   if($cont == 3){
                       $value = $data;
                   } elseif($cont == 2){
                       $dueDate = $data;
                   } elseif($cont == 1){
                       $status = $data;
                   }
                   $cont--;
                   if($cont == 0){
                       $cont = 3;
                       Installment::insert([
                           'number_installments' => $request->number_installment,
                           'value' => floatval(converStringToDouble($value)),
                           'due_date' =>$dueDate,
                           'account_id' => $newAccount->id,
                           'status' => ($status == '0' ? 0 : 1),
                           'created_at' => new \DateTime()
                       ]);
                   }
               }
               session()->flash('messageInfo','Success@Conta cadastrada com sucesso');
               return redirect()->route('source.accounts.create');
           } else {
               session()->flash('messageInfo','Warning@As parcelas não podem ser nulas');
               return back()->withInput();
           }
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
