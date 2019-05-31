function changeDone(current, id){
  var desired=100;
  if(current==0)desired=1;
  else desired=0;
  document.getElementById("currentDoneInput").value=desired;
  document.getElementById("StudentIDDone").value=id;
  document.getElementById("DoneChangeForm").submit();
}