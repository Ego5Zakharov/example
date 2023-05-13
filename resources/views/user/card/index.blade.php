@extends('layouts.main')

@section('page.title', 'ProductsPage')

@section('main.content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <div class="card">
                    <div class="card-body">
                        @if($card->products->isEmpty())
                            <p class="text-center">{{ __('Продукты не найдены!') }}</p>
                        @else
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach($card->products as $product)
                                    <div class="col mb-4">
                                        <div class="card">
                                            <img src="{{ asset('/storage/'.$product->image) }}" alt="Product Image"
                                                 class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a class="text-decoration-none"
                                                       href="{{route('market.show',$product->id)}}">
                                                        {{$product->name}}
                                                    </a>
                                                </h5>
                                                <p class="card-text">{{ $product->description }}</p>
                                                <p class="card-text">Цена: {{ $product->price }}</p>
                                                <p class="card-text">В
                                                    корзине: {{ $card->getProductQuantity($product->id) }}</p>
                                                <p class="card-text">Сумма
                                                    товаров: {{ $card->getProductTotalPriceCard($product->id) }}</p>

                                                <form action="{{route('user.card.delete', $product->id)}}"
                                                      method="POST">
                                                    @csrf
                                                    <button class="border">Удалить</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                    <p class="card-text">Сумма
                                        корзины: {{ $card->getCardSum() }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
