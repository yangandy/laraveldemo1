<?php

namespace App\Http\Controllers;

use App\Service\CartService;
use App\Service\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function  __construct(TestService $id)
    {

        $this->test = $id;

    }

    public function index(){
        $this->test->callMe('bug111');
    }
}
