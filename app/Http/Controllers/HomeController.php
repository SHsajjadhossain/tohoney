<?php

namespace App\Http\Controllers;

use App\Mail\MailBox;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'total_users' => User::count(),
            'total_admin' => User::where('role', 2)->count(),
            'total_customers' => User::where('role', 1)->count(),
            'total_vendors' => User::where('role', 3)->count(),
        ]);
    }

    public function mailbox()
    {
        return view('mailbox', [
            'customers' => User::where('role', '!=', 2)->get(),
        ]);
    }

    public function sendmail($id)
    {
        Mail::to(User::find($id)->email)->send(new MailBox());
        return back();
    }

    public function checkmail(Request $request)
    {
        foreach ($request->check as $id) {
            Mail::to(User::find($id)->email)->send(new MailBox());
        }
        return back();
    }

    public function location()
    {
        return view('location.index',[
            'countries' => Country::get(['id', 'name', 'status']),
        ]);
    }

    public function updatelocation(Request $request)
    {
        Country::where('status', 'active')->update([
            'status' => 'deactive',
        ]);

        foreach ($request->countries as $country_id) {
            Country::find($country_id)->update([
                'status' => "active",
            ]);
        }
        return back();
    }
}
