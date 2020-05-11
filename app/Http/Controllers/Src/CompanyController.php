<?php

namespace App\Http\Controllers\Src;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\CompanyRequest;
use App\User;
use App\Utils\ControlUrls;
use App\Utils\DocumentsValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CompanyController extends Controller
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
        return view('admin.administrativo.fornecedores.create');
    }

    public function search()
    {
        $companies = Company::all();

        return view('admin.administrativo.fornecedores.search')->with([
            'companies' => $companies
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company();
        $validateDocuments = null;

        if($request->physic_person){
            $validateDocuments = (new DocumentsValidator())->cpfValid($request->document_primary);
            if($validateDocuments){
                $company->document_primary = $request->document_primary;
                $company->physic_person = 1;
            }else{
                session()->flash('messageInfo','Warning@CPF é invalido');
                return back()->withInput();
            }
        } else {
           $validateDocuments = (new DocumentsValidator())->cnpjValid($request->document_company_identification);

           if($validateDocuments){
               $company->document_company_identification = $request->document_company_identification;
           } else {
               session()->flash('messageInfo','Warning@CNPJ é invalido');
               return back()->withInput();
           }
        }

        $company->fantasy_name = $request->fantasy_name;
        $company->company_name = $request->company_name;
        $company->zipcode = $request->zipcode;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->street = $request->street;
        $company->neighborhood = $request->neighborhood;
        $company->contact_one = $request->contact_one;
        $company->contact_two = $request->contact_two;
        $company->email = $request->email;

        $company->save();
        session()->flash('messageInfo','Success@Empresa cadastrada com sucesso');
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$request->fantasy_name);
        return redirect()->route('source.companies.create');



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
        $company = Company::find($id);
        return view('admin.administrativo.fornecedores.edit')->with(['company' => $company]);
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
        $company = Company::find($id);
        $validateDocuments = null;
        if($request->physic_person){
            $validateDocuments = (new DocumentsValidator())->cpfValid($request->document_primary);
            if($validateDocuments){
                $company->document_primary = $request->document_primary;
                $company->physic_person = 1;
            }else{
                session()->flash('messageInfo','Warning@CPF é invalido');
                return back()->withInput();
            }
        } else {
            $validateDocuments = (new DocumentsValidator())->cnpjValid($request->document_company_identification);

            if($validateDocuments){
                $company->document_company_identification = $request->document_company_identification;
            } else {
                session()->flash('messageInfo','Warning@CNPJ é invalido');
                return back()->withInput();
            }
        }
        $company->fantasy_name = $request->fantasy_name;
        $company->company_name = $request->company_name;
        $company->zipcode = $request->zipcode;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->street = $request->street;
        $company->neighborhood = $request->neighborhood;
        $company->contact_one = $request->contact_one;
        $company->contact_two = $request->contact_two;
        $company->email = $request->email;
        $company->save();
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$request->fantasy_name);
        session()->flash('messageInfo','Success@Empresa Atualizada com sucesso');
        return redirect()->route('source.companies.edit',['company' => $company->id]);

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

    public function delete($id)
    {
        $company = Company::find($id);
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$company->fantasy_name);
        $company->delete();
        session()->flash('messageInfo','Success@Ação realizada com sucesso');
        return back()->withInput();
    }
}
