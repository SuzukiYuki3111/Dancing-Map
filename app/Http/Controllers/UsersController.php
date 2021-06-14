<?php

namespace App\Http\Controllers;

// use App\Models\Place;
use App\Models\User;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index(){

        $users = User::paginate();
        return Inertia::render('users/index', compact('users'));
    }

    public function show(User $user){
        return Inertia::render('users/show', compact('user'));
    }
}
