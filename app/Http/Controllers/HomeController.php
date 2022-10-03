<?php

namespace App\Http\Controllers;

use App\Mail\MailBox;
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
}
