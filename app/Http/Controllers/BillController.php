<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Facility;
use Illuminate\Http\Request;

class BillController extends Controller
{

    // //Admission
    // public function admissionBill(string $patient_id, string $admission_id, string $bill)
    // {
    //     //
    //     $data = new Bill();
    //     //
    //     $data->patient_id = $patient_id;
    //     $data->service_type = 'admission';
    //     $data->service_id = $admission_id;
    //     $data->price = $bill;
    //     $data->status = 0;
    //     $data->save();
    //     return 1;
    // }
    // public function admissionBillAccept(string $id)
    // {
    //     //
    //     $data = Bill::all()->where('service_id', '=', $id)->where('service_type', '=', 'admission')->first();
    //     $data->status = 1;
    //     $data->save();
    //     return redirect()->back()->with('success', 'Admission Bill Paid!');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Bill::all();
        return view('bill.index', ['data' => $data]);
    }
    public function create()
    {
        //
        $customers = Customer::all();
        $facility = Facility::all();
        return view('bill.create', ['customers' => $customers, 'facility' => $facility]);
    }

    public function generate(Request $request)
    {
        $dataCustomer = Customer::all()->where('id', '=', $request->customer)->first();
        if ($dataCustomer == null) {
            return redirect()->back()->with('danger', 'Not Found!');
        }
        //Facility Bill
        if (($request->facility) != null) {
            foreach ($request->facility as $facility) {
                $dataFacility = Facility::find($facility);
                $this->generateBill($request->customer, $facility, 'facility', 500);
            }
        }
        //Food Bill Generate
        if ($request->foodbill != '') {
            $this->generateBill($request->customer, 1, 'foodbill', $request->foodbill);
        }
        //
        $data = Bill::all()->where('customer_id', '=', $request->customer)->where('status', '<=', 1);
        $customer = Customer::all()->where('id', '=', $request->customer)->first();
        return view('bill.show', ['data' => $data, 'customer' => $customer]);
    }
    public function generateBill(string $customer_id, string $service_id, string $service_type, string $price)
    {
        //
        if ($service_type == 'facility') {
            $dataFacility = Bill::all()->where('customer_id', '=', $customer_id)->where('service_id', $service_id)->where('service_type', 'facility')->where('status', '=', 0)->first();
            if ($dataFacility != null) {
                return 0;
            }
        }
        $dataBill = new Bill();
        $dataBill->customer_id = $customer_id;
        $dataBill->service_type = $service_type;
        $dataBill->service_id = $service_id;
        $dataBill->price = $price;
        $dataBill->status = 0;
        if ($service_type == 'facility') {
            $dataFacility = Facility::find($service_id);
            $dataBill->extra = $dataFacility->title;
        }
        $dataBill->save();
        //
        return 1;
    }
    public function admin_payment($id, $customer_id)
    {
        //
        $dataBill = Bill::find($id)->where('status', 0)->first();
        dd($dataBill);
        if ($dataBill == null) {
            return redirect()->back()->with('danger', 'Bill Not Found!');
        } else {
            //
            $data = new Payment();
            $data->customer_id = $customer_id;
            $data->bill_id = $dataBill->id;
            $data->price = $dataBill->price;
            $data->method = 'Admin';
            $data->status = 1;
            $data->save();
            //Bill Update
            $dataBill->status = 2;
            $dataBill->save();
            return redirect()->back()->with('success', 'Payment Done!');
        }
    }
    public function clear_payment(string $id)
    {
        //
        $dataBill = Bill::all()->where('customer_id', '=', $id)->where('status', '=', 0);
        if ($dataBill == null || count($dataBill) == 0) {
            return redirect()->back()->with('danger', 'Bill Not Found!');
        }
        foreach ($dataBill as $dataB) {
            //
            $data = new Payment();
            $data->customer_id = $id;
            $data->bill_id = $dataB->id;
            $data->price = $dataB->price;
            $data->method = 'Admin';
            $data->status = 1;
            $data->save();
            //Bill Update
            $dataBU = Bill::find($dataB->id);
            $dataBU->status = 2;
            $dataBU->save();
        }
        return redirect()->route('admin.bill.index')->with('success', 'All Payment Done for this Customer!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function payBill(string $id)
    {
        //
        $data = Bill::find($id);
        if ($data == null) {
            return redirect()->back()->with('danger', 'Not Found!');
        }
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Bill Paid!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function billDelete(string $id, string $service_type)
    {
        //
        $data = Bill::all()->where('service_id', '=', $id)->where('service_type', '=', $service_type)->first();
        if ($data == null) {
            return 1;
        }
        if ($data->status == 1) {
            return 0;
        }
        $data->delete();
        return 1;
    }
    public function destroy(string $id)
    {
        //
    }
}
