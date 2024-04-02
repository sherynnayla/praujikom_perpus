<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function index()
    {
        $user = User::all();
        return view('user', compact('user'));
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function layout()
    {
        return view('layout');
    }

    public function inputRegister(Request $request)
    {
        $request->validate([
            'username' =>'required|min:4',
            'password' => 'required',
            'email' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'username' =>$request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! silakan melakukan login'); 
    }

    public function Auth(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($user)) {
            
                return redirect('dashboard')->with('success', "selamat datang dihalaman user");
            
        }
    }

    public function add()
    {
        return view ('/addUser');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        
        User::create([
            'username' =>$request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role,

        ]);
        return redirect('/user')->with('success', 'User berhasil ditambahkan');

    }

    public function editUser($id)
    {
        $user = User::where('id', $id)->first();
        return view ('editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        User::where('id', $id)->update([
            'username' =>$request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role,
            
        ]);

        return redirect('/user')->with('success', 'Data berhasil diperbarui');

    }
    public function destroy($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect('/user')->with('successDelete', 'Berhasil Menghapus User!');
        
    }
    

}