@extends('layouts.user')
@section('page')

<div class ="contener">
   <div class ="profile">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul class= "f red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
      @endif
      <div class ="f green">
         @isset($changed)
         {{$changed}}
         @endisset
      </div>
         <form  id="deleteprofile" action="{{route('profil.destroy', Auth::user()->id)}}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
                    @csrf
                    @method('DELETE')
                </form>
                <button form="deleteprofile" class = "delete-button f">Supprimer le compte</button>
            <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class = "txt f">Modifier le Profil</div>
            <div class = "f msgprofile">
               <label class="labels f" for="name">Nom:</label>
               <input class="form-control f" type="text" id ="name" name="name" value="{{Auth::user()->name}}">
            </div>
            <div>
               <label class="labels f" for="email">Email:</label>
               <input class="form-control f" type="email" id ="email" name="email" value="{{Auth::user()->email}}">
            </div>
               <button class = "profile-button f" type="submit">Mettre à jour</button>
         </form>
         <a href="{{route('password')}}"><button class = "return-button f">Éditer le mot de passe</button></a>
   </div>
</div>
@endsection
