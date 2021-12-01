$(document).ready(function () {
  $("#listaArticulos").DataTable({
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    language: {
      url: "views/js/spanishtable.json",
    },
    dom: "Bfrtip",
    buttons: ["copy", "excel", "pdf"],
    order: [[ 0, "desc" ]]
  });

  // Editor
  $("#editor").summernote();
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

$(document).ready(function () {
  $("#fecha").datepicker({
    format: "YYYY-MM-DD HH:mm:ss",
  });
});

Dropzone.autoDiscover = false;

new Dropzone(".dropzone", {
            url: "controllers/articulos.php",
            maxFiles: 1,
            addRemoveLinks: true,
            // uploadMultiple: true,
            maxFilesize: 0.5, //max 2mb
            acceptedFiles: ".jpg,.jpeg,.png", //
            autoProcessQueue: false,
            dictDefaultMessage: "Arrastra las imagenes aquí",
            removedfile: function(file) {
              file.previewElement.remove();
              },
              success: function(file,response){
                  // console.log(file);
  
                  if(file.status == "success"){
                      $('#content .alert').hide();
                      $('#content').append('<div class="alert alert-primary alert-dismissible fade show" role="alert">'
                      + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                      + '<span aria-hidden="true">&times;</span>'
                      +'</button>'
                      +'<strong>Se lograrón subir las imagenes</strong>'
                      +'</div>');
                  }
                  else
                  {
                      $('#content').append('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                                          + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                          + '<span aria-hidden="true">&times;</span>'
                                          +'</button>'+
                                          +'<strong>No se lograrón subir las imagenes</strong>'+
                                          +'</div>'); 
                  }
              }
});
