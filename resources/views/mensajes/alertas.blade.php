@if ($mensaje_error = Session::get('mensaje_error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="alert-icon">
            <i class="flaticon-close kt-font-brand text-danger"></i>
        </div>
        <div class="alert-text text-danger">
            <h6>{{ $mensaje_error }}</h6>
        </div>
    </div>
@endif

@if ($mensaje_exitoso = Session::get('mensaje_exitoso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="alert-icon">
            <i class="la la-check-circle kt-font-brand text-success"></i>
        </div>
        <div class="alert-text text-success">
            <h6>{{ $mensaje_exitoso }}</h6>
        </div>
    </div>
@endif
