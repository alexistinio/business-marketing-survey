<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\UserDetails;
use App\Http\Requests\Auth\RegisterRequest;
use App\Notifications\WelcomeNotifcation;
use App\Services\UserService;
use App\Traits\SweetAlert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    use SweetAlert;

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request, UserService $user, Point $points)
    {
        $validated = $request->validated();

        $response = $user->create($validated);

        if ($response['status'] == RESPONSE_SUCCCESS_CODE) {

            Auth::login($response['user']);
            event(new Registered(auth()->user()));
            $this->flashSuccess('Succcessfully Registererd!', 'Account Created Successfully!');


            if(auth()->user()->voucher != 'MARKIT10'){
            $data = [
                'user_id' => auth()->user()->id,
                'points' => 0,
               
            ]; 
            
            $points->create($data);
            return redirect(route('subscription'));
          }
            else {
                $data = [
                    'user_id' => auth()->user()->id,
                    'points' => 10,
                
                ]; 
                
                $points->create($data);
                return redirect(route('subscription'));
            }
        }

        $this->flashError('Whoops! Something went wrong', $response['message']);

        return redirect(route('register'));
    }
}
