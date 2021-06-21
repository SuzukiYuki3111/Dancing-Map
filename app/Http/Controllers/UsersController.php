<?php

namespace App\Http\Controllers;

// use App\Models\Place;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(){

        $users = User::paginate(5);
        return Inertia::render('users/index', compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        return Inertia::render('users/show', compact('user'));
    }
}
