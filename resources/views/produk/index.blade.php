@extends('layouts.app')
@section('title', 'Produk')
@section('content_title', 'Data Produk')

@section('content')

<div class="card">
    <div class="p-2 d-flex justify-content-between border-bottom">
        <h4 class="h4">Data Produk</h4>
        <div>
            <x-product.form-produk />
        </div>
    </div>
    <div class="card-body"></div>

    <x-alert :errors='$errors' type='warning'/>
    
    <table class="table table-sm" id="table1">
        <thead>
            <tr>
                <th>No</th>
                <th>Sku</th>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stock</th>
                <th>Active</th>
                <th>opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $p )
                <tr>
                    <td>{{ $index +1 }}</td>
                    <td>{{ $p->sku }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>Rp. {{ number_format($p->harga_jual,0,",",".") }}</td>
                    <td>Rp. {{ number_format($p->harga_beli_pokok,0,",",".") }}</td>
                    <td>{{ number_format($p->stok) }}</td>
                    <td>
                        <p class="badge {{ $p->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $p->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </p>
                    <td>
                        <div class="d-flex align-items-center">
                            <x-product.form-produk :id="$p->id"/>
                                <a href="{{ route('master-data.produk.destroy', $p->id) }}" class="btn btn-danger mx-1" data-confirm-delete="true">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection