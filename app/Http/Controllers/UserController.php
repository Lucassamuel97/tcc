<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller 
{   
    public function index(){
        $users = User::orderBy('created_at', 'asc')->paginate(5);
        return view('users/index',compact('users'));
    }

    public function create(){
      return view('users/create');
    }

    public function store(Request $request){
        $validator = validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('/users/create')
            ->withInput()
            ->withErrors($validator);
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = $request->is_admin;

        $user->save();

        return redirect('/users');
    }

    public function edit($id){
        $user = User::find($id);
        return view('users/create',compact('user'));
    }

    public function update(Request $request, int $id) {
        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('/user/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }
        
        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = $request->is_admin;
        
        $user->save();
        
        return redirect('/users');
    }

    public function destroy($id)
    {
        $del = User::find($id);

        if ($del) {
            session()->flash('message', 'Usuário deletado com sucesso');
        }
        
        return($del)?"sim":"não";
    }

    
}