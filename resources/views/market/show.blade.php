@extends('layouts.main')

@section('page.title', 'Product')

@section('main.content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none">{{ __('Назад') }}</a>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <p>{{ $product->price }}</p>
                            <img src="{{asset('/storage/'.$product->image) }}" alt="Product Image"
                                 class="img-fluid img-thumbnail">
                            <p>{{ $product->published_at?->format('d.m.Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
