@extends('layouts.template')
<link rel="stylesheet" href="{{ URL::asset('css/admin.css'); }}">
@section('main')
    
<form class="adminform" action="{{ route('recipe.update', $recipe)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" value="{{$recipe->name}}" name="name"><br>
    <textarea name="description" id="description" cols="30" rows="10">{{$recipe->description}}</textarea><br>
    <input type="number" step="0.01" value="{{$recipe->price}}" name="price"><br>
    <img src="{{Storage::url($recipe->image)}}" alt="Image de bubbletea">
    <input type="file" name="image"><br>
    
    <button>Mettre à jour</button>
</form>

@endsection