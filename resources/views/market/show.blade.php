@extends('layouts.main')

@section('page.title', 'Product')

@section('main.content')
    <div class="container">

        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="col-lg-8">
                <a href="{{ route('market') }}" class="text-decoration-none">{{ __('Назад') }}</a>

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

                @if(!$feedbacks->isEmpty())
                    <div class="mt-4">
                        <h2>Комментарии</h2>
                        @foreach($feedbacks as $feedback)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="mb-2">{{ $feedback->comment }}</div>
                                    <div>{{ $feedback->rating }} баллов</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (Auth::check())
                    @if(!$hasFeedback)
                        <div class="mt-4">
                            <h2>Оставьте комментарий</h2>
                            <form action="{{ route('market.feedback', $product) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">{{__('Комментарий')}}</label>
                                    <textarea class="form-control" name="comment" id="comment" cols="10"
                                              rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="rating">{{__('Оценка')}}:</label>
                                    <select class="form-control" name="rating" id="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">{{__('Отправить')}}</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
