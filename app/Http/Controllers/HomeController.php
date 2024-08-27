<?php

namespace App\Http\Controllers;

use App\ai;
use App\Mapel;
use App\Models\AiCustomerData;
use App\Models\AiMobile;
use App\Models\PimType;
use App\Models\PimProduct;
use App\Models\PimInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Troubleshoot;
use App\Models\Swap;
use App\Models\Permintaan;
use App\User;

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
    $title = 'judul';
    $Murid = User::role('murid')->count();
    $Guru = User::role('guru')->count();
    $Mapel = Mapel::count();

    return view('dashboard', compact('title','Guru','Murid','Mapel'));
  }
}
