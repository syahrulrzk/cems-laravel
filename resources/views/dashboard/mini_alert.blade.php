@if($count > 0)
<div class="col-12">
    <p class="alert alert-danger">
        <strong class="text-danger">{{ $count }} data on threshold.</strong>
        <br>
        <a href="{{ url('notif') }}?q=threshold" class="text-danger"><small><i class="feather icon-chevrons-right"></i> View detail</small></a>
    </p>
</div>
@endif
