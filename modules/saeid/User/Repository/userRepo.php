<?php


namespace saeid\User\Repository;


use App\User;
use saeid\RolePermission\Models\Permission;

class userRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email',$email)->first();
    }

    public static function getTeacher()
    {
        return User::permission('teach')->get();
    }
    public function findById($id)
    {
        return User::find($id);
    }
    public function paginate()
    {
        return User::latest()->paginate();
    }

    public function updateUser($userId, $value)
    {
        $data=[
            "name" => $value->name,
            "email" => $value->email,
            "username" => $value->username,
            "mobile" => $value->mobile,
            "status" => $value->status,
            "headline" => $value->headline,
            "card_number" => $value->card_number,
            "shaba" => $value->shaba,
            "balance" => $value->balance,
            "telegram" => $value->telegram,
            "bio" => $value->bio,
            "image_id" => $value->image_id
        ];
        if($value->password){
            $data['password'] = bcrypt($value->password);
        }



          return User::where('id',$userId)->update($data);
    }

    public function updateProfile( $request)
    {
        auth()->user()->name = $request->name;
        if(auth()->user()->email != $request->email){
            auth()->user()->email = $request->email;
            auth()->user()->email_verified_at = null;
        }

        if(auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH)){
            auth()->user()->username = $request->username;
            auth()->user()->headline = $request->headline;
            auth()->user()->card_number = $request->card_number;
            auth()->user()->bio = $request->bio;
            auth()->user()->shaba = $request->shaba;
        }
        if($request->password){
            auth()->user()->password=bcrypt($request->password);
        }
        auth()->user()->save();
    }
}
