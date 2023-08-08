<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Engine Trust Login</title>
  </head>
  <body>
   <div class="login">
    <div class="login-main-div">
      <div class="login-logo-img ">
        <img src="{{asset('image/login_logo.svg')}}" style="margin-left: 20px" alt="">
      </div>
      <div class="login-main-content">

           <div class="login-left-div">
              <span>Welcome To</span> <br>
              <span class="welcome-header">V6 Auto Centre</span>
           </div>
           <div class="login-right-div">
            @if (Session::get('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
              
          @endif
               <div class="right-div-header">
                <span>Login to account</span> <br>
                <span>Enter your credentials to access your account</span>
               </div>
               <div class="login-input-div">
                <form action="{{route('user.check')}}" method="POST">
                  @csrf
                <div class="email-div">
                  {{-- <label for="">Enter email</label> <br> --}}
                  <input placeholder="Enter email" type="email" name="email" id="" value="{{old('email')}}">
                  <span class="text-danger">@error('email')
                    {{$message}}   
                  @enderror</span>
                </div>
                <div class="password-div">
                  {{-- <label for="">Enter password</label> <br> --}}
                  <input placeholder="Enter password" type="password" name="password" id="" value="{{old('password')}}">
                  <span class="text-danger">@error('password')
                    {{$message}}   
                  @enderror</span> 
                </div>
                <div class="remember-forgot-div">
                  <div class="remember-me-input-div">
                    <input type="checkbox" name="remember_me" id="">&nbsp;<span class="remember-me-text"> Remember for 30 days</span>
                  </div>
                  <div>
                    <span class="forgot-password">Forgot Password</span>
                  </div>  
                </div>
                <div class="submit-button-div">
                   <button type="submit" class="btn"> Login </button>
                </div>
              </form>
                <div class="register-div">
                   <span>Not a member?</span><span>Create account</span>
                </div>
               </div>
           </div>
      </div>

   </div>
    </div> 
    
    

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>