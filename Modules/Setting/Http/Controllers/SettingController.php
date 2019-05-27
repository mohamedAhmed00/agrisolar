<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Http\Requests\EditSettingRequest;
use Modules\Setting\Http\Requests\SettingRequest;
use Modules\Setting\Repository\Interfaces\SettingInterface;
use Validator;

class SettingController extends Controller
{
    /**
     * @var
     */
    protected $settingRepository;

    /**
     * SettingController constructor.
     * @param SettingInterface $settingRepository
     * @author Nader Ahmed
     */
    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $settings = $this->settingRepository->getAll();
        return view('setting::index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setting::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SettingRequest $request)
    {
        if($request->hasFile('value'))
        {
            $image = $request->file('value');
            $setting = $this->settingRepository->store(array_merge($request->all(),['type' => $request->get('setting_type'),'value'=>'h']));
            $image = $this->settingRepository->saveImage($image,'setting',$setting->id);
            $this->settingRepository->update($setting->id,['value' => $image->image]);
            return redirect()->back()->with('successful',' adding setting successfully');
        }
        else
        {
            $this->settingRepository->store(array_merge($request->all(),['type' => $request->get('setting_type')]));
            return redirect()->back()->with('successful',' adding setting successfully');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $setting = $this->settingRepository->getById($id);
        return view('setting::form',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id,EditSettingRequest $request
     * @return Response
     */
    public function update(int $id,EditSettingRequest $request)
    {
        if(empty($request->get('setting_type')))
        {
            $this->settingRepository->update($id,$request->all());
            return redirect()->back()->with('successful',' Edit setting successfully');
        }
        else
        {
            if($request->hasFile('value'))
            {
                $setting = $this->settingRepository->update($id,array_merge($request->all(),['type' => $request->get('setting_type'),'value'=>'h']));
                $image = $this->settingRepository->saveImage($request->file('value'),'setting',$id);
                $this->settingRepository->update($id,['value' => $image->image]);
                return redirect()->back()->with('successful',' Edit setting successfully');
            }
            else
            {
                $this->settingRepository->update($id,array_merge($request->all(),['type' => $request->get('setting_type')]));
                return redirect()->back()->with('successful',' Edit setting successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->settingRepository->delete($id);
        return redirect()->back()->with('successful',' deleting setting successfully');
    }
}
