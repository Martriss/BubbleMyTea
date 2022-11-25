<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Supplement;
use App\Models\OrderProduct;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('orders.user_id', Auth::id())
                        ->orderBy('orders.created_at', 'desc')
                        ->get();
        //dd($orders);

        foreach($orders as $order) {
            $order->products = OrderProduct::where('order_products.order_id', $order->id)
                        ->join('products', 'order_products.product_id', '=', 'products.id')
                        ->join('recipes', 'recipes.id', '=', 'products.recipe_id')
                        ->join('popings', 'popings.id', '=', 'products.poping_id')
                        ->select('products.*', 'recipes.name as recipe_name','popings.name as popping_name')
                        ->get();

            // echo \Carbon\Carbon::parse($order->created_at)->format('D, d M \'y, H:i');
            // $date = getdate($order->created_at->toDateTimeString());
            $order->date_order = \Carbon\Carbon::parse($order->created_at)->format('D, d M \'y');
            if (isset($order->products[0])) {
                foreach($order->products as $product) {
                    $product->supplements = Supplement::where('product_id', $product->id)
                    ->join('popings', 'popings.id', '=', 'supplements.poping_id')
                    ->select('popings.name as popping_name')
                    ->get();
                }
            }
            //dd($order->supplements[0]);
        }
        //dd($orders);

        return view('list_orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $my_shopping_cart = ShoppingCart::find($request->shopping_cart);

        $val_order = [
            'user_id' => $my_shopping_cart->user_id,
            'price' => $my_shopping_cart->price,
        ];
        $my_order = Order::create($val_order);

        $shopping_cart = ShoppingCart::where('id', $my_shopping_cart->id)
                        ->get();
        $shopping_cart[0]->products = ShoppingCart::where('shopping_carts.id', $my_shopping_cart->id)
                                ->join('shopping_cart_products', 'shopping_carts.id', '=', 'shopping_cart_products.cart_id')
                                ->join('products', 'products.id', '=', 'shopping_cart_products.product_id')
                                ->join('recipes', 'recipes.id', '=', 'products.recipe_id')
                                ->join('popings', 'popings.id', '=', 'products.poping_id')
                                ->select('products.*', 'recipes.name as recipe_name', 'popings.name as popping_name')
                                ->orderBy('shopping_carts.created_at', 'asc')
                                ->get();
        foreach($shopping_cart[0]->products as $product) {
            $val_order_products = [
                'order_id' => $my_order->id,
                'product_id' => $product->id,
            ];

            OrderProduct::create($val_order_products);
        }

        ShoppingCartProduct::where('cart_id', $my_shopping_cart->id)->delete();
        ShoppingCart::where('id', $my_shopping_cart->id)->delete();

        return redirect()->route('catalogue');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
