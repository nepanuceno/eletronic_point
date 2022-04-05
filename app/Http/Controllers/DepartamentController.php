<?php

namespace App\Http\Controllers;

use App\Http\Requests\Departament\DepartametRequest;
use App\Services\DepartamentService;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    private $service;

    public function __construct(DepartamentService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departaments = $this->service->list($request);
        $status = $this->service->getStatusActive();
        return view('departaments.index', compact('departaments','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = $this->service->list();
        return view('departaments.create', compact('departaments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartametRequest $request)
    {
        $this->service->store($request->all());
        return redirect()->back()->with('success','Departamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departament = $this->service->get($id);
        $root = $this->service->rootDepartament()[0];
        $output = $this->service->output($root->descendants, $departament);

        $output = "<ul class=\"tree\"><li><code>".$root->name."</code>".$output."</li></ul>";
        return view('departaments.show', compact('departament', 'output'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departament = $this->service->get($id);
        $departaments = $this->service->list();
        return view('departaments.create', compact('departament','departaments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartametRequest $request, $id)
    {
        $this->service->update($request->all(), $id);
        return redirect()->route('departaments.index')
            ->with('success', "Departamento alterado com sucesso!");
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('departaments.index')
        ->with('success', "Departamento desativado com sucesso!");
    }

     /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->service->restore($id);
        return redirect()->route('departaments.index')
        ->with('success', "Departamento restaurado com sucesso!");
    }
}
