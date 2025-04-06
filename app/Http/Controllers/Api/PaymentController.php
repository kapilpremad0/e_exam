<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\VerifyPaymentRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Str;


class PaymentController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Generate a unique order ID
        $order_id = strtoupper(Str::random(10));

        $amount = 100; // Amount in INR (for example, 100 INR)

        // Create order data
        $orderData = [
            'receipt'         => $order_id,
            'amount'          => $amount * 100, // Convert to paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto-capture payment
        ];

        // Create order in Razorpay
        $razorpayOrder = $api->order->create($orderData);

        // Store order in database
        $order = Order::updateOrCreate(['user_id' => $request->user()->id, 'level_id' => $request->level_id], [
            'order_id'      => $razorpayOrder['id'],
            'receipt'       => $order_id,
            'amount'        => $amount,
            'status'        => 'pending',
            'user_id'     => $request->user()->id,
            'level_id'    => $request->level_id,
        ]);

        return response()->json([
            'order_id' => $razorpayOrder['id'],
            'amount' => $razorpayOrder['amount'],
            'currency' => $razorpayOrder['currency'],
            'key' => env('RAZORPAY_KEY'),
            'order' => $order,
        ]);
    }

    public function verifyPayment(VerifyPaymentRequest $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Update order status in database
            $order = Order::where('order_id', $request->razorpay_order_id)->first();
            $order->status = 'completed';
            $order->payment_status = 'paid';
            $order->razorpay_payment_id = $request->razorpay_payment_id;
            $order->razorpay_signature = $request->razorpay_signature;
            $order->save();

            return response()->json(['status' => 'Payment successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment verification failed'], 400);
        }
    }
    public function getPaymentStatus(Request $request)
    {
        // Logic to get payment status
        return response()->json(['status' => 'Payment status']);
    }
}
