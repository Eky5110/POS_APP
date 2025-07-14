@extends('layouts.app')
@section('title', 'Data Users')
@section('content_title', 'Data Users')
@section('content')
<div class="card">
    <div class="p-2 d-flex justify-content-between border-bottom">
        <h4 class="h4">Data Users</h4>
        <div >
            <x-users.form-users />
        </div>
    </div>
    <div class="card-body">
        <x-alert :errors='$errors' type='warning'/>
        <table class="table table-sm" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Users</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $index => $u )
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->name }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                            <x-users.form-users :id="$u->id"/>
                                <a href="{{ route('users.destroy', $u->id) }}" class="btn btn-danger mx-1" data-confirm-delete="true">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <x-user.reset-password :id="$u->id" />
                                </div>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection