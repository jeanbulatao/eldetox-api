<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserInterface
{
   public function add($req)
   {
       $v = Validator::make($req->all(),[
            'name'              => 'required',
            'lastname'          => 'requierd',
            'email'             => 'requierd',
            'password'          => 'required:password',
            'password_confirm'  => 'required|same:password',
            'phone'             => 'required'
       ]);

       if($v->fails()) return res('failed', $v->errors(), 402);

       $user = User::where('name', $req->name)->where('lastname', $req->lastname)->first();
       if($user) return res('fialed', 'user already exist', 402);

       $new_user = new User();
       $new_user->name = $req->name;
       $new_user->lastname = $req->lastname;
       $new_user->email = $req->email;
       $new_user->password = $req->password;
       $new_user->mobile = $req->mobile;
       $new_user->type = 0;
       $new_user->save();

       return res('success', null, 200);
   }
}
