<?php

namespace App\Http\Controllers;

use Auth;
use App\manager;
use App\katalog;
use App\kamar;
use App\k_transaction;
use App\k_detailtransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $katalogs = Katalog::paginate(30);
        return view('manager.katalog.katalog', compact('katalogs'));
    }

    public function detail($id)
    {
        $katalog = Katalog::where('id', $id)->first();
        return view('manager.katalog.detailkatalog', compact('katalog'));
    }

    public function indexkamar()
    {
        $kamars = Kamar::paginate(30);
        return view('manager.kamar.kamar', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.kamar.buatkamar');
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
            'booking' => ['required', 'string'],
            'deskripsi' => ['required'],
            'gbrkamar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
        //insert ke tabel kamar
        $kamar = new \App\kamar;
        $kamar->nama_barang = $request->nama_barang;
        $kamar->harga = $request->harga;
        $kamar->booking = $request->booking;
        $kamar->deskripsi = $request->deskripsi;
        if ($request->hasFile('gbrkamar')) {
            $request->file('gbrkamar')->move('gbrkamar/', $request->file('gbrkamar')->getClientOriginalName());
            $kamar->gbrkamar = $request->file('gbrkamar')->getClientOriginalName();
            $kamar->save();
        }
        $kamar->save();

        Alert::success('Success', 'Data Kamar Berhasil Ditambahkan');
        return redirect('/manager/kamar/kamar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kamars = Kamar::findorfail($id);
        return view('manager.kamar.editkamar', compact('kamars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_barang' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer'],
            'booking' => ['required', 'string'],
            'deskripsi' => ['required'],
            'gbrkamar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $ubah = Kamar::findorfail($id);
        $awal = $ubah->gbrkamar;

        $kamars = [
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'booking' => $request->booking,
            'deskripsi' => $request->deskripsi,
            'gbrkamar' => $awal,
        ];

        $request->gbrkamar->move(public_path() . '/gbrkamar', $awal);
        $ubah->update($kamars);

        Alert::success('Success', 'Data Kamar Berhasil Dirubah');
        return redirect('/manager/kamar/kamar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::where('id', $id)->first();

        $kamar->delete();

        Alert::error('Data Kamar Berhasil Dihapus');
        return redirect('/manager/kamar/kamar');
    }

    public function managerprofile($id)
    {
        $manager = \App\manager::find($id);
        return view('manager.profile.profile', ['manager' => $manager]);
    }

    public function managereditprofile($id)
    {
        $users = \App\User::find($id);
        return view('manager.profile.edit', ['users' => $users]);
    }

    public function managerupdateprofile(Request $request, $id)
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
                ->join('managers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
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
                ->join('managers as p', 'u.id', '=', 'p.user_id')->where('u.id', $user)
                ->update([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "no_hp" =>  $request->no_hp,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "alamat" => $request->alamat,
                ]);
        }

        Alert::success('Success', 'Profile Berhasil Ditambahkan');
        return redirect(url('/manager/profile/profile/{{auth()->user()->manager->id}}'));
    }

    public function contact()
    {
        return view('manager.contact');
    }

    public function katalog(Request $request, $id)
    {
        $katalog = Katalog::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi melebihi stok
        if ($request->jumlah_pesan > $katalog->stok) {
            Alert::error('Maaf, Pesanan Melebihi Stok');
            return redirect('/manager/katalog/detailkatalog/' . $id);
        }

        //cek validasi
        $cek_k_transaction = K_transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //simpan ke database k_transaction
        if (empty($cek_k_transaction)) {
            $k_transaction = new K_transaction;
            $k_transaction->user_id = Auth::user()->id;
            $k_transaction->tanggal = $tanggal;
            $k_transaction->status = 0;
            $k_transaction->jumlah_harga = 0;
            $k_transaction->kode = mt_rand(100, 999);
            $k_transaction->save();
        }


        //simpan ke database k_detailtransaction
        $k_transaction_baru = K_transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek k_transaction detail
        $cek_k_detailtransaction = K_detailtransaction::where('katalog_id', $katalog->id)->where('k_transaction_id', $k_transaction_baru->id)->first();
        if (empty($cek_k_detailtransaction)) {
            $k_detailtransaction = new K_detailtransaction;
            $k_detailtransaction->katalog_id = $katalog->id;
            $k_detailtransaction->k_transaction_id = $k_transaction_baru->id;
            $k_detailtransaction->jumlah = $request->jumlah_pesan;
            $k_detailtransaction->jumlah_harga = $katalog->harga * $request->jumlah_pesan;
            $k_detailtransaction->save();
        } else {
            $k_detailtransaction = K_detailtransaction::where('katalog_id', $katalog->id)->where('k_transaction_id', $k_transaction_baru->id)->first();
            $k_detailtransaction->jumlah = $k_detailtransaction->jumlah + $request->jumlah_pesan;

            //harga sekarang
            $harga_k_detailtransaction_baru = $katalog->harga * $request->jumlah_pesan;
            $k_detailtransaction->jumlah_harga = $k_detailtransaction->jumlah_harga + $harga_k_detailtransaction_baru;
            $k_detailtransaction->update();
        }

        $k_transaction = k_transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $k_transaction->jumlah_harga = $k_transaction->jumlah_harga + $katalog->harga * $request->jumlah_pesan;
        $k_transaction->update();

        Alert::success('Success', 'katalog Berhasil Dimasukkan Keranjang');
        return redirect('/manager/katalog/check_out');
    }

    public function check_out()
    {
        $k_transaction = K_transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($k_transaction)) {
            $k_detailtransactions = K_detailtransaction::where('k_transaction_id', $k_transaction->id)->get();
        }

        return view('manager.katalog.check_out', compact('k_transaction', 'k_detailtransactions'));
    }

    public function delete($id)
    {
        $k_detailtransaction = K_detailtransaction::where('id', $id)->first();

        $k_transaction = K_transaction::where('id', $k_detailtransaction->k_transaction_id)->first();
        $k_transaction->jumlah_harga = $k_transaction->jumlah_harga - $k_detailtransaction->jumlah_harga;
        $k_transaction->update();

        $k_detailtransaction->delete();

        Alert::error('Delete', 'Pesanan Sukses Dihapus');
        return redirect('/manager/katalog/check_out');
    }

    public function konfirmasi()
    {
        $k_transaction = K_transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $k_transaction_id = $k_transaction->id;
        $k_transaction->status = 1;
        $k_transaction->ongkir = 17000;
        $k_transaction->update();

        $k_detailtransactions = K_detailtransaction::where('k_transaction_id', $k_transaction_id)->get();
        foreach ($k_detailtransactions as $k_detailtransaction) {
            $katalog = Katalog::where('id', $k_detailtransaction->katalog_id)->first();
            $katalog->stok = $katalog->stok - $k_detailtransaction->jumlah;
            $katalog->update();

            $k_transaction = K_transaction::where('id', $k_detailtransaction->k_transaction_id)->first();
            $k_transaction->ongkir = $k_transaction->ongkir * $k_detailtransaction->jumlah;
            $k_transaction->update();
        }

        Alert::success('Success', 'katalog Berhasil Di Check Out');
        return redirect('/manager/katalog/pesanan');
    }

    public function pesanan()
    {
        $k_transactions = K_transaction::where('user_id', Auth::user()->id)->where('status', '!=', 0)->orderBy('id', 'desc')->get();

        return view('manager.katalog.pesanan', compact('k_transactions'));
    }

    public function detailpesanan($id)
    {
        $k_transaction = K_transaction::where('id', $id)->first();
        $k_detailtransactions = K_detailtransaction::where('k_transaction_id', $k_transaction->id)->get();

        return view('manager.katalog.pesanandetail', compact('k_transaction', 'k_detailtransactions'));
    }

    public function buktiupload($id)
    {
        $k_transaction = K_transaction::where('id', $id)->first();
        $k_detailtransactions = K_detailtransaction::where('k_transaction_id', $k_transaction->id)->get();

        return view('manager.katalog.bukti', compact('k_transaction', 'k_detailtransactions'));
    }

    public function bukti(Request $request, $id)
    {
        $validation = $request->validate([
            'bukti_transfer' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $k_transaction = K_transaction::findorfail($id);
        if ($request->hasFile('bukti_transfer')) {
            $request->file('bukti_transfer')->move('bukti_transfer/', $request->file('bukti_transfer')->getClientOriginalName());
            $k_transaction->bukti_transfer = $request->file('bukti_transfer')->getClientOriginalName();
            $k_transaction->save();
        }
        $k_transaction->save();

        Alert::success('Bukti Transfer Berhasil Diupload, Menunggu Verifikasi');
        return redirect('/manager/katalog/pesanan');
    }

    public function pendapatan()
    {
        $data = DB::table('k_detailtransactions as td')
        ->join('k_transactions as t', 't.id', '=', 'td.k_transaction_id')
        ->join('katalogs as p', 'p.id', '=', 'td.katalog_id')->where('t.status', '=', 2)
        ->select([
            DB::raw('sum(t.jumlah_harga) as total'),
            DB::raw('sum(t.kode) as kodeunik'),
            DB::raw('sum(td.jumlah) as katalog'),
            DB::raw('DATE(t.tanggal) as tanggal_pesan'),
            DB::raw('p.nama_barang as nama_katalog')
        ])
        ->groupBy('nama_katalog', 'tanggal_pesan')
        ->orderBy('tanggal_pesan', 'desc')
        ->get();

        $total = DB::table('k_transactions as t')
        ->join('k_detailtransactions as td', 't.id', '=', 'td.k_transaction_id')->where('t.status', '=', 2)
        ->select([
            DB::raw('sum(t.jumlah_harga) as jumlah'),
            DB::raw('sum(t.kode) as unik'),
            DB::raw('sum(td.jumlah) as stok')
        ])
        ->get();

        return view('manager.katalog.pendapatan', compact('data', 'total'));
    }
}