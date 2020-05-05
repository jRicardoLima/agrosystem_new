@php
    $typeAlert = strtolower(strstr($type,'@',true));
@endphp
@if($typeAlert == 'warning')
    <div class="alert alert-warning" role="alert">
        {{clearVars(['@'],strstr($slot,'@'))}}
    </div>
@elseif($typeAlert == 'success')
    <div class="alert alert-success" role="alert">
        {{clearVars(['@'],strstr($slot,'@'))}}
    </div>
@elseif($typeAlert == 'danger')
    <div class="alert alert-danger" role="alert">
        {{clearVars(['@'],strstr($slot,'@'))}}
    </div>
@else
    <div class="alert alert-primary" role="alert">
        {{clearVars(['@'],strstr($slot,'@'))}}
    </div>

@endif

