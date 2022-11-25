<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCartProduct;
use App\Models\Supplement;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $shopping_cart_product = ShoppingCartProduct::where('product_id', $product->id)
                                ->select('shopping_cart_products.cart_id')
                                ->get();

        $my_shopping_cart = ShoppingCart::find($shopping_cart_product[0]->cart_id);
        $my_shopping_cart->price -= $product->price;
        $my_shopping_cart->save();

        ShoppingCartProduct::where('product_id', $product->id)->delete();
        Supplement::where('product_id', $product->id)->delete();
        Product::where('id', $product->id)->delete();

        return redirect()->action([ShoppingCartController::class, 'index']);
    }
}
