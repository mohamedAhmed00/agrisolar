<?php

namespace Modules\FrontEnd\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\FrontEnd\Http\Requests\EditRequest;
use Modules\FrontEnd\Http\Requests\LoginRequest;
use Modules\FrontEnd\Http\Requests\RegisterRequest;
use Modules\FrontEnd\Http\Requests\SearchRequest;
use Modules\Groups\Repository\Interfaces\GroupInterface;
use Auth;
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
     * ServicesController constructor.
     * @param UserInterface $userRepository
     * @param GroupInterface $groupRepository
     * @author Nader Ahmed
     */
    public function __construct(UserInterface $userRepository,GroupInterface $groupRepository,PumpInterface $pumpRepository)
    {
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
        return view('frontend::dashboard');
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
                }
                else
                {
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
            $user = $this->userRepository->store(array_merge($request->except(['password_confirmation','_token']),['group_id'=>$this->groupRepository->getWhere(['slug' => $settings['public user group']->value])->first()->id]));
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
        $this->userRepository->update(auth()->user()->id,$request->all());
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
        $pumps = $this->pumpRepository->search($request->all());
        return view('frontend::dashboard',compact('pumps'))->withInput(Input::all());
    }
}
