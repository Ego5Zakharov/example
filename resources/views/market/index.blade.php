@extends('layouts.main')

@section('page.title', 'ProductsPage')

@section('main.content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('market') }}" method="GET">
                            <div>
                                <input type="text" name="search" id="name" value="{{$search}}" placeholder="search">
                            </div>

                            <div>
                                <button type="submit">{{__('Искать')}}</button>
                            </div>
                        </form>
                        @if($products->isEmpty())
                            <p class="text-center">{{ __('Продукты не найдены!') }}</p>
                        @else

                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach($products as $product)
                                    <div class="col mb-4">
                                        <div class="card">
                                            <img src="{{ asset('/storage/'.$product->image) }}" alt="Product Image"
                                                 class="card-img-top">
                                            <div class="card-body">

                                                <h5 class="card-title"><a class="text-decoration-none"
                                                                          href="{{route('market.show',$product->id)}}">{{$product->name}}</a>
                                                </h5>

                                                <p class="card-text">{{ $product->description }}</p>

                                                <p class="card-text">Цена: {{ $product->price }}</p>
                                                <p class="card-text">
                                                    Категории: @foreach($product->categories as $category)
                                                        {{ $category->name }}
                                                    @endforeach</p>


                                                    <p class="card-text">На складе: {{ $product->stock }}</p>

                                                    <form action="{{ route('user.card.create', $product->id) }}"
                                                          method="POST">
                                                        @csrf

                                                        <div class="input-group">
                                                            <input type="number" name="quantity" value="1" min="1"
                                                                   class="form-control" required>
                                                            <button
                                                                type="submit" class="btn btn-primary">Добавить в корзину
                                                            </button>
                                                        </div>
                                                    </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div> {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
