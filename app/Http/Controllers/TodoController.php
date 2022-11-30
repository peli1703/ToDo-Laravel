<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('dashboard.login');
    }

    public function inputRegister(Request $request)
    {
        // untuk memvalidasi data di db
        $request->validate([
            'email' => 'required',
            'name' => 'required|min:4|max:50',
            'username' => 'required|min:4|max:50',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //hash adalah enkripsi (mengubah huruf menjadi abstrak)
        ]);
        return redirect()->back()->with('succes','berhasil membuat akun');
    }
    public function auth (Request $request){
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
            //required harus diisi
        ],
        [
            //username.exists 
            'username.exists' => "This username doesn't exists"
        ]);
        //aut fitur untuk menyimpan login ke usernya
        $user = $request->only('username', 'password');
        if (Auth::attempt($user)){
            return redirect()->route('todo.index');
        }else{
            return redirect('/')->with('fail', "Gagal Login, perikasa dan coba lagi dong!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function index()
    {
        //menampilkan halaman awal
        //return view buat memanggil file index.blade.php
        $todos = Todo::where([
            ['user_id','=', Auth::user()->id],
            ['status','=', 0],
            ])->get();
        //tampilin file index difolder dashboard dan bawa data dari variable yang namanya todos ke file tersebut
        return view('dashboard.home', compact('todos'));
    }

    public function complated()
    {
        $todos = Todo::where([
            ['user_id','=', Auth::user()->id],
            ['status','=', 1],
            ])->get();
        return view('dashboard.complated', compact('todos'));
    }

    public function updateComplated($id)
    {
        Todo::where('id', $id)->update([
        'status' => 1,
        'done_time' => Carbon::now(),
        ]);
        return redirect()->route('todo.complated')->with('done', 'todo sudah selesai dikerjakan!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan halaman input form tambah data
        return view('dashboard.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mengirim data ke database (data baru) / menambahkan data baru ke db
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('todo.index')->with('successAdd','berhasil menambahkan data ToDo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan form edit data
        // ambil data dari db yang ada id nya sama derngan id yang dikirim di route
        $todo = Todo::where('id', $id)->first();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('dashboard.edit', compact('todo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //mengubah data di database
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        Todo::where('id', $id)->update([
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
        'status' => 0,
        'user_id' => Auth::user()->id,
        ]);
        return redirect('/todo/')->with('successUpdated','data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id','=',$id)->delete();
        return redirect()->route('todo.index')->with('successDelete', 'berhasil menghapus data');
    }
}
