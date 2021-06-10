<?php

namespace App\Http\Controllers;

use Auth;
use App\customer;
use App\kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamars = Kamar::paginate(30);
        return view('customer.kamar.kamar', compact('kamars'));
    }

    public function detail($id)
    {
        $kamar = Kamar::where('id', $id)->first();
        return view('customer.kamar.detailkamar', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }

    public function customerprofile($id)
    {
        $customer = \App\customer::find($id);
        return view('customer.profile.profile', ['customer' => $customer]);
    }

    public function customereditprofile($id)
    {
        $users = \App\User::find($id);
        return view('customer.profile.edit', ['users' => $users]);
    }

    public function customerupdateprofile(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'min:11', 'max:13'],
            'tanggal_lahir' => ['required'],
            'foto' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $user = \Auth::user()->id;
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('foto', $request->file('foto')->getClientOriginalName());
            DB::table('users as u')
                ->join('customers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
                ->update([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "no_hp" =>  $request->no_hp,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "alamat" => $request->alamat,
                    "foto" => $request->file('foto')->getClientOriginalName(),
                ]);
        } else {
            DB::table('users as u')
                ->join('customers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
                ->update([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "no_hp" =>  $request->no_hp,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "alamat" => $request->alamat,
                ]);
        }

        Alert::success('Success', 'Profile Berhasil Dirubah');
        return redirect(url('/customer/profile/profile/{{auth()->user()->customer->id}}'));
    }

    public function contact()
    {
        return view('customer.contact');
    }
}
