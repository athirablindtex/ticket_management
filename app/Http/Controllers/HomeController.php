<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $showPopup = false;

        if ($user) {
            // Today's date without time
            $today = Carbon::today();
 

            // Check if today is user's birthday or work anniversary
            $isBirthday = Carbon::parse($user->date_of_birth);
            $isAnniversary =Carbon::parse($user->work_joined);
      
            if (($today->isSameDay( $isBirthday ))|| $today->isSameDay($isAnniversary)) {
                $showPopup = true;
            } else {
                echo "Today is not the birthday.";
            }
                
            $showPopup = $isBirthday || $isAnniversary;
        }

        return view('home', compact('showPopup', 'user', 'isBirthday', 'isAnniversary'));
    }
}
