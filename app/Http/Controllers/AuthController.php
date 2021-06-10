<?php

namespace App\Http\Controllers;

use Redirect; 
use App\User;
use App\supplier;
use App\manager;
use App\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $user = \App\User::All();
        if(Auth::attempt($request->only('email','password'))){
            $user = \App\User::where('email', $request->email)->first();
            if($user->role == 'manager'){
                    //Auth::guard('manager')->LoginUsingId($user->id);
                    return redirect('/home');
                } elseif($user->role == 'supplier'){
                    //Auth::guard('supplier')->LoginUsingId($user->id);
                    return redirect('/supplier/dashboard');
                }elseif ($user->role == 'customer') {
                // Auth::guard('customer')->LoginUsingId($user->id);
                    return redirect('/customer/index');
                }
            }
        return redirect('/login')->with('status', 'Maaf, email dan password anda tidak sesuai. Harap periksa kembali');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('logout', 'Anda yakin ingin keluar ?');
    }

    //homenya manager
    public function setviewhomemanager ()
    {
        return view('home');

    }

    //homenya supplier
    public function setviewhomesupplier ()
    {
        return view('supplier.dashboard');

    }

  //homenya customer
     public function setviewhomecustomer (){         
        return view ('customer.index');
    }

    public function registercustomer()
    {
        return view('auth.registercustomer');
    }

    public function registermanager()
    {
        return view('auth.registermanager');
    }

    public function registersupplier()
    {
        return view('auth.registersupplier');
    }

    public function postregistercustomer(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:30', 'unique:users'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'min:11', 'max:13'],
            'tanggal_lahir' => ['required'],
            'foto' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
        //insert ke tabel user
        $user = new \App\User;
        $user->role = 'customer';
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        //insert ke tabel customer
        $request->request->add(['user_id' => $user->id]);
        $customer = \App\customer::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $customer->foto = $request->file('foto')->getClientOriginalName();
            $customer->save();
        }
        return redirect('/registercustomer')->with('sukses', 'Data Berhasil Dibuat');
    }

    public function postregistersupplier(Request $request)
    { {
            $this->validate($request, [
                'nama' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:30', 'unique:users'],
                'alamat' => ['required', 'string', 'max:255'],
                'no_hp' => ['required', 'min:11', 'max:13'],
                'tanggal_lahir' => ['required'],
                'foto' => ['required', 'mimes:jpg,jpeg,png'],
            ]);
            //insert ke tabel user
            $user = new \App\User;
            $user->role = 'supplier';
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(60);
            $user->save();
            //insert ke tabel supplier
            $request->request->add(['user_id' => $user->id]);
            $supplier = \App\supplier::create($request->all());
            if ($request->hasFile('foto')) {
                $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
                $supplier->foto = $request->file('foto')->getClientOriginalName();
                $supplier->save();
            }
            return redirect('/registersupplier')->with('sukses', 'Data Berhasil Dibuat');
        }
    }

    public function postregistermanager(Request $request)
    { {
            $this->validate($request, [
                'nama' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:30', 'unique:users'],
                'alamat' => ['required', 'string', 'max:255'],
                'no_hp' => ['required', 'min:11', 'max:13'],
                'tanggal_lahir' => ['required'],
                'foto' => ['required', 'mimes:jpg,jpeg,png'],
            ]);
            //insert ke tabel user
            $user = new \App\User;
            $user->role = 'manager';
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(60);
            $user->save();
            //insert ke tabel manager
            $request->request->add(['user_id' => $user->id]);
            $manager = \App\manager::create($request->all());
            if ($request->hasFile('foto')) {
                $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
                $manager->foto = $request->file('foto')->getClientOriginalName();
                $manager->save();
            }
            return redirect('/registermanager')->with('sukses', 'Data Berhasil Dibuat');
        }
    }
}
