<?php

namespace Modules\Groups\Repository\Elequent;

use Illuminate\Support\Str;
use Modules\Base\Repository\Elequent\BaseElequent;
use Modules\Groups\Entities\Group;
use Modules\Groups\Repository\Interfaces\GroupInterface;

class GroupElequent extends BaseElequent implements GroupInterface
{
    /**
     * @var
     */
    protected $group;

    /**
     * @array
     */
    private $permission;

    /**
     * @var
     */
    private $data;

    /**
     * GroupElequent constructor.
     */
    public function __construct()
    {
        $this->group = new Group();
        parent::__construct($this->group);
    }

    /**
     * @param array $data
     * @auther Nader Ahmed
     * @return mixed
     */
    public function storePermission(array $data)
    {
        $this->data = $data;
        $this->preparePermission();
        $group['name'] = $data['name'];
        $group['slug'] = Str::slug($data['name']);
        $group['permission'] = json_encode($this->permission);
        $this->store($group);
    }

    /**
     * @param array $data
     * @param int $id
     * @auther Nader Ahmed
     * @return mixed
     */
    public function updatePermission(int $id,array $data)
    {
        $this->data = $data;
        $this->preparePermission();
        $group['name'] = $data['name'];
        $group['permission'] = json_encode($this->permission);
        $this->update($id,$group);
    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermission()
    {
        $this->preparePermissionPump();
        $this->preparePermissionPumpHeight();
        $this->preparePermissionSettings();
        $this->preparePermissionGroups();
        $this->preparePermissionUser();
    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermissionPump()
    {
        $this->permission['show_pump'] = !empty($this->data['show_pump'])? ($this->data['show_pump'] == 'true')? 'true':'false' :'false';
        $this->permission['create_pump'] = !empty($this->data['create_pump'])? ($this->data['create_pump'] == 'true')? 'true':'false' :'false';
        $this->permission['edit_pump'] = !empty($this->data['edit_pump'])? ($this->data['edit_pump'] == 'true')? 'true':'false' :'false';
        $this->permission['delete_pump'] = !empty($this->data['delete_pump'])? ($this->data['delete_pump'] == 'true')? 'true':'false' :'false';

    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermissionPumpHeight()
    {
        $this->permission['show_pump_height'] = !empty($this->data['show_pump_height'])? ($this->data['show_pump_height'] == 'true')? 'true':'false' :'false';
        $this->permission['create_pump_height'] = !empty($this->data['create_pump_height'])? ($this->data['create_pump_height'] == 'true')? 'true':'false' :'false';
        $this->permission['edit_pump_height'] = !empty($this->data['edit_pump_height'])? ($this->data['edit_pump_height'] == 'true')? 'true':'false' :'false';
        $this->permission['delete_pump_height'] = !empty($this->data['delete_pump_height'])? ($this->data['delete_pump_height'] == 'true')? 'true':'false' :'false';
    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermissionSettings()
    {
        $this->permission['show_settings'] = !empty($this->data['show_settings'])? ($this->data['show_settings'] == 'true')? 'true':'false' :'false';
        $this->permission['create_settings'] = !empty($this->data['create_settings'])? ($this->data['create_settings'] == 'true')? 'true':'false' :'false';
        $this->permission['edit_settings'] = !empty($this->data['edit_settings'])? ($this->data['edit_settings'] == 'true')? 'true':'false' :'false';
        $this->permission['delete_settings'] = !empty($this->data['delete_settings'])? ($this->data['delete_settings'] == 'true')? 'true':'false' :'false';
    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermissionGroups()
    {
        $this->permission['show_groups'] = !empty($this->data['show_groups'])? ($this->data['show_groups'] == 'true')? 'true':'false' :'false';
        $this->permission['create_groups'] = !empty($this->data['create_groups'])? ($this->data['create_groups'] == 'true')? 'true':'false' :'false';
        $this->permission['edit_groups'] = !empty($this->data['edit_groups'])? ($this->data['edit_groups'] == 'true')? 'true':'false' :'false';
        $this->permission['delete_groups'] = !empty($this->data['delete_groups'])? ($this->data['delete_groups'] == 'true')? 'true':'false' :'false';
    }

    /**
     * @author Nader Ahmed
     */
    private function preparePermissionUser()
    {
        $this->permission['show_user'] = !empty($this->data['show_user'])? ($this->data['show_user'] == 'true')? 'true':'false' :'false';
        $this->permission['create_user'] = !empty($this->data['create_user'])? ($this->data['create_user'] == 'true')? 'true':'false' :'false';
        $this->permission['edit_user'] = !empty($this->data['edit_user'])? ($this->data['edit_user'] == 'true')? 'true':'false' :'false';
        $this->permission['delete_user'] = !empty($this->data['delete_user'])? ($this->data['delete_user'] == 'true')? 'true':'false' :'false';
    }
}
