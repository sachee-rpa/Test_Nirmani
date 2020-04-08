@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>
        <i class="fa fa-check" aria-hidden="true" title="Copy to use bell"></i>
        Completed!</strong> {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif