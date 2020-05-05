<?php

namespace App\Http\Controllers\Src;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Src\EmployeeRequest;
use App\Occupation;
use App\Unity;
use App\User;
use App\Utils\DocumentsValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
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
    {   $occupations = Occupation::all();
        $unities = Unity::all();
        return view('admin.administrativo.funcionarios.create')->with(['occupations' => $occupations,'unities' => $unities ]);
    }

    public function search()
    {
        $employees = Employee::all();

        return view('admin.administrativo.funcionarios.search')->with(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();

        $employee->name = $request->name;

        $documentValid = (new DocumentsValidator())->cpfValid($request->document_primary);

        if($documentValid){
            $employee->document_primary = $request->document_primary;
        } else{
            session()->flash('messageInfo','Warning@CPF é invalido');
            return back()->withInput();
        }

        $employee->document_secondary = $request->document_secondary;
        $employee->document_secondary_complement = $request->document_secondary_complement;
        $employee->married = $request->married;
        $employee->children = $request->children;
        $employee->number_of_children = $request->number_of_children;
        $employee->date_birth = $request->date_birth;
        $employee->zipcode = $request->zipcode;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->street = $request->street;
        $employee->neighborhood = $request->neighborhood;
        $employee->telphone = $request->telphone;
        $employee->celphone = $request->celphone;
        $employee->email = $request->email;
        $employee->contract_date = $request->contract_date;
        $employee->salary = $request->salary;
        $employee->occupation_id = $request->occupation_id;
        $employee->unity_id = $request->unity_id;
        $employee->bank = $request->bank;
        $employee->account = $request->account;
        $employee->agency = $request->agency;

        $employee->save();
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$request->name);
        session()->flash('messageInfo','Success@Funcionario cadastrado com sucesso');
        return redirect()->route('source.employees.create');

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
        $employee = Employee::find($id);
        $occupations = Occupation::all();
        $unities = Unity::all();
        return view('admin.administrativo.funcionarios.edit')->with([
            'employee' => $employee,
            'occupations' => $occupations,
            'unities' => $unities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        $employee->name = $request->name;

        $documentValid = (new DocumentsValidator())->cpfValid($request->document_primary);

        if($documentValid){
            if($employee->document_primary != $request->document_primary){
                $employee->document_primary = $request->document_primary;
            }

        } else{

            session()->flash('messageInfo','Warning@CPF é invalido');
            return back()->withInput();
        }

        $employee->document_secondary = $request->document_secondary;
        $employee->document_secondary_complement = $request->document_secondary_complement;
        $employee->married = $request->married;
        $employee->children = $request->children;
        $employee->number_of_children = $request->number_of_children;
        $employee->date_birth = $request->date_birth;
        $employee->zipcode = $request->zipcode;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->street = $request->street;
        $employee->neighborhood = $request->neighborhood;
        $employee->telphone = $request->telphone;
        $employee->celphone = $request->celphone;
        $employee->email = $request->email;
        $employee->contract_date = $request->contract_date;
        $employee->salary = $request->salary;
        $employee->occupation_id = $request->occupation_id;
        $employee->unity_id = $request->unity_id;
        $employee->bank = $request->bank;
        $employee->account = $request->account;
        $employee->agency = $request->agency;

        $employee->save();
        Log::channel('systemLog')->info('Usuario:'.Auth::user()->name.' CPF:'.Auth::user()->document_primary." Atualizou:".$employee->name);
        session()->flash('messageInfo','Success@Funcionario Atualizado com sucesso');
        return redirect()->route('source.employees.edit',['employee' => $employee->id]);

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
        $employee = Employee::find($id);

        $employee->departure_date = new \DateTime();

        $employee->save();

        Employee::where('id','=',$id)->delete();
        session()->flash('messageInfo','Success@Ação realizada com sucesso');
        return back()->withInput();
    }
}
