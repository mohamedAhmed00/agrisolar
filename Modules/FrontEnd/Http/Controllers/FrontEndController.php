<?php

namespace Modules\FrontEnd\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\City\Repository\Interfaces\CityInterface;
use Modules\FrontEnd\Http\Requests\DataRequest;
use Modules\FrontEnd\Http\Requests\EditRequest;
use Modules\FrontEnd\Http\Requests\LoginRequest;
use Modules\FrontEnd\Http\Requests\MonthSearchRequest;
use Modules\FrontEnd\Http\Requests\RegisterRequest;
use Modules\FrontEnd\Http\Requests\SearchRequest;
use Modules\Groups\Repository\Interfaces\GroupInterface;
use Modules\Module\Repository\Interfaces\ModuleInterface;
use Modules\Pumps\Repository\Interfaces\HeightPumpsInterface;
use Modules\Pumps\Repository\Interfaces\PumpInterface;
use Modules\Users\Repository\Interfaces\UserInterface;

class FrontEndController extends Controller
{

    /**
     * @var
     */
    protected $userRepository;

    /**
     * @var
     */
    protected $groupRepository;

    /**
     * @var
     */
    protected $pumpRepository;

    /**
     * @var
     */
    protected $cityRepository;

    /**
     * ServicesController constructor.
     * @param UserInterface $userRepository
     * @param GroupInterface $groupRepository
     * @param PumpInterface $pumpRepository
     * @param CityInterface $cityRepository
     * @param ModuleInterface $module
     * @author Nader Ahmed
     */
    public function __construct(UserInterface $userRepository, GroupInterface $groupRepository, PumpInterface $pumpRepository, CityInterface $cityRepository,ModuleInterface $module)
    {
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->pumpRepository = $pumpRepository;
        $this->module = $module;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        return view('frontend::login');
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function getFormRegister()
    {
        return view('frontend::register');
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function dashboard()
    {
        $existingPumps = $this->pumpRepository->getAll();
        $cities = $this->cityRepository->getAll();
        $modules = $this->module->getAll();
        return view('frontend::dashboard', compact(['cities','modules','existingPumps']));
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function getProfile()
    {
        return view('frontend::profile');
    }

    /**
     * Display a listing of the resource.
     * @param LoginRequest $request
     * @return View
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();
        $settings = getSetting();
        if (!empty($settings['public user group']->value)) {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if ($this->userRepository->checkAuth() === true) {
                    return redirect()->intended('dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->with('unauth', 'You Are An Admin Not Website User, Go To Admin Dashboard To Login');
                }
            } else {
                return redirect()->back()->with('unauth', 'Email and Password Dont Match any account');
            }
        } else {
            return redirect()->back()->with('unauth', 'No User Group Exist Try Again Later');

        }
    }

    /**
     * Display a listing of the resource.
     * @param RegisterRequest $request
     * @return View
     */
    public function register(RegisterRequest $request)
    {
        $settings = getSetting();
        if (!empty($settings['public user group']->value)) {
            $user = $this->userRepository->store(array_merge($request->except(['password_confirmation', '_token']), ['group_id' => $this->groupRepository->getWhere(['slug' => $settings['public user group']->value])->first()->id]));
            Auth::attempt(['email' => $user['email'], 'password' => $request->only('password')['password']]);
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->with('unauth', 'No User Group Exist Try Again Later');
    }

    /**
     * Display a listing of the resource.
     * @param RegisterRequest $request
     * @return View
     */
    public function editProfile(EditRequest $request)
    {
        $this->userRepository->update(auth()->user()->id, $request->all());
        return redirect()->back()->with('successful', 'Your Profile Is Modified Successfully');
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function search(SearchRequest $request)
    {
        $cities = $this->cityRepository->getAll();
        $pumps = $this->pumpRepository->search($request->all());
        $modules = $this->module->getAll();
        $inputs = $request->all();
        $existingPumps = $this->pumpRepository->getAll();
        return view('frontend::dashboard', compact(['pumps', 'cities', 'inputs','modules','existingPumps']));
    }

    /**
     *
     */
    public function pumpData(DataRequest $request)
    {
        $data = $this->pumpRepository->getChart($request);
        if (null == $data) {
            return response()->json(['error' => "incorrect data"], 200, []);
        }
        $row = array_search(true,array_column($data['pvgen_array'],'selected'));
        return response(['avg'=> $data['avg'],'pvgen_array' => $data['pvgen_array'][$row],'chart' => $data['points'] , 'head' => $data['head'],'month' => $data['month']['points']], 200, []);
    }

    /**
     *
     */
    public function pumpDataSearch(DataRequest $request)
    {
        $data = $this->pumpRepository->getChartWithSearch();
        if (null == $data) {
            return response()->json(['error' => "incorrect data"], 200, []);
        }
        $row = array_search(true,array_column($data['pvgen_array'],'selected'));
        $data['year'][] = array('avg' , $data['avg']);
        return response(['avg'=> $data['avg'],'chart' => $data,'pvgen_array' => $data['pvgen_array'][$row]], 200, []);
    }

    public function monthChart(MonthSearchRequest $request)
    {
        $monthPoints = $this->pumpRepository->getMonthChart($request->get('mounting_structure'),$request->get('id'),$request->get('month'));
        if (null == $monthPoints) {
            return response()->json(['error' => "incorrect data"], 200, []);
        }
//        $avgMonth = 0;
        foreach ($monthPoints['points'] as $key => $monthPoint){
//            $avgMonth += $monthPoint;
            $arr['month']['points'][] = array($key , $monthPoint);
        }
//        $arr['month']['points'][] = array('avg',round($avgMonth/count($arr['month']['points']),2));

        return response(['chart' => $arr['month']['points']], 200, []);
    }

    public function getPDF(Request $request,HeightPumpsInterface $heightPumpsRepository){

        $data = $this->pumpRepository->generatePDF($request);
        $heightPumps = $heightPumpsRepository->getHead($data['model']->id,$request->get('dynamic_head'));
        $heightPumps = is_array($heightPumps)? $heightPumps[0] : $heightPumps;
        return view('frontend::getPDF',compact(['data','heightPumps']));
    }

    public function download($path){
        $headers = ['Content-Type: application/pdf'];
        return response()->download($path);
    }
}
