<?php

namespace App\Http\Controllers;

use Auth;
use App\customer;
use App\kamar;
use App\kamar_transaction;
use App\DateTime;
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
    public function createpesanan($id)
    {
        $customer = \App\customer::find($id);
        return view('customer.profile.profile', ['customer' => $customer]);
    }

    public function contact()
    {
        return view('customer.contact');
    }
    public function kamarpesanan(Request $request,$id)
    {
        $date1=new \DateTime($request->check_in);
        $date2=new \DateTime($request->check_out);
        $date_diff=$date1->diff($date2)->format("%a");
        $this->validate($request, [
            'check_in' => ['required'],
            'check_out' => ['required'],
        ]);
        $kamar_transaction= kamar_transaction::where('kamar_id', $id)->where('status', 0)->orWhere('status', 1)->get();
        $counter=0;
        foreach ($kamar_transaction as $key => $kamar_transaction) {
            if ($request->check_in<$kamar_transaction->check_in&&$request->check_out>=$kamar_transaction->check_in||$request->check_in>=$kamar_transaction->check_in&&$request->check_out<=$kamar_transaction->check_out||$request->check_in<=$kamar_transaction->check_out&&$request->check_out>$kamar_transaction->check_out) {
                # code...
                $counter+=1;
            }else{
                # code...
            }
        }
        if ($counter==0) {
            # code...
            $kamar = kamar::findorfail($id);
            //insert ke tabel katalog
            $kamar_transactions = new \App\kamar_transaction;
            $kamar_transactions->kamar_id =$id;
            $kamar_transactions->user_id = Auth::user()->id;
            $kamar_transactions->check_in = $request->check_in;
            $kamar_transactions->check_out = $request->check_out;
            $kamar_transactions->harga = ($kamar->harga)*$date_diff;
            $kamar_transactions->status = 0;
            $kamar_transactions->save();

            Alert::success('Success', 'Pesanan Berhasil Ditambahkan');
            return redirect('/customer/kamar/keranjang');
        } else {
            # code...
            Alert::error('Gagal', 'Pesanan Sudah ada');
            return redirect()->back();
        }
        
        
    }
    public function keranjang()
    {
        $kamar_transactions = kamar_transaction::where('user_id', Auth::user()->id)->where('status', 0)->get();;
        return view('customer.kamar.keranjang',compact('kamar_transactions'));
    }
    public function detailpesanan($id)
    {
        $kamar_transactions = kamar_transaction::where('id', $id)->where('user_id', Auth::user()->id)->get();;
        return view('customer.kamar.detailpesanan',compact('kamar_transactions'));
    }
    public function uploadbuktitransfer(Request $request, $id)
    {
        $this->validate($request, [
            'gambar' => ['required','mimes:jpg,jpeg,png'],
        ]);
        $kamar_transactions = kamar_transaction::findorfail($id);
        //insert ke tabel katalog
        
        $kamar_transactions->status = 1;
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('gambar/', $request->file('gambar')->getClientOriginalName());
            $kamar_transactions->bukti_transfer = $request->file('gambar')->getClientOriginalName();
            $kamar_transactions->save();
        }
        $kamar_transactions->save();
        Alert::success('Success', 'Bukti Transfer Berhasil Diupload');
        return redirect('/customer/kamar/pesanan');
    }
    public function pesanan()
    {
        $kamar_transactions = kamar_transaction::where('user_id', Auth::user()->id)->where('status','!=', 0)->get();;
        return view('customer.kamar.pesanan',compact('kamar_transactions'));
    }
    public function hapuspesanan($id)
    {
        $kamar_transactions = kamar_transaction::where('id', $id)->first();

        $kamar_transactions->delete();

        Alert::success('Katalog Berhasil Dihapus');
        return redirect()->back();
    }
    public function rating($id)
    {
        $id_transaksi = $id;
        return view('customer.kamar.rating',compact('id_transaksi'));
    }
    public function tambahrating(Request $request, $id)
    {
        $this->validate($request, [
            'rating' => ['required', 'integer', 'between:1,5'],
            'Ulasan' => ['required', 'string'],
        ]);
        $kamar_transactions = kamar_transaction::where('id', $id)->first();
        $kamar_transactions->rating = $request->rating;
        $kamar_transactions->ulasan = $request->Ulasan;
        $kamar_transactions->status = 4;
        $kamar_transactions->save();

        return redirect()->back();
    }
}
