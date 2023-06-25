<?php
//! only the model interacts with the database
//! logic part -> controller

class Model extends DB{
  protected function retrieveUsers(){
    $sql = "SELECT nickname, experience_points FROM users ORDER BY experience_points DESC";

    $statement = $this->connect()->prepare($sql);
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  protected function registerUser($email, $nickname, $password, $role){
    $sql = "INSERT INTO users(email, nickname, password, role) VALUES(:email, :nickname, :password, :role)";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':nickname', $nickname);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':role', $role);
  
    $statement->execute();
  }

  protected function deleteUserById($id){
    $sql = "DELETE FROM users WHERE id=:id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
  }

  protected function updateUserById($id, $email, $nickname, $password){
    $sql = "UPDATE users SET email = :email, nickname = :nickname, password = :password WHERE id=:id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':nickname', $nickname);
    $securePassword = md5($password);
    $statement->bindValue(':password', $securePassword);
    $statement->execute();
  }

  protected function getUserById($id){
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $currentUser = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $currentUser;
  }


  // !rebuild this function to check for user id too (improves accuracy)
  protected function getUser($email){
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();

    $currentUser = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $currentUser;
  }

  protected function getUsers(){
    $sql = "SELECT users.id, users.email FROM users";
    $statement = $this->connect()->prepare($sql);
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
    
  }

  protected function retrieveCategories(){
    $sql = "SELECT categories.id, categories.name FROM categories";
    $statement = $this->connect()->prepare($sql);
    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
  }

  protected function getSubjectsForCategoryId($id){
    $sql = "SELECT s.id, s.name, s.category_id FROM subjects s WHERE s.category_id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $subjects;
  }

  protected function getCategoryById($id){
    $sql = "SELECT * FROM categories WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $category = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $category;
  }
  protected function getQuizzById($id){
    $sql = "SELECT * FROM quizzes WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $quizz = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $quizz;
  }

  protected function addCategory($name){
    $sql = "INSERT INTO categories(name) VALUES(:name)";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':name', $name);
  
    $statement->execute();
  }

  protected function insertQuiz($name, $exp, $pass, $subject_id){
    $sql = "INSERT INTO quizzes(name, experience_points, passing_limit, subject_id) 
    VALUES(:name, :exp, :pass, :subject_id)";

    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':exp', $exp);
    $statement->bindValue(':pass', $pass);
    $statement->bindValue(':subject_id', $subject_id);

    $statement->execute();
  }

  protected function insertQuestion($text, $quiz_id, $test_id) {
    $sql = "INSERT INTO questions(text, quiz_id, test_id) 
            VALUES(:text, :quiz_id, :test_id)";
  
    $statement = $this->connect()->prepare($sql);
  
    foreach ($text as $question) {
      $statement->bindValue(':text', $question);
      $statement->bindValue(':quiz_id', $quiz_id);
      $statement->bindValue(':test_id', $test_id);
  
      $statement->execute();
    }
  }
  
  protected function insertAnswer($text, $question_id, $is_correct) {
    $sql = "INSERT INTO answers(text, question_id, is_correct) 
            VALUES(:text, :question_id, :is_correct)";
  
    $statement = $this->connect()->prepare($sql);
  
    foreach ($text as $answer) {
      $statement->bindValue(':text', $answer);
      $statement->bindValue(':question_id', $question_id);
      $statement->bindValue(':is_correct', $is_correct);
  
      $statement->execute();
    }
  }
  
  
  public function addQuiz($name, $exp, $pass, $subject_id) {
    return $this->insertQuiz($name, $exp, $pass, $subject_id);
  }
  
  public function addQuestion($text, $quizz_id, $test_id) {
    return $this->insertQuestion($text, $quizz_id, $test_id);
  }
public function addAnswer($text,$question_id,$is_correct){
  return $this->insertAnswer($text,$question_id,$is_correct);
}

  protected function deleteCategoryById($id){
    $sql = "DELETE FROM categories WHERE id=:id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
  }
  
  protected function deleteQuizzById($id){
    $sql = "DELETE FROM quizzes WHERE id=:id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
  }


  protected function retrieveSubjects(){
    $sql = "SELECT subjects.* FROM subjects";
    $statement = $this->connect()->prepare($sql);
    $statement->execute();

    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $subjects;
  }
  

  protected function getSubjectById($id){
    $sql = "SELECT * FROM subjects WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $category = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $category;
  }

  protected function getChaptersForSubjectById($id){
    $sql = "SELECT * FROM chapters c WHERE c.subject_id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $subjects;
  }

  protected function addSubject($name, $category_id){
    $sql = "INSERT INTO subjects(name, category_id) VALUES(:name, :category_id)";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':category_id', $category_id);
  
    $statement->execute();
  }

  protected function deleteSubjectById($id){
    $sql = "DELETE FROM subjects WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
  
    if ($statement->execute()) {
        // Subject deleted successfully

        // Delete associated quizzes
        $sql = "DELETE FROM quizzes WHERE subject_id = :subjectId";
        $statement = $this->connect()->prepare($sql);
        $statement->bindValue(':subjectId', $id);
        $statement->execute();

        // Delete associated chapters
        $sql = "DELETE FROM chapters WHERE subject_id = :subjectId";
        $statement = $this->connect()->prepare($sql);
        $statement->bindValue(':subjectId', $id);
        $statement->execute();

        // Perform any other necessary clean-up or operations

        echo "Subject, quizzes, and chapters deleted successfully";
    } else {
        echo "Failed to delete subject";
    }
}


  protected function getChapterById($id){
    $sql = "SELECT * FROM chapters WHERE id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $category = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $category;
  }

  protected function getTestForSubjectById($id){
    $sql = "SELECT * FROM tests t WHERE t.chapter_id = :id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $subjects;
  }

  protected function addChapter($text, $title, $subject_id){
    $sql = "INSERT INTO chapters(text, title,  subject_id) VALUES(:text, :title, :subject_id)";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':text', $text);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':subject_id', $subject_id);
  
    $statement->execute();
  }

  protected function deleteChapterById($id){
    $sql = "DELETE FROM chapters WHERE id=:id";
    $statement = $this->connect()->prepare($sql);
    $statement->bindValue(':id', $id);
  
    $statement->execute();
  }

  public function retrieveQuizzes(){
    $sql = "SELECT quizzes.* FROM quizzes";
    $statement = $this->connect()->prepare($sql);
    $statement->execute();

    $quizzes = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $quizzes;
}


public function retrieveQuestions(){
  $sql = "SELECT questions.* FROM questions";
  $statement = $this->connect()->prepare($sql);


  $statement->execute();

  $questions = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $questions;
}

public function retriveAnswers(){
  $sql = "SELECT answers.* FROM answers";
  $statement = $this->connect()->prepare($sql);

  $statement->execute();

  $answers = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $answers;
}
public function retriveTests(){
  $sql = "SELECT tests.* FROM tests";
  $statement = $this->connect()->prepare($sql);
  $statement->execute();

  $quizzes = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $quizzes;
}

}
?>