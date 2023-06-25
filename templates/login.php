
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Register</title>
</head>
<body style="background: #18225D;">

     

  <nav class="flex flex-wrap my-3 space-x-5 space-between md:flex-row">
    <div class="flex flex-row flex-wrap w-full px-3">
      <div class="container-logo">
        <img src="../img/LandingPage/Logo-UVT.png" alt="" class="flex ">
      </div>
      <div class="flex flex-1 space-x-5 my-3 sm:flex-wrap md:flex-row w-full justify-center">
        <a class="text-white text-xl px-5" href="./">Home</a>
        <a class="text-white text-xl px-5" href="#">About Us</a>
        <a class="text-white text-xl px-5" href="courses">Courses</a>
        <a class="text-white text-xl px-5" href="#">Contact</a>
        
      </div>

      <div class="space-x-10 my-3 px-6 w-max">
        <a class="text-black bg-amber-300 border-black text-xl border-solid border-2 rounded-md px-8 py-1" href="login">Login</a>
        <a class="text-white text-xl border-solid border-2 rounded-md px-8 py-1" href="register">Sign Up</a>
      </div>
    </div>
  </nav>

  <div class="flex-row px-10 mx-10 items-center w-auto justify-center">
    <div class="flex flex-col flex-wrap  items-center self-center">
        <form class="flex flex-col md:w-1/2 lg:w-1/2 items-center justify-center rounded-lg bg-white p-10 pt-1 mb-10"
         action="/Quizzyv3/app/auth" method="POST">
          <!-- form group -->
          <div class="text-4xl block text-center mx-auto py-8 mt-10">
            <h1 class="font-bold">Authenticate to Quizzy</h1>
          
          </div>

          <div class="block p-3 w-full">
            <h1 class="text-2xl my-2">Email</h1>
            <input class="w-full bg-slate-200 text-xl px-5 py-2 rounded-md" name="email" type="email" placeholder="Enter email...">
          </div>
          <div class="block p-3 w-full">
            <h1 class="text-2xl my-2">Password</h1>
            <input class="w-full bg-slate-200 text-xl px-5 py-2 rounded-md" name="password" type="password" placeholder="Enter password...">
          </div>
      
        <input type="hidden" name= "role" value="{{role}}">

          <div class="block mx-auto mb-3 py-3 mt-3">
            <button style="background-color: #007074;" 
            class="text-white font-semibold text-3xl rounded-md py-2 px-20 block mx-auto"
            type="submit">Login</button>
            <p class="px-8 mt-3 text-xl">Don't have an account? <a style="color: #007074;" class="font-semibold" href="register">Sign Up</a></p>
          
            
          </div>

          <h1 class="text-3xl mb-3">OR</h1>

          <div class="flex flex-row mx-auto items-center  border-2 rounded-lg px-2">
            <img  class="" src="../img/Register/Google.png" alt="">
            <a class="ml-1" href="#">Continue with Google</a>
          </div>
        </form>
      
    </div>
  </div>

</body>
</html>