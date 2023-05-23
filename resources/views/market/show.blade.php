@extends('layouts.main')

@section('page.title', 'Product')

@section('main.content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
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
                @if(\App\Models\Feedback::all()->contains('user_id',auth()->user()->id))
                    <form action="{{route('user.market.delete')}}" method="POST">
                        @csrf
                        <button type="submit">Удалить свой комментарий</button>
                    </form>
                @endif
                @if(!$feedbacks->isEmpty())
                    <div class="mt-4">
                        <h2>Комментарии</h2>
                        @foreach($feedbacks as $feedback)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <span>{{ $user->first_name }}</span>
                                        <span>{{ $user->last_name }}</span>
                                        <span
                                            class="float-sm-end">{{ \Carbon\Carbon::parse($feedback->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <div class="mb-2">{{ $feedback->comment }}</div>
                                    <div class="flex items-center">
                                        <div class="pl-6 flex">
                                            @for ($i = 0; $i < $feedback->rating; $i++)
                                                <img src="https://img.icons8.com/ios-filled/256/filled-star.png"
                                                     style="height: 16px; width: 16px"/>
                                            @endfor
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (Auth::check())
                    @if(!$hasFeedback)
                        <div class="mt-4">
                            <h2>Оставьте комментарий</h2>
                            <form action="{{ route('user.market.create', $product) }}" method="POST">
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
