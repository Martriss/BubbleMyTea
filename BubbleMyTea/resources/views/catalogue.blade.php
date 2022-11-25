@extends('layouts.template')
<link rel="stylesheet" href="{{ URL::asset('css/admin.css'); }}">

@section('main')
    @can('create', App\Models\Recipe::class)
        <button class="addbutton" onclick="location.href='{{route('recipe.create')}}';">Ajouter un produit</button>
    @endcan
    <div class="foreach">
        @foreach ($recipes as $recipe)
            @if($recipe->inCatalog === 1)
                <a class="lien" href="{{route('recipe.show',$recipe)}}">
                    <div class="product">
                        <img class="image" src="{{Storage::url($recipe->image)}}">
                        <p class ="f"> {{$recipe->name}} {{number_format($recipe->price, 2)}}€</p>
                    </div>
                </a>
            @endif
        @endforeach
    </div>


    @can('update', $recipe)
    <br>
    <h3 class="Horscatalogue">Hors Catalogue</h3>
    <div class="foreach">
        @foreach ($recipes as $recipe)
            @if($recipe->inCatalog === 0)
                <a class="lien" href="{{route('recipe.show',$recipe)}}">
                    <div class="product">
                        <img class="image outcatalog" src="{{Storage::url($recipe->image)}}">
                        <p> {{$recipe->name}} - {{number_format($recipe->price, 2)}}€</p>
                    </div>
                </a>
            @endif
        @endforeach
    @endcan
    </div>
@endsection
