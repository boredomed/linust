
        var  my_data = {"Departments": [
     {"Name": "Computer Science", "Link": "this is link for CS" ,
        "Courses": [{"Name": "Database Systems", "Link": "This is link for DBS"},
         {"Name": "Adavanced Programming", "Link": "This is link for AP"},
          {"Name": "Artificial Intellegence", "Link":"This is link for AI"}]},
     {"Name": "Software Engineering", "Link": "this is link for SE" ,
        "Courses": [{"Name": "Datastructures and Algorithms", "Link": "This is link for DSA"},
         {"Name": "Software Design and Architecture", "Link": "This is link for SDA"},
          {"Name": "Web Development", "Link":"This is link for Web"}]},
     {"Name": "Eelectrical Enginerring", "Link": "this is link for EE" ,
        "Courses": [{"Name": "Digital Logic Design", "Link": "This is link for DLD"},
         {"Name": "Computer Networking", "Link": "This is link for CN"},
          {"Name": "Basic Electronics", "Link":"This is link for BE"}]}
]};
                

        function search()
        {   
            console.log("Enter function");
            var wid = $("#name").width();
            $("#list").width(wid);
            var name = document.getElementById("name").value.toLowerCase();
            //console.log(name);
            //console.log(dept);

            var length = my_data.Departments.length;
            var flag = 0;
            var link;
            var course;

            console.log("About to enter loop");
            var options = "";

            for (var i = 0; i < length; i++)
            {
                //console.log(i);
                var students = my_data.Departments[i].Courses.length;
                //console.log(students);
                for (var x =0; x < students; x++)
                {
                    //console.log(my_data.Departments[i].Courses[x]);
                    var str=my_data.Departments[i].Courses[x].Name.toLowerCase();
                if(str.includes(name))
                {
                    options += '<option value="'+my_data.Departments[i].Courses[x].Name+'" />';

                    flag = 1;
                    
                }
                }
            }
            console.log(flag);
            if(flag != 0){
                  document.getElementById('list').innerHTML = options;
            } 
            
        }




function func_p(){
    var str = document.getElementById("password1").value;
    var y = str.length;

    var strength = 0;

    var capital = new RegExp("[A-Z]");
    var small = new RegExp("[a-z]");
    var num = new RegExp("[1-9]");
    var special = new RegExp("[{}/!@$%^&*()~]");

    if(y > 7){
        strength++;
    }
    
    if(capital.test(str) && small.test(str)){
        strength++;
    }

    if(num.test(str)){
        strength++;
    }

    if(special.test(str)){
        strength++;
    }
    var x = " ";
    var colors = "red";
    if(strength == 0){
        color="red";
        x = " poor";
    }
    else if(strength == 1){
        colors = "red";
        x = " poor";
    }
    else if(strength == 2){
        colors = "orange"
        x = " fair";
    }
    else if(strength == 3){
        colors = "yellow"
        x = " good";
    }
    else if(strength == 4){
        colors = "blue";
        x = " strong";
    }
    var x1 = "Strength";
    document.getElementById("demo").style.color = colors;
    document.getElementById("demo").innerHTML = x;
    document.getElementById("demo1").innerHTML = x1;
}

function pass_match(){

var password = document.getElementById("password1")
  ,confirm_password = document.getElementById("repassword");

  if(password.value != confirm_password.value) {
    document.getElementById("demo2").innerHTML = "Password don't match";
  } else {
    document.getElementById("demo2").innerHTML = "Pasword Matched";
    document.getElementById("demo2").style.color = "blue";
  }
}


  var y = 33.642561;
  var y1 = 72.988047;
  var uluru = {lat: y, lng: y1};
  function initMap() {
    
       var map = new google.maps.Map(document.getElementById('map'), {
       zoom: 14,
       center: uluru
  });
  
  var marker = new google.maps.Marker({
          position: uluru,
          map: map
});
}


var i = 0;
var txt = 'LINE NUST WITH INOVATION';
var speed = 50;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("n2").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}




function courseUpload() {
  var file = $("courseSelector").files[0];
  var formdata = new FormData();
  formdata.append("courseSelector", file);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", courseProgressHandler, false);

  ajax.open("POST", ""); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
  $("courseProgress").value = 0;
  $("#courseProgress").show();
}

function courseProgressHandler(event) {
  $("courseProgress").value = Math.round(percent);
}

function linkUpload() {
  var file = $("linkSelector").files[0];
  var formdata = new FormData();
  formdata.append("linkSelector", file);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", linkProgressHandler, false);

  ajax.open("POST", ""); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
  $("linkProgress").value = 0;
  $("#linkProgress").show();
}

function linkProgressHandler(event) {
  $("linkProgress").value = Math.round(percent);
}

$(window).resize(function(){
  if($(window).width()<768)
    $("#myfooter").removeClass("navbar navbar-default navbar-fixed-bottom");
  else
    $("#myfooter").addClass("navbar navbar-default navbar-fixed-bottom");
  $("html").attr("width",$(window).width());
});

$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
    if($(window).width()<768)
      $("#myfooter").removeClass("navbar navbar-default navbar-fixed-bottom");
    else
      $("#myfooter").addClass("navbar navbar-default navbar-fixed-bottom");
});