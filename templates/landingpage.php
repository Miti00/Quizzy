<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/landingpage.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Home</title>
</head>
<body>
  <nav class="flex flex-wrap my-5 space-x-5 space-between md:flex-row">
    <div class="flex flex-row flex-wrap w-full p-3">
      <div class="container-logo mr-20">
        <img src="../img/LandingPage/Logo-UVT.png" alt="" class="flex">
      </div>
      <div class="flex flex-1 space-x-5 my-3 sm:flex-wrap md:flex-row mx-auto">
        <a class="text-white text-xl px-5" href="./">Home</a>
        <a class="text-white text-xl px-5" href="#about">About Us</a>
        <a class="text-white text-xl px-5" href="courses">Courses</a>
        <a class="text-white text-xl px-5" href="#contact">Contact</a>
        
      </div>

      <div class="space-x-10 my-3 px-6">
        <a class="text-white text-xl border-solid border-2 rounded-md px-8 py-1" href="login">Login</a>
        <a class="text-white text-xl border-solid border-2 rounded-md px-8 py-1" href="register">Sign Up</a>
      </div>
    </div>
  </nav>

  <section id="online-courses">
    <div class="flex flex-row flex-wrap w-full p-5">
      <div class="flex flex-col flex-1 text-left w-1/2 my-5 mx-10">
        <h1 class="text-white text-4xl">Find Most Exciting</h1>
        <h1 class="text-amber-300 text-4xl">Online Courses</h1>
        <p class="text-white w-2/3 py-3 text-xl">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius, quos tenetur sunt deserunt dolorum voluptatum, quas animi dolores eum sequi ut ratione eveniet neque a praesentium impedit veniam corporis officia!</p>
        
        <div class="flex flex-row w-max py-3">
          <a class="font-bold bg-amber-300 p-3 border-solid rounded-md mr-10" href="#">Explore Courses</a>
          <a class="text-white font-semibold border-solid border-2 rounded-md p-3" href="#">Start Learning</a>
        </div>

        <div class="flex flex-row justify-start pt-8 space-x-10">
          <li class="list-none text-white mr-2 pr-5">x</li>
          <li class="list-none text-white  pl-5">x</li>
          <li class="list-none text-white  pl-10">x</li>
        </div>
        <div class="flex flex-row justify-start">
          <p class="text-white pl-2 pr-8">Students</p>
          <p class="text-white pr-8">Courses</p>
          <p class="text-white">Instructors</p>
        </div>
          
        
      </div>

      <div class="flex flex-1 w-1/2 my-5 ml-10 justify-end">
        <img src="../img/LandingPage/image 2.png" alt="">
      </div>
    </div>
  </section>

  <section id="category" class="py-10">
    <div class="flex flex-row justify-center items-center py-10 w-full">
      <h1 class="text-white text-4xl">Most Popular <span class="text-amber-300">Category</span></h1>
    </div>

    <!-- Menu Category -->
    <div class="flex flex-row py-10 w-full items-center justify-center space-x-6">
      <button class="c-btn font-semibold text-white text-xl px-2 rounded-xl"><</button>
        <div class="flex flex-col c-item text-white p-3 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icons8-drawing-48 1.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">Art & Design</a>
        </div>
        <div class="flex flex-col c-item text-white p-3 pt-2 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icons8-web-design-64 1.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">Web Design</a>
        </div>
        <div class="flex flex-col c-item text-white p-3 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icons8-compact-camera-30 1.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">Photography</a>
        </div>
        <div class="flex flex-col c-item text-white p-3 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icons8-communication-30 1.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">Communication</a>
        </div>
        <div class="flex flex-col c-item text-white p-3 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icons8-drawing-48 1.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">UI & UX Design</a>
        </div>
      
        <div class="flex flex-col c-item text-white p-3 text-end justify-center items-center rounded-md cursor-pointer">
          <img src="../img/LandingPage/icon-market.png" alt="" class="mb-1 bg-slate-300 rounded-2xl p-1">
          <a class="text-white" href="#">Marketing</a>
        </div>
      <button class="c-btn font-semibold text-white text-xl px-2  rounded-xl">></button>
    </div>
  </section>

  <section id="courses" class="pt-10">
    <div class="flex flex-row justify-center items-center pt-10 pb-5 w-full">
      <img src="../img/LandingPage/waving-hand.png" alt="">
      <div class="flex flex-col items-center justify-start w-1/4">
        <h1 class="ml-5 text-white text-4xl pb-3 self-start">Featured <span class="text-amber-300">Courses</span></h1>
        <p class="text-white text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati nam necessitatibus sapiente.</p>
      </div>
    </div>

    <div class="flex flex-row justify-center items-center mb-10 w-full">
      <a class="mx-3 text-xl px-2 py-1 font-semibold rounded-md bg-amber-300 " href="#">General</a>
      <a class="mx-3 text-xl px-2 py-1 font-semibold border-2 rounded-md text-white" href="#">Features</a>
      <a class="mx-3 text-xl px-2 py-1 font-semibold border-2 rounded-md text-white" href="#">Varifaction</a>
      <a class="mx-3 text-xl px-2 py-1 font-semibold border-2 rounded-md text-white" href="#">Pro Market</a>
    </div>

    <!-- Photo Gallery -->
    <div id="gallery" class="flex flex-row flex-wrap w-full py-20 justify-center items-center">
      <div class="container flex flex-row justify-center items-end mt-20 mx-10 space-x-10">
        <div class="flex flex-col p-3 rounded-lg" style="background: #302B6D;">
          <img src="../img/LandingPage/category-1.png" alt="" class="mb-5">
          <div class="flex flex-row">
          <p class="ml-2 text-white font-semibold text-2xl">Curs de Matematica</p>
          <div class="mx-3 flex flex-row flex-1">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
          </div>
        </div>
        <p class="ml-2 text-white font-semibold text-xl">Autor: <span class="ml-3 text-amber-300">Mihai</span></p>
        </div>

        <div class="flex flex-col p-3 rounded-lg" style="background: #302B6D;">
          <img src="../img/LandingPage/category-2.png" alt="" class="mb-5">
          <div class="flex flex-row">
          <p class="ml-2 text-white font-semibold text-2xl">Curs de Romana</p>
          <div class="mx-3 flex flex-row flex-1">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            <img class=" p-3" src="../img/LandingPage/star.png" alt="">
          </div>
        </div>
        <p class="ml-2 text-white font-semibold text-xl">Autor: <span class="ml-3 text-amber-300">Andrei</span></p>
        </div>

        <div class="flex flex-col p-5 rounded-lg" style="background: #302B6D;">
          <img src="../img/LandingPage/category-3.png" alt="" class="mb-5">
          <div class="flex flex-row">
            <p class="ml-2 flex-1 text-white font-semibold text-2xl">Curs de Arte</p>
            <div class="mx-3 flex flex-row flex-1">
              <img class=" p-3" src="../img/LandingPage/star.png" alt="">
              <img class=" p-3" src="../img/LandingPage/star.png" alt="">
              <img class=" p-3" src="../img/LandingPage/star.png" alt="">
              <img class=" p-3" src="../img/LandingPage/star.png" alt="">
              <img class=" p-3" src="../img/LandingPage/star.png" alt="">
            </div>
          </div>
          <p class="ml-2 text-white font-semibold text-xl">Autor: <span class="ml-3 text-amber-300">Toma</span></p>
        </div>
      </div>
    </div>
    <div class="flex flex-row justify-center items-center py-10 my-20">
      <a class="py-5 px-20 rounded-lg bg-amber-300 font-semibold" href="#">More Courses</a>
    </div>
  </section>

  <section id="about" class="mb-20">
    <div class="flex flex-row justify-center items-center w-full">
      <h1 class="text-white text-4xl">What <span class="text-amber-300">People Say</span></h1>

    </div>
    
    <div class="flex flex-row justify-center items-center mt-20">
      <!-- <img src="../img/LandingPage/working.png" alt="" class="ml-20 pl-60"> -->
      <div style="background-color:#302B6D;"
        class="flex flex-row justify-center items-center align-start mx-auto rounded-md w-1/2">
        <div class="flex flex-row static mr-20">
          <img src="../img/LandingPage/working.png" alt="" class="absolute">
        </div>
      <div class="flex flex-col ml-5 w-1/3 py-10 border-l-2">
        <h1 class="ml-10 font-semibold text-white text-2xl">Alex
          <div class="flex flex-row justify-start items-start align-start mb-1">
            <img src="../img/LandingPage/star.png" alt="">
            <img src="../img/LandingPage/star.png" alt="">
            <img src="../img/LandingPage/star.png" alt="">
            <img src="../img/LandingPage/star.png" alt="">
            <img src="../img/LandingPage/star.png" alt="">
          </div>
        </h1>
        <p class="ml-10 pt-1 pb-5 text-slate-400">UI & UX Designer</p>
        <p class="ml-10 text-white text-xl ">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem nobis voluptate ex? Nemo laborum omnis unde magni cumque impedit expedita.</p>
        
        <div class="ml-10 flex flex-row justify-center mt-10">
          <a class="p-3 px-5 rounded-lg bg-amber-300 font-bold text-2xl" href="#">See More</a>
        </div>
      </div>
    </div>


     
    </div>
  </section>
</body>
</html>