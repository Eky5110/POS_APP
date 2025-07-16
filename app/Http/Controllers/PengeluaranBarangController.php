<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaranBarang;
use App\Models\PengeluaranBarang;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranBarangController extends Controller
{
    public function index(){
        return view('pengeluaran-barang.index');
    }

    public function store(Request $request)
    {
        if (empty($request->produk)){
            toast()->error('Tidak ada produk yang dipilih');
            return redirect()->back();
        }
        $request->validate([
            'produk' => 'required|array',
            'bayar' => 'required|numeric'
        ],[
            'produk.required' => 'Produk harus terisi',
            'bayar.required' => 'Pembayaran harus terisi'
        ]);

        $produk = collect($request->produk);
        $bayar = $request->bayar;
        $total = $produk->sum('sub_total');
        $kembalian = intval($bayar) - intval($total);

        if($bayar < $total){
            toast()->error("Pembayaran tidak cukup");
            return redirect()->back()->withInput([
                'produk' => $produk,
                'bayar' => $bayar,
                'total' => $total,
                'kembalian' => $kembalian,
            ]);
        }

        $data = PengeluaranBarang::create([
            'nomor_pengeluaran' => PengeluaranBarang::nomorPengeluaran(),
            'nama_petugas' => Auth::user()->name,
            'bayar' => $bayar,
            'total_harga' => $total,
            'kembalian' => $kembalian
        ]);

        foreach ($produk as $p){
            ItemPengeluaranBarang::create([
                'nomor_pengeluaran' => $data->nomor_pengeluaran,
                'nama_produk' => $p['nama_produk'],
                'qty' => $p['qty'],
                'harga' => $p['harga_jual'],
                'sub_total' => $p['sub_total']
            ]);

            Product::where('id', $p['produk_id'])->decrement('stok', $p['qty']);
        }

        toast()->success('Transaksi Tersimpan');
        return redirect()->route('pengeluaran-barang.index');
        
    }

    public function laporan(){
        $data = PengeluaranBarang::orderBy('created_at', 'desc')->get()->map(function($item){
            $item->tanggal_transaksi = Carbon::parse($item->created_at)->locale('id')->translatedFormat('l,d F Y');
            return $item;
        });
        return view('laporan.pengeluaran-barang.laporan', compact('data'));
    }

    public function detailLaporan(String $nomorPengeluaran){
        $data = PengeluaranBarang::with('items')->where('nomor_pengeluaran', $nomorPengeluaran)->first();
        $data->total_harga = $data->items->sum('sub_total');
        $data->tanggal_transaksi = Carbon::parse($data->created_at)->locale('id')->translatedFormat('l,d F Y');
        return view('laporan.pengeluaran-barang.detail', compact('data'));
    }
}
