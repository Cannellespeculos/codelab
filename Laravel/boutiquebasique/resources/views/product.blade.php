@extends("layout")

@section('css')
        .card-footer {
            justify-content: center;
            align-items: center;
            padding: 0.4em;
        }
        .is-info {
            margin: 0.3em;
        }

        select, .is-info {
            margin: 0.3em;
        }

        .author {
            background-color: pink;
            width: 100%;
            height: 100%;
        }

    @endsection


@section("main")
    <main>
        <section>
            @foreach($products as $product)
                <article id="product">
                    <span class='author'>
                      <a href="{{route("product.show",$product->id )}}"></a>
                  </span>
                    <h2><a href="{{route("product.show",$product->id )}}">@lang($product->name)</a></h2>
                    <img src="{{asset("storage/image/". $product->image)}}" alt="jpp">
                    <p>@lang($product->price)$</p>
                </article>
            @endforeach
        </section>
        <footer class="card-footer is-centered">
            {{ $products->links() }}
        </footer>
    </main>
@endsection


@section("js")
    <script>
        const articles = document.getElementById("product")

        for (let i = 0; i < articles.length; i++) {
            let article = articles[i]

            article.addEventListener("click" , () => {

            })
        }
    </script>

@endsection
