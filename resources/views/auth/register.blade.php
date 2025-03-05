<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{asset(Storage::url('logo/favicon.png'))}}" type="image">
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
<link rel="stylesheet" href="{{ asset('assets/css/customizer.css')}}">
  <link rel="stylesheet" href="{{asset('public/custom/css/custom.css')}}">
  <title>Sign Up</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: sans-serif, Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 90vh;
      /* background-color: #f5f5f5; */
      background-color: white;

      padding: 20px;
      margin-top: 10vh;
    }

    .container {
      width: 100%;
      max-width: 400px;
      background: white;
      border-radius: 40px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      min-height: 600px;
    }

    .header {
      background: linear-gradient(135deg, rgba(112, 12, 160, 1),rgba(112, 12, 160, 1));
      padding: 25% 20px 10px;
      text-align: left;
      color: white;
      border-bottom-right-radius: 150px;
    }

    .header h1 {
      margin: 10px 0 5px;
      font-size: 28px;
      font-weight: bold;
    }

    .header img {
      width: 80px;
      height: auto;
      margin-bottom: 20px;
    }

    .form {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px;
    }

    .form label {
      font-size: 14px;
      color: #888;
      width: 90%;
      text-align: left;
      margin-bottom: 5px;
      padding-left: 20px;
      font-weight: bold;
    }

    .form input {
      width: 90%;
      padding: 10px;
      padding-left: 20px;
      border: 0px solid #ddd;
      border-radius: 20px;
      margin-bottom: 15px;
      font-size: 14px;
      height: 45px;
      background-color: #F5F5F5;
      color: #555;
      transition: all 0.3s ease;
    }

    .form input::placeholder {
      color: #bbb;
      font-size: 11px;
      filter: blur(0.5px);
      transition: filter 0.3s ease;
    }

    .form input:focus::placeholder {
      filter: none;
    }

    .form .forgot-password {
      text-align: right;
      font-size: 11px;
      color: #888;
      width: 90%;
      margin-bottom: 20px;
      cursor: pointer;
      font-weight: bold;
    }

    .form button {
      width: 90%;
      padding: 15px;
      background: linear-gradient(135deg, rgba(112, 12, 160, 1),rgba(112, 12, 160, 1));
      color: white;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      height: 45px;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .form .signup {
      text-align: center;
      margin-top: 15px;
      font-size: 12px;
      color: #888;
      font-weight: bold;
    }

    .form .signup a {
      color:rgba(112, 12, 160, 1);
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="{{ asset(Storage::url('logo/logo-light.png'))}}" alt="Logo">
      <h1>Sign Up</h1>
    </div>
    <div class="form">
      <form method="post" action="{{route('register')}}">
        @csrf
      <label for="phone">Phone Number</label>
      <input type="text" id="phone" name="phone_no" placeholder="Enter Your Phone Number">
       @error('phone_no')
                <p class="error invalid-name text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </p>
        @enderror
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Your Password">
       @error('password')
                <p class="error invalid-name text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </p>
        @enderror

      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Your Password">
       @error('password_confirmation')
                <p class="error invalid-name text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </p>
        @enderror

      <label for="otp">OTP</label>
      <input type="text" id="otp" name="otp" placeholder="Enter OTP">

      <label for="code">Code</label>
      <input type="text" id="code" name="referral_code" placeholder="Enter Referral Code (Optional)">
       @error('referral_code')
                <p class="error invalid-name text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </p>
        @enderror
      
      
      <button type="submit">Sign Up</button>
      </form>
      <div class="signup">Already Have An Account? <a href="#">Sign In</a></div>
    </div>
  </div>
</body>
</html>
