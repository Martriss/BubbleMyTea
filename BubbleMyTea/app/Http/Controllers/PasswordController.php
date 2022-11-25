<?php

   

namespace App\Http\Controllers;

use App\http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

  

class PasswordController extends Controller

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

        return view('password');

    } 

   

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function store(Request $request)

    {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8',
            'new_confirm_password' => 'same:new_password',

        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        $pwchanged ="Votre mot de passe a bien été changé.";
        return view('profile', [
            'changed' => $pwchanged
        ]);

    }
}