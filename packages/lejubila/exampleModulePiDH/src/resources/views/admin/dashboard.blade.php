@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('backpack::base.dashboard') }}<small>{{ $name_module }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('backpack.dashboard') }}">{{ trans('backpack::base.dashboard') }}</a></li>
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

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <div class="box-title">Event</div>
                </div>
                <div class="box-body text-center">
                    <div>
                        <p>
                            <button id="button-event">Click to triger event</button>
                        </p>
                        <form method="post" action="/admin/dashboard/example/private-event/1">
                            {{ csrf_field() }}
                            <button type="submit">Click to triger private event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
