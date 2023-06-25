<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Middleware\JwtAuthentication;


require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/config/config.php");
require_once(dirname(__DIR__) . "/MVC/Loader/init.php");

$twigLoader = new \Twig\Loader\FileSystemLoader([$templateDir]);
// $twig = new Twig\Environment($loader, $cacheDir);
$twig = new \Twig\Environment($twigLoader);

// init MVC
$view = new View();
$controller = new Controller();

/**
 * @OA\Info(title="Quizzy", version="0.03")
*/

/**
 * @OA\Server(url="http://localhost/Quizzy/app/docs")
*/

$app = AppFactory::create();
$app->setBasePath($serverURI);

//!! composer require tuupola/slim-jwt-auth
$app->get('/', function($request, $response) use($twig){
  echo $twig->render('landingpage.php');
  return $response;
});

$app->get('/register', function($request, $response) use($twig){
  echo $twig->render('register.php');
  return $response;
});

$app->get('/login', function($request, $response) use($twig){
  echo $twig->render('login.php');
  return $response;
});
$app->get('/leaderboard', function($request, $response) use($twig){
  echo $twig->render('leaderboard.php');
  return $response;
});
$app->get('/courses', function($request, $response) use($twig){
  

  echo $twig->render('courses.php');
  return $response;
});
$app->get('/dashboard', function($request, $response) use($twig){
  echo $twig->render('dashboard.php');
  return $response;
});

$app->post('/auth', function($request, $response) use($controller, $twig){
  session_start();
  $user = $controller->currentUser($_POST['email']);

  $_SESSION['user_id'] = $user[0]['id'];
  $_SESSION['role'] = $user[0]['role'];
 // Fetch the role from the database and store it in a variable
 $role = $user[0]['role'];

 if(isset($user) && ($role === 'admin' || $role === 'ADMIN')){
   echo $twig->render('adminpanel.php', ['role' => $role]); // Pass the role to the template
   return $response;
 } else {
   echo $twig->render('courses.php', ['role' => $role]); // Pass the role to the template
   return $response;
 }
  });
 
 
$app->get('/admin', function($request, $response) use($twig, $controller, $view){
  session_start();
  
  if($_SESSION['role'] !== 'ADMIN' || $_SESSION['role'] !== 'admin'){
    return $response->withHeader('Location', 'http://localhost/Quizzyv3/app')->withStatus(301);
  }

  $subjects = $view->getSubjects();
  $quizzes = $view->getQuizzes();
  $categories = $view->getCategories();

    
  echo $twig->render('adminpanel.php', array(
    'subjects' => $subjects,
    'quizzes' => $quizzes,
    'categories' => $categories,

  ));
  return $response;
});


$app->get('/users', function($request, $response) use($view){
  $users = $view->displayUsers();
  $response->getBody()->write(json_encode($users));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/users', function($request, $response) use($controller){
  $nickname = $_POST['nickname'];
  if($_POST['password'] === $_POST['password-confirm']){
    $password = md5($_POST['password']);
  }
  $email = $_POST['email'];
  $role = 'user';

  if(!$email || !$nickname || !$password){
    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $controller->register($email, $nickname, $password, $role);
  $response->getBody()->write(json_encode('Account Registered'));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/quizzes', function($request, $response) use($twig, $view){
  $quizzes = $view->getQuizzes();

    echo $twig->render('quizzes.php', array(
        'quizzes' => $quizzes
    ));

    return $response;
});

$app->get('/tests', function($request, $response) use($twig, $view){
  $tests = $view->getTests();

    echo $twig->render('test_page.php', array(
        'tests' => $tests
    ));

    return $response;
});

$app->get('/questions', function ($request, $response) use ($twig, $view) {
  $questions = $view->getQuestions();
  $answers = $view->getAnswers();
  $queryString = $request->getQueryParams();
  $selectedQuestion = $queryString['quiz_id'];

  echo $twig->render('questions.php', array(
      'questions' => $questions,
      'answers' => $answers,
      'selectedQuestion' => $selectedQuestion
  ));

  return $response;
});






//** documentation */


//! users

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"User"},
 *     summary="Retrieve list of users within app",
 *     @OA\Response(response="200", description="View Registered Users"),
 *     @OA\Response(response="404", description="No Users Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/users', function($request, $response) use($view){
  $users = $view->displayUsers();
  $response->getBody()->write(json_encode($users));
  return $response->withHeader('Content-Type', 'application/json');
});

/**
 * @OA\Post(
 *     path="/users", tags = {"Users"},
 *     summary="Register",
 *     description="Register Account",
 *   @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"email", "password", "nickname"}, 
 *          @OA\Property(property = "email", type = "string"),
 *          @OA\Property(property = "password", type = "password"),
 *          @OA\Property(property = "nickname", type = "string")
 *                                            
 *              )
 *      )
 * ),
 *   @OA\Response  (response="201", description="Account Registered"),
 *   @OA\Response  (response="400", description="Bad Request"),
 *   @OA\Response(response="500", description="Server Maintenance")
 * )
 */

$app->post('/docs/users', function($request, $response) use($controller){
      $json = $request->getBody();
      $data = json_decode($json, true);

      $email = $data['email'] ?? false;
      $nickname = $data['nickname'] ?? false;
      $password = $data['password'] ?? false;
      $role = 'user';

      if($email == false || $nickname == false || $password == false){
        $response->getBody()->write(json_encode('Bad Request!'));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
      }

      $controller->register($email, $nickname, $password, $role);
      $response->getBody()->write(json_encode('Account Registered'));
      return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

 /**
 * @OA\Get(
 *     path="/users/{userID}",
 *     tags={"User"},
 *     summary="Retrieve specific user from list of users within app",
 *     @OA\Parameter(
 *      description="Selected user",
 *      in="path",
 *      name="userID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="View User Data"),
 *     @OA\Response(response="403", description="Confidential Info."),
 *     @OA\Response(response="404", description="No User Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/users/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];

   $user = $controller->userById($id);
   if($user == null){
      $response->getBody()->write(json_encode("User not found!"));
      return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
   }

   $response->getBody()->write(json_encode($user));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/users/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];

   $user = $controller->userById($id);
   if($user == null){
      $response->getBody()->write(json_encode("User not found!"));
      return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
   }

   $response->getBody()->write(json_encode($user));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

 /**
 * @OA\Delete(
 *     path="/users/{userID}",
 *     tags={"User"},
 *     summary="Remove user account",
 *     @OA\Parameter(
 *      description="Selected user",
 *      in="path",
 *      name="userID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="User Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="User Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->delete('/docs/users/{id}', function($request, $response, $args) use($controller){
    $id = $args['id'];
    $userToBeDeleted = $controller->userById($id);

    if($userToBeDeleted == null){
      $response->getBody()->write(json_encode("User not found!"));
      return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }

     $controller->deleteUser($id);
     $response->getBody()->write(json_encode($userToBeDeleted));
     return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->delete('/users/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $userToBeDeleted = $controller->userById($id);

  if($userToBeDeleted == null){
    $response->getBody()->write(json_encode("User not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteUser($id);
   $response->getBody()->write(json_encode($userToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

 /**
 * @OA\Put(
 *     path="/users/{userID}",
 *     tags={"User"},
 *     summary="Update user account",
 *     @OA\Parameter(
 *      description="Selected user",
 *      in="path",
 *      name="userID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="User Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="User Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

$app->put('/docs/users/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $userToBeUpdated = $controller->userById($id);

  if($userToBeUpdated == null){
    $response->getBody()->write(json_encode("User not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

    $json = $request->getBody();
    $data = json_decode($json, true);

    $email = $data['email'] ?? false;
    $nickname = $data['nickname'] ?? false;
    $password = $data['password'] ?? false;

    if($email == false){
      $email = $userToBeUpdated['email'];
    }


   $updatedUser = $controller->updateUser($id, $email, $nickname, $password);
   $response->getBody()->write(json_encode($updatedUser));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->put('/users/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $userToBeUpdated = $controller->userById($id);

  if($userToBeUpdated == null){
    $response->getBody()->write(json_encode("User not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

    $json = $request->getBody();
    $data = json_decode($json, true);

    $email = $data['email'] ?? false;
    $nickname = $data['nickname'] ?? false;
    $password = $data['password'] ?? false;

    if($email == false){
      $email = $userToBeUpdated['email'];
    }


   $updatedUser = $controller->updateUser($id, $email, $nickname, $password);
   $response->getBody()->write(json_encode($updatedUser));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

 /**
 * @OA\Post(
 *     path="/chapters",
 *     tags={"Chapter"},
 *     summary="Add new chapter",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"title", "text", "subject_id"}, 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "text", type = "string"),
 *          @OA\Property(property = "subject_id", type = "integer")                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Add New Chapter"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->post('/docs/chapters', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);


  $text = $data['text'] ?? false;
  $title = $data['title'] ?? false;
  $subject_id = $data['subject_id'] ?? false;
  
  if($text == false || $title == false || $subject_id == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $controller->postChapter($text, $title, $subject_id);
  $response->getBody()->write(json_encode('Chapter Added!'));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

$app->post('/chapters', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);

  $text = $data['text'] ?? false;
  $title = $data['title'] ?? false;
  $subject_id = $data['subject_id'] ?? false;
  
  if($text == false || $title == false || $subject_id == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $controller->postChapter($text, $title, $subject_id);
  $response->getBody()->write(json_encode('Chapter Added!'));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

 /**
 * @OA\Get(
 *     path="/chapters/{chapterID}/test",
 *     tags={"Chapter"},
 *     summary="Retrieve test from a specific chapter",
 *      @OA\Parameter(
 *      description="Selected chapter",
 *      in="path",
 *      name="chapterID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="View Test"),
 *     @OA\Response(response="404", description="No Test Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/chapters/{id}/test', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapter = $controller -> getChapter($id);

  if($chapter == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

  $test = $controller -> testForSubjectById($id);

   $response->getBody()->write(json_encode($test));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/chapters/{id}/test', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapter = $controller->getChapter($id);

  if($chapter == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $test = $controller->testForSubjectById($id);

   $response->getBody()->write(json_encode($test));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

/**
 * @OA\Delete(
 *     path="/chapters/{chapterID}",
 *     tags={"Chapter"},
 *     summary="Remove specific chapter",
 *      @OA\Parameter(
 *      description="Selected chapter",
 *      in="path",
 *      name="chapterID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="Remove Chapter"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Chapter Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->delete('/docs/chapters/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapterToBeDeleted = $controller -> getChapter($id);

  if($chapterToBeDeleted == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller -> deleteChapter($id);
   $response->getBody()->write(json_encode($chapterToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

 $app->delete('/chapters/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapterToBeDeleted = $controller -> getChapter($id);

  if($chapterToBeDeleted == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller -> deleteChapter($id);
   $response->getBody()->write(json_encode($chapterToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

/**
 * @OA\Get(
 *     path="/chapters/{chapterID}",
 *     tags={"Chapter"},
 *     summary="Get specific chapter",
 *      @OA\Parameter(
 *      description="Selected chapter",
 *      in="path",
 *      name="chapterID",
 *      required=true,
 *      @OA\Schema(
 *        type="integer",
 *        format="int64",
 *      )
 *       ),
 *     @OA\Response(response="200", description="Get Chapter"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Chapter Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/chapters/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapter = $controller -> getChapter($id);

  if($chapter == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $response->getBody()->write(json_encode($chapter));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/chapters/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $chapter = $controller -> getChapter($id);

  if($chapter == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $response->getBody()->write(json_encode($chapter));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

//! subject

/**
 * @OA\Get(
 *     path="/subjects/{id}",
 *     tags={"Subject"},
 *     summary="Retrieve subject by id.",
 *     @OA\Response(response="200", description="View Subjects"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/subjects/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $subject = $controller -> getSubject($id);

  if($subject == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $response->getBody()->write(json_encode($subject));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/subjects/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $subject = $controller -> getSubject($id);

  if($subject == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $response->getBody()->write(json_encode($subject));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

/**
 * @OA\Get(
 *     path="/subjects/{subjectID}/chapters",
 *     tags={"Subject"},
 *     summary="Retrieve quizz from specific subject.",
 *     @OA\Response(response="200", description="View Selected Quizz"),
 *     @OA\Response(response="404", description="Quizz Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/subjects/{id}/chapters', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $subject = $controller -> getSubject($id);

  if($subject == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

  $chapters = $controller -> chaptersForSubjectById($id);

   $response->getBody()->write(json_encode($chapters));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/subjects/{id}/chapters', function($request, $response, $args) use($controller){
  $id = $args['id'];  
  
  $subject = $controller -> getSubject($id);

  if($subject == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

  $chapters = $controller -> chaptersForSubjectById($id);

   $response->getBody()->write(json_encode($chapters));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

/**
 * @OA\Post(
 *     path="/subject",
 *     tags={"Subject"},
 *     summary="Add new subject",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"name", "category", "chapters"}, 
 *           @OA\Property(property = "name", type = "string"),
 *           @OA\Property(property = "category", type = "string"),
 *           @OA\Property(property = "chapters", type = "array", items = {"integer"})                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Add New Subject"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->post('/docs/subjects', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);


  $name = $data['name'] ?? false;
  $category_id = $data['category_id'] ?? false;
  
  if($name == false || $category_id == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $controller->postSubject($name, $category_id);
  $response->getBody()->write(json_encode('Subject Added!'));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

$app->post('/subjects', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);


  $name = $data['name'] ?? false;
  $category_id = $data['category_id'] ?? false;
  
  if($name == false || $category_id == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $controller->postSubject($name, $category_id);
  $response->getBody()->write(json_encode('Subject Added!'));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

/**
 * @OA\Delete(
 *     path="/subjects/{subjectID}",
 *     tags={"Subject"},
 *     summary="Remove subject",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *          @OA\Property(property = "id", type = "integer")                                        
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Subject Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Subject Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->delete('/docs/subjects/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $subjectToBeDeleted = $controller->getSubject($id);

  if($subjectToBeDeleted == null){
    $response->getBody()->write(json_encode("Subject not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteSubject($id);
   $response->getBody()->write(json_encode($subjectToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->delete('/deleteSubject/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $subjectToBeDeleted = $controller->getSubject($id);

  if($subjectToBeDeleted == null){
    $response->getBody()->write(json_encode("Subject not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteSubject($id);
   $response->getBody()->write(json_encode($subjectToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});


//! category

/**
 * @OA\Get(
 *     path="/categories",
 *     tags={"Category"},
 *     summary="Retrieve available categories.",
 *     @OA\Response(response="200", description="View Categories"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/categories', function($request, $response) use($controller){
  $categories = $controller->getCategories();
  $response->getBody()->write(json_encode($categories));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/categories', function($request, $response) use($controller){
  $categories = $controller->getCategories();
  $response->getBody()->write(json_encode($categories));
  return $response->withHeader('Content-Type', 'application/json');
});

/**
 * @OA\Get(
 *     path="/categories/{id}/subjects",
 *     tags={"Category"},
 *     summary="Retrieve all subjects within defined category.",
 *     @OA\Response(response="200", description="View Subjects"),
 *     @OA\Response(response="404", description="Subjects Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/categories/{id}/subjects', function($request, $response, $args) use($controller){
    $id = $args['id'];  

    $category = $controller->getCategory($id);

   if($category == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
   }

   $subjects = $controller->subjectsForCategoryId($id);

   $response->getBody()->write(json_encode($subjects));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/categories/{id}/subjects', function($request, $response, $args) use($controller){
  $id = $args['id'];  

  $category = $controller->getCategory($id);

 if($category == null){
  return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
 }

 $subjects = $controller->subjectsForCategoryId($id);

 $response->getBody()->write(json_encode($subjects));
 return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});


/**
 * @OA\Post(
 *     path="/category",
 *     tags={"Category"},
 *     summary="Add new category",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"name", "description", "subjects"}, 
 *           @OA\Property(property = "name", type = "string"),
 *           @OA\Property(property = "description", type = "string"),
 *           @OA\Property(property = "subjects", type = "array",
 *            @OA\Items(type = "integer"))                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Add New Subject"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->post('/docs/categories', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);

  $name = $data['name'] ?? false;
  
  if($name == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $category = $controller->postCategory($name);
  $response->getBody()->write(json_encode(sprintf("Added Category with name %s", $name)));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});

$app->post('/categories', function($request, $response) use($controller){
  $json = $request->getBody();
  $data = json_decode($json, true);

  $name = $data['name'] ?? false;
  
  if($name == false){

    $response->getBody()->write(json_encode('Bad Request!'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
  }

  $category = $controller->postCategory($name);
  $response->getBody()->write(json_encode(sprintf("Added Category with name %s", $name)));
  return $response->withHeader('Content-Type', 'application/json')->withStatus(201);;
});


$app->post('/quizzes', function($request, $response) use($twig, $controller){
  $categoryID = $_POST['category_id'];

  $subjectID = $_POST['subject_id'];

  $exp = $_POST['experience_points'];
  $pass = $_POST['passing_limit'];
  $quizName = $_POST['quiz'];
  $quizID = 16;          // To DO
  $questionId = 8;       // To Do

  $is_correct= 0;
  $test_id= 0;
 // Retrieve the question and answer values
 $questions = array();
 $answers = array();

 foreach ($_POST as $key => $value) {
  if (strpos($key, 'question') === 0 && $key !== 'question_number') {
    // Handle question input
    $questionNumber = substr($key, 8); // Remove 'question' from the key
    $questions[$questionNumber] = $value;
  } elseif (strpos($key, 'answer') === 0 && $key !== 'answer_number') {
    // Handle answer input
    $answerNumber = substr($key, 6); // Remove 'answer' from the key
    $answers[$answerNumber] = $value;
  }
}



 print_r($_POST);



  $controller->addQuiz($quizName, $exp, $pass, $subjectID);
  $controller->addQuestion($questions, $quizID, $test_id);
  $controller->addAnswer($answers,$questionId,$is_correct);

  return $response;
});




/**
 * @OA\Put(
 *     path="/categories/{categoryID}",
 *     tags={"Category"},
 *     summary="Update category",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id", "name", "description", "subjects"}, 
 *           @OA\Property(property = "id", type = "integer"),
 *           @OA\Property(property = "name", type = "string"),
 *           @OA\Property(property = "description", type = "string"),
 *           @OA\Property(property = "subjects", type = "array",
 *            @OA\Items(type = "integer"))                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Category Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Category Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->get('/docs/categories/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  

   $category = $controller->getCategory($id);

   if($category == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
   }

   $response->getBody()->write(json_encode($category));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/categories/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];  

   $category = $controller->getCategory($id);

   if($category == null){
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
   }

   $response->getBody()->write(json_encode($category));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

/**
 * @OA\Delete(
 *     path="/categories/{categoryID}",
 *     tags={"Category"},
 *     summary="Remove category",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id", "name", "description", "subjects"}, 
 *           @OA\Property(property = "id", type = "integer")              
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Remove Category"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Category Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 $app->delete('/docs/categories/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $categoryToBeDeleted = $controller->getCategory($id);

  if($categoryToBeDeleted == null){
    $response->getBody()->write(json_encode("Category not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteCategory($id);
   $response->getBody()->write(json_encode($categoryToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->delete('/categories/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $categoryToBeDeleted = $controller->getCategory($id);

  if($categoryToBeDeleted == null){
    $response->getBody()->write(json_encode("Category not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteCategory($id);
   $response->getBody()->write(json_encode($categoryToBeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

//! quizz

$app->delete('/quizz/{id}', function($request, $response, $args) use($controller){
  $id = $args['id'];
  $quizzTobeDeleted = $controller->getQuizz($id);

  if($quizzTobeDeleted == null){
    $response->getBody()->write(json_encode("Category not found!"));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
  }

   $controller->deleteQuizz($id);
   $response->getBody()->write(json_encode($quizzTobeDeleted));
   return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});


/**
 * @OA\Get(
 *     path="/quizzes",
 *     tags={"Quizz"},
 *     summary="Retrieve available quizzes",
 *     @OA\Response(response="200", description="View Quizzes"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Get(
 *     path="/quizzes/{quizzID}",
 *     tags={"Quizz"},
 *     summary="Retrieve data related to specific quizz",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *           @OA\Property(property = "id", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="View Quizz Data"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Post(
 *     path="/quizz",
 *     tags={"Quizz"},
 *     summary="Add new quizz",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"title", "score", "exp", "subject_id"}, 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "score", type = "integer"),
 *          @OA\Property(property = "exp", type = "integer"),
 *          @OA\Property(property = "subject_id", type = "integer")                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Add New Chapter"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Put(
 *     path="/quizzes/{quizzID}",
 *     tags={"Quizz"},
 *     summary="Update quizz",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id", "title", "score", "exp", "subject_id"},
 *          @OA\Property(property = "id", type = "integer"), 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "score", type = "integer"),
 *          @OA\Property(property = "exp", type = "integer"),
 *          @OA\Property(property = "subject_id", type = "integer")                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Quizz Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Quizz Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Delete(
 *     path="/quizzes/{quizzID}",
 *     tags={"Quizz"},
 *     summary="Remove specific quizz",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *           @OA\Property(property = "id", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Quizz Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Quizz Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 //! question

/**
 * @OA\Get(
 *     path="/questions",
 *     tags={"Question"},
 *     summary="Retrieve available questions",
 *     @OA\Response(response="200", description="View Questions"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Get(
 *     path="/questions/{questionID}",
 *     tags={"Question"},
 *     summary="Retrieve data related to specific question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *           @OA\Property(property = "id", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="View Question Data"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Post(
 *     path="/question",
 *     tags={"Question"},
 *     summary="Add new question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"title", "quizzID", "answers"}, 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "quizzID", type = "integer"),
 *          @OA\Property(property = "answers", type = "array",
 *           @OA\Items(type = "integer"))                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Added"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Put(
 *     path="/questions/{questionID}",
 *     tags={"Question"},
 *     summary="Modify question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"questionID", "title", "quizzID", "answers"},
 *          @OA\Property(property = "questionID", type = "integer"), 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "quizzID", type = "integer"),
 *          @OA\Property(property = "answers", type = "array",
 *           @OA\Items(type = "integer"))                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Delete(
 *     path="/questions/{questionID}",
 *     tags={"Question"},
 *     summary="Remove question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"questionID", "title", "quizzID", "answers"},
 *          @OA\Property(property = "questionID", type = "integer"), 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "quizzID", type = "integer"),
 *          @OA\Property(property = "answers", type = "array",
 *           @OA\Items(type = "integer"))                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 //! answer

/**
 * @OA\Get(
 *     path="/answers/{questionID}",
 *     tags={"Answer"},
 *     summary="Retrieve available answers for a specific question",
 *     @OA\Response(response="200", description="View Answers"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Get(
 *     path="/answers/{answerID}",
 *     tags={"Answer"},
 *     summary="Retrieve data related to specific answer",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *           @OA\Property(property = "id", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="View Answer Data"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Post(
 *     path="/answer",
 *     tags={"Answer"},
 *     summary="Add new answer",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"text", "correct", "questionID"}, 
 *          @OA\Property(property = "text", type = "string"),
 *          @OA\Property(property = "correct", type = "boolean"),
 *          @OA\Property(property = "questionID", type = "integer")                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Added"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Put(
 *     path="/answers/{answerID}",
 *     tags={"Answer"},
 *     summary="Modify question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"answerID", "text", "correct", "questionID"},
 *          @OA\Property(property = "answerID", type = "integer"), 
 *          @OA\Property(property = "text", type = "string"),
 *          @OA\Property(property = "correct", type = "boolean"),
 *          @OA\Property(property = "questionID", type = "integer")                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Delete(
 *     path="/answers/{answerID}",
 *     tags={"Answer"},
 *     summary="Remove question",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"},
 *          @OA\Property(property = "id", type = "integer")                                  
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Question Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 //! test

/**
 * @OA\Get(
 *     path="/tests",
 *     tags={"Test"},
 *     summary="Retrieve available tests",
 *     @OA\Response(response="200", description="View Tests"),
 *     @OA\Response(response="404", description="No Entry Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

  /**
 * @OA\Get(
 *     path="/tests/{testID}",
 *     tags={"Test"},
 *     summary="Retrieve data related to specific test",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"testID"}, 
 *           @OA\Property(property = "testID", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="View Test Data"),
 *     @OA\Response(response="404", description="Test Not Found"),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Post(
 *     path="/test",
 *     tags={"Test"},
 *     summary="Add new test",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"title", "score", "exp", "chapterID"}, 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "score", type = "integer"),
 *          @OA\Property(property = "exp", type = "integer"),
 *          @OA\Property(property = "chapterID", type = "integer")                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Add New Test"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

 /**
 * @OA\Put(
 *     path="/tests/{testID}",
 *     tags={"Test"},
 *     summary="Update test",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"testID", "title", "score", "exp", "chapterID"},
 *          @OA\Property(property = "testID", type = "integer"), 
 *          @OA\Property(property = "title", type = "string"),
 *          @OA\Property(property = "score", type = "integer"),
 *          @OA\Property(property = "exp", type = "integer"),
 *          @OA\Property(property = "chapterID", type = "integer")                                    
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Test Updated"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Test Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */

/**
 * @OA\Delete(
 *     path="/tests/{testID}",
 *     tags={"Test"},
 *     summary="Remove specific test",
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType = "application/json",
 *          @OA\Schema(required = {"id"}, 
 *           @OA\Property(property = "id", type = "integer")                                
 *          )
 *      )
 *     ),
 *     @OA\Response(response="200", description="Test Removed"),
 *     @OA\Response(response="403", description="Access Denied."),
 *     @OA\Response(response="404", description="Test Not Found."),
 *     @OA\Response(response="500", description="Server Maintenance")
 * )
 */


$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true,true,true);
$app->run();
?>
