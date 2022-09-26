<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function list(Request $request)
    {
        $orders = Order::when($request->status,function($query,$status){
                if($status == 'all'){
                    $query;
                }else{
                    $query->where('status', '=' , $status);
                }
             })
             ->orderBy('created_at','desc')
             ->paginate(4);
        return view('admin.order.list', [
            'orders' => $orders,
        ]);
    }

    public function changeStatus(Request $request)
    {
        Order::where('order_code',$request->order_code)
            ->update([
                'status' => $request->status,
            ]);

        return response()->json([
            'message' => 'change status success',
        ],200);

    }

    public function details($ordercode)
    {
        $order = Order::where('order_code',$ordercode)->first();
        $orderlists  =  OrderList::with('user','product')->where('order_code',$ordercode)->get();
        return view('admin.order.details', [
            'orderlists' => $orderlists,
            'order' => $order,
        ]);
    }
}