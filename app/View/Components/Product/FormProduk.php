<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Kategori;
use phpDocumentor\Reflection\Types\Null_;

class FormProduk extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $nama_produk, $sku, $harga_jual, $harga_beli_pokok, $stok, $is_active, $stok_minimal, $kategori_id, $kategori;
    public function __construct($id=null)
    {
        $this->kategori = Kategori::all();
        if($id){
            $produk = Product::find($id);
            $this->id = $produk->id;
            $this->nama_produk = $produk->nama_produk;
            $this->sku = $produk->sku;
            $this->harga_jual = $produk->harga_jual;
            $this->harga_beli_pokok = $produk->harga_beli_pokok;
            $this->stok = $produk->stok;
            $this->is_active = $produk->is_active;
            $this->stok_minimal = $produk->stok_minimal;
            $this->kategori_id = $produk->kategori_id;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form-produk');
    }
}
