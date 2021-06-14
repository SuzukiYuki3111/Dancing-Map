<?php

namespace App\Http\Controllers;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function store($id)
    {
        $places = Place::find($id);

        if($places->favorites()->where('user_id', Auth::id())->exists()){
            $places->favorites()->detach(Auth::id());
        } else{
            $places->favorites()->attach(Auth::id());
        }

        return redirect()->back();
    }
}
