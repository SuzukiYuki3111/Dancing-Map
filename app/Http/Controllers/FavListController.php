<?php

namespace App\Http\Controllers;
use App\Models\User;
use Inertia\Inertia;

class FavListController extends Controller
{
    public function index(User $user){
        return Inertia::render('users/favList', [
            'favList' => $user->favorites()->paginate(),
            'user' => $user,
        ]);
    }
}
