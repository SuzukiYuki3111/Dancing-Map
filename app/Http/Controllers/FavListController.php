<?php

namespace App\Http\Controllers;
use App\Models\User;
use Inertia\Inertia;

class FavListController extends Controller
{
    public function index($id){
        return Inertia::render('users/favList', [
            'userInfo' => $userInfo = User::find($id),
            'favList' => $userInfo->favorites()->paginate(),
        ]);
    }
}
