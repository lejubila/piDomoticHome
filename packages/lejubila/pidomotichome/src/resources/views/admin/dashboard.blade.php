@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        @forelse($modules as $module)
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border text-center">
                    <div class="box-title">{{ $module['name'] }}</div>
                </div>
                <div class="box-body text-center">
                    {{ $module['description'] }}
                    <div><a href="{{ $module['link'] }}"><img src="{{ $module['iconUrl'] }}"></a></div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">{{ trans('pidomotichome::dashboard.no_modules') }}</div>
            </div>
        </div>
        @endforelse
    </div>
@endsection
