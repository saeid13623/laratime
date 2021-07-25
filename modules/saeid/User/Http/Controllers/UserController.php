<?php

namespace saeid\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use saeid\Commen\Responses\AjaxResponse;
use saeid\Media\Services\MediaFileServices;
use saeid\RolePermission\Repositories\RoleRepo;
use saeid\User\Http\Requests\AddRoleRequest;
use saeid\User\Http\Requests\UpdateProfileRequest;
use saeid\User\Http\Requests\UpdateUserRequest;
use saeid\User\Http\Requests\UserPhotoRequest;
use saeid\User\Repository\userRepo;

class UserController extends Controller
{

    public $userRepo;
    public $roleRepo;
    public function __construct(userRepo $userRepo,RoleRepo $roleRepo)
    {
        $this->userRepo=$userRepo;
        $this->roleRepo=$roleRepo;
    }

    public function index(RoleRepo $roleRepo)
    {
        $this->authorize('index',User::class);
        $roles=$roleRepo->all();
        $users=$this->userRepo->paginate();
        return view('User::admin.index',compact('users','roles'));
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole',User::class);
        $user->assignRole($request->role);

        alert()->success('موفقیت آمیز',"به کاربر {$user->name} نقش کاربری {$request->role} داده شد");
        return back();
    }
    public function removeRole($userId,$role)
    {
        $this->authorize('manage',User::class);
        $user=$this->userRepo->findById($userId);
        $user->removeRole($role);
        AjaxResponse::SuccessResponse();
    }
    public function manualVerified($userId)
    {
        $this->authorize('manage',User::class);
        $user=$this->userRepo->findById($userId);
        $user->markEmailAsVerified();
        AjaxResponse::SuccessResponse();
    }

    public function edit($userId)
    {
        $this->authorize('edit',User::class);
        $user=$this->userRepo->findById($userId);
        $roles=$this->roleRepo->all();
        return view('User::admin.edit',compact('user','roles'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $this->authorize('edit',User::class);
        $user=$this->userRepo->findById($userId);
        if($request->hasFile('image')){
            $request->request->add(['image_id'=>MediaFileServices::PublicUpload($request->file('image'))->id]);
            if($user->image){
                $user->image->delete();
            }

        }else{
            $request->request->add(['image_id'=>$user->image_id]);
        }
        $this->userRepo->updateUser($userId,$request);
        return redirect()->back();
    }


    public function destroy($userId)
    {
        $this->authorize('manage',User::class);
        $user=$this->userRepo->findById($userId);
        $user->delete();
        return back();
    }
    public function userPhoto(UserPhotoRequest $request)
    {
        $this->authorize('editProfile',User::class);
        $media=MediaFileServices::PublicUpload($request->file('userphoto'));

        if(auth()->user()->image) auth()->user()->image->delete();

        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }

    public function profile()
    {
        $this->authorize('editProfile',User::class);
        return view('User::admin.profile');
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->authorize('editProfile',User::class);

        $this->userRepo->updateProfile($request);

        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();

    }


}
