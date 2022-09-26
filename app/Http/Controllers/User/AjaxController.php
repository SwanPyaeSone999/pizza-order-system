<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function pizzaList(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', $request->status)->get();
        } else {
            $data = Product::orderBy('created_at', $request->status)->get();
        }
        return $data;
    }

    public function addToCart(Request $request)
    {

        $data = [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
        ];
        Cart::create($data);
        $response = [
            'message' => 'add to cart success',
            'status' => '200',
        ];
        return response()->json($response, 200);
    }

    public function order(Request $request)
    {
        $total = 2000;
        foreach ($request->all() as $item) {
            $data =  OrderList::create($item);
            $total += $item['total_price'];
        }
        logger($total);
        logger($data->order_code);
        Cart::where('user_id', auth()->user()->id)->delete();
        Order::create([
            'user_id' => auth()->user()->id,
            'order_code' => $data->order_code,
            'totalprice' => $total,
        ]);
        return response()->json([
            'message' => 'Order success',
        ], 200);
    }

    public function addCart(Request $request)
    {
        $data = Cart::where('user_id', $request->userId)
            ->where('product_id', $request->pizzaId)
            ->update([
                'qty' => $request->qty,
            ]);
        $response = [
            'message' => 'success',
            'status' => '200',
        ];
        return response()->json($data, 200);
    }

    public function minusCart(Request $request)
    {
        $data = Cart::where('user_id', $request->userId)
            ->where('product_id', $request->pizzaId)
            ->update([
                'qty' => $request->qty,
            ]);
        $response = [
            'message' => 'success',
            'status' => '200',
        ];
        return response()->json($data, 200);
    }


    public function viewCount(Request $request)
    {
        $product =  Product::where('id',$request->product_id)->first();
        $product->update([
            'view_count' => $product->view_count  + 1,
        ]);
    }
}