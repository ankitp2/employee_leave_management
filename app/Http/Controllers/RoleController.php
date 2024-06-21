<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list(){
        return view('role.list');
    }
    public function add(){
        return view('role.add');
    }
}
