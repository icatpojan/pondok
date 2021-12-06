<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Ship;
use App\Models\Type;
use App\User;
use Carbon\Carbon;
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
        $Customer = Customer::count();
        $Ship = Ship::count();
        $Product = Product::where('status_id', 1)->count();
        $Type = Type::count();
        $Tipe = Type::get(['name','id']);
        $Week = Invoice::whereBetween('due_date', [Carbon::now()->subDays(7)->toDateTimeString(), Carbon::now()->toDateTimeString()])->count();
        $Month = Invoice::whereBetween('due_date', [Carbon::now()->subDays(30)->toDateTimeString(), Carbon::now()->toDateTimeString()])->count();
        return view('dashboard',compact('Customer','Ship','Product','Type','title','Tipe','Week','Month'));
    }
}