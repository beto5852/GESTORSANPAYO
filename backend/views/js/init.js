$(document).ready(function () {

  $("#listaArticulos").DataTable({
   
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    language: {
      url: 'views/js/spanishtable.json'
    },
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
  });

  // Editor
  $('#editor').summernote();

});

 



// Disable form submissions if there are invalid fields
(function () {
  "use strict";
  window.addEventListener(
    "load",
    function () {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
});



$(document).ready(function() {
  $("#fecha").datepicker({
    format:'YYYY-MM-DD HH:mm:ss'
  });
});
