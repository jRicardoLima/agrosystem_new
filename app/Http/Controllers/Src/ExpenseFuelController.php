<?php

namespace App\Http\Controllers\Src;

use App\ExpenseFuel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\ExpenseFuelRequest;
use App\PurchaseOrder;
use App\Utils\DocumentsValidator;
use Illuminate\Http\Request;

class ExpenseFuelController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseFuelRequest $request)
    {

        $keyNfe = (new DocumentsValidator())->invoiceAccessKey(cleanSpaceString($request->invoice_fuel_key));
        if($keyNfe){
            $expenseFuel = new ExpenseFuel();

            $expenseFuel->name_product = $request->name_product_fuel;
            $expenseFuel->access_key = $request->invoice_fuel_key;
            $expenseFuel->quantity = $request->quantity_fuel;
            $expenseFuel->type = $request->type_quantity_fuel;
            $expenseFuel->value = $request->value_fuel;
            $expenseFuel->due_date = $request->due_date_fuel;
            $expenseFuel->status = $request->status_fuel;
            $expenseFuel->company_id = $request->company_id;
            $idRequest = PurchaseOrder::requestNumber($request->number_request_fuel)->get()->first();

            if($idRequest != null){
                $expenseFuel->purchase_id = $idRequest->id;
            }else{
                session()->flash('messageInfo','Warning@Requisição não existe');
                return back()->withInput();
            }
            $checkKey = $expenseFuel->where('access_key','=',$request->invoice_fuel_key)->get()->first();

            if($checkKey != null){
                $expenseFuel->danfe_path = $checkKey->danfe_path;
                $expenseFuel->save();
                session()->flash('messageInfo','Success@Lançamento realizado com sucesso');
                return redirect()->route('source.accounts.create');
            } else {
                $name = $request->file('danfe')->getClientOriginalName();
                $expenseFuel->danfe_path = $request->file('danfe')->storeAs('danfes_fuel',cleanSpaceString($request->invoice_fuel_key)."@".$name);
                $expenseFuel->save();
                session()->flash('messageInfo','Success@Lançamento realizado com sucesso');
                return redirect()->route('source.accounts.create');
            }
        } else {
            session()->flash('messageInfo','Warning@Chave de acesso invalida');
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
