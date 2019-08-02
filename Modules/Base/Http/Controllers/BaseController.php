<?php

namespace Modules\Base\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contact\Repository\Interfaces\ContactInterface;
use Modules\Services\Repository\Interfaces\ServiceInterface;
use Modules\Users\Repository\Interfaces\UserInterface;

class BaseController extends Controller
{

    /**
     * @var
     */
    protected $userRepository;

    /**
     * @var
     */
    protected $messageRepository;

    /**
     * @var
     */
    protected $serviceRepository;
    /**
     * ServicesController constructor.
     * @author Nader Ahmed
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();
        $data = getHomeCounts();
        return view('base::index',compact(['users','data']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('base::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('base::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('base::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
