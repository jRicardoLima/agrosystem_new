<?php

namespace App\Http\Controllers\Src;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\ProductRequest;
use App\Invoice;
use App\Product;
use App\ProductCompanies;
use App\ProductEntry;
use App\ProductOutput;
use App\ProductStock;
use App\Unity;
use App\Utils\DocumentsValidator;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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
        return view('admin.estoque.cadastro_produtos.create')->with(['companies' => $companies]);
    }

    public function search()
    {
        $products = Product::all();
        return view('admin.estoque.cadastro_produtos.search')->with(['products' => $products] );
    }

    public function showCompanies($id)
    {
        $product = Product::find($id);

        $companiesProduct = $product->productsCompaniesRelation()->get();

        $json['companiesProduct'] = $companiesProduct;

        return response()->json($json);
    }

    public function listStock()
    {
        $products = new Product();

        return view('admin.estoque.movimentacao.show_stock')->with(['products' => $products->getStockInformationAll()]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->type = $request->type;
        $product->minimum_quantity = $request->minimum_quantity;
        $product->save();
        $id = $product->id;
        $dateNow = new \DateTime();
        foreach ($request->companies as $item) {
            ProductCompanies::insert([
                'company_id' => $item,
                'products_id' => $id,
                'created_at' => $dateNow
            ]);
        }
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Cadastrou o produto:".$request->name);
        session()->flash('messageInfo','Success@Produto cadastrado com sucesso');
        return redirect()->route('source.products.create');
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

    public function productMoviment()
    {
        $products = Product::all();
        $unities = Unity::all();
        return view('admin.estoque.movimentacao.product_movement')->with(['products' => $products,'unities' => $unities]);
    }

    public function productMovimentQuantity($id)
    {
       $product = Product::find($id);

       $json['product'] = $product;

       return response()->json($json);
    }

    public function productMovimentEntry(Request $request)
    {
        $rules = [
            'products' => 'required|exists:products,id',
            'minimum_quantity' => 'numeric',
            'quantity' => 'required|numeric',
            'invoice' => 'required|mimes:pdf',
            'access_key' => 'required|min:44'
        ];

        $request->validate($rules);
        $keyNfe = (new DocumentsValidator())->invoiceAccessKey(cleanSpaceString($request->access_key));
        if($keyNfe){

            $invoice = new Invoice();

            $invoice->product_id = $request->products;
            $invoice->access_key = cleanSpaceString($request->access_key);
            $checkKey = $invoice->where('access_key','=',$request->access_key)->get()->first();

            if($checkKey != null){

               $invoice->path = $checkKey->path;

               $invoice->save();
            } else {
                $name = $request->file('invoice')->getClientOriginalName();
                $invoice->path = $request->file('invoice')->storeAs("danfes",cleanSpaceString($request->access_key)."@".$name);

                $invoice->save();
            }


        }
        $entry = ProductEntry::create([
            'product_id_entry' => $request->products,
            'quantity' => $request->quantity
        ]);

        $stock = ProductStock::where('product_id_stock','=',$request->products)->get()->first();

        if(!empty($stock) && $stock != null) {
            $stock->quantity_current = $stock->quantity_current + $request->quantity;
            $stock->save();
            Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Deu entrada no produto:".$request->products);
            session()->flash('messageInfo','Success@Entrada realizada com sucesso');
            return redirect()->route('source.products.product-moviment');
        } else {
            $newStock = new ProductStock();
            $newStock->product_id_stock = $request->products;
            $newStock->quantity_current = $request->quantity;

            $newStock->save();

            Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Deu entrada no produto:".$request->products);
            session()->flash('messageInfo','Success@Entrada realizada com sucesso');
            return redirect()->route('source.products.product-moviment');
        }
    }

    public function productMovimentOutput(Request $request)
    {
        $rules = [
            'products' => 'required|exists:products,id',
            'minimum_quantity' => 'numeric',
            'quantity' => 'required|numeric',
            'unity_id' => 'required|exists:unities,id'
        ];

        $request->validate($rules);
        $stock = ProductStock::where('product_id_stock','=',$request->products)->get()->first();
        if(!empty($stock) && $stock != null) {
            $output = ProductOutput::create([
                'product_id_output' => $request->products,
                'quantity' => $request->quantity,
                'unity_id' => $request->unity_id
            ]);
        } else {
            session()->flash('messageInfo','Warning@Não existe este produto cadastrado no estoque');
            return back()->withInput();
        }

        if(!empty($stock) && $stock != null){
            if($stock->quantity_current > 0){
                if($stock->quantity_current < $request->quantity){
                    session()->flash('messageInfo','Warning@Saida não pode ser maior que a quantidade em estoque');
                    return back()->withInput();
                }
                $stock->quantity_current = $stock->quantity_current - $request->quantity;
                $stock->save();

                Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Deu saida no produto:".$request->products);
                session()->flash('messageInfo','Success@Saida realizada com sucesso');
                return redirect()->route('source.products.product-moviment');
            } else {
                session()->flash('messageInfo','Warning@O estoque do produto encontra-se zerado');
                return back()->withInput();
            }

        } else {
            session()->flash('messageInfo','Warning@Não existe este produto cadastrado no estoque');
            return back()->withInput();
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        $companiesAviable = (new Product)->getCompaniesAviable($id);

        return view('admin.estoque.cadastro_produtos.edit')->with(['product' => $product,'companies' => $companies,'companiesAviable' => $companiesAviable]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->type = $request->type;
        $product->minimum_quantity = $request->minimum_quantity;
        $product->save();

        session()->flash('messageInfo','Success@Dados Atualizado com sucesso');
        return redirect()->route('products.edit',['product' => $id]);
    }

    public function addCompany(Request $request, $id)
    {

        $rules = [
          'aviable_companies' => 'required|exists:companies,id'
        ];
        $request->validate($rules);

        $dateNow = new \DateTime();
        foreach ($request->aviable_companies as $item){
            ProductCompanies::insert([
                'company_id' => $item,
                'products_id' => $id,
                'created_at' => $dateNow
            ]);
        }

        session()->flash('messageInfo','Success@Fornecedor adicionado com sucesso');
        return redirect()->route('source.products.edit',['product' => $id]);
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

//    public function delete($id)
//    {
//        $product = Product::find($id);
//
//        $product->delete();
//
//        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Excluiu o produto:".$product->name);
//        session()->flash('messageInfo','Success@Produto Deletado com sucesso');
//        return redirect()->route('source.products.search');
//    }

    public function deleteSupplier(Request $request,$id)
    {
        $rules = [
            'companies' => 'required|exists:companies,id'
        ];

        $request->validate($rules);

        foreach ($request->companies as $item){

            ProductCompanies::where([
                ['products_id','=',$id],
                ['company_id','=',$item]
            ])->delete();
        }

    }
}
