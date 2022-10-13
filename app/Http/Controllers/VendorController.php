<?php

namespace App\Http\Controllers;

use App\Mail\VendorNotification;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.index',[
            'allvendors' => Vendor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $random_password = Str::random(9);
        $request->validate([
            'vendor_name' => 'required',
            'vendor_email' => 'required | email',
            'vendor_phone_number' => 'required',
            'vendor_address' => 'required',
        ]);

        $user_info = User::create([
            'name' => $request->vendor_name,
            'email' => $request->vendor_email,
            'password' => bcrypt($random_password),
            'phone_number' => $request->vendor_phone_number,
            'role' => '3'
        ]);

        Vendor::insert([
            'user_id' => $user_info->id,
            'address' => $request->vendor_address,
            'created_at' => Carbon::now(),
        ]);

        // now send password to vendor mail
        Mail::to($request->vendor_email)->send(new VendorNotification($random_password));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('vendor.show', [
            'single_vendor' => Vendor::find($vendor->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
