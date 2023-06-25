let displayChapters = (e) => {
  e.preventDefault();

  const container = document.querySelector('displayContainer'); 

  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/chapters";
  xhr.open('GET' , url, true);

  xhr.onload = function(){
    console.log(this.responseText);
    var data = JSON.parse(this.responseText);
   
    for(var i = 0; i < data.length; i++){
      let title = document.createElement('li');
      title.setAttribute('class', 'title');
      title.innerHTML = data[i].title;

      let text = document.createElement('li');
      text.setAttribute('class', 'text');
      text.innerHTML = data[i].text;

      container.appendChild(title);
      container.appendChild(text);
    }
  }
}

let createChapter = (e) => {
  e.preventDefault();
    var inputFields = document.querySelectorAll(".input_field");
    title = inputFields[0].value;
    text = inputFields[1].value;
    subjectID = inputFields[2].value
    
    
    const data = new FormData();
    data.append('title', title);
    data.append('text', text);
    data.append('subjectID', subjectID);
    
    var xhr = new XMLHttpRequest();
    const url = "/Quizzyv3/app/chapters";
    xhr.open('POST' , url, true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
      console.log(this.responseText);
    }
    xhr.send(data);
  }


let updateChapter = (e) => {
    e.preventDefault();

    var id = document.querySelector(".id-field").value;
    var title = document.querySelector(".title").innerText;
    var text = document.querySelector(".text").innerText;
    var subjectID = document.querySelector(".subjectID").value;

    //  * request PUT to the server 
    var xhr = new XMLHttpRequest();
  
      let parameters = new Object();
      parameters = {
        "id": id,
        "title": title,
        "text": text,
        "subjectID": subjectID
      }
      
      xhr.open('PUT' , `/Quizzyv3/app/chapters/${id}`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        console.log(this.responseText);
  
      }
      xhr.send("parameters=" + encodeURIComponent(JSON.stringify(parameters)));
    } 


    
let deleteChapter = (e) => {
  e.preventDefault();
  var id = document.querySelector(".id-field").value;

  var xhr = new XMLHttpRequest();
  const url = `/Quizzyv3/app/chapters/${id}`;
  xhr.open('DELETE', url, true);
  xhr.onload = function(){
   
    console.log(this.responseText);

  }

  xhr.send();
}


var retrieveChapters = document.querySelector("btn-show-ch");
retrieveChapters.addEventListener("click", displayChapters);

var addChapter = document.querySelector("form-add-ch");
addChapter.addEventListener("submit", createChapter);

var editChapter = document.querySelector("btn-edit-ch");
editChapter.addEventListener("click", updateChapter);

var removeChapter = document.querySelector(".btn-rm-ch");
removeChapter.addEventListener("click", deleteChapter);

