<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('view.user-management.index');
    }

    public function edit($id)
    {
        return view('view.user-management.edit', compact('id'));
    }

    public function create()
    {
        return view('view.user-management.create');
    }

    public function reset_points($id){

       $points = Point::find($id);
       $points->request = "Not Claimed";
       $points->points = 0;

       $points->update();

        return redirect('/user-management');
    }
}
