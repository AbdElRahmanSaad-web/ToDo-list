<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{asset('assets/todo.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/login.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
 <div class="p-login">
       <div class="container">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="card mx-auto">
                  
                        <h2 class="text-center text-primary">Login</h2>
                   
                    <form action="{{route('post_login')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        <div class="form-group mb-3 mt-3">
                            <!-- <label for="email" class="form-label">Email</label> -->
                            <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email">
                            <span class="text-danger">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </span> 
                        </div>
                        <div class="form-group mb-3  mt-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" value="{{old('password')}}" name="password" id="password" class="form-control" placeholder="Password">
        <i class="fas fa-eye toggle-password"></i>
                            <span class="text-danger">
                                @error('password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group w-100 d-flex justify-content-center mb-3">
                            <button type="submit" class="btn  btn-primary w-50">Login</button>                        
                        </div>
                        <div class="text-center">
                            <a href="{{ url('register') }}">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
     <script>
        document.querySelector('.toggle-password').addEventListener('click', function (e) {
            const passwordField = document.querySelector('#password');
            const passwordFieldType = passwordField.getAttribute('type');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>