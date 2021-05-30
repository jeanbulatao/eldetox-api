<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\LoginInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $req;
    protected $login;

    public function __construct(Request $req, LoginInterface $login)
    {
        $this->req = $req;
        $this->login = $login;
    }

}
