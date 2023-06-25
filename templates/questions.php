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
    <title>Test</title>
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

    <div>
        <a class="text-white text-xl px-5">Test page</a>
    </div>
    <div>
        {% if questions %}
            <div class="grid grid-cols-1 gap-4">
                {% for questions in questions %}
                    {% if questions.id ==  selectedQuestion %}
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h5 class="text-lg font-bold mb-4">Question Number: {{ questions.id }}</h5>
                            <p class="mb-4">Question Text: {{ questions.text }}</p>
                            {% if answers %}
                                <ul>
                                    {% for answers in answers %}
                                        {% if answers.question_id == questions.id %}
                                            <li class="flex items-center mb-2">
                                                <input type="radio" id="answer_{{ answer.id }}"
                                                    name="question_{{ question.id }}" value="{{ answer.id }}"
                                                    class="form-radio mr-2">
                                                <label for="answer_{{ answer.id }}"
                                                    class="text-gray-800">{{ answers.text }}</label>
                                            </li>
                                        {% endif %}
                                    {% endfor %}
                                </ul>
                            {% else %}
                                <p>No answers found for this question.</p>
                            {% endif %}
                        </div>
                    {% endif %}
                {% endfor %}
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                <button type="reset" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">Reset</button>
            </div>
        {% else %}
            <p class="text-white">No questions found for this quiz.</p>
        {% endif %}
    </div>

</body>
</body>


</html>
