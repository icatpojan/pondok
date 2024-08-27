<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Content;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Galery;
use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\Preview;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $title = 'Welcome to nusa penida';
        $Destination = Destination::paginate(3);
        $Galery = Galery::get();
        $Package = Package::paginate(3);
        $Event = Event::where('showing', 'yes')->paginate(3);
        $Berita = Berita::where('showing', 'yes')->paginate(3);
        $Content = Content::first();
        $Preview = Preview::where('tampilkan', 'yes')->with(['user'])->get();
        $Country = Country::get();

        return view('UI.welcome', compact('title', 'Preview', 'Destination', 'Galery', 'Package', 'Event', 'Berita', 'Content','Country'));
    }

    public function destination()
    {
        $title = 'Our destination';
        $Destination = Destination::get();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();

        return view('UI.destination', compact('title', 'Destination', 'Galery', 'Content','Country'));
    }

    public function event()
    {
        $title = 'Our Event';
        $Event = Event::where('showing', 'yes')->get();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();
        return view('UI.event', compact('title', 'Event', 'Galery','Content', 'Country'));
    }

    public function berita()
    {
        $title = 'Our news';
        $Berita = Berita::where('showing', 'yes')->get();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();
        return view('UI.berita', compact('title', 'Berita', 'Galery','Content', 'Country'));
    }

    public function showDestination($id)
    {
        $Destination = Destination::where('destination_id', $id)->first();
        $Galery = Galery::get();
        $Preview = Preview::where('tampilkan', 'yes')->where('destination_id', $id)->get();
        $Content = Content::first();
        $Country = Country::get();

        return view('UI.details.destination', compact('Destination', 'Galery', 'Preview','Content', 'Country'));
    }

    public function showEvent($id)
    {
        $Event = Event::where('event_id', $id)->first();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();

        return view('UI.details.event', compact('Event', 'Galery','Content', 'Country'));
    }

    public function showPackage($id)
    {
        $Package = Package::where('package_id', $id)->first();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();

        return view('UI.details.package', compact('Package', 'Galery','Content', 'Country'));
    }

    public function showBerita($id)
    {
        $Berita = Berita::where('berita_id', $id)->first();
        $Galery = Galery::get();
        $Content = Content::first();
        $Country = Country::get();

        return view('UI.details.berita', compact('Berita', 'Galery','Content', 'Country'));
    }


    public function package()
    {
        $title = 'Our tour package';
        $Package = Package::get();
        $Content = Content::first();
        $Galery = Galery::get();
        $Country = Country::get();

        return view('UI.package', compact('title', 'Package', 'Galery','Content', 'Country'));
    }

    public function me()
    {
        $title = 'My page';
        $Content = Content::first();
        $Order = Order::where('user_id', Auth::id())->where('date', '>=', date('y-m-d'))->with(['preview'])->orderBy('created_at', 'DESC')->get();
        $History = Order::where('user_id', Auth::id())->where('date', '<', date('y-m-d'))->with(['preview'])->orderBy('created_at', 'DESC')->get();
        $OrderPackage = OrderPackage::where('user_id', Auth::id())->where('date', '>', now())->get();
        $HistoryOrderPackage = OrderPackage::where('user_id', Auth::id())->where('date', '<', now())->get();

        return view('UI.me', compact('title', 'Order', 'History', 'OrderPackage', 'HistoryOrderPackage', 'Content'));
    }
}
