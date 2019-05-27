<?php

namespace Modules\Pumps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pumps\Http\Requests\PumpRequest;
use Modules\Pumps\Repository\Interfaces\PumpInterface;

class PumpsController extends Controller
{
    /**
     * @var
     */
    protected $pumpRepository;

    /**
     * PumpController constructor.
     * @param PumpInterface $pumpRepository
     * @author Nader Ahmed
     */
    public function __construct(PumpInterface $pumpRepository)
    {
        $this->pumpRepository = $pumpRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pumps = $this->pumpRepository->getAll();
        return view('pumps::index',compact('pumps'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pumps::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(PumpRequest $request)
    {
        $this->pumpRepository->store($request->all());
        \request()->session()->put('successful',' pump is added successfully');
        return redirect('_admin_/pumps');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('pumps::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $pump = $this->pumpRepository->getById($id);
        return view('pumps::form',compact('pump'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(int $id,PumpRequest $request)
    {
        $this->pumpRepository->update($id,$request->all());
        \request()->session()->put('successful','pump is edited successfully');
        return redirect('_admin_/pumps');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->pumpRepository->delete($id);
        return redirect()->back()->with('successful',' pump is Deleted successfully');
    }
}
