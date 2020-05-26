<?php

namespace App\Http\Controllers\Src;

use App\FixedAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\FixedAccountRequest;
use Illuminate\Http\Request;

class FixedAccountController extends Controller
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
    public function store(FixedAccountRequest $request)
    {
        $fixedAccount = new FixedAccount();

        $fixedAccount->name_fixed_product = $request->name_fixed_product;
        $fixedAccount->companies_id = $request->company_id;
        $fixedAccount->type = $request->type_payment;
        $fixedAccount->value = $request->value;
        $fixedAccount->due_date = $request->due_date;
        $fixedAccount->status = $request->status;

        $fixedAccount->save();
        session()->flash('messageInfo','Success@Despesa fixa cadastrada com sucesso');
        return redirect()->route('source.accounts.create');
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
