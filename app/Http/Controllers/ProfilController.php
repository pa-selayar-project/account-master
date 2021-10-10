<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Profil::with('category')->get();
        return view('profil/index', ['data'=>$data]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Profil $profil)
    {
        //
    }

    public function edit(Profil $profil)
    {
        //
    }

    public function update(Request $request, Profil $profil)
    {
        //
    }

    public function destroy(Profil $profil)
    {
        //
    }
}
