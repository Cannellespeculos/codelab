@extends('layout')

@section('main')
    <form class="show" method="POST">

    <div class="card">
        <div class="card-header">
            <p class="card-header-title">Nom du produit : {{ $product->name }}</p>
        </div>
        <div class="card-content">
            <div class="content">
                <img src="{{asset("storage/image/". $product->image)}}">
                <p>Prix :</p>
                <p>{{ $product->price }} $</p>
            </div>
        </div>
        <button>Mettre dans le panier</button>
    </div>


    </form>
@endsection
