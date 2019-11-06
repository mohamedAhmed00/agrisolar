<?php

namespace Modules\City\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Http\Requests\CityRequest;
use Modules\City\Repository\Interfaces\CityInterface;

class CityController extends Controller
{
    /**
     * @var
     */
    protected $cityRepository;

    /**
     * CityController constructor.
     * @param CityInterface $cityRepository
     * @author Nader Ahmed
     */
    public function __construct(CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cities = $this->cityRepository->getAll();
        return view('city::index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('city::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  CityRequest $request
     * @return Response
     */
    public function store(CityRequest $request)
    {
        $this->cityRepository->store($request->all());
        \request()->session()->put('successful',' city is added successfully');
        return redirect('_admin_/city');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('city::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $city = $this->cityRepository->getById($id);
        return view('city::form',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     * @param  CityRequest $request
     * @return Response
     */
    public function update(int $id,CityRequest $request)
    {
        $this->cityRepository->update($id,$request->all());
        \request()->session()->put('successful','city is edited successfully');
        return redirect('_admin_/city');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->cityRepository->delete($id);
        return redirect()->back()->with('successful',' city is Deleted successfully');
    }
}
