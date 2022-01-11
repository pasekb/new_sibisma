<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockHistory;

class ReportController extends Controller
{
    public function stockHistory(){
        $data = StockHistory::all();
        return view('page', compact('data'));
    }
}
