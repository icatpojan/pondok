<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $History = History::orderBy('created_at', 'DESC')->get();
        $title = "Product";
        return view('history', compact('title', 'History'));
    }
}