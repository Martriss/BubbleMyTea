<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Poping;
use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Http\Request;


class RecipeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
      
        return view('catalogue',[
           'recipes' => $recipes 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createbubble');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('image')->store('img/products', 'public');
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required',
        ]);

        $validated['image'] = $path;

        Recipe::create($validated);

        return redirect()->route('catalogue');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $poppings = Poping::all();

        return view('description',[
            'recipe' => $recipe, 'poppings' => $poppings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('editbubble', [
            'recipe' => $recipe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        if($request->image !== null)
            $path = $request->file('image')->store('img/products', 'public');
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required',
        ]);

        $recipe->name = $validated['name'];
        $recipe->description = $validated['description'];
        $recipe->price = $validated['price'];

        if(isset($path))
            $recipe->image = $path;

        $recipe->save();

        return redirect()->route('catalogue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->inCatalog = 0;
        $recipe->save();

        return redirect()->route('catalogue');
    }

    /**
    * Restore the specified resource from storage.
    *
    * @param  \App\Models\Recipe  $recipe
    * @return \Illuminate\Http\Response
    */
    public function restore(Recipe $recipe)
    {
        $recipe->inCatalog = 1;
        $recipe->save();
 
        return redirect()->route('catalogue');
    }
    
    /**
     * Recette le + vendu
     */
    public function best_seller()
    {
        $recipes = DB::select(
            'SELECT COUNT(*) as nb, recipe_id 
            FROM products 
            GROUP BY recipe_id
            ORDER BY COUNT(*) desc
            LIMIT 1;');
        if(!isset($recipes[0])) {
            return redirect()->route('recipe.show', 1);
        }

        return redirect()->route('recipe.show', $recipes[0]->recipe_id);
    }
}
