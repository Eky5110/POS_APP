@extends('layouts.app')
@section('title', 'Laporan Transaksi')
@section('content_title', 'Laporan Pengeluaran Barang (Transaksi)')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Laporan Pengeluaran Barang (Transaksi)</h4>
    </div>
    <div class="card-body">
        <table class="table table-sm" id="table1">
        <thead >
            <tr>
                <th>No</th>
                <th>Nomor Pengeluaran</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Kembalian</th>
                <th>Nama Petugas</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i=>$d )
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->nomor_pengeluaran }}</td>
                    <td>{{ $d->tanggal_transaksi }}</td>
                    <td>Rp. {{ number_format( $d->total_harga) }}</td>
                    <td>Rp. {{ number_format( $d->bayar) }}</td>
                    <td>Rp. {{ number_format( $d->kembalian) }}</td>
                    <td>{{ ucwords($d->nama_petugas) }}</td>
                    <td>
                        <a href="{{ route('laporan.pengeluaran-barang.detail-laporan', $d->nomor_pengeluaran) }}">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
