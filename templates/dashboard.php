<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../css/dashboard.css">
</head>


<body style="background: #18225D;">
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
                <a class="text-white text-xl px-2" href="update">Update</a>

                <a class="text-white text-xl px-2" href="quizzes">Quizzes</a>
                <a class="text-white text-xl px-2" href="leaderboard">Leaderboard</a>
                <a class="text-white text-xl px-2" href="dashboard">Dashboard</a>

        </div>
    </div>
</nav>



    <div class="container mt-4">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Subject Progress</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="progress blue">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">90%</div>
                    </div>
                    <div class="subject-name">Math</div>
                </div>

                <div class="col-md-6">
                    <div class="progress yellow">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">37.5%</div>
                    </div>
                    <div class="subject-name">English</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
    <div class="card-body text-center">
        <h5 class="card-title">Overall Experience Progress</h5>
        <div class="d-flex justify-content-center">
            <div class="progress blue">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value">90%</div>
            </div>
        </div>
        <div class="subject-name">Overall</div>
    </div>
</div>


</body>

</html>
