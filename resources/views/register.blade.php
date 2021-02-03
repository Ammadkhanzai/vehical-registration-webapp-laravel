
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Sign up</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <!-- <link href="{{ asset('assets/signin-bootstrap.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/signin.css')}}" rel="stylesheet">
  </head>
  <body class="text-center">
  
    <form class="form-signin" action="{{ route('user.register.submit') }}" method="POST">
      @method('POST')
      @csrf
      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please Sign up</h1>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <?php if($errors->any()): ?>
          <div class="form-group">
              
          <?php foreach($errors->all() as $error ): ?>
              <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
          <?php endforeach;?>
              
          </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="inputCnic" class="sr-only">CNIC Number</label>
        <input type="text" name="cnic" value="{{old('cnic')}}" id="inputCnic" class="form-control" placeholder="CNIC: Example: 4130477674155" required autofocus>
      </div>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" name="email" value="{{old('email')}}" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      </div>
      
      <div class="form-group">
        <label for="inputConfPassword" class="sr-only">Confirm Password</label>
        <input type="password" name="conf-password" id="inputConfPassword" class="form-control" placeholder="Confirm Password" required>
      </div>
      <div class="row m-t-25 text-left">
          <div class="col-md-12">
              <div class="checkbox-fade fade-in-primary">
                  <label>
                      <span class="text-inverse">
                          Select Role:
                      </span>
                  </label>
              </div>
          </div>
          <div class="col-md-12">
              <div class="checkbox-fade fade-in-primary">
                  <label>
                      <input type="radio" name="role" value="1" @if (old('role') == "1") {{ 'checked' }} @endif >
                      <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                      <span class="text-inverse">User</span>
                  </label>
              </div>
          </div>
          <div class="col-md-12">
              <div class="checkbox-fade fade-in-primary">
                  <label>
                      <input type="radio" name="role" value="2" @if (old('role') == "2") {{ 'checked' }} @endif >
                      <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                      <span class="text-inverse">Dealer</span>
                  </label>
              </div>
          </div>
          <div class="col-md-12">
              <div class="checkbox-fade fade-in-primary">
                  <label>
                      <input type="radio" name="role" value="3" @if (old('role') == "3") {{ 'checked' }} @endif>
                      <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                      <span class="text-inverse">Manufacturer</span>
                  </label>
              </div>
          </div>
      </div>      
      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>
