<?php

namespace App\Http\Controllers;

use App\Models\ItemPenerimaanBarang;
use App\Models\PenerimaanBarang;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PenerimaanBarangController extends Controller
{
    public function index()
    {
        return view('penerimaan-barang.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'distributor' => 'required',
            'nomor_faktur' => 'required',
            'produk' => 'required'
        ],[
            'distributor.required' => 'Distributor harus diisi',
            'nomor_faktur.required' => 'Nomor Faktur harus diisi',
            'produk.required' => "produk harus diisi"
        ]);

        $newData = PenerimaanBarang::create([
            'nomor_penerimaan' => PenerimaanBarang::nomorPenerimaan(),
            'distributor' => $request->distributor,
            'nomor_faktur' => $request->nomor_faktur,
            'petugas_penerima' => Auth::user()->name,
        ]);
     
        $produk = $request->produk;
        foreach($produk as $index => $value){
            ItemPenerimaanBarang::create([
                'nomor_penerimaan' => $newData->nomor_penerimaan,
                'nama_produk' => $value['nama_produk'],
                'qty' => $value['qty'],
                'harga_beli' => $value['harga_beli'],
                'sub_total' => $value['sub_total']
            ]);

            Product::where('id', $value['produk_id'])->increment('stok', $value['qty']);
        }
        
        toast()->success('Data berhasil ditambahkan');
        return redirect()->route('penerimaan-barang.index');
    }

    public function laporan()
    {
        $penerimaanBarang = PenerimaanBarang::orderBy('created_at','desc')->get()->map(function($item){
            $item->tanggal_penerimaan = Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y');
            return $item;
        });
        return view('laporan.penerimaan-barang.laporan',compact('penerimaanBarang'));
    }

    public function detailLaporan(String $nomorPenerimaan){
        $data = PenerimaanBarang::with('items')->where('nomor_penerimaan', $nomorPenerimaan)->first();
        $data->tanggal_penerimaan = Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d F Y');
        $data->total = $data->items->sum('sub_total');
        return view('laporan.peerimaan-barang.detail', compact('data'));
    }
}
