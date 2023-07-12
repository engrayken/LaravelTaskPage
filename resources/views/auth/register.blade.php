<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>moorAdvice Registration</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>

<div class="content">
<div class="row align-items-center vh-100 rouded">
<div class="col-md-4 offset-4 border border-1 rounded broder-primary">
<h4>MoorAdvice Registration</h4>
<hr>
<form action="{{ route('registerUser') }}" method="POST">
    @csrf
<div class="form-group">
@if (Session::has('failed'))
<div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif


@if (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

<label for="fullname">Full Name</label>
<input type="text" name="fullname" placeholder="Enter Full Name" value="{{ old('fullname') }}" class="form-control" required>
@error('fullname')
 <div class="text-danger">{{ $message }}
</div>
@enderror
<label for="email">Email</label>
<input type="email" name="Email" placeholder="Enter Email" value="{{ old('Email') }}" class="form-control" required>
@error('Email')
 <div class="text-danger">{{ $message }}
</div>
@enderror
<label for="password">Password</label>
<input type="password" name="Password" placeholder="Enter password" value="{{ old('Password') }}" class="form-control" required>
@error('Password')
 <div class="text-danger">{{ $message }}
</div>
@enderror
<button type="submit" name="submit"  class="btn btn-info mt-1">
    Register Now </button>

    Already a Member <a href="{{ route('login') }}">Login here</a>
</div>

</form>

</div>

</div>
</div>

</body>
</html>
