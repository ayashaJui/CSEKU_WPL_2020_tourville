$(document).ready(function () {
  //CK Editor....
  ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );
});