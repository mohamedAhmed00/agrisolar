<?php

namespace Modules\FrontEnd\Http\Controllers;


use Auth;
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
     * @author Nader Ahmed
     */
    public function __construct(UserInterface $userRepository, GroupInterface $groupRepository, PumpInterface $pumpRepository, CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->pumpRepository = $pumpRepository;
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
        $cities = $this->cityRepository->getAll();
        return view('frontend::dashboard', compact('cities'));
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
        $inputs = $request->all();
        return view('frontend::dashboard', compact(['pumps', 'cities', 'inputs']));
    }

    /**
     *
     */
    public function pumpData(DataRequest $request)
    {
        $data = $this->pumpRepository->getChart($request->get('id'));
        if (null == $data) {
            return response()->json(['error' => "incorrect data"], 200, []);
        }
        return response(['chart' => $data['points'] , 'head' => $data['head'],'month' => $data['month']['points']], 200, []);
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
        return response(['chart' => $data], 200, []);
    }

    public function monthChart(MonthSearchRequest $request)
    {
        $data = $this->pumpRepository->getMonthChart($request->get('mounting_structure'),$request->get('id'),$request->get('month'));
        if (null == $data) {
            return response()->json(['error' => "incorrect data"], 200, []);
        }
        return response(['chart' => $data], 200, []);
    }
}
