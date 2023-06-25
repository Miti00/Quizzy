let createCategory = () => {
    event.preventDefault();
    const categoryName = document.getElementById('name').value;
  
    const data = {
      name: categoryName
    };
  
    var xhr = new XMLHttpRequest();
    const url = "/Quizzyv3/app/categories";
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
      console.log(this.responseText);
    };
    xhr.send(JSON.stringify(data));
  };
  
  
  
          function deleteCategory(categoriesId) {
      $.ajax({
          url: `/Quizzyv3/app/categories/${categoriesId}`,
          method: 'DELETE',
          data: {
              categoriesId: categoriesId
          },
          success: function(response) {
              // Handle success response
              console.log(response);
              // Perform any necessary UI updates or display success message
          },
          error: function(xhr, status, error) {
              // Handle error response
              console.log(error);
              // Display error message or handle the error accordingly
          }
        })};
        function deleteQuizz(quizz_id) {
          $.ajax({
              url: `/Quizzyv3/app/quizz/${quizz_id}`,
              method: 'DELETE',
              data: {
                quizz_id: quizz_id
              },
              success: function(response) {
                  // Handle success response
                  console.log(response);
                  // Perform any necessary UI updates or display success message
              },
              error: function(xhr, status, error) {
                  // Handle error response
                  console.log(error);
                  // Display error message or handle the error accordingly
              }
            })};



  


//   <script>
//     function submitForm(event) {
//         event.preventDefault(); // Prevent the form from submitting immediately

//         var form = document.getElementById('add-form');
//         var category = document.getElementById('name').value;
//         var course = document.getElementById('course').value;
//         var quiz = document.getElementById('quiz').value;
//         var questionNumber = document.getElementById('question_number').value;
//         var answerNumber = document.getElementById('answer_number').value;

//         if (category && course) {
//             // Submit the form to the category endpoint using Ajax
//             var categoryData = {
//                 name: category,
//                 course: course
//             };

//             // Make an Ajax request to the category endpoint
//             // Adjust the URL and other parameters as per your requirements
//             $.ajax({
//                 url: '/Quizzyv3/app/categories',
//                 method: 'POST',
//                 data: categoryData,
//                 success: function(response) {
//                     // Handle the success response
//                 },
//                 error: function(error) {
//                     // Handle the error response
//                 }
//             });
//         } else if (quiz && course && questionNumber && answerNumber) {
//             // Submit the form to the quiz endpoint using Ajax
//             var quizData = {
//                 quiz: quiz,
//                 course: course,
//                 questionNumber: questionNumber,
//                 answerNumber: answerNumber
//             };

//             // Make an Ajax request to the quiz endpoint
//             // Adjust the URL and other parameters as per your requirements
//             $.ajax({
//                 url: '/Quizzyv3/app/quizz',
//                 method: 'POST',
//                 data: quizData,
//                 success: function(response) {
//                     // Handle the success response
//                 },
//                 error: function(error) {
//                     // Handle the error response
//                 }
//             });
//         } else {
//             // Handle validation or display an error message
//         }
//     }
// </script>
