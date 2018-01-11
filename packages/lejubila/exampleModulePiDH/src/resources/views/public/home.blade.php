@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('pidomotichome::home.title') }} <small>{{ $name_module }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('pidomotichome.public.index') }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('pidomotichome.home') }}">{{ trans('pidomotichome::home.title') }}</a></li>
            <li class="active">{{ $name_module }}</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="row">
        @widget('ExampleModule.Widgets.DateTime')
        @widget('ExampleModule.Widgets.DateTime')
        @widget('ExampleModule.Widgets.DateTime')
        @widget('ExampleModule.Widgets.DateTime')
        @widget('ExampleModule.Widgets.DateTime')
    </div>

@endsection

@section('after_scripts')

    <script>
        /*
        Echo.private(`order.{orderId}`)
            .listen('ShippingStatusUpdated', (e) => {
            console.log(e.update);
        });
        */
        /*
        e = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001'
        });

        e.channel('example-channel')
            .listen('ExampleEvent', function(e){
                console.log(e);
            });
        */
    </script>

@endsection
