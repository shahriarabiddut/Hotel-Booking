<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    //
    public function index()
    {
        $data = Facility::all();
        return view('facility.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Facility;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->image = $request->file('image')->store('FacilityPhoto', 'public');
        $data->save();

        return redirect('admin/facility')->with('success', 'Facility has been added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Facility::find($id);
        return view('facility.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Facility::find($id);
        return view('facility.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = Facility::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        //If user Gieven any PHOTO
        if ($request->hasFile('image_new')) {
            $data->image = $request->file('image_new')->store('FacilityPhoto', 'public');
        } else {
            $data->image = $request->image_old;
        }
        $data->save();

        return redirect('admin/facility')->with('success', 'Facility has been updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Facility::find($id);
        $data->delete();
        return redirect('admin/facility')->with('danger', 'Facility has been deleted Successfully!');
    }
}
