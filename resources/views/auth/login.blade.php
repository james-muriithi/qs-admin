@extends('layouts.app')
@section('content')
    <div class="container-login100" style="background-image: url('images/Brance-Quick-Scan.jpg');">
        <div class="wrap-login100 p-t-20 p-b-40">
            <span class="login100-form-title p-b-20 d-none">  Welcome to Brance Prime </span>
            <span class="login100-form-title p-b-41">
					{{ trans('panel.site_title') }} Admin
				</span>
            <form class="login100-form validate-form p-b-33 p-t-5" action="{{ route('login') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="row justify-content-center">
                        <div class="col-10 alert alert-dismissible alert-danger">
                            @foreach($errors->all() as $error)
                                <p class="small">{{$error}}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="wrap-input100 validate-input" data-validate = "Enter Email">
                    <input class="input100" type="text" name="email" class="username" placeholder="john@doe.com" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" class="pass" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
