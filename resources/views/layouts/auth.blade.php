@extends('layouts.base')

@section('content')
    <section>
        <container>
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                    @yield('auth.content')
                </div>
            </div>
        </container>
    </section>
@endsection
