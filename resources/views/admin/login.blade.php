
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{asset('admin_theam/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin_theam/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin_theam/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('admin_theam/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('admin_theam/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <p>Email : admin@gmail.com</p>
    <p>Password : 123</p>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          
            <form method="post" action="{{route('admin.makelogin')}}">
                @csrf
              <h1>Admin   Login Form</h1>
              @if (session('message'))
              <h6 class="alert alert-danger text-center ">{{ session('message') }}</h6>
          @endif
              <div>
                <input type="text" name="email" class="form-control" placeholder="Enter Email" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required="" />
              </div>
              <div>
              <input type="submit" value="Log In" class="btn btn-default submit" name="" id="">
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
