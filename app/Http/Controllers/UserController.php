<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*public function __invoke(){
        return "<h1>Listagem de Usuários</h1>";
    }*/
    public function listuser(){
        /*$user = new User();
        $user->name = 'David Marques';
        $user->email = 'davidtheiron412294@gmail.com';
        $user->password = Hash::make(123);
        $user->save();*/

        /*echo "<h1>Listagem de Usuários</h1>";*/

        $user = User::where('id','>=',1)->first();

        return view('listUser', [
            'user' => $user
        ]);
    }
}
