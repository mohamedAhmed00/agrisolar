<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Http\Requests\EditMediaRequest;
use Modules\Media\Http\Requests\MediaRequest;
use Modules\Media\Repository\Interfaces\MediaInterface;

class MediaController extends Controller
{
    /**
     * @var
     */
    protected $mediaRepository;

    /**
     * MediaController constructor.
     * @param MediaInterface $mediaRepository
     * @author Nader Ahmed
     */
    public function __construct(MediaInterface $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $medias = $this->mediaRepository->getAll();
        return view('media::index',compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('media::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(MediaRequest $request)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $media = $this->mediaRepository->store($request->all());
            $image = $this->mediaRepository->saveImage($image,'media',$media->id);
            $this->mediaRepository->update($media->id,['image' => $image->image]);
            return redirect()->back()->with('successful',' adding media successfully');
        }
        else
        {
            $this->mediaRepository->store($request->all());
            return redirect()->back()->with('successful',' adding media successfully');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $media = $this->mediaRepository->getById($id);
        return view('media::form',compact('media'));
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id,EditMediaRequest $request
     * @return Response
     */
    public function update(int $id,EditMediaRequest $request)
    {
        if($request->hasFile('image'))
        {
            $this->mediaRepository->update($id,$request->all());
            $image = $this->mediaRepository->saveImage($request->file('image'),'media',$id);
            $this->mediaRepository->update($id,['image' => $image->image]);
            return redirect()->back()->with('successful',' Edit media successfully');
        }
        else
        {
            $this->mediaRepository->update($id,$request->all());
            return redirect()->back()->with('successful',' Edit media successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     * int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->mediaRepository->delete($id);
        return redirect()->back()->with('successful',' deleting media successfully');
    }
}
