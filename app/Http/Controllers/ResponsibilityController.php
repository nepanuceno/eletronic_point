<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponsibilityService;

class ResponsibilityController extends Controller
{
    private $service;

    public function __construct(ResponsibilityService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsibilities = $this->service->listResponsibilities();
        return view('responsibilities.index', compact('responsibilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('responsibilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service->createResponsibility($request->all());
        return redirect()->route('responsibilities.index')->with('success', __('responsibility.success_create_responsibility'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responsibility = $this->service->getResponsibility($id);
        return view('responsibilities.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsibility = $this->service->getResponsibility($id);
        return view('responsibilities.create', compact('responsibility'));
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
        $this->service->updateResponsibility($request->all(), $id);

        return redirect()->route('responsibilities.index')->with('success', __('responsibility.success_edit_responsibility'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroyResponsibility($id);
    }
}
