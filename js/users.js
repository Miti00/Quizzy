let displayUsers = (e) => {
  e.preventDefault();

  const container = document.querySelector('displayContainer'); 

  var xhr = new XMLHttpRequest();
  const url = "/Quizzyv3/app/users";
  xhr.open('GET' , url, true);

  xhr.onload = function(){
    console.log(this.responseText);
    var data = JSON.parse(this.responseText);
   
    for(var i = 0; i < data.length; i++){
      let nickname = document.createElement('li');
      nickname.setAttribute('class', 'nickname');
      nickname.innerText = data[i].nickname;

      let experiencePoints = document.createElement('li');
      experiencePoints.setAttribute('class', 'exp');
      experiencePoints.innerText = data[i].experience_points;

      container.appendChild(nickname);
      container.appendChild(experiencePoints);
    }
  }
}

let createUser = (e) => {
  e.preventDefault();
    var inputFields = document.querySelectorAll(".input_field");
    nickname = inputFields[0].value;
    email = inputFields[1].value;
    password = inputFields[2].value;
    experiencePoints = inputFields[3].value
    
    
    const data = new FormData();
    data.append('nickname', nickname);
    data.append('email', email);
    data.append('password', password);
    data.append('experience_points', experiencePoints);
    
    var xhr = new XMLHttpRequest();
    const url = "/Quizzyv3/app/users";
    xhr.open('POST' , url, true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
      console.log(this.responseText);
    }
    xhr.send(data);
  }


let updateUser = (e) => {
    e.preventDefault();

    var id = document.querySelector(".id-field").value;
    var nickname = document.querySelector(".nickname").innerText;
    var email = document.querySelector(".email").innerText;
    var password = document.querySelector(".password").text;
    var experiencePoints = document.querySelector(".exp").value;

    //  * request PUT to the server 
    var xhr = new XMLHttpRequest();
  
      let parameters = new Object();
      parameters = {
        "id": id,
        "nickname": nickname,
        "email": email,
        "password": password,
        "experience_points": experiencePoints
      }
      
      xhr.open('PUT' , `/Quizzyv3/app/users/${id}`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        console.log(this.responseText);
  
      }
      xhr.send("parameters=" + encodeURIComponent(JSON.stringify(parameters)));
    } 


let deleteUser = (e) => {
  e.preventDefault();
  var id = document.querySelector(".id-field").value;

  var xhr = new XMLHttpRequest();
  const url = `/Quizzyv3/app/users/${id}`;
  xhr.open('DELETE', url, true);
  xhr.onload = function(){
   
    console.log(this.responseText);

  }

  xhr.send();
}


var retrieveUsers = document.querySelector("btn-show-us");
retrieveUsers.addEventListener("click", displayUsers);

var addUser = document.querySelector("form-add-us");
addUser.addEventListener("submit", createUser);

var editUser = document.querySelector("btn-edit-us");
editUser.addEventListener("click", updateUser);

var removeUser = document.querySelector(".btn-rm-us");
removeUser.addEventListener("click", deleteUser);

