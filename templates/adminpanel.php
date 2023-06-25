<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include the Twig library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twig.js/1.15.0/twig.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

<body style="background-color: #18225D;">
    <div>
        <!-- nav -->

        <body>
            <nav class="navbar flex flex-wrap my-3 space-x-5 space-between md:flex-row">
                <div class="flex flex-row flex-wrap w-full px-3">
                    <div class="container-logo">
                        <img src="../img/LandingPage/Logo-UVT.png" alt="" class="flex " width="100">
                    </div>
                    <div class="flex flex-1 space-x-5 my-3 sm:flex-wrap md:flex-row  w-full justify-center">
                        <a class="text-white text-xl px-2" href="landingpage">Home</a>
                        <a class="text-white text-xl px-2" href="courses">Courses</a>

                        <a class="text-white text-xl px-2" href="admin">AdminPanel</a>

                        <a class="text-white text-xl px-2" href="quizzes">Quizzes</a>
                        <a class="text-white text-xl px-2" href="leaderboard">Leaderboard</a>
                        <a class="text-white text-xl px-2" href="dashboard">Dashboard</a>


                    </div>
                </div>
            </nav>

            <div class="flex justify-center mb-5">
                <!-- add form button -->
                <button id="addFormBtn" class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20 mr-2"
                    type="button" style="background-color: #007074;">
                    Add Form
                </button>

                <!-- remove form button -->
                <button id="removeFormBtn" class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20 ml-2"
                    type="button" style="background-color: #F45050;">
                    Remove Form
                </button>
                      <!-- add form button -->
                      <button id="addCategoryBtn" class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20 mr-2"
                    type="button" style="background-color: #007074;">
                    Add Category
                </button>

            </div>

<!-- add category form -->
<div class="flex-row px-10 mx-10 items-center w-auto justify-center" id="addCategoryContainer"
                style="display: none;">
                <div class="flex-wrap items-center self-center">
                    <form id="add-form"
                        class="flex flex-col md:w-full lg:w-full items-center justify-center rounded-lg bg-white p-10 pt-1 mb-10"
                        action="/Quizzyv3/app/categories" method="POST"  onsubmit="createCategory(event)">
                        <!-- form group -->
                        <div class="text-4xl block text-center mx-auto py-8 mt-10">
                            <h4 class="font-medium">Add category</h4>
                        </div>
                        <div class="block p-1 w-full flex items-center">
                            <!-- check if the course exists!!!!!!!!!!!!!!!!! -->
                            <label class="text-2xl my-2 w-2/3">Category Name</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="text"
                                placeholder="Choose a category name" name="name" id="name">

                            <button style="background-color: #007074; margin-left: 1rem;"
                                class="text-white font-normal text-1xl rounded-md py-2 px-20" type="submit"
                                >Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- add course form -->
            <div class="flex-row px-10 mx-10 items-center w-auto justify-center" id="addFormContainer"
                style="display: none;">
                <div class="flex-wrap items-center self-center">
                    <form id="add-form"
                        class="flex flex-col md:w-full lg:w-full items-center justify-center rounded-lg bg-white p-10 pt-1 mb-10"
                        action="/Quizzyv3/app/quizzes" method="POST">
                        <!-- form group -->
                        

                            <div class="block p-1 w-full flex items-center">
                                <!-- choose the course you want to add the quiz to -->
                                <label class="text-2xl my-2 w-1/3">Choose a category</label>
                                <select class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" name="category_id">

                                    {% for category in categories %}

                                    <option name="category_id" value="{{ category.id }}">{{category.name}}

                                    </option>

                                    {% endfor %}

                                </select>
        
                            </div>

                        <div class="text-4xl block text-center mx-auto py-8 mt-10">
                            <h4 class="font-medium">Add quiz</h4>
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <!-- choose the course you want to add the quiz to -->
                            <label class="text-2xl my-2 w-1/3">Choose a subject</label>
                         
                            <select class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" name="subject_id">
                               
                            {% for subject in subjects %}
                            
                                <option name="subject_id" value="{{ subject.id }}">{{subject.name}}
                                    
                                </option>
                               
                                {% endfor %}
                                
                            </select>
                          
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <label class="text-2xl my-2 w-1/3">Quiz title</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="text"
                                placeholder="Choose a quiz title" name="quiz" >
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <!-- choose the course you want to add the quiz to -->
                            <label class="text-2xl my-2 w-1/3">Question number</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="text"
                                placeholder="Custom" name="question_number" list="answernumbers">
                            <datalist id="questionnumber">
                                <option value="2">
                                <option value="3">
                                <option value="4">
                            </datalist>
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <!-- choose the course you want to add the quiz to -->
                            <label class="text-2xl my-2 w-1/3">Answer number</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="text"
                                placeholder="Custom" name="answer_number" list="answernumbers">
                            <datalist id="answernumber">
                                <option value="2">
                                <option value="3">
                                <option value="4">
                            </datalist>
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <label class="text-2xl my-2 w-1/3">Passing Limit</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="number"
                                placeholder="Enter the passing limit" name="passing_limit">
                        </div>


                        <div class="block p-1 w-full flex items-center">
                            <label class="text-2xl my-2 w-1/3">Experience Points</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="number"
                                placeholder="Enter the experience points" name="experience_points">
                        </div>


                        <!-- generate questions button -->
                        <button style="background-color: #007074; margin-left: 1rem;"
                            class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20" type="button"
                            onclick="generateQuestions()">Generate</button>

                        <!-- add button for each quiz to mark it as wrong/correct??????/ -->
                        <div id="questionContainer"></div>

                        <!-- post only the created content to the selected course -->
                        <button style="background-color: #007074; margin-left: 1rem;"
                            class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20" type="submit"
                            name="create_quiz">Post</button>


                    </form>
                </div>
            </div>









            <!-- remove div-->
            <div class="flex-row px-10 mx-10 items-center w-auto justify-center" id="removeFormContainer"
                style="display: none;">
                <div class="flex-wrap items-center self-center">
                    <form id="remove-form"
                        class="flex flex-col md:w-full lg:w-full items-center justify-center rounded-lg bg-white p-10 pt-1 mb-10">
                        <!-- form group -->
                        <div class="text-4xl block text-center mx-auto py-8 mt-10">
                            <h4 class="font-medium">Remove course</h4>
                        </div>
                        <div class="block p-1 w-full flex items-center">
                            <!-- check if the course exists!!!!!!!!!!!!!!!!! -->
                            <label class="text-2xl my-2 w-2/3">Category Name</label>
                            <input class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" type="text"
                                placeholder="Choose a course name" name="course" id="categories">
                            <button style="background-color: #F45050; margin-left: 1rem;"
                                class="text-white font-normal text-1xl rounded-md py-2 px-20" type="button"
                                onclick="deleteCategory(document.getElementById('categories').value)">Delete</button>

                        </div>


                        <div class="text-4xl block text-center mx-auto py-8 mt-10">
                            <h4 class="font-medium">Remove quiz</h4>
                        </div>


                        <!-- <div class="block p-1 w-full flex items-center">
                            choose the course you want to add the quiz to
                            <label class="text-2xl my-2 w-1/3">Choose Subject</label>
                            <select class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md" name="course">

                                {% for subject in subjects %}
                                <option value="{{ subject.id }}">{{subject.name}}</option>
                                <input type="hidden" name="category_id" value="subject.category_id">
                                {% endfor %}


                            </select>
                        </div>
 -->
                        <div class="block p-1 w-full flex items-center">
                            <label class="text-2xl my-2 w-1/3">Quiz name</label>
                            <select class="w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md">
                                {% for subject in subjects %}
                                    {% for quizz in quizzes %}
                                        {% if subject.id == quizz.subject_id %}
                                            <option name="quizz_id" id="quizz_id" value="{{ quizz.id }}">{{ quizz.name }} - {{ subject.name }}</option>
                                        {% endif %}
                                    {% endfor %}
                                {% endfor %}
                            </select>
                        </div>


                        <button style="background-color: #F45050; margin-left: 1rem;"
                            class="text-white font-normal text-1xl rounded-md my-2 py-2 px-20" type="submit"
                            onclick="deleteQuizz(document.getElementById('quizz_id').value)">>Delete quiz</button>
                    </form>
                </div>
            </div>

        </body>



    
        <script src="../js/category.js"></script>

        <!--generate questions and answeres fields-->
        <script>
        $(document).ready(function() {
            // Show add form when "Add Form" button is clicked
            $('#addFormBtn').click(function() {
                $('#addFormContainer').toggle();
                $('#removeFormContainer').hide();
            });

            // Show remove form when "Remove Form" button is clicked
            $('#removeFormBtn').click(function() {
                $('#removeFormContainer').toggle();
                $('#addFormContainer').hide();
            });

                  // Show add category form when "Add Category" button is clicked
                  $('#addCategoryBtn').click(function() {
                $('#addCategoryContainer').toggle();
                $('#addFormContainer').hide();
                $('#removeFormContainer').hide();
            });
        });
       


        function generateQuestions() {
            var questionNumber = document.querySelector('input[name="question_number"]').value;
            var answerNumber = document.querySelector('input[name="answer_number"]').value;

            var questionContainer = document.getElementById('questionContainer');
            questionContainer.innerHTML = '';

            for (var i = 1; i <= questionNumber; i++) {
                var questionDiv = document.createElement('div');
                questionDiv.className =
                    'block p-1 w-full flex items-center my-2'; // Added 'my-2' class for vertical spacing

                var questionLabel = document.createElement('label');
                questionLabel.className = 'text-2xl my-2 w-1/3';
                questionLabel.innerHTML = 'Question ' + i;

                var questionInput = document.createElement('input');
                questionInput.className = 'w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md';
                questionInput.type = 'text';
                questionInput.placeholder = 'Enter question text';
                questionInput.name = 'question' + i;
                questionInput.id = 'questionId';


                questionDiv.appendChild(questionLabel);
                questionDiv.appendChild(questionInput);

                questionContainer.appendChild(questionDiv);

                for (var j = 1; j <= answerNumber; j++) {
                    var answerDiv = document.createElement('div');
                    answerDiv.className =
                        'block p-1 w-full flex items-center my-2'; // Added 'my-2' class for vertical spacing

                    var answerLabel = document.createElement('label');
                    answerLabel.className = 'text-2xl my-2 w-1/3';
                    answerLabel.innerHTML = 'Answer ' + j;

                    var answerInput = document.createElement('input');
                    answerInput.className = 'w-2/3 bg-slate-200 text-xl px-5 py-2 rounded-md';
                    answerInput.type = 'text';
                    answerInput.placeholder = 'Enter answer text';
                    answerInput.name = 'answer' + i + '-' + j;
                    answerInput.id = 'answerId';


                    answerDiv.appendChild(answerLabel);
                    answerDiv.appendChild(answerInput);

                    questionContainer.appendChild(answerDiv);
                }
            }
        }
        </script>


       
</html>