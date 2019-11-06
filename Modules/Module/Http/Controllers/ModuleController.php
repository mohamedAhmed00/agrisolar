<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Module\Http\Requests\ModuleRequest;
use Modules\Module\Repository\Interfaces\ModuleInterface;

class ModuleController extends Controller
{

    /**
     * @var
     */
    protected $moduleRepository;

    /**
     * ModuleController constructor.
     * @param ModuleInterface $moduleRepository
     * @author Nader Ahmed
     */
    public function __construct(ModuleInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $modules = $this->moduleRepository->getAll();
        return view('module::index',compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('module::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ModuleRequest $request)
    {
        $this->moduleRepository->store($request->all());
        \request()->session()->put('successful',' module is added successfully');
        return redirect('_admin_/module');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('module::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $module = $this->moduleRepository->getById($id);
        return view('module::form',compact('module'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(int $id,ModuleRequest $request)
    {
        $this->moduleRepository->update($id,$request->all());
        \request()->session()->put('successful','module is edited successfully');
        return redirect('_admin_/module');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->moduleRepository->delete($id);
        return redirect()->back()->with('successful',' module is Deleted successfully');
    }
}
