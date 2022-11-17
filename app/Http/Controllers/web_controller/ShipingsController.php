<?php

namespace App\Http\Controllers\web_controller;

use App\delivery_status;
use App\Http\Controllers\Controller;
use App\shipping;
use Illuminate\Http\Request;

class ShipingsController extends Controller
{
    public function index()
    {
        $shippings = shipping::select('shippings.id as shippings_id','shippings.shipping_code', 'shippings.name as shipping_name', 'shippings.ship_from', 'shippings.created_at', 'delivery_status.name as delivery_status_name','delivery_status.id as delivery_status_id')
            ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
            ->orderBy('shippings.created_at', 'DESC')
            ->paginate(10);
        $status = delivery_status::all();
        return view('Content.Shippings.Shippings', [
            'shippings' => $shippings,
            'status'=> $status
        ]);
    }
    public function update(Request $request){
        $shipping = shipping::find($request['update_shipping']['shipping_id']);
        $shipping->delivery_status_id = $request['update_shipping']['id_change'];
        $status  = delivery_status::find($request['update_shipping']['id_change']);
        $shipping->update();
        return "Chỉnh sửa đơn hàng ".$shipping->shipping_code." sang trạng thái ". $status->name;
        // return $request['update_shipping']['shipping_id'];
    }
}
