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
      <form method="POST" action="{{ route('switch.password') }}">
         @csrf 
         <div class = "f txt">Modifier le mot de passe</div>
         <div class = "f">
            <label class="labels f" for="password">Mot de passe actuel</label>
            <input class="form-control" id="password" type="password" name="current_password" autocomplete="current-password">
         </div>
         <br>
         <div>
            <label class="labels f" for="password">Nouveau mot de passe</label>
            <input class="form-control" id="new_password" type="password" name="new_password" autocomplete="current-password">
         </div>
         <br>
         <div>
            <label class="labels f" for="password">Confirmer le nouveau mot de passe</label>
            <input class="form-control" id="new_confirm_password" type="password" name="new_confirm_password" autocomplete="current-password">
         </div> 
            <button class = "profile-button f" type="submit">Mettre à jour</button>
      </form>
      <a href ="{{route('profile')}}"><button class = "return-button f"> Retour Profil</button></a>
   </div>
</div>

@endsection
