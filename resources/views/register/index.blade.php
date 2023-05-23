@extends('layouts.auth')

@section('page.title', 'Register')

@section('auth.content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ __('Регистрация') }}</h5>
            <div class="card-tools">
                <a href="{{ route('login') }}" class="btn btn-link">{{ ('Вход') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('register.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="required">{{('Email')}}</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{request()->old('email')}}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="name" class="required">{{__('Имя')}}</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{request()->old('first_name')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="name" class="required">{{__('Фамилия')}}</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{request()->old('last_name')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="required">{{__('Пароль')}}</label>
                        <input type="password" class="form-control" id="password" name="password"
                               value="{{request()->old('password')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="required">{{__('Повторите пароль')}}</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation" value="{{request()->old('password_confirmation')}}"
                               required>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" value="1"
                                   {{request()->old('agreement') ? 'checked' : ''}} required>
                            <label class="form-check-label"
                                   for="agreement">{{__('Я согласен на обработку пользовательских данных')}}</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">{{__('Зарегистрироваться')}}</button>

                </form>

            </div>
        </div>

    </div>
@endsection
