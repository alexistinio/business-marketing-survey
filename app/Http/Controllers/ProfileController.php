<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index($id = null)
    {
        return view('view.profile.index', compact('id'));
    }
}
