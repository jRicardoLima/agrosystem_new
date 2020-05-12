<?php

namespace App\Http\Controllers\Src;

use App\Http\Controllers\Controller;
use App\Invoice;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function download($id,$accessKey)
    {

        $invoice = Invoice::where([
            ['product_id','=',$id],
            ['access_key','=',$accessKey]
        ])->get()->first();

       return Storage::download($invoice->path);
    }

    public function showNfe($id)
    {
       $invoice = Invoice::where('product_id','=',$id)->orderBy('created_at','DESC')->get();

       $json = [];
        if($invoice){
            $json['invoice'] = $invoice ;
            return response()->json($json);
        } else {
            $json['message'] = 'Produto não possui notas fiscais';
            return response()->json($json);
        }

    }
}
