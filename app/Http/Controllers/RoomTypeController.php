<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\RoomTypeImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RoomType::all();
        return view('roomType.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roomType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'price' => 'required',
        ]);
        $data = new RoomType;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->details = $request->details;
        $data->save();
        foreach ($request->file('imgs') as $img) {
            $imgPath = $img->store('RoomTypeImages', 'public');
            $imgData = new RoomTypeImage;
            $imgData->room_type_id = $data->id;
            $imgData->img_src = $imgPath;
            $imgData->img_alt = $request->title;
            $imgData->save();
        }
        return redirect('admin/roomtype')->with('success', 'Room Type has been Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = RoomType::find($id);
        return view('roomType.show', ['data' => $data]);
    }
    public function cshow()
    {
        //
        $data = RoomType::all();
        return view('roomType.cshow', ['roomType' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = RoomType::find($id);
        return view('roomType.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = RoomType::find($id);
        $formFields = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'price' => 'required',
        ]);
        $data->update($formFields);
        if ($request->hasFile('imgs')) {
            foreach ($request->file('imgs') as $img) {
                $imgPath = $img->store('RoomTypeImages', 'public');
                $imgData = new RoomTypeImage;
                $imgData->room_type_id = $data->id;
                $imgData->img_src = $imgPath;
                $imgData->img_alt = $request->title;
                $imgData->save();
            }
        }
        return redirect('admin/roomtype')->with('success', 'Data has been updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = RoomType::find($id);
        $data->delete();
        return redirect('admin/roomtype')->with('danger', 'Data has been deleted Successfully!');
    }
    public function destroy_image($id)
    {
        $data = RoomTypeImage::find($id);
        //Delete Image from storage
        $path = 'storage/' . $data->img_src;
        if (File::exists($path)) {
            File::delete($path);
        }
        //Delete Image
        $data->delete();
        return response()->json(['bool' => true]);
    }
}
