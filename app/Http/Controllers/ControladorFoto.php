<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Foto;

class ControladorFoto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Foto::all ();
        return view ('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('arquivo')->store('imagens', 'public');
        $post = new Foto() ;
        $post->email = $request-> input('email') ;
        $post->mensagem = $request-> input('mensagem') ;
        $post->arquivo = $path ;
        $post->save() ;
        return redirect('/');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Foto::find( $id );
        if(isset($post)) {
            $arquivo = $post->arquivo;
            Storage::disk('public')->delete($arquivo);
            $post->delete();
        }
        return redirect('/');
    }
}
