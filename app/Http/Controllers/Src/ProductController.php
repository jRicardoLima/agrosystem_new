<?php

namespace App\Http\Controllers\Src;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\ProductRequest;
use App\Product;
use App\ProductCompanies;
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
