<div class="widget wt-{{ $idWidgetType }} col-md-4 col-sm-6 col-xs-12" id="wid-{{ $idWidget }} }}">
    <div class="box box-primary">
        <div class="box-header with-border text-center">
            <div class="box-title">{{ $nameWidget }}</div>
        </div>
        <div class="box-body text-center">
            <div>{{ $descriptionWidget }}</div>

            <div class="btn-group btn-group-zone">
                <form method="post" action="{{ $button->actionUrl }}">
                    <button class="btn btn-app" style="margin-bottom: 0px;">
                        {{ csrf_field() }}
                        <input type="hidden" name="wid" value="{{$idWidget}}" />
                        <i class="fa {{ $button->actionButtonClass }}"></i> <span class="button-zone-text">{{ $button->actionButtonText }}</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>


