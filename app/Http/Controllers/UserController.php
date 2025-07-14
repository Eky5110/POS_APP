<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        confirmDelete('Hapus User', 'Apakah anda yakin ingin menghapus user ini?');
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        // Validasi dan simpan user baru
        $request->validate([
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
        ],[
            'name.required' => 'Nama harus diisi.',
            'name.unique' => 'Nama sudah ada.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah ada.',
        ]);

       $newRequest = $request->all();
       if(!$id){
        $newRequest['password'] = Hash::make('12345678');
       }

       User::updateOrCreate(['id'=>$id], $newRequest);

        toast()->success('Data Berhasil Disimpan');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(Auth::id() == $id)
        {
            toast()->error('Tidak dapat menghapus akun yang sedang digunakan');
            return redirect()->route('users.index');
        }

        $user->delete();
        toast()->success('Data Berhasil Dihapus');
        return redirect()->route('users.index');
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|min:8|confirmed'
            // 'password_confirmation' => ['same:password']
            // 'password' => Password::min(8)->mixedCase()->numbers()->symbols(),
        ],[
            'old_password.required' => 'Password lama harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::find(Auth::id());

        // cek old password
        if(!Hash::check($request->old_password, $user->password))
        {
            toast()->error('Password lama tidak cocok.');
            return redirect()->route('dashboard');
        }

        // update Passsword
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast()->success('Password berhasil diubah.');
        return redirect()->route('dashboard');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $user = User::find($request->id);
        $user->update(['password' => Hash::make('12345678')]);

        toast()->success('Password berhasil direset.');
        return redirect()->route('users.index');
    }
}
