<?php

namespace App\Http\Controllers;

use Auth;
use App\supplier;
use App\katalog;
use Carbon\Carbon;
use App\k_transaction;
use App\k_detailtransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $katalogs = Katalog::paginate(30);
        return view('supplier.katalog.katalog', compact('katalogs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.katalog.buatkatalog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer'],
            'stok' => ['required', 'integer'],
            'deskripsi' => ['required'],
            'gambar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
        //insert ke tabel katalog
        $katalog = new \App\katalog;
        $katalog->nama_barang = $request->nama_barang;
        $katalog->harga = $request->harga;
        $katalog->stok = $request->stok;
        $katalog->deskripsi = $request->deskripsi;
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('gambar/', $request->file('gambar')->getClientOriginalName());
            $katalog->gambar = $request->file('gambar')->getClientOriginalName();
            $katalog->save();
        }
        $katalog->save();

        Alert::success('Success', 'Katalog Berhasil Ditambahkan');
        return redirect('/supplier/katalog/katalog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $katalogs = Katalog::findorfail($id);
        return view('supplier.katalog.editkatalog', compact('katalogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer'],
            'stok' => ['required', 'integer'],
            'deskripsi' => ['required'],
            'gambar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $ubah = Katalog::findorfail($id);
        $awal = $ubah->gambar;

        $katalogs = [
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $awal,
        ];

        $request->gambar->move(public_path() . '/gambar', $awal);
        $ubah->update($katalogs);

        Alert::success('Success', 'Katalog Berhasil Dirubah');
        return redirect('/supplier/katalog/katalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $katalog = Katalog::where('id', $id)->first();

        $katalog->delete();

        Alert::error('Katalog Berhasil Dihapus');
        return redirect('/supplier/katalog/katalog');
    }

    public function supplierprofile($id)
    {
        $supplier = \App\supplier::find($id);
        return view('supplier.profile.profile', ['supplier' => $supplier]);
    }

    public function suppliereditprofile($id)
    {
        $users = \App\User::find($id);
        return view('supplier.profile.edit', ['users' => $users]);
    }

    public function supplierupdateprofile(Request $request, $id)
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
                ->join('suppliers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
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
                ->join('suppliers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
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
        return redirect(url('/supplier/profile/profile/{{auth()->user()->supplier->id}}'));
    }

    public function contact()
    {
        return view('supplier.contact');
    }

    public function verif()
    {
        $k_transactions = K_transaction::where('status', '!=', 0)->where('bukti_transfer', '!=', '')->orderBy('id', 'desc')->get();

        return view('supplier.katalog.verifikasi', compact('k_transactions'));
    }

    public function verifikasidetail($id)
    {
        $k_transaction = K_transaction::where('id', $id)->first();
        $k_detailtransactions = K_detailtransaction::where('k_transaction_id', $k_transaction->id)->get();

        return view('supplier.katalog.verifikasidetail', compact('k_transaction', 'k_detailtransactions'));
    }

    public function disetujui($id)
    {
        $k_transaction = K_transaction::where('id', $id)->first();
        if($k_transaction->status == 1){
            $k_transaction->status = 2;
            $k_transaction->update();
        }elseif($k_transaction->status == 2){
            $k_transaction->status = 2;
            $k_transaction->update();
        }else{
            $k_transaction->status = 2;
            $k_transaction->update();
        }
        
        Alert::success('Verifikasi Pembayaran Diterima');
        return redirect('/supplier/katalog/verifikasi');
    }

    public function ditolak($id)
    {
        $k_transaction = k_transaction::where('id', $id)->first();
        if($k_transaction->status == 1){
            $k_transaction->status = 3;
            $k_transaction->update();
        }elseif($k_transaction->status == 2){
            $k_transaction->status = 3;
            $k_transaction->update();
        }else{
            $k_transaction->status = 3;
            $k_transaction->update();
        }

        Alert::error('Verifikasi Pembayaran Ditolak');
        return redirect('/supplier/katalog/verifikasi');
    }
}
