<?php

namespace Modules\Radiation\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Repository\Interfaces\CityInterface;
use Modules\Radiation\Http\Requests\RadiationEditRequest;
use Modules\Radiation\Http\Requests\RadiationRequest;
use Modules\Radiation\Import\RadiationImport;
use Modules\Radiation\Repository\Interfaces\RadiationInterface;
use Maatwebsite\Excel\Facades\Excel;

class RadiationController extends Controller
{
    /**
     * @var
     */
    protected $radiationRepository;

    /**
     * @var
     */
    protected $cityRepository;

    /**
     * RadiationController constructor.
     * @param RadiationInterface $radiationRepository
     * @param CityInterface $cityRepository
     * @author Nader Ahmed
     */
    public function __construct(RadiationInterface $radiationRepository,CityInterface $cityRepository)
    {
        $this->radiationRepository = $radiationRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     * @param int $city_id
     * @param string $type
     * @return Response
     */
    public function index(int $city_id, string $type)
    {
        $radiations = $this->radiationRepository->getWhere(['city_id' => $city_id,'type' => $type]);
        $city = $this->cityRepository->getById($city_id);
        return view('radiation::index',compact(['radiations','city','type']));
    }

    /**
     * Show the form for creating a new resource.
     * @param int $city_id
     * @param  string $type
     * @return Response
     */
    public function create(int $city_id,string $type)
    {
        $city = $this->cityRepository->getById($city_id);
        return view('radiation::form',compact(['city','type']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  RadiationRequest $request
     * @param  int $id
     * @param  string $type
     * @return Response
     */
    public function store(RadiationRequest $request,int $id,string $type)
    {
        Excel::import(new RadiationImport(), request()->file('file_radiation'));
        $this->radiationRepository->saveAverage($id,$type);
        \request()->session()->put('successful',' radiations are added successfully');
        return redirect('_admin_/radiation/view/' . $id . '/' . $type);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @param int $city_id
     * @param  string $type
     * @return Response
     */
    public function edit(int $id,int $city_id,string $type)
    {
        $radiation = $this->radiationRepository->getById($id);
        $city = $this->cityRepository->getById($city_id);
        return view('radiation::form_edit',compact(['radiation','city','type']));
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @param  int $city_id
     * @param  string $type
     * @param  RadiationEditRequest $request
     * @return Response
     */
    public function update(int $id,int $city_id,string $type,RadiationEditRequest $request)
    {
        $data = $request->only(['january','february','march','april','may','june','july','august','september','october','november','december']);
        $this->radiationRepository->update($id,array_merge($request->all(),['avg' => array_sum($data) / count($data)]));
        $this->radiationRepository->updateAverage($city_id,$type);
        \request()->session()->put('successful','radiation is edited successfully');
        return redirect('_admin_/radiation/view/' . $city_id . '/' . $type);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $radiation = $this->radiationRepository->getById($id);
        $this->radiationRepository->delete($id);
        $this->radiationRepository->updateAverage($radiation->city_id,$radiation->type);
        return redirect()->back()->with('successful',' radiation is Deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroyAll(int $city_id,string $type)
    {
        $this->radiationRepository->deleteAll($city_id,$type);
        return redirect()->back()->with('successful',' radiation is Deleted successfully');
    }
}
