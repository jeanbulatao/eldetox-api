<?php

namespace App\Repositories;

use App\Interfaces\LoginInterface;
use App\Model\OauthAccessToken;
use App\User;

class LoginRepository implements LoginInterface {

    public function generateToken(User $user, $sm_id = null)
    {
        $origin = session('origin');
        OauthAccessToken::where('user_id', $user->id)->where('name', $origin)->delete();
        $data = [
            'token' => $user->createToken($origin)->accessToken,
            'user' => [
                'user_id' => $user->id,
                'hashid' => encode($user->id, 'uuid'),
                'social_id' => $sm_id ? $sm_id : null,
                'email' => $user->email,
                'mobile_prefix' => $user->mobile_prefix,
                'mobile' => $user->mobile,
                'name' => $user->name,
                'type_info' => $user->type_info,
                'gender' => $user->gender,
                'bdate' => $user->bdate,
            ]
        ];
        // NOTE: Also update on API routes
        return $data;
    }
}