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
                            <a class="text-decoration-none" href="{{ route('admin.products.edit', $product->id) }}">
                                <h3>{{ $product->name }}</h3>
                            </a>

                            <p>{{ $product->description }}</p>
                            <p>{{ $product->price }}</p>
                            <p class="card-text">На складе: {{ $product->stock }}</p>

                            <img src=" {{ asset('/storage/'.$product->image) }}" alt="Product Image" class="card-img-top">
                            <p>{{ $product->published_at?->format('d.m.Y H:i:s') }}</p>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
