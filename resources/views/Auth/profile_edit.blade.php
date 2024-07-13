<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('assets/todo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="p-login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto">
                        <h2 class="text-center text-primary">Update Profile</h2>
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                            @endif
                            <div class="form-group mb-3 mt-3">
                                <input type="text" value="{{ old('name', auth()->user()->name) }}" name="name" class="form-control" placeholder="Full Name">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <input type="email" value="{{ old('email', auth()->user()->email) }}" name="email" class="form-control" placeholder="Email">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <input type="password" name="password" id="password" class="form-control password" placeholder="New Password (leave blank if not changing)">
                                <i class="fas fa-eye toggle-password" data-target="#password"></i>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control password" placeholder="Confirm New Password (leave blank if not changing)">
                                <i class="fas fa-eye toggle-password" data-target="#password_confirmation"></i>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group w-100 d-flex justify-content-center mb-3">
                                <button type="submit" class="btn btn-primary w-50">Update Profile</button>
                            </div>
                            <div class="text-center mb-3">
                                <a href="{{ url('/') }}" class="btn btn-secondary">Back to Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function () {
                const target = document.querySelector(this.getAttribute('data-target'));
                const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
                target.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
