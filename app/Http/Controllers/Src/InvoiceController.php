<?php

namespace App\Http\Controllers\Src;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function download($id)
    {
        $invoice = Invoice::where('product_id','=',$id)->get()->first();

       return Storage::download($invoice->path);
    }
}
