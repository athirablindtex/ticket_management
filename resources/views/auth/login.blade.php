<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Management System</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Reem+Kufi+Fun:wght@500&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Reem Kufi Fun", sans-serif;
    

      
    }

    body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;

    background-size: cover; /* Makes the image cover the entire background */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat; /* Prevents the image from tiling */
}


    .box {
      position: relative;
      width: 400px;
      height: 600px; /* Increased height to accommodate error message */
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      margin-left:50px;
    }

    .box::before,
    .box::after {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 380px;
      height: 420px;
      background: linear-gradient(0deg, transparent, #9b1fe8, #9b1fe8);
      transform-origin: bottom right;
      animation: animate 6s linear infinite;
    }

    .box::after {
      animation-delay: -3s;
    }

    @keyframes animate {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    .form {
      position: absolute;
      inset: 2px;
      border-radius: 8px;
      background: #fff;
      z-index: 10;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form h2 {
      color: #9b1fe8;
      font-weight: 500;
      text-align: center;
      letter-spacing: 0.1em;
      margin-bottom: 10px;
    }

    .logo-text {
      font-size: 1.8em;
      color: #9b1fe8;
      margin-bottom: 10px;
      font-weight: 600;
      text-align: center;
    }

    .clock-icon {
      width: 50px;
      height: 50px;
      margin-bottom: 20px;
    }

    .inputBox {
      position: relative;
      width: 300px;
      margin-top: 35px;
    }

    .inputBox input {
      width: 100%;
      padding: 20px 10px 10px 40px;
      background: transparent;
      border: none;
      outline: none;
      color: #23242a;
      font-size: 1em;
      letter-spacing: 0.05em;
      z-index: 10;
    }

    .inputBox span {
      position: absolute;
      left: 10px;
      padding: 20px 0px 10px;
      font-size: 1em;
      color: #8f8f8f;
      pointer-events: none;
      transition: 0.5s;
    }

    .inputBox input:valid~span,
    .inputBox input:focus~span {
      color: #9b1fe8;
      transform: translateY(-34px);
      font-size: 0.75em;
    }

    .links {
      display: flex;
      justify-content: space-between;
    }

    .links a {
      margin: 10px 0;
      font-size: 0.75em;
      color: #8f8f8f;
      text-decoration: none;
    }

    .links a:hover,
    .links a:nth-child(2) {
      color: #9b1fe8;
    }

    input[type="submit"] {
      border: none;
      outline: none;
      background: #9b1fe8;
      padding: 11px 25px;
      width: 100px;
      margin-top: 10px;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
      color: white;
    }

    input[type="submit"]:active {
      opacity: 0.8;
    }

    /* Error message styling */
    .error {
      margin-top: 20px;
      padding: 10px 15px;
      color: #f44336;
      background-color: #ffe6e6;
      border-left: 4px solid #f44336;
      border-radius: 4px;
      text-align: center;
      font-size: 0.9em;
      width: 100%;
    }
  </style>
</head>

<body style="">

  <div class="box">
    <div class="form">
      <h1 class="logo-text">Ticket Management</h1>
      <img src="https://img.icons8.com/ios-filled/50/9b1fe8/clock.png" class="clock-icon" alt="Clock Icon">
      <h2>Sign in</h2>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <!-- Username Input Box -->
        <div class="inputBox">
          <input type="text" required="required" name="username">
          <span>Username</span>
        </div>

        <!-- Password Input Box -->
        <div class="inputBox">
          <input type="password" required="required" name="password">
          <span>Password</span>
        </div>

        <input type="submit" value="Login">
      </form>

      <!-- Error Message Display -->
      @if ($errors->any())
      <div class="error alert">{{ $errors->first() }}</div>
      @endif

    </div>
  </div>
</body>

</html>
