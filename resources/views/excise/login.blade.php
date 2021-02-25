
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Admin | Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/signin.css')}}" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="{{ route('admin.submit.login') }}" method="POST">
      @method('POST')
      @csrf

      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <?php if($errors->any()): ?>
          <div class="form-group">
              
          <?php foreach($errors->all() as $error ): ?>
              <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
          <?php endforeach;?>
              
          </div>
      <?php endif; ?>  
        <div class="form-group">
            <label for="inputID" class="sr-only">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" id="inputID" class="form-control" placeholder="Email" required autofocus>      
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <p  class="text-sm-right"> <a href="#">Forget password? </a></p>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
        <!-- <div class="form-group">
            <p>Don't have an account! <a href="{{-- route('user.register') --}}">Sign Up Here</a> </p>
        </div>     -->
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>
