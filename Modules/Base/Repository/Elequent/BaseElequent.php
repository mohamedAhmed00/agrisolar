<?php

namespace Modules\Base\Repository\Elequent;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Support\Facades\File;
use Modules\Base\Entities\Image;
use Modules\Base\Repository\Interfaces\BaseInterface;

class BaseElequent implements BaseInterface
{

    /**
    * @var
    */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('created_at','DESC')->get();
    }

    /**
     * @param $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function update(int $id,$data)
    {
       return $this->getById($id)->update($data);
    }

    /**
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * @param int $pivot_id
     * @param string $type
     * @param $image
     * @auther Nader Ahmed
     * @return mixed
     */
    public function saveImage($image,string $type,int $pivot_id)
    {
        $this->removeImageFromLocation($pivot_id,$type);
        $this->removeImageFromDatabase($pivot_id,$type);
        $path = $this->UplaodImage($image, $type);
        return Image::create(['image' => $path,'pivot_id'=> $pivot_id,'type'=> $type]);
    }

    /**
     * @param string $type
     * @param $image
     * @auther Nader Ahmed
     * @return mixed
     */
    private function UplaodImage($image,string $type):string
    {
        $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/'.$type);
        $image->move($destinationPath, $name);
        return '/images/'.$type . '/' . $name;
    }

    /**
     * @param int $pivot_id
     * @param string $type
     * @auther Nader Ahmed
     */
    private function removeImageFromDatabase(int $pivot_id,string $type)
    {
        Image::where(['pivot_id'=>$pivot_id,'type' => $type])->delete();
    }

    /**
     * @param int $pivot_id
     * @param string $type
     * @auther Nader Ahmed
     */
    private function removeImageFromLocation(int $pivot_id,string $type)
    {
        $image = Image::where(['pivot_id'=>$pivot_id,'type' => $type])->first();
        if(isset($image->image))
        {
            if(File::exists(public_path($image->image))) {
                File::delete(public_path($image->image));
            }
        }

    }

    /**
     * @param array $where = null
     * @auther Nader Ahmed
     * @return int
     */
    public function getCount(array $where = null)
    {
        return $this->model->where($where)->count();
    }

    /**
     * @param array $where = null
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getWhere(array $where = null)
    {
        return $this->model->where($where)->get();
    }
}
