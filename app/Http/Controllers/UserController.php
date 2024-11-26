<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate();
        return view('user.index')->withuser($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:users|min:5',
            'nama_lengkap' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'hp' => $request->hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                $role = new Role;
                $role->user_id = $user->id;
                $role->role = $request->role;
                $role->save();
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }

        return redirect('user')->with('success', 'Data Berhasil Disimpian');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'unique:users,name,' . $id],
            'nama_lengkap' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => ['required', 'string', 'unique:users,email,' . $id],
            'role' => 'required',
        ]);

        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->hp = $request->hp;
            $user->email = $request->email;

            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            if ($user) {
                $cek = Role::where('user_id', $id)->first();
                if ($cek) {
                    $role = Role::where('user_id', $id)->first();
                } else {
                    $role = new Role;
                    $role->user_id = $user->id;
                }
                $role->role = $request->role;
                $role->save();
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }

        return redirect('user')->with('success', 'Data Berhasil Disimpian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'User Gagal di hapus');
        }
        return redirect()->back()->with('success', 'User Berhasil dihapus');
    }

    
}

