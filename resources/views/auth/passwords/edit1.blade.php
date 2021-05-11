@extends('layouts.admin1')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/material_style.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('global.my_profile') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">
                        {{ trans('global.my_profile') }}
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-sm-6">
                <div class="card-box">
                    <div class="card-head">
                        <header>{{ trans('global.my_profile') }}</header>
                    </div>
                    <form method="POST" id="myForm" action="{{ route("profile.password.updateProfile") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="title">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                <a href="{{route('admin.permissions.index')}}"
                                   class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card-box">
                    <div class="card-head">
                        <header>{{ trans('global.change_password') }}</header>
                    </div>
                    <form method="POST" id="myForm" action="{{ route("profile.password.update") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="title">New {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="title">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                                </div>
                            </div>

                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                <a href="{{route('admin.permissions.index')}}"
                                   class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
