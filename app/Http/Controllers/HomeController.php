<?php


namespace App\Http\Controllers;
use App\Models\Point;

class HomeController extends Controller
{
    public function index()
    {
        return view('view.home.index');
    }

    public function welcome()
    {
        return view('layouts.partials.landingpage');
    }

    public function claim_points(Point $points){

        $id = auth()->user()->id;

        $points = Point::find($id);

        if($points->points > 9){
        $points->request = "Claiming/Claimed";

        $points->update();
        return redirect('/')->with('success','success');
        }

        else {
         return redirect('/')->with('error','error');
        }
     }


}
