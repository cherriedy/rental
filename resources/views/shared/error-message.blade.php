@error('error')
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <span>{{ $message }}</span>
    </div>
@enderror
