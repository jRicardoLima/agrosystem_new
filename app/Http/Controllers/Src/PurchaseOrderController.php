<?php

namespace App\Http\Controllers\Src;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\PurchaseOrderRequest;
use App\PurchaseOrder;
use App\Utils\TemplatePurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class PurchaseOrderController extends Controller
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
        $employees = Employee::all();
        return view('admin.estoque.purchase_order')->with(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseOrderRequest $request)
    {
        $newPurchase = new PurchaseOrder();
        $requisition = rand();
        $purchases = PurchaseOrder::where('request_number','=',$requisition)->get()->first();

        if($purchases != null){
                do{
                    $requisition = rand();
                    $purchases = PurchaseOrder::where('request_number','=',$requisition)->get()->first();
                }while($purchases != null);
            }

        if($request->employee_id == $request->requesting_user){
            session()->flash('messageInfo','Warning@O solicitante e o autorizador não podem ser o mesmo');
            return back()->withInput();
        }

        $newPurchase->requesting_user = $request->requesting_user;
        $newPurchase->employee_id = $request->employee_id;
        $newPurchase->request_number = $requisition;
        $newPurchase->justification = $request->justification;
        $newPurchase->user_id = Auth::user()->id;

        $newPurchase->save();
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Gerou a requisição numero:".$requisition);
        $templatePurchase = new TemplatePurchaseOrder($request->justification,$requisition,Employee::nameEmployee($request->requesting_user)->get()->first()->name,Employee::nameEmployee($request->employee_id)->get()->first()->name,new Mpdf());
        $templatePurchase->render();

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
