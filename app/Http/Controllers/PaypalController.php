<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use DB;
use App\Models\Order;


class PaypalController extends Controller
{
    public function return(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            $order = Order::where('order_number', $request->vnp_TxnRef)->first();
            $order->status = 'process';
            $order->payment_status = 'paid';
            $order->save();
//            $cartId = str_replace('0', '', $request->vnp_TxnRef);
//            $cartId = str_replace('#', '', $cartId);
            $cartId = str_replace('#00000', '', $request->vnp_TxnRef);
            $cart = Cart::find($cartId);
//            $cart = Cart::where('id', $cartId)->first();
//dd($request->vnp_TxnRef);
            $orderId = (int)$order->id;
            $cart->order_id = $orderId;
            $cart->status = 'progress';
            $cart->save();
            request()->session()->flash('success', 'Bạn đã thanh toán thành công.');
            return redirect()->route('home');
        }

        request()->session()->flash('error', 'Bạn đã thanh toán thất bại!.');

        return redirect()->route('home');
    }

    public function payment(Request $request)
    {
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
        $data = [];
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => $item['price'],
                'desc'  => 'Thank you for using paypal',
                'qty' => $item['quantity']
            ];
        }, $cart);

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::where('order_number', '#00000' . $cart[0]['id'])->first();

//        $order = Order::where('id', $request->id)->first();
        $total = $order->total_amount;

        $vnp_TmnCode = "TTLETJF8";
        $vnp_HashSecret = "DNCYAMOUBDNRYKCQJZJOQKJFQNKBDVSV";
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = "http://ifruitmarket.local:8000/return-vnpay";
        $vnp_TxnRef = '#00000' . $cart[0]['id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo =  "Thanh toan GD:" . $vnp_TxnRef;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return void
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        // return $response;

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success','You successfully pay from Paypal! Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('home');
        }

        request()->session()->flash('error','Something went wrong please try again!');
        return redirect()->back();
    }
}
