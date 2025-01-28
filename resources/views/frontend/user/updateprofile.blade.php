@extends(getLayout())

@section('content')
    <div class="container">
        <div class="py-3 m osahan-header-main">
            <div class="d-flex align-items-center">
                <div class="gap-3 d-flex align-items-center">
                    <a href="{{ url()->previous() }}"><i
                            class="m-0 bi bi-arrow-left d-flex text-success h3 back-page"></i></a>
                    <h3 class="m-0 fw-bold">Edit Profile</h3>
                </div>

            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

      

        <div class="mb-4 overflow-hidden bg-white shadow rounded-4">
            <div class="gap-3 p-4 text-center d-flex align-items-center border-bottom">
                <div><img src="{{ asset('assets/frontend/img/user.jpg') }} " alt="" class="img-fluid cw-70 ch-70 rounded-pill"></div>
                
            </div>
            <div class="p-4">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label text-muted">Name*</label>
                        <input type="text" class="shadow-none form-control" value="{{ $user->name }}" required
                            name="name" id="name">
                    </div>
                    <!-- phone no -->
                    <div class="mb-3">
                        <label class="form-label text-muted">Phone Number</label>
                        <div class="input-group">
                            <span class="bg-white input-group-text">+91</span>
                            <input type="text" class="shadow-none form-control" value="{{ $user->mobile }}" required
                                name="mobile" id="mobile">
                            <span class="bg-white input-group-text"><a href="#"
                                    class="text-decoration-none text-danger"> Change</a></span>
                        </div>
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label class="form-label text-muted">Email</label>
                        <div class="input-group">
                            <input type="email" class="shadow-none form-control" name="email" id="email"
                                value="{{ $user->email }}">
                            <span class="bg-white input-group-text"><a href="#"
                                    class="text-decoration-none text-danger"> Change</a></span>
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="shadow-none form-control">
                            <option value="">Select</option>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <!-- Discription -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo (optional)</label>
                        <input type="file" name="photo" id="photo" class="shadow-none form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="shadow-none form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="shadow-none form-control">
                    </div>

                    <div class="d-grid">
                        <button  type="submit" class="btn btn-success btn-lg rounded-pill">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-5"></div>
    </div>
@endsection
