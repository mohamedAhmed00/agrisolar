<?php

namespace Modules\Pumps\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Pumps\Entities\HeightPumps;
use Modules\Pumps\Http\Requests\HeightPumpRequest;
use Modules\Pumps\Repository\Interfaces\HeightPumpsInterface;
use Modules\Pumps\Repository\Interfaces\PumpInterface;

class HeightPumpsController extends Controller
{
    /**
     * @var
     */
    protected $heightPumpsRepository;

    /**
     * @var
     */
    protected $pumpRepository;

    /**
     * PumpController constructor.
     * @param HeightPumpsInterface $heightPumpsRepository
     * @param PumpInterface $pumpRepository
     * @author Nader Ahmed
     */
    public function __construct(HeightPumpsInterface $heightPumpsRepository, PumpInterface $pumpRepository)
    {
        $this->heightPumpsRepository = $heightPumpsRepository;
        $this->pumpRepository = $pumpRepository;
    }

    /**
     * Display a listing of the resource.
     * @param int $pump_id
     * @return Response
     */
    public function index(int $pump_id)
    {
        $heightPumps = $this->heightPumpsRepository->getHeadOrderByHead($pump_id);
        $pump = $this->pumpRepository->getById($pump_id);
        return view('pumps::index_height',compact(['heightPumps','pump']));
    }

    /**
     * Show the form for creating a new resource.
     * @param int $pump_id
     * @return Response
     */
    public function create(int $pump_id)
    {
        $pump = $this->pumpRepository->getById($pump_id);
        return view('pumps::form_height',compact('pump'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  HeightPumpRequest $request
     * @param int $pump_id
     * @return Response
     */
    public function store(HeightPumpRequest $request,int $pump_id)
    {
        if(count($this->heightPumpsRepository->getWhere(['pump_id' => $pump_id,'head' => $request->get('head')]))  != 0)
        {
            \request()->session()->put('error','head must be unique for this pump');
            return redirect()->back()->withInput();
        }
        $this->heightPumpsRepository->store(array_merge($request->all(),array('pump_id' => $pump_id)));
        return redirect('_admin_/pumps/add/height/'.$pump_id);
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
    public function edit(int $pumpHeight,int $pump_id)
    {
        $pump = $this->pumpRepository->getById($pump_id);
        $pumpHeight = $this->heightPumpsRepository->getById($pumpHeight);
        return view('pumps::form_height',compact(['pump','pumpHeight']));
    }

    /**
     * Update the specified resource in storage.
     * @param  HeightPumpRequest $request
     * @param int $pumpHeight_id
     * @param int $pump_id
     * @return Response
     */
    public function update(HeightPumpRequest $request,int $pumpHeight_id,int $pump_id)
    {
        if(count($this->heightPumpsRepository->getWhere(['pump_id' => $pump_id,'head' => $request->get('head')]))  != 0)
        {
            \request()->session()->put('error','head must be unique for this pump');
            return redirect()->back()->withInput();
        }
        $this->heightPumpsRepository->update($pumpHeight_id,array_merge($request->all(),array('pump_id' => $pump_id)));
        return redirect('_admin_/pumps/add/height/'.$pump_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->heightPumpsRepository->delete($id);
        return redirect()->back()->with('successful',' pump Height is Deleted successfully');
    }
}
