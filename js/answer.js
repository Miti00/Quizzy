let displayAnswers = (e) => {
  e.preventDefault();

  const container = document.querySelector('displayContainer'); 

  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/chapters";
  xhr.open('GET' , url, true);

  xhr.onload = function(){
    console.log(this.responseText);
    var data = JSON.parse(this.responseText);
   
    for(var i = 0; i < data.length; i++){
      let text = document.createElement('li');
      text.setAttribute('class', 'title');
      text.innerHTML = data[i].text;

      let correct = document.createElement('li');
      correct.setAttribute('class', 'correct');
      text.innerHTML = data[i].is_correct;

      let questionID = document.createElement('li');
      questionID.setAttribute('class', 'quID');
      questionID.innerHTML = `Belongs to question: ` + data[i].question_id;

      container.appendChild(text);
      container.appendChild(questionID);
    }
  }
}

let createAnswer = (e) => {
  e.preventDefault();
    var inputFields = document.querySelectorAll(".input_field");
    title = inputFields[0].value;
    is_correct = inputFields[1].value;
    questionID = inputFields[2].value
    
    
    const data = new FormData();
    data.append('text', text);
    data.append('is_correct', is_correct);
    data.append('question_id', questionID);
    
    var xhr = new XMLHttpRequest();
    const url = "/Quizzyv3/app/answers";
    xhr.open('POST' , url, true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
      console.log(this.responseText);
    }
    xhr.send(data);
  }


let updateAnswer = (e) => {
    e.preventDefault();

    var id = document.querySelector(".id-field").value;
    var text = document.querySelector(".text").innerText;
    var correct = document.querySelector(".correct").value;
    var questionID = document.querySelector(".quID").value;

    //  * request PUT to the server 
    var xhr = new XMLHttpRequest();
  
      let parameters = new Object();
      parameters = {
        "id": id,
        "text": text,
        "correct": correct,
        "question_id": questionID
      }
      
      xhr.open('PUT' , `/Quizzyv3/app/answers/${id}`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        console.log(this.responseText);
  
      }
      xhr.send("parameters=" + encodeURIComponent(JSON.stringify(parameters)));
    } 


let deleteAnswer = (e) => {
  e.preventDefault();
  var id = document.querySelector(".id-field").value;

  var xhr = new XMLHttpRequest();
  const url = `/Quizzyv3/app/answers/${id}`;
  xhr.open('DELETE', url, true);
  xhr.onload = function(){
   
    console.log(this.responseText);

  }

  xhr.send();
}


var retrieveAnswers = document.querySelector("btn-show-an");
retrieveAnswers.addEventListener("click", displayAnswers);

var addAnswer = document.querySelector("form-add-an");
addAnswer.addEventListener("submit", createAnswer);

var editChapter = document.querySelector("btn-edit-an");
editAnswer.addEventListener("click", updateAnswer);

var removeAnswer = document.querySelector(".btn-rm-an");
removeAnswer.addEventListener("click", deleteAnswer);

