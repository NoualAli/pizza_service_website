@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8">
            <h3 class="text-center mb-4">{{ trans('backpack::base.register') }}</h3>
            <div class="card">
                <div class="card-body">
                    <form class="form" action="{{ route('backpack.auth.register') }}" role="form" method="post">

                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                @php
                                    $label = 'Firstname';
                                    $field = 'firstname';
                                @endphp
                                <label class="@error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror" type="text"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                @php
                                    $label = 'Lastname';
                                    $field = 'lastname';
                                @endphp
                                <label class="@error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror" type="text"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                @php
                                    $label = 'Username';
                                    $field = 'username';
                                @endphp
                                <label class="required @error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror" type="text"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                @php
                                    $label = 'Email';
                                    $field = 'email';
                                @endphp
                                <label class="required @error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror"
                                    type="email"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                @php
                                    $label = 'Phone';
                                    $field = 'phone';
                                @endphp
                                <label class="required @error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror"
                                    type="phone"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                @php
                                    $label = trans('backpack::base.password');
                                    $field = 'password';
                                @endphp
                                <label
                                    class="required @error($field) text-danger @enderror">{{ $label }}</label>
                                <input class="form-control @error($field) border-danger @enderror" type="password"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                @php
                                    $label = trans('backpack::base.confirm_password');
                                    $field = 'password_confirmation';
                                @endphp
                                <label>{{ $label }}</label>
                                <input class="form-control"
                                    type="password"
                                    autocomplete="new-password"
                                    name="{{ $field }}"
                                    value="{{ old($field) }}">
                                @error($field)
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('backpack::base.register') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group d-flex flex-lg-row flex-column justify-content-center w-full">
                                <a class="btn btn-danger text-white" href="{{ route('google.login') }}">
                                    <i class="lab la-google"></i>
                                    {{ __('Google') }}
                                </a>
                                <a class="btn btn-primary text-white" href="{{ route('facebook.login') }}">
                                    <i class="lab la-facebook"></i>
                                    {{ __('Facebook') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                <div class="text-center"><a
                        href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
                </div>
            @endif
            <div class="text-center"><a href="{{ route('backpack.auth.login') }}">{{ trans('backpack::base.login') }}</a>
            </div>
        </div>
    </div>
@endsection
