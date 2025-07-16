@extends('layouts.app')
@section('title', 'Detail Pengeluaran')
@section('content_title', 'Laporan Pengeluaran Barang')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Laporan Pengeluaran Barang (Transaksi) #{{ $data->nomor_pengeluaran }}</h4>
    </div>
    <div class="card-body">
        <p class="m-0">Tanggal : <strong>{{ $data->tanggal_transaksi }}</strong></p>
        <p class="m-0">Nama Petugas : <strong>{{ $data->nama_petugas }}</strong></p>
        <p class="m-0">Jumlah Bayar : <strong>{{ number_format( $data->bayar) }}</strong></p>
        <p class="m-0">Kembalian : <strong>{{ number_format( $data->kembalian) }}</strong></p>
        <p class="m-0">Total Harga : <strong>{{ number_format( $data->total_harga) }}</strong></p>
        <table class="table table-sm table-bordered mt-3">
            <thead>
                <tr>
                    <th class="text-center" style="width: 20px">No</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $data->items as $i=>$d )
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $d->nama_produk }}</td>
                        <td>{{ $d->qty }}</td>
                        <td>Rp. {{ number_format( $d->harga) }}</td>
                        <td>Rp. {{ number_format( $d->sub_total) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right text-bold">Total Harga</td>
                    <td class="text-bold">Rp. {{ number_format($data->total_harga) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
