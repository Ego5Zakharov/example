@extends('layouts.main')

@section('page.title', 'Edit Product')

@section('main.content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none">{{ __('Назад') }}</a>

                <div class="card">
                    <div class="card-body">
                        <h3>Edit Product</h3>

                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="published">Published:</label>
                                <select name="published" id="published" class="form-control">
                                    @foreach($options as $index => $option)
                                        <option value="{{ $index }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="published_at">Published At:</label>
                                <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ $product->published_at ? $product->published_at->format('Y-m-d\TH:i') : '' }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
