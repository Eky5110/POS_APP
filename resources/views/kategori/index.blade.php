@extends('layouts.app')
@section('title', 'Kategori')
@section('content_title', 'Data Kategori')

@section('content')
    <div class="card ">
        <div class="p-2 d-flex justify-content-between border-bottom">
            <h4 class="h4"> Data Kategori</h4>
            <div>
                <x-kategori.form-kategori />
            </div>
        </div>
        <div class="card-body"></div>
        <x-alert :errors='$errors' type='warning'/>
        <table class="table table-sm table-responsive" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $k->nama_kategori}}</td>
                    <td>{{ $k->deskripsi}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                        <x-kategori.form-kategori :id="$k->id"/>
                            <a href="{{ route('master-data.kategori.destroy', $k->id) }}" data-confirm-delete="true" class="btn btn-danger mx-1">
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