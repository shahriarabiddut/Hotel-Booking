<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Booking::all();
        return view('booking.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::all();
        return view('booking.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Booking();
        $request->validate([
            'customer_id' => 'required',
            'room_id' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'total_adults' => 'required',
            'total_children' => 'required',
        ]);

        $data->customer_id = $request->customer_id;
        $data->room_id = $request->room_id;
        $data->checkin_date = $request->checkin_date;
        $data->checkout_date = $request->checkout_date;
        $data->total_adults = $request->total_adults;
        $data->total_children = $request->total_children;
        $data->save();
        //Generate Bill
        $date1 = Carbon::parse($request->checkin_date);
        $date2 = Carbon::parse($request->checkout_date);
        $diff = $date1->diff($date2);
        $daysDifference = $diff->days;
        if ($daysDifference == 0) {
            $daysDifference = 1;
        }
        //
        $room  = Room::find($request->room_id);
        $roomType  = RoomType::find($room->room_type_id);
        $dataBill = new Bill();
        $dataBill->customer_id = $request->customer_id;
        $dataBill->service_type = 'booking';
        $dataBill->service_id = $data->id;
        $dataBill->price = $roomType->price * $daysDifference;
        $dataBill->status = 0;
        $dataBill->save();
        //
        $ref = $request->ref;
        if ($ref == 'front') {
            return redirect('welcome')->with('success', 'Booking has been added Successfully! Your Checkin Date ' . $request->checkin_date . ' And Checkout date ' . $request->checkout_date);
        } else {
            return redirect('admin/booking/create')->with('success', 'Booking Data has been added Successfully!');
        }
    }
    public function generateBill(string $id)
    {
        $data = Booking::find($id);
        //Generate Bill
        $date1 = Carbon::parse($data->checkin_date);
        $date2 = Carbon::parse($data->checkout_date);
        $diff = $date1->diff($date2);
        $daysDifference = $diff->days;
        if ($daysDifference == 0) {
            $daysDifference = 1;
        }
        //
        $room  = Room::find($data->room_id);
        $roomType  = RoomType::find($room->room_type_id);
        $dataBill = new Bill();
        $dataBill->customer_id = $data->customer_id;
        $dataBill->service_type = 'booking';
        $dataBill->service_id = $data->id;
        $dataBill->price = $roomType->price * $daysDifference;
        $dataBill->status = 0;
        $dataBill->save();
        //
        return redirect()->back()->with('danger', 'Booking Bill Generated!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Booking::find($id);
        return view('booking.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Booking::find($id);
        return view('booking.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Booking::find($id);
        $dataBill = Bill::all()->where('service_id', $data->id)->first();
        $data->delete();
        $dataBill->delete();
        return redirect()->back()->with('danger', 'Booking Deleted!');
    }
    // Check available-rooms
    public function available_rooms(Request $request, $checkin_date)
    {
        //
        $arooms = DB::select("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");
        $data = [];
        foreach ($arooms as $aroom) {
            $roomTypes = RoomType::find($aroom->room_type_id);
            $data[] = ['room' => $aroom, 'roomtype' => $roomTypes];
        }

        return response()->json(['data' => $data]);
    }
    public function front_booking()
    {
        //
        return view('front-booking');
    }
    public function front_payment($id)
    {
        //
        $data = Booking::find($id);
        if ($data->bill == null) {
            return redirect()->back()->with('danger', 'Payment Not Found!');
        } elseif ($data->bill->status == 0) {
            return view('front-payment', ['data' => $data]);
        } else {
            return redirect('welcome')->with('danger', 'Payment Request Found!');
        }
    }
    public function admin_payment($id)
    {
        //
        $dataBooking = Booking::find($id);
        $dataBill = Bill::all()->where('service_type', 'booking')->where('service_id', $id)->first();
        if ($dataBooking->bill == null) {
            return redirect()->back()->with('danger', 'Payment Not Found!');
        } else {
            //
            $data = new Payment();
            $data->customer_id = $dataBooking->customer_id;
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
    public function paymentAccept($id)
    {
        //
        $dataB = Booking::find($id);
        $data = Payment::all()->where('bill_id', $dataB->bill->id)->first();
        $data->status = 1;
        $data->save();
        //Bill Update
        $dataBill  = Bill::find($data->bill_id);
        $dataBill->status = 2;
        $dataBill->save();
        //
        return redirect()->back()->with('success', 'Payment Request Accepted!');
    }
    public function paymentStore(Request $request)
    {
        //
        $data = new Payment();
        $request->validate([
            'method' => 'required',
        ]);

        $data->customer_id = $request->customer_id;
        $data->bill_id = $request->bill_id;
        $data->price = $request->price;
        $data->method = $request->method;
        $data->status = 0;
        $data->save();
        //Bill Update
        $dataBill  = Bill::find($request->bill_id);
        $dataBill->status = 1;
        $dataBill->save();
        //
        return redirect('welcome')->with('success', 'Payment Request Submitted!');
    }
    //User bookings
    public function mybookings()
    {
        $uid = session('CustomerData')[0]->id;
        $data =  Booking::all()->where('customer_id', $uid);
        $brooms = [];
        if (!sizeof($data) < 1) {
            foreach ($data as $key => $d) {
                $temp = $data[$key]->room_id;
                $brooms[] = DB::select("SELECT * FROM rooms WHERE id = $temp");
            }
            // dd($brooms);
        }

        return view('panel.customer.mybookings', ['data' => $data, 'brooms' => $brooms]);
    }
}
