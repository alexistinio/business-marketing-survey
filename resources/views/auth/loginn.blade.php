<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

            <h1 style="font-size: 64px; font-weight: 900">Happening now.</h1>
            <h2 class="mt-4" style="font-size: 32px; font-weight: 800">Join Mark IT today.</h2>



       <form class="mt-4" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3 mt-2 form-field">
                <label for="email" class="mb-2" style="font-family: Raleway; font-weight: bolder; font-size: 15px;">Email or Username</label>
                <div class="col">
                <input id="email" style="height:50px" placeholder="Email or Username" class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" autofocus>
                </div>
                @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>

            <div class="row mb-3 mt-2 form-field">
                <label for="password" class="mb-2" style="font-family: Raleway; font-weight: bolder; font-size: 15px;">Password</label>
                <div class="col">
                    <input id="password" style="height:50px" class="form-control @error('password') is-invalid @enderror"
                                type="password"
                                name="password"
                                placeholder="Enter Password"
                                autocomplete="current-password">
                </div>
                @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>

            <div class="mt-4 flex justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                <div class="mt-2">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                </div>
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
                class="btn btn-dark mt-3">Log in</button>
             
                <div class="mt-4 ms-3" style="font-size: 18px; font-weight: 300">No account yet? Sign up <a href="/register">here</a>.</div>
               
        </form>

      
    </div>
    </div>
</body>
</html>