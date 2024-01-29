<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Home Page
    function home()
    {
        $roomTypes = RoomType::all();
        $Facility = Facility::all();
        return view('home', ['roomTypes' => $roomTypes, 'Facility' => $Facility]);
    }
}
