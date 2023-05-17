<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pointArray = [];
        if(Auth::user()->email == 'admin@qubicle.com'){

            $names = User::where('email', '<>', 'admin@qubicle.com')->get();
            $i = 0;
            foreach($names as $row){
                $pointArray[$i]['name'] = $row->name;
                $pointArray[$i]['email'] = $row->email;
                $pointArray[$i]['point'] = $this->getPoints([$row->referral_code]);
                $i++;
            }
        }
        return view('home', compact('pointArray'));
    }

    public function getPoints($referrlCode){

        $totalPoints = 0;
        for($i=10; $i>0; $i--){

            $usedCodes = User::whereIn('used_referral_code', $referrlCode)->get();
            $referrlCode = [];
            if($usedCodes->isNotEmpty()){
                foreach($usedCodes as $codes){

                    $referrlCode[] = $codes->referral_code;
                    $totalPoints += $i;
                }
            }else
                break;
        }
        return $totalPoints;
    }
}
