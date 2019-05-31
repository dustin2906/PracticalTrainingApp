/*
	file:	js/myApp.js
	desc:	This is the Javasript file that gets the data (JSON) from webserver and
			displays it in index.html -> id:s in index.html
*/
//the address to the webservers PHP-folder used in AJAX-calls
var path="http://localhost/FinalProject/finalProject/php/";   
$(document).ready(function(){
	$("#showall").hide();
	isLoggedIn();	//calling a function to check if user is logged in
	$("#frmlogin").submit(function(){
		//When button in form frmlogin is clicked->submit() event happens
		login(); //call login()-function
		return false; //prevent page from reloading (form stays visible)
	});
	$("#logoutbtn").click(function(){
		logout(); //when logoutbtn is clicked, call function logout()
	});
	$("#allstudents").click(function(){
		var search='';	//these two variables are passed as parameter
		var group='';	//to showStudents(), but they are empty in this
		showStudents(search,group); //call. Displays all the students.
	});
	$("#myfilter").keyup(function(){
		var search=$("#myfilter").val(); //take value from search-box
		var group='';
		$("#showall").show();
		showStudents(search,group);
	});
	$("#maincontent").on('click','.groupname',function(){
		var search='';
		var group=$(this).attr('data-groupid'); //value from class="groupname"->data-groupid
		$("#showall").show();
		showStudents(search,group);
	})
	$("#showall").click(function(){
		var search='';	//these two variables are passed as parameter
		var group='';	//to showStudents(), but they are empty in this
		$("#showall").hide();
		showStudents(search,group);
	});
	$("#maincontent").on('click','.studentID',function(){
		var studentID=$(this).attr('data-studentID');
		showSelectedStudent(studentID);	
	});
	$("#modStudentText").on('click','.addTraining',function(){
		$("#frmTrainingStudID").val($(this).attr('data-studentid'));
		$("#showStudent").modal('hide');
		$("#addTraining").modal('show');
		getOptionsForFormAddTraining();
	});
	$("#addTraining").on('hidden.bs.modal',function(){
		$("#showStudent").modal('show');
	});
	$("#frmTraining").submit(function(){
		var studentID=$("#frmTrainingStudID").val();
		var start=$("#start").val();
		var end=$("#end").val();
		var place=$("#place").val();
		var supervisor=$("#supervisor").val();
		var hours=$("#hours").val();
		addTraining(studentID,start,end,place,supervisor,hours);
		showSelectedStudent(studentID); 
		$("#showStudent").modal('show');
		$("#addTraining").modal('hide');
	});
});
function addTraining(studentID,start,end,place,supervisor,hours){
	var target=path+'addTraining.php';
	$.post(target,{
		studentID:studentID,
		start:start,
		end:end,
		place:place,
		supervisor:supervisor,
		hours:hours
	},function(data){
		if(data=='Fail') alert('Could not insert into database!');
	});
}
function getOptionsForFormAddTraining(){
	//gets organization names and supervisor names to the form addTraining
	//supervisors first into the form <select> -list
	var target=path+'getSupervisors.php';
	var txtData='<option value="">-Select supervisor-</option>';
	$.get(target,function(data){
	 if(data!='Fail'){
		var result=$.parseJSON(data);
		$.each(result.supervisors,function(key,supervisor){
			txtData=txtData+'<option value="'+supervisor.supervisorID+'">';
			txtData=txtData+supervisor.firstname+' '+supervisor.lastname+'</option>';
		});
		$("#supervisor").html(txtData);
	 }else $("#mainlogin").html('<p class="alert alert-info">Login first!</p>');
	});
	//organizations into the form <select> -list
	var target=path+'getOrganizations.php';
	var txtData1='<option value="">-Select organization-</option>';
	$.get(target,function(data){
	 if(data!='Fail'){
		var result=$.parseJSON(data);
		$.each(result.organizations,function(key,organization){
			txtData1=txtData1+'<option value="'+organization.organizationID+'">';
			txtData1=txtData1+organization.name+'</option>';
		});
		$("#place").html(txtData1);
	 }else $("#mainlogin").html('<p class="alert alert-info">Login first!</p>');
	});
}
function showSelectedStudent(studentID){
	var target=path+'getStudent.php?studentID='+studentID;
	var txtData='<p><a href="#" class="addTraining" data-studentID="'+studentID+'">Add Training</a></p>';
	
	$("#showStudent").modal(); //shows the modal (toggle)
	$.get(target,function(data){
	 if(data!='Fail'){
		var result=$.parseJSON(data);
		$.each(result.students,function(key,student){
			txtData=txtData+'<p>'+student.firstname+' '+student.lastname+'</p>';
			txtData=txtData+'<p>'+student.email+','+student.phone+'</p>';
		});
		$("#modStudentID").html(studentID);
		$("#modStudentText").html(txtData);
	 }else $("#mainlogin").html('<p class="alert alert-info">Login first!</p>');
	});
	getTraining(studentID); //show the training info in modal
}
function getTraining(studentID){
	var target=path+'getTraining.php?studentID='+studentID;
	var txtData='<table class="table table-condensed">';
	$.get(target,function(data){
	 if(data!='Fail'){
		var result=$.parseJSON(data);
		$.each(result.trainings,function(key,training){
			txtData=txtData+'<tr><td>'+training.start+'</td>';
			txtData=txtData+'<td>'+training.end+'</td>';
			txtData=txtData+'<td>'+training.name+'</td>';
			txtData=txtData+'<td>'+training.firstname+' ';
			txtData=txtData+training.lastname+'</td></tr>';
		});
		txtData=txtData+'</table>';
		$("#modTraining").html(txtData);
	 }else $("#mainlogin").html('<p class="alert alert-info">Login first!</p>');
	});
};



function showStudents(search,group){
	var target=path+'students.php?search='+search+'&group='+group;
	var txtData='<div class="well"><h3>Students</h3></div>';
	if(search!='' || group!=''){
		$("#showall").show();
	}else $("#showall").hide();
	txtData=txtData+'<div class="card-columns">'; //used to create html to display
	$.get(target,function(data){
		if(data!='Fail'){
			//data is coming, parse through the data in JSON
			var result=$.parseJSON(data); //creates array result from data
			$.each(result.students,function(key,student){
			 txtData=txtData+'<div class="card">';
			 txtData=txtData+'<div class="card-body text-center">';
			 txtData=txtData+'<span class="studentID" data-studentID="'+student.studentID+'">';
			 txtData=txtData+'<h5 class="card-title">'+student.studentID+'</h5>'
			 txtData=txtData+'<p class="card-text">'+student.firstname+' '+student.lastname+'</p></span>';
			 txtData=txtData+'<p class="card-text groupname" data-groupid="'+student.groupname+'">'+student.groupname+'</p>';
			 if(student.practicaltrainingdone==1){
			  txtData=txtData+'<p class="card-text"><img src="img/ok.png" class="img-responsive" width="20px" />Finished training!</p>';
			 }else{
			  txtData=txtData+'<p class="card-text"><img src="img/cancel.png" class="img-responsive" width="20px" />Training not finished!</p>';
			 }
			 txtData=txtData+'</div>'; //ends "card-body"
			 txtData=txtData+'</div>'; //ends "card"
			});
			txtData=txtData+'</div>'; //ends the "card-columns" div
			$("#maincontent").html(txtData);
		}else $("#mainlogin").html('<p class="alert alert-info">Login first!</p>');
	});
}
function logout(){
	var targed=path+'logout.php';
	$.get(targed,function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status, user from JSON
		})
		$("#mainlogin").html('<h3 class="alert alert-info">'+result.status+'</h3>');
			//removes username from navbar
		$("#loginplace").show(); //shows login-button in navbar
		$("#logoutplace").hide();//hides logout-button in navbar
		$("#maincontent").hide();//hides maincontent from page
		setTimeout(function(){
			$("#maininfo").html(''); //clears text from maininfo
			$("#maincontent").html(''); //clears maincontent
			$("#maincontent").show(); //shows maincontent again
			$("#showInTraining").hide();
			location.reload();
		},2000);
		
	});
}
function login(){
	var targed=path+'login.php';
	var email=$("#email").val(); //value from the formfield email
	var password=$("#password").val();
	$.post(targed,{
		inputEmail:email,
		inputPassword:password
	},function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status, user from JSON
		})
		if(result.status=='ok'){
			
			$("#logininfo").html('<p class="alert alert-success">Login success!</p>');			
			$("#loginplace").hide(); //hides Login-button (span id="loginplace")
			$("#logoutplace").show();//shows Logout-button
			$("#mainlogin").html('<h4 class="alert alert-success colorchange">Welcome to SupTrain!</h4>');
			$("#showInTraining").show();
			setTimeout(function(){
				$("#loginfrm").modal('hide'); //closes modal form
				$("#email").val(''); //clear email-field
				$("#password").val(''); //clear password-field
				$("#logininfo").html('');
			},2000); //runs the parts inside this block after 2 seconds
			$("#bu").prepend('<a href="SuptrainApplication.php?page=userinfo"><span id="user" style="color:white"></span></a> ');
			$("#user").html(result.user);
		}else{
			$("#logininfo").html('<p class="alert alert-danger">Login failed!</p>');
			$("#email").val(''); //clear email-field
			$("#password").val(''); //clear password-field
		}
	});
}
function isLoggedIn(){
	var target=path+'session.php';
	$.get(target,function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status from JSON
		})
		if(result.status=='ok'){
			$("#loginplace").hide(); //hides Login-button (span id="loginplace")
			$("#logoutplace").show();//displays Logout-button (span id="logoutplace")
			$("#bu").append('<span id="user" style="color:white"></span> ');
			$("#user").html(result.user);
			$("#showInTraining").show();
		}else{
			$("#loginplace").show(); //hides Login-button (span id="loginplace")
			$("#logoutplace").hide();//displays Logout-button (span id="logoutplace")
			$("#showInTraining").hide();
			
		};
	});
}
