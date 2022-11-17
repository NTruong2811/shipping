<?php

namespace App\Http\Controllers\web_controller;

use App\Http\Controllers\Controller;
use App\shipping;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $shippings = shipping::select('shippings.shipping_code', 'shippings.name as shipping_name','shippings.ship_from','shippings.created_at', 'delivery_status.name as delivery_status_name',)
            ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
            ->orderBy('shippings.created_at','DESC')
            ->paginate(5);

        return view('Content.Dashboard', [
            'shippings' => $shippings
        ]);
    }
}
