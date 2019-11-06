<?php

namespace Modules\Groups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Groups\Http\Requests\GroupRequest;
use Modules\Groups\Http\Requests\UpdateGroupRequest;
use Modules\Groups\Repository\Interfaces\GroupInterface;

class GroupsController extends Controller
{

    /**
     * @var
     */
    protected $groupRepository;

    /**
     * ServicesController constructor.
     * @param GroupInterface $groupRepository
     * @author Nader Ahmed
     */
    public function __construct(GroupInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $groups = $this->groupRepository->getAll();
        return view('groups::index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('groups::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(GroupRequest $request)
    {
        $this->groupRepository->storePermission($request->all());
        return redirect()->back()->with('successful',' adding group successfully');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $group = $this->groupRepository->getById($id);
        return view('groups::form',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     * @param  UpdateGroupRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(int $id , UpdateGroupRequest $request)
    {
        $this->groupRepository->updatePermission($id,$request->all());
        return redirect()->back()->with('successful',' updating Group successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->groupRepository->delete($id);
        return redirect()->back()->with('successful',' Deleting Group successfully');

    }
}
