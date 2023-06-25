<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>Quizzes</title>
</head>

<body style=" background: #18225D;">
<div>
        <!-- nav -->

       <nav class="navbar flex flex-wrap my-3 space-x-5 space-between md:flex-row">
    <div class="flex flex-row flex-wrap w-full px-3">
        <div class="container-logo">
            <img src="../img/LandingPage/Logo-UVT.png" alt="" class="flex " width="100">
        </div>
        <div class="flex flex-1 space-x-5 my-3 sm:flex-wrap md:flex-row w-full justify-center">
            <a class="text-white text-xl px-2" href="./">Home</a>
            <a class="text-white text-xl px-2" href="courses">Courses</a>

                <a class="text-white text-xl px-2" href="admin">AdminPanel</a>
     
                <a class="text-white text-xl px-2" href="quizzes">Quizzes</a>
                <a class="text-white text-xl px-2" href="leaderboard">Leaderboard</a>
                <a class="text-white text-xl px-2" href="questions">Questions</a>
                <a class="text-white text-xl px-2" href="dashboard">Dashboard</a>

        </div>
    </div>
</nav>


    <!-- quiz list -->
    <div class="container mt-4">
        <h2 class="text-2xl font-semibold mb-4 text-white">Quizzes</h2>
        <ul class="list-group">
            {% for quiz in quizzes %}
            <li class="list-group-item">
                <div class="flex justify-between items-center">
                    <h5 class="mb-0 text-lg font-medium">{{ quiz.name }}</h5>
                    <!-- Generate link to the test page with the quiz ID as a query parameter -->
                    <a class="text-white text-xl px-5" href="questions?quiz_id={{ quiz.id }}">
                        <button style="background-color: #007074; margin-left: 1rem;"
                            class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20" type="submit">Start
                            quiz</button>
                    </a>
                </div>
                <p class="mt-2">
                    ID: {{ quiz.id }}<br>
                    Experience Points: {{ quiz.experience_points }}<br>
                    Passing Limit: {{ quiz.passing_limit }}
                </p>
            </li>
            {% endfor %}
        </ul>
    </div>
</body>

</html>