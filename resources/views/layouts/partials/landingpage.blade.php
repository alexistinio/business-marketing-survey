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
    <title>Mark IT</title>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap');
       
      p{
        font-size: 18px
      }
      .card{
        width: 22rem
      }
      .borderline {
        border-left:1px solid white
      }
      .plan-cards ul li{
        font-family: 'Raleway', sans-serif;
        font-weight: 400;
      }
      .right-side a:hover{
        background-color: rgb(197, 39, 39)
      }
      @media only screen and (max-width: 1200px) {
        .plans {
          flex-direction: column;
          align-items: center;
        }
        .card {
          width: 30rem
        }
      }
      @media only screen and (max-width: 990px) {
      .borderline {
        border:none
      }
      }
      @media only screen and (max-width: 600px) {
        .rewards {
          width: 100%;
          height:400px
        }
        .card {
          width: 100%
        }
      }

    </style>
</head>
<body style="background-color: black">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid mx-4 mx-md-5 px-none px-md-5 py-3">
          <a class="navbar-brand text-white pt-2" href="#"><h1><span class="text-danger">Mark</span><span style="font-weight:lighter"> IT</span></h1></a>
          <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
       
            <div class="right-side">
                <ul class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item mx-2">
                    <a class="nav-link text-white" style="font-weight:bold; font-size:18px" href="#premium">Premium</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link text-white" style="font-weight:bold; font-size:18px" href="#footer">Support</a>
                  </li>
                  <li class="nav-item dropdown mx-2 me-4">
                    <a class="nav-link dropdown-toggle text-white" href="#" style="font-weight:bold; font-size:18px" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <div class="px-0 px-lg-4 d-flex borderline">
                    <li class="nav-item mx-3">
                      <a href="/register"><button class="btn btn-light px-3 mt-1">Sign up</button></a>
                     </li>
                    <li class="nav-item">
                      <a href="/login"><button class="btn btn-danger px-3 mt-1">Log in</button></a>
                     </li>
                  </div>
                 
                </ul>
            </div>
          </div>
        </div>
      </nav>

    <main>

      <div class="container-fluid bg-white">
        <div class="row">
          <div class="col-12 col-lg-6 pb-none pb-md-4 text-center">
            <img class="rewards" src="/images/rewards.jpeg" height="500px" alt="">
          </div>
          <div class="col px-4 d-flex justify-content-center" style="flex-direction:column; border: 1px solid none">
            <div class="text-center">
            
              <h1>Earn rewards for every successful answered survey.</h1>
            </div>
            
            <div class="text-center mt-5">
              <p class="mx-3 d-none d-xl-block">Free Users are eligible to earn up to 3000 points for 1 month (30 days) prior to account creation. You'll earn 1 point for every 1 successful answered survey. 10 points is equivalent to <span style="font-weight:bold">1 Peso</span>. This is our way to make our product much more engaging and interesting.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col d-flex justify-content-center" style="flex-direction:column; border: 1px solid none">
            <div class="text-center pt-5">
      
              <h1 class="text-white">Take advantage of a large-scale community in an instant.</h1>
            </div>
            
            <div class="text-center mt-5">
              <p class="d-none d-xl-block px-5 text-secondary">Anyone who is in need of a large-scale community will surely benefit from our product. This is why start-up business owners love it, with just few steps, they can ask and discuss their ideas to people who have the same interest by subscribing to one of our Premium Accounts.</p>
            </div>
          </div>
          <div class="col-12 col-lg-6 p-0 mt-0 mt-lg-5" >
            <img src="/images/community.jpg" style="border-radius:20px" width="100%" alt="">
          </div>
        </div>
      </div>

      <div class="container-fluid mt-5 pb-3" style="background-color: whitesmoke">
        <div class="row">
          <div class="col-12 col-lg-6 p-0 mt-5">
            <img src="/images/chat.png" width="100%" alt="">
          </div>
          <div class="col d-flex justify-content-center mb-5" style="flex-direction:column; border: 1px solid none">
            <div class="text-center pt-5">
      
              <h1>Dedicated Chat System for all users.</h1>
            </div>
            
            <div class="text-center mt-5 mb-5 mb-lg-0 d-none d-lg-block">
              <p class="px-5 d-none d-xl-block">Want to message someone? Getting in touch with each other has never been easier with our dedicated chat system.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid mt-5 pb-5 mb-5" id="premium">
         <h1 class="text-center text-secondary pt-5 mb-3" style="font-weight:bolder">Why Go Premium?</h1>

         <div class="pt-5 mt-5 px-5">
          <div class="row">
            <div class="col text-center mt-5 mt-md-0">
              <img style="border-radius: 50%" height="170px" width="178px" src="/images/survey.jpeg" alt="">
              <div class="text-white mt-5" style="font-size:22px; font-weight:lighter">Post Surveys.</div>
            </div>
        
           <div class="col text-center mt-5 mt-md-0">
            <img style="border-radius: 50%" height="170px" width="178px" src="/images/comment.jpeg" alt="">
            <div class="text-white mt-5" style="font-size:22px; font-weight:lighter">View & Post Comments.</div>
           </div>
          <div class="col text-center mt-5 mt-md-0">
            <img style="border-radius: 50%" height="170px" width="178px" src="/images/longevity.jpeg" alt="">
            <div class="text-white mt-5" style="font-size:22px; font-weight:lighter">Earn continuous points for 3 or 6 months based on your plan.</div>
          </div>
          <div class="col text-center mt-5 mt-md-0">
            <img style="border-radius: 50%" height="170px" width="178px" src="/images/follow.jpeg" alt="">
            <div class="text-white mt-5" style="font-size:22px; font-weight:lighter">Gain followers.</div>
          </div>
         </div>
        </div>
      </div>

      <div class="container-fluid pt-5 bg-secondary plan-cards">
       
        <h1 class="text-center text-white pt-5 mb-3" style="font-weight:bolder">See the difference.</h1>
        <p class="text-center text-white" style="font-size:20px; font-weight: 300">Post surveys anytime, anywhere.</p>
        <div class="container d-flex justify-content-around plans">
          <div class="card mt-5 mb-0 mb-lg-5">
            <div class="card-body d-flex" style="flex-direction:column">
              <h4 class="card-title text-center" style="font-weight:bolder">Free</h4>
             
              <ul class="mt-4">
                <li class="py-2" style="font-size:18px">Earn up to 3000 points. <span style="font-weight:bold">10 Points</span> is equivalent to <span style="font-weight:bold">1 Peso</span>.(30 days prior to registration).</li>
                <li class="py-2" style="font-size:18px">View & Answer Surveys.</li>
                <li class="py-2" style="font-size:18px">Join Focus Groups.</li>
                <li class="py-2" style="font-size:18px">Follow other users</li>
                <li class="py-2" style="font-size:18px; color: transparent">Follow other users & gain followers.</li>
                <li class="py-2" style="font-size:18px; color: transparent">Access to comment</li>
              </ul>
              <br><br><br><br> 
              <span class="text-center font-bold mb-4" style="font-size: 40px">FREE</span>
              <a href="/register" class="btn btn-dark mt-auto">GET STARTED</a>
              <div class="mt-3" style="font-size:14px"><span style="text-decoration: underline">Terms and conditions apply</span>. <span style="color:transparent; text-decoration: none;">Offer not available for users who still have active subscriptions.</span></div>
            </div>
          </div>

          <div class="card mt-5 mb-0 mb-lg-5">
            <div class="card-body d-flex" style="flex-direction:column">
              <h4 class="card-title text-center" style="font-weight:bolder">Premium <span style="color:rgb(5, 180, 5)">(3 months)</span></h4>
              <ul class="mt-4">
                <li class="py-2" style="font-size:18px">Earn up to 3000 points. <span style="font-weight: bolder;">8 Points</span> is equivalent to <span style="font-weight:bold">1 Peso</span>.</li>
                <li class="py-2" style="font-size:18px"><span style="font-weight: bold">Post unlimited surveys.</span></li>
                <li class="py-2" style="font-size:18px; font-family: 'Raleway', sans-serif">View & Answer Surveys.</li>
                <li class="py-2" style="font-size:18px">Join Focus Groups.</li>
                <li class="py-2" style="font-size:18px">Follow other users & gain followers.</li>
                <li class="py-2" style="font-size:18px">Access to comment section on focus groups.</li>
              </ul>
              <br><br><br><br>
              <span class="text-center font-bold mb-4" style="font-size: 40px">PHP 300</span>
              <a href="/register" class="btn btn-dark mt-auto">GET STARTED</a>
              <div class="mt-3" style="font-size:14px"><span style="text-decoration: underline">Terms and conditions apply</span>. Offer not available for users who still have active subscriptions.</div>
            </div>
          </div>

          <div class="card mt-5 mb-5">
            <div class="card-body d-flex" style="flex-direction:column">
              <h4 class="card-title text-center" style="font-weight:bolder">Premium <span style="color:rgb(5, 180, 5)">(6 months)</span></h4>
              <ul class="mt-4">
                <li class="py-2" style="font-size:18px">Earn up to 3000 points. <span style="font-weight:500">5 Points</span> is equivalent to <span style="font-weight:bold">1 Peso</span>.</li>
                <li class="py-2" style="font-size:18px"><span style="font-weight:bold">Post unlimited surveys.</span></li>
                <li class="py-2" style="font-size:18px">View & Answer Surveys.</li>
                <li class="py-2" style="font-size:18px">Join Focus Groups.</li>
                <li class="py-2" style="font-size:18px">Follow other users & gain followers.</li>
                <li class="py-2" style="font-size:18px">Access to comment section on focus groups.</li>
              </ul>
              <br><br><br><br>
              <span class="text-center font-bold mb-4" style="font-size: 40px">PHP 500</span>
              <a href="/register" class="btn btn-dark mt-auto">GET STARTED</a>
              <div class="mt-3" style="font-size:14px"><span style="text-decoration: underline">Terms and conditions apply</span>. Offer not available for users who still have active subscriptions.</div>
            </div>
          </div>
        </div>
      </div>

    </main>
    
      <footer class="container-fluid" id="footer" style="height:50vh">
        <div class="row">
          <div class="col-12 col-md-6">
            <h1 class="text-center mt-5"><span class="text-danger">Mark</span><span class="text-white" style="font-weight:lighter"> IT</span></h1>
            <p class="text-white text-center" style="font-weight:lighter">A Social Media Community.</p>
          </div>
          <div class="col text-center">
            <div class="icons mt-0 mt-md-5 pt-0 pt-md-3">
              <a href="https://www.facebook.com/profile.php?id=100088519024889" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" class="bi bi-facebook mx-2" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
              </svg></a>
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" class="bi bi-instagram mx-2" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" class="bi bi-twitter mx-2" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col mt-4" style="flex-direction: column">
            <h4 class="text-white text-center mt-5" style="font-weight: lighter;">Having issues with your account? Contact us at:</h4>
            <div class="d-flex justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" class="bi bi-telephone mt-3" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
              </svg>
              <h5 class="pt-4 ms-4 text-white">+63 939 896 9415</h5>
            </div>

            <div class="d-flex mt-4 justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="white" class="bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
              </svg>
              <h5 class="pt-1 ms-4 text-white">alexis.tinio@adamson.edu.ph</h5>
            </div>
          </div>
        </div>
      </footer>
      
  </body>
</html>
