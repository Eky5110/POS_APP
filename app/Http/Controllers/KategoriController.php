<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        confirmDelete('Hapus Data','Apakah Anda yakin ingin menghapus kategori ini?');
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,'.$id,
            'deskripsi' => 'required|max:500|min:10',
        ],[
            'nama_kategori.required' => 'Nama Kategori harus diisi',
            'nama_kategori.unique' => 'Nama Kategori sudah ada',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);

        Kategori::updateOrCreate(
            ['id' => $id],
            [
                'nama_kategori' => $request->nama_kategori,
                'slug'=> Str::slug($request->nama_kategori),
                'deskripsi' => $request->deskripsi,
            ]
        );

        toast()->success('Data Berhasil Disimpan');
        return redirect()->route('master-data.kategori.index');
    }

    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        toast()->success('Data Berhasil Dihapus');
        return redirect()->route('master-data.kategori.index');
    }
}
