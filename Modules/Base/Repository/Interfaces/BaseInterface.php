<?php

namespace Modules\Base\Repository\Interfaces;

interface BaseInterface
{

    /**
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getAll();

    /**
     * @param $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function store($data);

    /**
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function update(int $id,$data);

    /**
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param int $id
     * @param string $type
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function saveImage($image,string $type,int $id);

    /**
     * @param array $where = null
     * @auther Nader Ahmed
     * @return int
     */
    public function getCount(array $where = null);

    /**
     * @param array $where = null
     * @auther Nader Ahmed
     * @return mixed
     */
    public function getWhere(array $where = null);
}
