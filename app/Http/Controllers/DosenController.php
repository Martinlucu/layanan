<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class DosenController extends Controller
{
    public function doshome()
    {
        
    	return view('doshome');
    }
}
