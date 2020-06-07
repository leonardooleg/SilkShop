<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 4/30/2017
 * Time: 10:58 AM
 */

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Cart2Controller extends Controller
{
    public function go(){
        return view('cart2');
    }
    public function index(){
            return view('cart2');
    }

    public function add(Request $request){
        $valid = Validator::make($request->all(),[
            '_check' => 'reinclusion',
        ]);
        if($valid->fails()){
            return redirect()->route('welcome');
        }
        $userId = (new \App\Models\Order)->user_guest();
        $c_id= $userId.'_cart_items';
        $orders = new Order($request->all());
        $cartCollection = \Cart::session($userId)->getContent();
        $cart = $cartCollection->sort();
        $cart->each(function($item) use (&$items)
        {
            $items[] = $item;
        });
        $orders->cart_data =json_encode($items);
        $orders->user_id =$userId;
        $orders->save();
        if($orders){
            \Cart::session($userId)->clear();
            \Cart::session($userId)->clearCartConditions();
            $request=null;
            unset($_REQUEST);
            return view('cart3',[
                'success' => true,
                'id' => $orders->id,
                'email' => $orders->clientEmail,
                'message' => "Заказ успешный!"
            ]);
        }else{
            return back()->with('error', 'Your article has been added error. Please wait for the admin to approve.');
        }


    }


}
