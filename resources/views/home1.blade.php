@extends('layouts.admin1')
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{trans('global.dashboard')}}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('admin.home')}}">{{trans('global.home')}}</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{trans('global.dashboard')}}</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->
        <div class="row">
            <div class="col-xl-5">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4 class="info-box-title">{{ $settings1['chart_title'] }}</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="l-bg-green info-icon">
                                                <i class="fa fa-users pull-left col-orange font-30"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 info-box-title">{{ number_format($settings1['total_number']) }}</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4 class="info-box-title">{{ $settings2['chart_title'] }}</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="col-indigo info-icon">
                                                <i class="fa fa-book pull-left card-icon font-30"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 info-box-title">{{ number_format($settings1['total_number']) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4 class="info-box-title">{{ $settings3['chart_title'] }}</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="col-teal info-icon">
                                                <i class="fa fa-user pull-left card-icon font-30"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 info-box-title">{{ number_format($settings3['total_number']) }}</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h4 class="info-box-title">{{ $settings4['chart_title'] }}</h4>
                                        </div>
                                        <div class="col-auto">
                                            <div class="col-pink info-icon">
                                                <i class="fa fa-coffee pull-left card-icon font-30"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 info-box-title">{{ number_format($settings4['total_number']) }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="card card-box">
                    <div class="card-head">
                        <header>{!! $chart5->options['chart_title'] !!}</header>
                        <div class="tools">
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body no-padding height-9">
                        <div class="row">
                            {!! $chart5->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end widget -->
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Latest Records</header>
                    </div>
                    <div class="card-body ">
                        <div class="mdl-tabs mdl-js-tabs">
                            <div class="mdl-tabs__tab-bar tab-left-side">
                                <a href="#tab4-panel"
                                   class="mdl-tabs__tab tabs_three is-active">{{ $settings6['chart_title'] }}</a>
                                <a href="#tab5-panel" class="mdl-tabs__tab tabs_three">{{ $settings7['chart_title'] }}</a>
                            </div>
                            <div class="mdl-tabs__panel is-active p-t-20" id="tab4-panel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            @foreach($settings6['fields'] as $key => $value)
                                                <th>
                                                    {{ trans(sprintf('cruds.%s.fields.%s', $settings6['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                </th>
                                            @endforeach
                                        </tr>
                                        @forelse($settings6['data'] as $entry)
                                            <tr>
                                                @foreach($settings6['fields'] as $key => $value)
                                                    <td>
                                                        @if($value === '')
                                                            @if($key == 'emp_id')
                                                                <a href="{{route('admin.employees.show', $entry->id)}}">
                                                                    {{ $entry->{$key} }}
                                                                </a>
                                                            @else
                                                                {{ $entry->{$key} }}
                                                            @endif
                                                        @elseif(is_iterable($entry->{$key}))
                                                            @foreach($entry->{$key} as $subEentry)
                                                                <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            @endforeach
                                                        @else
                                                            {{ data_get($entry, $key . '.' . $value) }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($settings6['fields']) }}">{{ __('No entries found') }}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mdl-tabs__panel p-t-20" id="tab5-panel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        @foreach($settings7['fields'] as $key => $value)
                                            @if($key == 'employee')
                                                <th>
                                                    Employee
                                                </th>
                                            @else
                                                <th>
                                                    {{ trans(sprintf('cruds.%s.fields.%s', $settings7['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                </th>
                                            @endif
                                        @endforeach

                                        @forelse($settings7['data'] as $entry)
                                            <tr>
                                                @foreach($settings7['fields'] as $key => $value)
                                                    <td>
                                                        @if($value === '')
                                                            {{ $entry->{$key} }}
                                                        @elseif(is_iterable($entry->{$key}))
                                                            @foreach($entry->{$key} as $subEentry)
                                                                <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            @endforeach
                                                        @else
                                                            @if($key == 'employee')
                                                                <a href="{{route('admin.employees.show', data_get($entry, $key . '.id' ))}}">
                                                                    {{ data_get($entry, $key . '.' . $value) }}
                                                                </a>
                                                            @else
                                                                {{ data_get($entry, $key . '.' . $value) }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($settings7['fields']) }}">{{ __('No entries found') }}</td>
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>{{$settings8['chart_title']}}</header>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <ul class="docListWindow small-slimscroll-style">
                                @forelse($settings8['data'] as $entry)
                                    <li>
                                        <div class="prog-avatar">
                                            <img src="{{$entry->logoUrl}}"
                                                 alt="" width="40" height="40">
                                        </div>
                                        <div class="details">
                                            <div class="title">
                                                <a href="{{route('admin.business-accounts.show', $entry->id)}}">
                                                    {{$entry->BS_Name}}</a> - ({{$entry->BS_ID}})
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div class="mt-3 text-center">
                                        <p>No organisations</p>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {!! $chart5->renderJs() !!}
@endsection
