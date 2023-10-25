<?php

namespace App\Http\Controllers;

class GroupController extends Controller
{
    public function index()
    {
        return view('view.group.index');
    }

    public function view($id)
    {
        return view('view.group.view', compact('id'));
    }
}
