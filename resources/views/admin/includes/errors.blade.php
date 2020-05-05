<div class="row">
    <div class="col-md-6">
        @if($errors->all())
            @foreach($errors->all() as $error)
                @component('admin.components.messageValidation')
                    {{$error}}
                @endcomponent
            @endforeach
        @endif
    </div>
</div>
