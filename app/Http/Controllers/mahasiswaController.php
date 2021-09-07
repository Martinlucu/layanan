<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class mahasiswaController extends Controller
{
    public function mhscuti()
    {
        
    	return view('mhscuti');
    }
    public function mhsdispen()
    {
    	return view('mhsdispen');
    }
    public function mhsbst()
    {
    	return view('mhsbst');
    }
    public function mhsyudi()
    {
    	return view('mhsyudi');
    }

    public function createbss(){

    }
}
