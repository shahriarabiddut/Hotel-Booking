<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use Illuminate\Support\Facades\Cookie as Cookieppp;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //Login
    function login(){
        return view('login');
    }
    function check_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required | min:4',
        ]);
        $admin =Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->count();
        if($admin>0) {
            $adminData =Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->get();
            session(['adminData'=>$adminData]);
            if($request->has('rememberme')){
                Cookie::queue('adminuser',$request->username,1440 );
                Cookie::queue('adminpwd',$request->password,1440 );
            }
            return redirect('admin')->with('success','Welcome Back!');
        }else{
            return redirect('admin/login')->with('invalidMessage','Invalid Username Or Password!');
        }
    }
    //LogOut
    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login')->with('invalidMessage','Logged out!');
    }
    //Dashboard
    function dashboard(){
        // for chart area
        $bookings = Booking::selectRaw('count(id) as tootal_bokings,checkin_date')->groupBy('checkin_date')->get();
        $labels = [];
        $data = [];
        foreach($bookings as $booking){
            $labels[]= $booking['checkin_date'];
            $data[]= $booking['tootal_bokings'];
        }

        //for pie chart
        $rtbookings = DB::table('room_types as rt')
                    ->join('rooms as r','r.room_type_id','=','rt.id')
                    ->join('bookings as b','b.room_id','=','r.id')
                    ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
                    ->groupBy('r.room_type_id')
                    ->get();

                    

        $plabels = [];
        $pdata = [];
        foreach($rtbookings as $rtbooking){
            $plabels[]= $rtbooking->title;
            $pdata[]= $rtbooking->total_bookings;
        }
       
        return view('dashboard',['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);
    }
}
