<?php



namespace App\Http\Controllers;

use App\http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProduct;

class ProfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()

    {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('profile');
    } 


    public function profileUpdate(request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20|alpha_dash',
            'email' => 'required|max:40|email'
        ]);
    
        User::find(auth()->user()->email = request()->input('email'));
        User::find(auth()->user()->name = request()->input('name'));
        User::find(auth()->user()->save());
        
        $epchanged ="Les modifications ont été prises en compte.";

        return view('profile', [
            'changed' => $epchanged
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::where('user_id', $id)->get();

        if (isset($orders[0])) {
            foreach($orders as $order) {
                OrderProduct::where('order_id', $order->id)->delete();
                Order::where('id', $order->id)->delete();
            }
        }

        $shopp_carts = ShoppingCart::where('user_id', $id)->get();

        if (isset($shopp_carts[0])) {
            foreach($shopp_carts as $shopp_cart) {
                ShoppingCartProduct::where('cart_id', $shopp_cart->id)->delete();
                ShoppingCart::where('id', $shopp_cart->id)->delete();
            }
        }

        User::where('id', $id)->delete();

        return redirect()->action([RecipeController::class, 'index']);
    }
}
    