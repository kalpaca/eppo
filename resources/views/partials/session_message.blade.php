@if (Session::has('success-message'))
    <div class="alert alert-success">
        <p>{{ Session::get('success-message') }}</p>
    </div>
@endif
@if (Session::has('message'))
    <div class="alert alert-default">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
@if (Session::has('warning-message'))
    <div class="alert alert-warning">
        <p>{{ Session::get('warning-message') }}</p>
    </div>
@endif