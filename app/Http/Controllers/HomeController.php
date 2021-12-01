<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ship;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $User = User::count();
        $Ship = Ship::count();
        $Category = Category::count();
        $Type = Type::count();
        return view('dashboard',compact('User','Ship','Category','Type','title'));
    }
}