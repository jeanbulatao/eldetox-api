<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $req;
    protected $user;

    public function __construct(Request $req, UserInterface $user)
    {
        $this->req = $req;
        $this->user = $user;
    }

    public function add()
    {
       return $this->user->add($this->req);
    }
}
