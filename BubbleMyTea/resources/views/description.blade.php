@extends('layouts.template')
<link rel="stylesheet" href="{{ URL::asset('css/style.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('css/history.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('css/admin.css'); }}">
@section('main')
    <div class="alignbutton">
        @can('update', $recipe)
            <button class="editbutton" onclick="location.href='{{route('recipe.edit', $recipe)}}';">Modifier</button>
        @endcan
        @can('delete', $recipe)
            @if($recipe->inCatalog === 1)
                <form id="deleteform" action="{{route('recipe.destroy', $recipe)}}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit du catalogue?');">
                    @csrf
                    @method('DELETE')
                </form>
                <button form="deleteform" class="deletebutton">Supprimer</button>
            @else
                <form id="restoreform" action="{{route('recipe.restore', $recipe)}}" method="GET" onsubmit="return confirm('Voulez-vous vraiment remettre ce produit dans le catalogue?');">
                    @csrf
                </form>
                <button form="restoreform" class="editbutton">Restaurer</button>
            @endif
        @endcan
    </div> 
    <!-- ici commence le code du panier vue client -->
    <div class="description">
        <div class="descriptionbis">
            <img class="img" src="{{Storage::url($recipe->image)}}">
        </div>
        <div class="descriptionbis">
            <div>
                <p class ="f"> {{$recipe->name}} : {{number_format($recipe->price, 2)}}€</p> 
                <p class="f"> {{$recipe->description}}</p>
                <form class="f" action="{{route('shopping_cart.store')}}" method="POST" id="panier_add">
                    @csrf
                    <input type="text" name="recipe_id" class="hide" value="{{ $recipe->id }}">
                    <select class="f checksize fontlist" name="popping_default">
                        <div class="popping">
                            @foreach ($poppings as $popping)
                                <div>
                                    <option value="{{$popping->id}}">{{$popping->name}}</option>                            
                                </div>
                            @endforeach()
                        </div>
                    </select>
                    <p class="supp f"> Suppléments :</p>
                    @foreach ($poppings as $popping)
                        <div class="f wrap ">
                            <input class="check" type="checkbox" value="{{$popping->id}}" id="flexCheckDefault{{$popping->id}}" name="supplement_popping[]">
                            <label class="transi" for="flexCheckDefault{{$popping->id}}">
                                {{$popping->name}} + {{number_format($popping->price, 2)}}€
                            </label>
                        </div> 
                    @endforeach()
                    <p class="supp">Sucrosité:</p>
                    <select class ="f checksize fontlist" name="sucre">
                        <div class="sucre ">
                            <div>
                                <option value="Sans sucre">Sans sucre</option>
                                <option value="Normal">Normal: 10g</option>
                                <option value="Très sucré">Très sucré: 20g </option>                           
                            </div>
                        </div>
                    </select>
                    <br>
                    <br>
                </form>
                <button type="submit" form="panier_add" class="editbutton"><i class="icon f"></i>Ajouter au panier</button>
            </div>
        </div>
    </div>
@endsection
