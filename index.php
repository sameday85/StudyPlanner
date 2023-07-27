<html>
<head>
<title>Study Planner</title>
<link rel="stylesheet" href="css/study.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function() {
   // Bind submit button onclick handler to send an Ajax request and process Ajax response.
   $("#ask").click(function(event) {
      event.preventDefault();  // Do not run the default action
      $('#answer').html("Thinking...");
      
      $.ajax({
         type: 'POST',
         url:  'gpt.php',
         data: { days: $("#days").val(), grade: $("#grade").val(), subject: $("#subject").val() , daily_time: $("#daily_time").val() }
      })
         .done( function (responseText) {
            // Triggered if response status code is 200 (OK)
            $('#answer').html(responseText);
         })
         .fail( function (jqXHR, status, error) {
            // Triggered if response status code is NOT 200 (OK)
            alert(jqXHR.responseText);
         })
         .always( function() {
            // Always run after .done() or .fail()
            // $('p:first').after('<p>Thank you.</p>');
         });
   });
});    
</script>
</head>
<body>
<div id="wrapper">    
    <div id="banner">
        <p class="title">Study Planner</p>
    </div>
    <hr class="separator">
    <div id="content">
        <div class="tab">
          <a class="tablinks" href="javascript:location.reload();"><img src="img/home.png">Home</a>
          <a class="tablinks" href="https://summer.harvard.edu/blog/top-10-study-tips-to-study-like-a-harvard-student/" target="blank"><img src="img/pencil.png">Study Tips</a>
        </div>          
        <div id="left">  
            <img src="img/education.png" class="banner">
        </div>  
        <div id="right">
            <div id="topright">
            <p class="intr">Soaring to excellence by empowering all students to learn to the best of their ability for success now and in the future.</p>
            <form method="POST">
                <table style="border:0">
                    <tr>
                        <td>Enter your grade: </td>
                        <td>
                            <select name="grade" id="grade">
                              <option value="1st grade">1st grade</option>
                              <option value="2nd grade">2nd grade</option>
                              <option value="3rd grade">3rd grade</option>
                              <option value="4th grade">4th grade</option>
                              <option value="5th grade">5th grade</option>
                              <option value="6th grade">6th grade</option>
                              <option value="7th grade">7th grade</option>
                              <option value="8th grade">8th grade</option>
                              <option value="9th grade">9th grade</option>
                              <option value="10th grade">10th grade</option>
                              <option value="11th grade">11th grade</option>
                              <option value="12th grade">12th grade</option>
                              <option value="College">College</option>
                              <option value="Graduate school">Graduate school</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Enter subject: </td>
                        <td><input type="text" name="subject" value="Math" id="subject" class="round"></td>
                    </tr>
                    <tr>
                        <td>How many days do you have to practice? </td>
                        <td>
                            <select name="days" id="days">
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>How much time do you have each day to study?</td>
                        <td>
                            <select name="daily_time" id="daily_time">
                              <option value="10">10 minutes</option>
                              <option value="15">15 minutes</option>
                              <option value="20">20 minutes</option>
                              <option value="30">30 minutes</option>
                              <option value="45">45 minutes</option>
                              <option value="60">1 hour</option>
                              <option value="90">1.5 hours</option>
                              <option value="120">2 hours</option>
                              <option value="180">3 hours</option>

                            </select>
                        </td>
                    </tr>
                    <tr><td span="2">&nbsp;</td></tr>
                    <tr>
                        <td span="2"><button id="ask" value="val_1" name="but1" class="round">Submit</button></td>
                    </tr>
                </table>
            </form>
            </div>
            <div id="answer" class="response">&nbsp;</div>  
    <div id = "hint">
        <p>Please use reasonable inputs, or else weird suggestions will be returned.
        <br> Latest update: 7/26/23. Made by Team 15: Victor, Jeffery, Aric, and Bryan.
        <br> Copyright 2023: Study Planner™</p>
    </div>
</div    
</body>
</html>
