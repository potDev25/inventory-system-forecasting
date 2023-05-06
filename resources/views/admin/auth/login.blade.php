<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Inventory Management System Admin Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>
<body class="">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<br>
<br>
<div class="container">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <form action="/admin-login" method="POST">
    @csrf
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
              <h1>Admin</h1>
              <p class="text-muted">Sign In to your account</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-primary px-4">Login</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-white bg-primary d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <img src="/images/image-admin.jpg" alt="" style="height: 100%; width:100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>

<style type="text/css">
body{
    margin-top:20px;
    background-image: url('/images/admin-bg.svg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;  
}
.container {
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    width: 100%;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}



.card-columns .card {
    margin-bottom: 0.75rem;
}

@media (min-width: 576px) {
    .card-columns {
        column-count: 3;
        column-gap: 1.25rem;
    }
    .card-columns .card {
        display: inline-block;
        width: 100%;
    }
}
.text-muted {
    color: #9faecb !important;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.mb-3 {
    margin-bottom: 1rem !important;
}

.input-group {
    position: relative;
    display: flex;
    width: 100%;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>