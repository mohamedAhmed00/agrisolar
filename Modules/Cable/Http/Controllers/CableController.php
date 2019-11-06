<?php

namespace Modules\Cable\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cable\Http\Requests\CableRequest;
use Modules\Cable\Repository\Interfaces\CableInterface;

class CableController extends Controller
{
    /**
     * @var
     */
    protected $cableRepository;

    /**
     * CableController constructor.
     * @param CableInterface $cableRepository
     * @author Nader Ahmed
     */
    public function __construct(CableInterface $cableRepository)
    {
        $this->cableRepository = $cableRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cables = $this->cableRepository->getAll();
        return view('cable::index',compact('cables'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cable::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  CableRequest $request
     * @return Response
     */
    public function store(CableRequest $request)
    {
        $this->cableRepository->store($request->all());
        \request()->session()->put('successful',' cable is added successfully');
        return redirect('_admin_/cable');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('cable::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $cable = $this->cableRepository->getById($id);
        return view('cable::form',compact('cable'));
    }

    /**
     * Update the specified resource in storage.
     * @param  CableRequest $request
     * @return Response
     */
    public function update(int $id,CableRequest $request)
    {
        $this->cableRepository->update($id,$request->all());
        \request()->session()->put('successful','cable is edited successfully');
        return redirect('_admin_/cable');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->cableRepository->delete($id);
        return redirect()->back()->with('successful',' cable is Deleted successfully');
    }
}
