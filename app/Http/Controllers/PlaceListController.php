<?php

namespace App\Http\Controllers;
use App\Models\Place;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PlaceListController extends Controller
{
    public function index(User $user){

        // $places = Place::paginate();

        // favoritesをfavoritedとしてuser_idと認証idが一致していたらfavoritedを真偽値で返す
        // $places = Place::withCount(['favorites as favorited' => function($q){
        //     $q->where('user_id', Auth::id());
        // }])->withCasts(['favorited' => 'boolean'])->with('user')->paginate();

        return Inertia::render('users/placeList', [
            'placeList' => $user->places()->paginate(),
            'user' => $user,
            // 'places' => $places,
        ]);
    }
}
