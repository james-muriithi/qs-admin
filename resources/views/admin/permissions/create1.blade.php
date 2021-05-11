@extends('layouts.admin1')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/material_style.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('cruds.permission.title_singular') }} {{ trans('global.create') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.permissions.index')}}">
                            {{ trans('cruds.permission.title') }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li class="active">
                        {{ trans('global.create') }}
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Basic Information</header>
                    </div>
                    <form method="POST" id="myForm" action="{{ route("admin.permissions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                <button type="button" onclick='document.getElementById("myForm").reset()'
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
