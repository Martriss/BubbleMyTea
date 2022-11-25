@extends('layouts.template')
<link rel="stylesheet" href="{{ URL::asset('css/admin.css'); }}">
@section('main')

<div>
    <form class="adminform" action="{{ route('recipe.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Product name" name="name"><br>
        <textarea placeholder="Description" name="description" id="description" cols="30" rows="10"></textarea><br>
        <input type="number" step="0.01" placeholder="Price" name="price"><br>
        <input type="file" name="image"><br>
        
        <button>Ajouter le produit</button>
    </form>
</div>

@endsection
