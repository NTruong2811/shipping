<?php

namespace App\Http\Controllers\web_controller;

use App\delivery_status;
use App\Http\Controllers\Controller;
use App\Notifications\SendNotifi;
use App\shipping;
use App\SubStatus_delivery;
use Illuminate\Http\Request;

class ShipingsController extends Controller
{
    public function index()
    {
        $shippings = shipping::select('shippings.id as shippings_id', 'shippings.shipping_code',
         'shippings.name as shipping_name', 'shippings.ship_from', 'shippings.created_at', 
         'delivery_status.name as delivery_status_name', 'delivery_status.id as delivery_status_id',
          'lastest_checkpoint_time','description_sub_status')
            ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
            ->join('sub_status_deliveries', 'sub_status_deliveries.id', '=', 'shippings.sub_delivery_status_id')
            ->orderBy('shippings.created_at', 'DESC')
            ->paginate(10);
        $status = delivery_status::all();
        $sub_status = SubStatus_delivery::all();
        return view('Content.Shippings.Shippings', [
            'shippings' => $shippings,
            'status' => $status,
               'sub_status' => $sub_status
        ]);
    }
    public function update(Request $request)
    {
        $shipping = shipping::find($request['update_shipping']['shipping_id']);
        $shipping->delivery_status_id = $request['update_shipping']['DeliveryStatus'];
        $shipping->latest_change_status = $shipping->sub_delivery_status_id;
        $shipping->sub_delivery_status_id = $request['update_shipping']['SubDeliveryStatus'];
        $status  = delivery_status::find($request['update_shipping']['DeliveryStatus']);
        $shipping->update();
        
        return "Chỉnh sửa đơn hàng " . $shipping->shipping_code;
        // return $request['update_shipping']['shipping_id'];
    }

    public function ShippingDetail(Request $request)
    {
        $shipping_detail = shipping::where('shippings.id','=',$request->ShippingId)
        ->select('shippings.*','delivery_status.id as delivery_status_id','delivery_status.name as delivery_status_name',
        'sub_status_deliveries.id as sub_status_deliveries_id','sub_status_deliveries.description_sub_status as sub_status_deliveries_name')
        ->join('sub_status_deliveries', 'sub_status_deliveries.id', '=', 'shippings.sub_delivery_status_id')
        ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
        ->first();
        return $shipping_detail;
    }

    
    


}
