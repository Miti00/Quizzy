let displayQuizzes = (e) => {
  e.preventDefault();

  const container = document.querySelector('displayContainer'); 

  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/quizzes";
  xhr.open('GET' , url, true);

  xhr.onload = function(){
    console.log(this.responseText);
    var data = JSON.parse(this.responseText);
   
    for(var i = 0; i < data.length; i++){
      let title = document.createElement('li');
      title.setAttribute('class', 'title');
      title.innerText = data[i].title;

      let experiencePoints = document.createElement('li');
      experiencePoints.setAttribute('class', 'exp');
      experiencePoints.innerText = data[i].experience_points;

      let passingLimit = document.createElement('li');
      passingLimit.setAttribute('class', 'pass');
      passingLimit.innerText = data[i].passing_limit;

      container.appendChild(title);
      container.appendChild(experiencePoints);
      container.appendChild(passingLimit);
    }
  }
}


let createQuizz = (e) => {
  e.preventDefault();
  var inputFields = document.querySelectorAll(".input_field");
  experiencePoints = inputFields[0].value;
  passingLimit = inputFields[1].value;
  subjectID = inputFields[2].value
  
  
  const data = new FormData();
  data.append('title', title);
  data.append('experience_points', experiencePoints);
  data.append('passing_limit', passingLimit);
  data.append('subject_id', subjectID);
  
  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/chapters";
  xhr.open('POST' , url, true);
  // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function(){
    console.log(this.responseText);
  }
  xhr.send(data);
}


let updateQuizz = (e) => {
  // e.preventDefault();

  var id = document.querySelector(".id-field").value;
  var title = document.querySelector(".title").innerText;
  var experiencePoints = document.querySelector(".experience-points").value;
  var passingLimit = document.querySelector(".passing-limit").value;
  var subjectID = document.querySelector(".subjectID").value;

  //  * request PUT to the server 
  var xhr = new XMLHttpRequest();

    let parameters = new Object();
    parameters = {
      "id": id,
      "title": title,
      "experience_points": experiencePoints,
      "passing_limit": passingLimit,
      "subjectID": subjectID
    }
    
    xhr.open('PUT' , `/Quizzyv3/app/quizzes/${id}`, true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      console.log(this.responseText);

    }
    xhr.send("parameters=" + encodeURIComponent(JSON.stringify(parameters)));
}

let deleteQuizz = (e) => {
  e.preventDefault();
  var id = document.querySelector(".id-field").value;

  var xhr = new XMLHttpRequest();
  const url = `/Quizzyv3/app/quizzes/${id}`;
  xhr.open('DELETE', url, true);
  xhr.onload = function(){
   
    console.log(this.responseText);

  }

  xhr.send();
}


var retrieveQuizzes = document.querySelector("btn-show-qz");
retrieveQuizzes.addEventListener("click", displayQuizzes);

var addQuizz = document.querySelector("form-add-qz");
addQuizz.addEventListener("submit", createQuizz);

var editQuizz = document.querySelector("btn-edit-qz");
editQuizz.addEventListener("click", updateQuizz);

var removeQuizz = document.getElementById('remove-form');
removeQuizz.addEventListener("submit", deleteQuizz);