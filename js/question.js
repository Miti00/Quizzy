let displayQuestions = (e) => {
  e.preventDefault();

  const container = document.querySelector('displayContainer'); 

  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/questions";
  xhr.open('GET' , url, true);

  xhr.onload = function(){
    console.log(this.responseText);
    var data = JSON.parse(this.responseText);
   
    for(var i = 0; i < data.length; i++){
      let text = document.createElement('li');
      text.setAttribute('class', 'title');
      text.innerHTML = data[i].text;

      let quizzID = document.createElement('li');
      quizzID.setAttribute('class', 'quID');
      quizzID.innerHTML = `Belongs to quizz: ` + data[i].quizz_id;

      let testID = document.createElement('li');
      testID.setAttribute('class', 'teID');
      testID.innerHTML = `Belongs to test: ` + data[i].test_id;

      container.appendChild(text);
      container.appendChild(quizzID);
      container.appendChild(testID);
    
    }
  }
}

let createQuestion = (e) => {
  e.preventDefault();
    var inputFields = document.querySelectorAll(".input_field");
    text = inputFields[0].value;
    quizzID = inputFields[1].value;
    testID = inputFields[2].value
    
    
    const data = new FormData();
    data.append('text', text);
    data.append('quizz_id', quizzID);
    data.append('test_id', testID);
    
    var xhr = new XMLHttpRequest();
    const url = "/Quizzyv3/app/quizzes";
    xhr.open('POST' , url, true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
      console.log(this.responseText);
    }
    xhr.send(data);
  }


let updateQuestion = (e) => {
    e.preventDefault();

    var id = document.querySelector(".id-field").value;
    var text = document.querySelector(".text").innerText;
    var quizzID = document.querySelector(".quID").value;
    var testID = document.querySelector(".teID").value;

    //  * request PUT to the server 
    var xhr = new XMLHttpRequest();
  
      let parameters = new Object();
      parameters = {
        "id": id,
        "text": text,
        "quizz_id": quizzID,
        "test_id": testID
      }
      
      xhr.open('PUT' , `/Quizzyv3/app/quizzes/${id}`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        console.log(this.responseText);
  
      }
      xhr.send("parameters=" + encodeURIComponent(JSON.stringify(parameters)));
    } 


let deleteQuestion = (e) => {
  e.preventDefault();
  var id = document.querySelector(".id-field").value;

  var xhr = new XMLHttpRequest();
  const url = `/Quizzyv3/app/questions/${id}`;
  xhr.open('DELETE', url, true);
  xhr.onload = function(){
   
    console.log(this.responseText);

  }

  xhr.send();
}


var retrieveQuestions = document.querySelector("btn-show-qu");
retrieveQuestions.addEventListener("click", displayQuestions);

var addQuestion = document.querySelector("form-add-qu");
addQuestion.addEventListener("submit", createQuestion);

var editQuestion = document.querySelector("btn-edit-qu");
editChapter.addEventListener("click", updateQuestion);

var removeQuestion = document.querySelector(".btn-rm-qu");
removeQuestion.addEventListener("click", deleteQuestion);

