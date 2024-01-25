@if (session()->has('success'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <span>{{ session('success') }}</span>
@endif
