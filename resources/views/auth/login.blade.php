@extends(getLayout())

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div>
        <h2>We Are Here To 100% Secure</h2>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email_or_mobile" class="form-label">Email or Mobile</label>
            <input type="text" name="email_or_mobile" id="email_or_mobile" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (Optional for OTP)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</div>
</div>
@endsection
