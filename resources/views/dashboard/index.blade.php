@extends('layouts.app')
@section('title', 'Dashboard')
@section('content_title', 'Dashboard')

@section('content')
<x-alert :errors='$errors' type='warning'/>
<div class="row">
    <x-dashboard-card type="bg-info" icon="fas fa-users" label="Total Users" value="{{ $totalUsers }}"/>
    <x-dashboard-card type="bg-warning" icon="fas fa-suitcase" label="Total Produk" value="{{ $totalProduk }}"/>
    <x-dashboard-card type="bg-success" icon="fas fa-shopping-bag" label="Total Order" value="{{ $totalOrder }}"/>
    <x-dashboard-card type="bg-teal" icon="fas fa-dollar-sign" label="Total Pendapatan" value="{{ $totalPendapatan }}"/>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi Terakhir</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Nomor Transaksi</th>
                            <th>Total Harga</th>
                            <th>Jumlah Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestOrder as $o )
                        <tr>
                            <td>{{ $o->tanggal_transaksi }}</td>
                            <td>{{ $o->nomor_pengeluaran }}</td>
                            <td>{{ $o->items->count() }} <small>Item</small></td>
                            <td>Rp. {{ number_format( $o->total_harga) }}</td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Menampilkan 5 Data Transaksi Terakhir
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Produk Terlaris</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $produkTerlaris as $i=>$p )
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->nama_produk }}</td>
                                <td>{{ $p->total_terjual }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Menampilkan 5 Produk Terlaris
            </div>
        </div>
    </div>
</div>
@endsection
