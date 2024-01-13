<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie as Cookie;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::all();
        return view('customer.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:customers',
            'password' => 'required | min:6',
            'mobile' => 'required',
        ]);

        //If user Gieven address
        if($request->has('address')){
            $formFields['address'] = $request->address;
        }
        //If user Gieven any PHOTO
        if($request->hasFile('photo')){
            $formFields['photo'] = $request->file('photo')->store('customerPhoto','public');
        }
        //Hash Password
        $formFields['password'] = sha1(($formFields['password']));

        Customer::create($formFields);
        $ref = $request->ref;
        if($ref=='front'){
            return redirect('welcome')->with('success','Registration Successful!'.$request->full_name);
        }else{
            return redirect('admin/customer')->with('success','Data has been added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Customer::find($id);
        return view('customer.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Customer::find($id);
        return view('customer.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = Customer::find($id);
        $formFields = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        //If user Gieven address
        if($request->has('address')){
            $formFields['address'] = $request->address;
        }
        //If user Gieven any PHOTO
        if($request->hasFile('photo')){
            $formFields['photo'] = $request->file('photo')->store('customerPhoto','public');
        }else{
            $formFields['photo'] = $request->prev_photo;
        }

        $data->update($formFields);;
        return redirect('admin/customer')->with('success','Data has been updated Successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return redirect('admin/customer')->with('danger','Data has been deleted Successfully!');

    }
    
    public function register()
    {
        return view('register');
    }
    //Login
    function login(){
        return view('loginFront');
    }
    function check_login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required | min:4',
        ]);
        $password =sha1($request->password) ;
        $customer = Customer::where(['email'=>$request->email,'password'=>$password])->count();
        if($customer>0) {
            $CustomerData = Customer::where(['email'=>$request->email,'password'=>$password])->get();
            session(['customerLogin'=>true,'CustomerData'=>$CustomerData]);
            if($request->has('rememberme')){
                Cookie::queue('CustomerEmail',$request->email,1440 );
                Cookie::queue('Customerpwd',$request->password,1440 );
            }
            return redirect('/');
        }else{
            return redirect('customer/login')->with('invalidMessage','Invalid Username Or Password!');
        }
    }
    //LogOut
    function logout(){
        session()->forget(['CustomerData','customerLogin']);
        return redirect('customer/login')->with('invalidMessage','Logged out!');
    }
    //profile
    public function customerProfile()
    {
        return view('panel.customer.profile');
    }
    

}
