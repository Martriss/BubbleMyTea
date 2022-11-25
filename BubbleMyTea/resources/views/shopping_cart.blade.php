@extends('layouts.template')

<link rel="stylesheet" href="{{ URL::asset('css/history.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('css/style.css'); }}">

@section('main')

    <div class="basket">
        <span class="title_basket">Mon Panier </span> <br>

        @isset($shopping_cart[0]->products[0])
            <span class="full_price">Total Prix : {{number_format($shopping_cart[0]->price, 2)}}€</span>

            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <input type="text" name="shopping_cart" class="hide" value="{{ $shopping_cart[0]->id }}">
                <input type="submit" class="my_submit" value="Confirmer Panier" onclick="alert('Votre commande a bien été prise en compte.')">
            </form>
        @endisset
        @isset($shopping_cart[0])
            @foreach ($shopping_cart[0]->products as $product)
                <div class="element2">
                    <form id="delete_article" action="{{route('product.destroy', $product)}}" method="POST" 
                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit de votre panier ?');">
                        @csrf
                        @method('DELETE')
                    </form>
                    <nav class="navshop">
                        <span class="article">Article </span> <br></li>
                        <br><span class="prix">Prix {{number_format($product->price, 2)}}€</span> <br><br>
                    </nav> 
                    <button form="delete_article" class="my_button">Supprimer l'article</button> <br>        
                    <img class="imgshop" src="{{Storage::url($product->image)}}">
                    <div class="tabulation2">{{ $product->recipe_name }} avec {{$product->popping_name }}.
                        @isset($product->supplements[0]) <br>
                        <div class="supple">
                            + supplément : <br>
                            @foreach ($product->supplements as $supplement)
                            <span class="tabulation2"> - {{$supplement->popping_name }}</span> <br>
                            @endforeach
                        </div>    
                        @endisset
                    </div>
                </div>
            @endforeach
        @endisset
    </div>

@endsection
