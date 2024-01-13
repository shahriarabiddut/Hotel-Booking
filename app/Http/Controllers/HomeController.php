<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Home Page
    function home(){
        $roomTypes = RoomType::all();
        return view('home',['roomTypes'=>$roomTypes]);
    }
}
