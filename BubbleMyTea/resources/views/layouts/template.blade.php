<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }}">
    <title>BubbleMyTea</title>
</head>
<body>

    <Header>
        <nav class="navbar">
            <ul class="unorderlist">
                <li><a href="/"><img class="panda" class="space_nav"href="/catalogue">Accueil</a></li>
                <li><a class="space_nav"href="/catalogue">Nos produits</a></li>
                <li><a class="space_nav"href="{{route('about')}}">Qui sommes nous ?</a></li>
                <li><a class="space_nav"href="{{route('best_seller')}}">Favori</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{route('shopping_cart.index')}}">Panier</a></li>  
                        <li><a href="{{ route('profile') }}" class="right">{{ Auth::user()->name }}</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li><a href="route('logout')" class="logout"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">Se déconnecter
                            </a></li>
                        </form>
                        
                    @else
                        <li><a href="{{ route('login') }}" class="right">S'identifier</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="right">S'inscrire</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
          </nav>
          <h1 class= "title">Bubble My Tea</h1>
    </Header>
  
    @yield('main')

    <footer>
        <br>
        <br>
        <ul>
            <li><a href="/contact">Nous contacter</a></li>
            <li><a href="https://deliveroo.fr/fr/menu/paris/18eme-montmartre/bubble-vie/">Livraison</a></li>

        </ul>
    </footer>
    
</body>
</html>
