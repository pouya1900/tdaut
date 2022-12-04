@if (count($errors))
    <div class="alert alert-danger alert-dismissible login_form--alert" role="alert">
        <strong>{{ $errors->first() }}</strong>
    </div>
@endif
@if(session('message'))
    <div class="alert alert-success alert-dismissible register_form--alert" role="alert">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
