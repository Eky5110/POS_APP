<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Product::all();
        confirmDelete('Hapus Produk', 'Apakah Anda yakin ingin menghapus produk ini?');
        return view('produk.index', compact('produk'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        // Validasi dan simpan produk baru
        $request->validate([
            'nama_produk' => 'required|unique:products,nama_produk,'.$id,
            'harga_jual' => 'required|numeric|min:0',
            'harga_beli_pokok' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|numeric|min:0',
            'stok_minimal' => 'required|numeric|min:0',
            'is_active' => '',
        ],[
            'nama_produk.required' => 'Nama produk harus diisi.',
            'nama_produk.unique' => 'Nama produk sudah ada.',
            'harga_jual.required' => 'Harga jual harus diisi.',
            'harga_beli_pokok.required' => 'Harga beli pokok harus diisi.',
            'kategori_id.required' => 'Kategori harus dipilih.',
            'stok.required' => 'Stok harus diisi.',
            'stok_minimal.required' => 'Stok minimal harus diisi.',
            'is_active.required' => 'Status aktif harus dipilih.',
            'harga_jual.numeric' => 'Harga jual harus berupa angka.',
            'harga_beli_pokok.numeric' => 'Harga beli pokok harus berupa angka.',
            'stok.numeric' => 'Stok harus berupa angka.',
            'stok_minimal.numeric' => 'Stok minimal harus berupa angka.',
        ]);


        $newRequest = [
                'id' => $id,
                'nama_produk' => $request->nama_produk,
                'harga_jual' => $request->harga_jual,
                'harga_beli_pokok' => $request->harga_beli_pokok,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'stok_minimal' => $request->stok_minimal,
                'is_active' => $request->is_active ? true : false,
            
        ];

        if (!$id){
            $newRequest['sku'] = Product::nomorSku();
        }
        Product::updateOrCreate(
            ['id' => $id], 
            $newRequest
            
        );
        toast()->success('Produk berhasil ditambahkan.');
        return redirect()->route('master-data.produk.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toast()->success('Produk berhasil dihapus');
        return redirect()->route('master-data.produk.index');
    }

    public function getData()
    {
        $search = request()->query('search');

        $query = Product::query();
        $produk = $query->where('nama_produk', 'like', '%'. $search .'%')->get();
        return response()->json($produk);
    }

    public function cekStok()
    {
        $id = request()->query('id');
        $stok = Product::find($id)->stok;
        return response()->json($stok);
    }
}
