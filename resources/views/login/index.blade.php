@extends('layouts.base')

@section('page.title', __('Login'))

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">{{__('Welcome back!')}}</h2>
                        <form action="{{route('login.store')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="{{__('Email')}}" autofocus>
                                <label for="email">{{__('Email')}}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="{{__('Password')}}">
                                <label for="password">{{__('Password')}}</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">{{__('Remember me')}}</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg d-block w-100">{{__('Login')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
