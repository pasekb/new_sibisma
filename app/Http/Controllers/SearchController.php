<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function search(Request $req){
        $search = $req->search;
        $data = Stock::with(['unit' => function($query) use($req){
            $query->where('model_name','like','%'.$req->search.'%');
        }])->get();

        dd($data);

        return view('page', compact('data','search'));
    }
}
