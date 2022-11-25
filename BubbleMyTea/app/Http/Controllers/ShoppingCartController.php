<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\ShoppingCart;
use App\Models\Supplement;
use App\Models\Poping;
use App\Models\Product;
use App\Models\ShoppingCartProduct;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ShoppingCart::class, 'shopping_cart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopping_cart = ShoppingCart::where('user_id', Auth::id())
                        ->get();
        // dd($shopping_cart);
        if(isset($shopping_cart[0])) {
            $shopping_cart[0]->products = ShoppingCart::where('user_id', Auth::id())
                                    ->join('shopping_cart_products', 'shopping_carts.id', '=', 'shopping_cart_products.cart_id')
                                    ->join('products', 'products.id', '=', 'shopping_cart_products.product_id')
                                    ->join('recipes', 'recipes.id', '=', 'products.recipe_id')
                                    ->join('popings', 'popings.id', '=', 'products.poping_id')
                                    ->select('products.*', 'recipes.name as recipe_name', 'popings.name as popping_name','recipes.image')
                                    ->orderBy('shopping_carts.created_at', 'asc')
                                    ->get();
            // dd($shopping_cart->products);
            foreach($shopping_cart[0]->products as $product) {
                $product->supplements = Supplement::where('product_id', $product->id)
                    ->join('popings', 'popings.id', '=', 'supplements.poping_id')
                    ->select('popings.name as popping_name', 'popings.price')
                    ->get();
            }
        }

        //dd($shopping_cart);

        return view('shopping_cart', [
            'shopping_cart' => $shopping_cart,
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
        // Rediriger quest sur page de connexion
        if (!Auth::check()) {
            return view('auth.login');
        }

        // Méthode utilisé pour ajouter à la table panier et supplément du panier
        // dd($request->all());
        // dd(Auth::id());
        // dd($request->product);

        $price = 0;
        $price_recipe = Recipe::where('id', $request->recipe_id)
                        ->select('recipes.price')
                        ->get();
        // dd($price_recipe[0]->price);
        $price += $price_recipe[0]->price;

        if (isset($request->supplement_popping)) {
            foreach($request->supplement_popping as $popping) {
                $price_pop = Poping::where('id', $popping)
                            ->select('popings.price')
                            ->get();
                
                $price += $price_pop[0]->price;
            }
        }

        $val_product = [
            'recipe_id' => $request->recipe_id,
            'poping_id' =>$request->popping_default,
            'price' => $price,
            'sweetness' => $request->sucre,
        ];

        $prod_id = Product::create($val_product);

        if (isset($request->supplement_popping)) {
            foreach($request->supplement_popping as $popping) {
                $product_id = Product::where('recipe_id', $val_product['recipe_id'])
                            ->where('poping_id', $val_product['poping_id'])
                            ->where('price', $val_product['price'])
                            ->where('sweetness', $val_product['sweetness'])
                            ->select('products.id')
                            ->get();

                // dd($popping);
                $supplement = [
                    'product_id' => $product_id[0]->id,
                    'poping_id' => $popping,
                ];
                Supplement::create($supplement);
            }
        }

        $shopping_cart = ShoppingCart::where('user_id', Auth::user()->id)->get();
        if (!isset($shopping_cart[0])) {
            $val_shopping_cart = [
                'user_id' => Auth::user()->id,
                'price' => 0,
            ];

            ShoppingCart::create($val_shopping_cart);
            $shopping_cart = ShoppingCart::where('user_id', Auth::user()->id)->get();
        }
        // dd($shopping_cart[0]->id);

        $val_shopping_cart_product = [
            'cart_id' => $shopping_cart[0]->id,
            'product_id' => $prod_id->id,
        ];

        ShoppingCartProduct::create($val_shopping_cart_product);

        $shopp_cart = ShoppingCart::find($shopping_cart[0]->id);
        $shopp_cart->price += $val_product['price'];
        $shopp_cart->save();

        return redirect()->action([ShoppingCartController::class, 'index']);
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
    public function update(Request $request, ShoppingCart $shopping_cart)
    {
        // $validated = $request->validate([
        //     'productName' => 'required|max:255',
        //     'description'=> 'required|max:255',
        //     'price' => 'required',
        // ]);

        // $shopping_cart->productName = $validated['productName'];

        // $shopping_cart->save();

        // return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $shopping_cart)
    {
        //
    }
}
