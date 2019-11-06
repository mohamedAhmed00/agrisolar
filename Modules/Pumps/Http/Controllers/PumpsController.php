<?php

namespace Modules\Pumps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Repository\Interfaces\MediaInterface;
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
    public function create(MediaInterface $media)
    {
        $medias = $media->getAll();
        return view('pumps::form',compact('medias'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(PumpRequest $request)
    {
        $pump = $this->pumpRepository->store($request->all());
        $this->pumpRepository->saveMedia($pump,$request->get('media'),$request->get('order'));
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
    public function edit(int $id,MediaInterface $media)
    {
        $medias = $media->getAll();
        $pump = $this->pumpRepository->getById($id);
        $selectedPumps = json_decode(json_encode($this->pumpRepository->getMedia($id)),true);
        return view('pumps::form',compact(['pump','medias','selectedPumps']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(int $id,PumpRequest $request)
    {
        $this->pumpRepository->update($id,$request->all());
        $pump = $this->pumpRepository->getById($id);
        $this->pumpRepository->saveMedia($pump,$request->get('media'),$request->get('order'));
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
