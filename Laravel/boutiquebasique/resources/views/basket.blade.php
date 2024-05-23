@extends('layout')

@section('main')
    <section>
        @foreach($Basketproducts as $product)
            {{$instant = $product->product_id}}
            @foreach($products as $pro)
                @if($instant === $pro->id)
                    <article id="product">
                        <h2><a href="{{route("product.show",$pro->id )}}">@lang($pro->name)</a></h2>
                        <img src="{{asset("storage/image/". $pro->image)}}" alt="jpp">
                        <p>@lang($pro->price)$</p>
                    </article>
                @endif
            @endforeach
        @endforeach
    </section>
@endsection
