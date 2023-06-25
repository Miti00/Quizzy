<?php
class View extends Model{
  public function displayUsers(){
    return $this->retrieveUsers();
  }


  public function getSubjects(){
    return $this->retrieveSubjects();
  }

  public function getQuizzes(){
    return $this->retrieveQuizzes();
  }

  
  public function getTests(){
    return $this->retriveTests();
  }

  public function getQuestions(){
    return $this->retrieveQuestions();
  }
  public function getAnswers(){
    return $this->retriveAnswers();
  }
  public function getCategories(){
    return $this->retrieveCategories();
  }

}
?>