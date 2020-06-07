<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Order;

class ProfileController extends Controller
{



    public function index(){
        $user = Auth::user();
        $orders= DB::table('orders')
            ->leftJoin('statuses', 'statuses.id', '=', 'orders.status')
            ->select('orders.*', 'statuses.status_name')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $items =array();
        foreach ($orders as $order){
            $cartCollection = $order->cart_data;
            $items[] = json_decode($cartCollection, true);
        }
        return view('profile.index', compact('user', 'orders', 'items'));
    }

    public function profileEdit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
        $avatar = $request->file('avatar'); //при завантажені файлів
        if ($avatar) {
            $data = "/" . $avatar->store('uploads/avatar', 'public');
           $user->avatar = $data;
        }
       /* if ($request->phone) {
            $user->phone = $request->phone;
        }*/
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();
        return view('profile.edit', compact('user'));
    }


}
