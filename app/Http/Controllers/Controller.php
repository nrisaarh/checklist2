<?php

namespace App\Http\Controllers;
use App\Models\Pic;

abstract class Controller
{
    public function create()
{
    $pics = Pic::all();
    return view('checklists.create', compact('pics'));
}
}
