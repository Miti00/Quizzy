<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include the Twig library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twig.js/1.15.0/twig.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../css/leaderboard.css">
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
      
                        <a class="text-white text-xl px-2" href="quizzes">Quizzes</a>
                        <a class="text-white text-xl px-2" href="leaderboard">Leaderboard</a>
                        <a class="text-white text-xl px-2" href="dashboard">Dashboard</a>
                </div>
            </div>
        </nav>
        <main>
            <div id="header">
                <h1>Leaderboard</h1>
            </div>
            <div id="leaderboard">
                <div class="ribbon"></div>
                <table>
                    <thead>
                     
                    </thead>
                    <tbody id="leaderboardTableBody"></tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            // When the page loads, make the AJAX request
            $.ajax({
                url: 'http://localhost/Quizzyv3/app/users', // PHP file to retrieve users
                type: 'GET',
                dataType: 'json',
                success: function (users) {
                    // Handle the response data (users)
                    var leaderboardTable = $('#leaderboardTableBody');

                    // Clear previous data
                    leaderboardTable.empty();

                    // Update the leaderboard with the received users
                    for (var i = 0; i < users.length; i++) {
                        var user = users[i];
                        var medal = (i === 0) ? '<img class="gold-medal" src="../img/gold-medal.png" alt="gold medal"/>' : '';
                        leaderboardTable.append('<tr><td class="number">' + (i + 1) + '</td><td class="name">' + user.nickname + '</td><td class="points">' + user.experience_points + '</td><td>' + medal + '</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        });
    </script>
</body>

</html>
