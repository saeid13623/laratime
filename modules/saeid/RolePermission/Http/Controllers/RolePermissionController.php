<?php

namespace saeid\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use saeid\RolePermission\Http\Requests\RolePermissionRequest;
use saeid\RolePermission\Http\Requests\RoleUpdateRequest;
use saeid\RolePermission\Repositories\PermissionRepo;
use saeid\RolePermission\Repositories\RoleRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public $roleRepo;
    public $permissionRepo;
    public function __construct(RoleRepo $roleRepo , PermissionRepo $permissionRepo)
    {
        $this->roleRepo=$roleRepo;
        $this->permissionRepo=$permissionRepo;
    }

    public function index()
    {
        $this->authorize('manageRolePermission',\saeid\RolePermission\Models\Role::class);
        $roles=$this->roleRepo->all();
        $permissions=$this->permissionRepo->all();
        return view('Permission::index',compact('roles','permissions'));
    }

    public function store(RolePermissionRequest $request)
    {
         $this->roleRepo->create($request);
         return back();
    }
    public function edit($id)
    {
        $role=$this->roleRepo->findById($id);
        $permissions=$this->permissionRepo->all();
        return view('Permission::edit',compact('role','permissions'));
    }
    public function update(Request $request,$id)
    {
        Validator::make($request->all(),[
            'id'=>'required|exists:Roles,id',
            'name'=>'required|min:4|unique:Roles,name,'.request()->id,
            'permissions'=>'required|array|min:1'
        ]);
        $this->roleRepo->update($request,$id);
        return redirect(route('role-permissions.index'));
    }

    public function destroy($roleId)
    {
        $this->roleRepo->delete($roleId);
        return back();
    }
}

