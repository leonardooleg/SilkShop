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
use YandexCheckout\Client;
use Illuminate\Support\Facades\Redirect;

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

            /////
            $client = new \RetailCrm\ApiClient(
                'https://silkandlace2.retailcrm.ru/',
                'ctdh3KV0salK3A32t2I7TFTiSjem712B',
                \RetailCrm\ApiClient::V5
            );
            if($orders["clientShipping"]=="500"){
                $shipping='russian-post';
            }elseif ($orders["clientShipping"]=="1000"){
                $shipping='ems';
            }else{
                $shipping='self-delivery';
            }

            foreach (json_decode($orders->cart_data) as $one_item){
                $items_ctr[]=array(
                    'productName' => $one_item->name,
                    'initialPrice' => $one_item->price,
                    'quantity' => $one_item->quantity,
                    'properties' => [
                        [
                            'name' => 'Цвет',
                            'value' => $one_item->attributes->color_name
                        ],
                        [
                            'name' => 'Размер',
                            'value' => $one_item->attributes->rus_name_size
                        ],
                    ]
                );
            }
            try {
                $response = $client->request->ordersCreate(array(
                    'firstName' => $orders["clientName"],
                    //'lastName' => 'Фамилия',
                    'phone' => $orders["clientTel"],
                    'email' => $orders["clientEmail"],
                    'call' => 1,
//                    'weight' => 50,
//                    'length' => 150,
//                    'width' => 150,
//                    'height' => 10,
                    //'managerId' => 15,
                    'customerComment' => $orders["clientComment"],
                    'items' => $items_ctr,
                    'delivery' => array(
                        'code' => $shipping,
                        'address' => array(
                            'index' => $orders["clientIndex"],
                            'city' => $orders["clientCity"],
                           // 'region' => $orders["clientShipping"],
                            'street' => $orders["clientAddress"],
                            //'building' => $orders["clientShipping"],
                            //'flat' => $orders["clientShipping"],
                            'notes' => $orders["clientAddress"],
                        ),

                    ),
                    'payments' => array(
                        array(
                            'type' => $orders["type_pay"]
                        )
                    )
                ));
            } catch (\RetailCrm\Exception\CurlException $e) {
                echo "Connection error: " . $e->getMessage();
            }

            if ($response->isSuccessful() && 201 === $response->getStatusCode()) {
                //echo 'Order successfully created. Order ID into retailCRM = ' . $response->id;
                $orders->id_retailcrm =$response->id;
                $orders->save();
            } else {
                echo sprintf(
                    "Error: [HTTP-code %s] %s",
                    $response->getStatusCode(),
                    $response->getErrorMsg()
                );
            }
            /////////
            /// yandex
            $client = new Client();
            $client->setAuth('659047', 'test_A4uJFx4TxD23lWn6DGyCCuxwkKROh63OdWk9pfgG-U0');
            $payment = $client->createPayment(
                array(
                    'amount' => array(
                        'value' => $orders->total_price,
                        'currency' => 'RUB',
                    ),
                    'confirmation' => array(
                        'type' => 'redirect',
                        'return_url' => 'http://leonardooleg.tech/return_url/'.$orders->id,
                    ),
                    'capture' => true,
                    'description' => 'Заказ №'.$orders->id,
                ),
                uniqid('', true)
            );
            $orders->paymentId= $payment->id;
            $orders->save();
            /// yandex
            ///
            return Redirect::to($payment->confirmation->getConfirmationUrl());
        }else{
            return back()->with('error', 'Your article has been added error. Please wait for the admin to approve.');
        }


    }


    public function return_money($cart_id){
        $client = new Client();
        $client->setAuth('659047', 'test_A4uJFx4TxD23lWn6DGyCCuxwkKROh63OdWk9pfgG-U0');
        $order= Order::where('id', $cart_id)->first();
        if(isset($order->paymentId)){
            $payment = $client->getPaymentInfo($order->paymentId);
        }
        if(isset($payment)) {
            if ($payment->getStatus() == "succeeded") {
                return view('cart3', [
                    'success' => true,
                    'id' => $order->id,
                    'email' => $order->clientEmail,
                    'message' => "Заказ успешный! Оплата прошла!"
                ]);
            }
        }else{
            return view('cart3', [
                'success' => false,
                'id' => $order->id,
                'email' => $order->clientEmail,
                'message' => "Заказ добавлен но оплата НЕ прошла!"
            ]);
        }

    }

}
