<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     <style>
         @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap');

         .form-field {
            width: 80%
         }
         .container-r {
            width:50%; 
            max-width: 50%; 
            background-color: whitesmoke;
            display: flex; 
            flex-direction: column;
            justify-content: center
         }
        @media only screen and (max-width: 1090px) {
          .form-field {
            width: 100%
        }
      }
        @media only screen and (max-width: 780px) {
            .container-l {
                display: none
            }
            .container-r {
                width: 100%;
                max-width: 100%;
            }
        }
     </style>
    <title>Mark IT</title>
</head>
<body>
    
    <div style="height: 100vh; display: flex">

    
        <div 
           class="container-l" 
           style="
                display: flex;
                width:50%; 
                max-width: 50%; 
                background-color: silver; 
                background-position: center;
                background-size: cover;
                align-items: center;
                justify-content: center">

            <img src="/images/logo.png" width="500" height="180" alt="">
        </div>

        <div 
             class="container-r px-4">

            <h1 style="font-size: 50px; font-weight: 900">Sign-up</h1>
            <p class="text-danger" style="font-style: italic; font-size: 15px;">Note: Please make sure to enter your <span style="font-weight: bold; text-decoration: underline;">G-cash</span> number. Your points will not be converted into peso if the number you provided is invalid.</p>
            
            <form method="POST" action="{{ route('register') }}">
            @csrf

                <div class="row mb-3 form-field">
                    <label for="name" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Name:</label>
                    <div class="col">
                        <input id="name" style="height: 38px" type="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus>
                    </div>
                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                
                <div class="row mb-3 form-field">
                    <label for="email" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Email:</label>
                    <div class="col">
                        <input id="email" style="height: 38px" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" autofocus>
                    </div>
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row mb-3 form-field">
                    <label for="username" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Username:</label>
                    <div class="col">
                        <input id="username" style="height: 38px" type="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="username" autofocus>
                    </div>
                    @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row mb-3 form-field">
                    <label for="phone_number" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Phone Number (G-cash):</label>
                    <div class="col">
                        <input id="phone_number" style="height: 38px" type="text" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" autocomplete="phone_number" autofocus>
                    </div>
                    @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
    
                <div class="row mb-3 form-field">
                    <label for="password" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Password:</label>
                    <div class="col">
                        <input id="password" style="height: 38px" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus>
                    </div>
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
    
                <div class="row mb-3 form-field">
                    <label for="password_confirmation" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Confirm Password:</label>
                    <div class="col">
                        <input id="password_confirmation" style="height: 38px" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" autofocus>
                    </div>
                </div>

                <label for="voucher" style="font-family: Raleway; font-weight: bolder; font-size: 14px;">Voucher:</label>
                <div style="display:flex; width:100%">
                    <input id="voucher" type="text" style="height: 38px; width:160px" value="{{ old('voucher') }}" class="form-control me-2" name="voucher">
                    <button id="enter_code" type="button" class="btn btn-success" style="width:130px">Enter Code</button>
                    <span id="code_added" class="ms-3 pt-1" style="font-style: italic; color:gray; display: none">MARKIT10</span>
                 </div>   
                <button 
                    type="submit"  
                    style="
                        width: 70%; 
                        height: 60px; 
                        border-radius: 35px; 
                        font-family: Raleway; 
                        font-size: 18px;
                        font-weight: bolder" 
                    class="btn btn-dark mt-3">Sign-up</button>
                
                 
                    <div class="mt-4 ms-3" style="font-size: 18px; font-weight: 300">Already have an account? Log in <a href="/login">here</a>.</div>
                   
            </form>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("#enter_code").click(function (e) { 
            e.preventDefault();
       
            $('#code_added').css('display', 'block');
            let x = $('#voucher').val();
            $('#code_added').text(x);
        });
    });
</script>
</html>