<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>moorAdvice</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>

<div class="content">
<div class="row align-items-center vh-100">
<div class="col-md-4 offset-4 border border-1 rounded broder-primary">
<h4>MoorAdvice Login</h4>
<hr>
<form action="{{ route('loginUser') }}" method="POST">
    @csrf
<div class="form-group m-4">

    @if (Session::has('failed'))
<div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif


<label for="email">Email</label>
<input type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" class="form-control">
@error('email')
 <div class="text-danger">{{ $message }}
</div>
@enderror

<label for="password">Password</label>
<input type="password" name="password" placeholder="Enter password" value="{{ old('password') }}" class="form-control">
@error('password')
 <div class="text-danger">{{ $message }}
</div>
@enderror
<button type="submit" name="submit"  class="btn btn-info mt-1">
    Login </button>
    Not Yet a Member <a href="{{ route('register') }}">Register here</a>

</div>

</form>

</div>

</div>
</div>

</body>
</html>
