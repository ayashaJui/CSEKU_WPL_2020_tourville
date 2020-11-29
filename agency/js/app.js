$(document).ready(function () {
  //CK Editor....
  var x = document.querySelectorAll('#body');

  for(var i=0; i<x.length; i++){
   ClassicEditor.create(x[i]).catch((error) => {
     console.log(error);
   });
  }
});
