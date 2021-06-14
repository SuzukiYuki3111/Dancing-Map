<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        // dd(Place::all());
        $places = Place::paginate(6);

        // favoritesをfavoritedとしてuser_idと認証idが一致していたらfavoritedを整数型で返す
        $places = Place::withCount(['favorites as favorited' => function($q){
            $q->where('user_id', Auth::id());
        }])->withCasts(['favorited' => 'boolean'])->with('user')->paginate();

        return Inertia::render('places/index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('places/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(storage_path());
        // validateメソッドで投稿データが合っているか検証
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'map_url' => 'required|url',
            'file' => 'required|file',
        ]);

        // placesに画像ファイルを保存
        $path = Storage::putFile('places', $data['file']);
        $data['file'] = $path;

        // user_idに認証で使ったidを代入
        $data['user_id'] = Auth::user()->id;

        // Placeモデルを使いデータを格納
        $place = Place::create($data);

        // データを格納したら、show.bladeにリダイレクトする
        return redirect()->route('places.show', compact('place'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return Inertia::render('places/show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        return Inertia::render('places/modify', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {

        // $placeのuser_idと認証のユーザーidが違っていたら403を出す
        if($place->user_id != Auth::user()->id){
            abort(403);
        }

        // validateメソッドで修正データが合っているか検証
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'map_url' => 'required|url',
            'file' => 'file',
        ]);

        if(isset($data['file'])){
            // 画像データがあったら削除してまた画像を保存する
            Storage::delete($place->file);
            $path = Storage::putFile('places', $data['file']);
            $data['file'] = $path;
        }
        // updateメソッドでDBのデータを更新する
        $place->update($data);
        // データを格納したら、show.bladeにリダイレクトする
        return redirect()->route('places.show', compact('place'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
          // $placeのuser_idと認証のユーザーidが違っていたらエラーを出す
          if($place->user_id != Auth::user()->id){
            abort(403);
        }
        // データを削除する
        $place->delete();

        // places.indexにリダイレクトする
        return redirect()->route('places.index');
    }
}
