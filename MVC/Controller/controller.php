<?php
class Controller extends Model{

public function register($email, $nickname, $password, $role){
  $this->registerUser($email, $nickname, $password, $role);
}

public function deleteUser($id){
  $this->deleteUserById($id);
}

public function updateUser($id, $email, $nickname, $password){
  $this->updateUserById($id, $email, $nickname, $password);

  $updatedUser = $this->getUserById($id);
  return $updatedUser;
}

public function userById($id){
  $user = $this->getUserById($id);
  return $user;
}

public function getCategories(){
  $categories = $this->retrieveCategories();
  return $categories;
}

public function subjectsForCategoryId($id){
  $subjects = $this->getSubjectsForCategoryId($id);
  return $subjects;
}

public function getCategory($id){
  $category = $this->getCategoryById($id);
  return $category;
}

public function getQuizz($id){
  $category = $this->getQuizzById($id);
  return $category;
}

public function postCategory($name){
  $this->addCategory($name);

}
public function postQuiz($name){
  $this->addQuiz($name);

}


public function deleteCategory($id){
  $this->deleteCategoryById($id);
}


public function deleteQuizz($id){
  $this->deleteQuizzById($id);
}
public function getSubject($id){
  $subject = $this->getSubjectById($id);
  return $subject;
}

public function chaptersForSubjectById($id){
  $chapters = $this->getChaptersForSubjectById($id);
  return $chapters;
}

public function postSubject($name, $category_id){
  $this->addSubject($name, $category_id);
}

public function deleteSubject($id){
  $this->deleteSubjectById($id);
}

public function getChapter($id){
  $chapter = $this->getChapterById($id);
  return $chapter;
}

public function testForSubjectById($id){
  $test = $this->getTestForSubjectById($id);
  return $test;
}

public function postChapter($text, $title, $subject_id){
  $this->addChapter($text, $title, $subject_id);
}

public function deleteChapter($id){
  $this->deleteChapterById($id);
}

public function currentUser($email){
  $currentUser = $this->getUser($email);
  return $currentUser;
}

}
?>