@extends('layouts.user')

<link rel="stylesheet" href="{{ URL::asset('css/history.css'); }}">

@section('page')
    <div>
        @foreach ($orders as $order)
            <div class="element">
                <span>{{ $order->date_order }}</span>
                <span class="tabulation">{{number_format($order->price, 2)}}€</span> <br><br>
                <div>
                    @foreach ($order->products as $product)
                        <span>{{ $product->recipe_name }}</span> 
                        <span>avec {{$product->popping_name }} et {{$product->sweetness }}.</span> <br>
                        @isset($product->supplements[0])
                            + supplément : <br>
                            @foreach ($product->supplements as $supplement)
                                <span class="tabulation2"> - {{$supplement->popping_name }}</span> <br>
                            @endforeach
                        @endisset
                        <br>
                    @endforeach  
                </div>
            </div>
        @endforeach
    </div>
@endsection
