 $(document).ready(function(){ 
  // deshabilitar clic secundario document.oncontextmenu = function(){return false;}  
  
  // --CHOSEN (SELECT)
  $(".chosen-select").chosen({
    placeholder_text_multiple: 'Puede seleccionar varias opciones.'
  });  

  $(".chosen").chosen({
    no_results_text : 'No se encontraron similitudes con:',
    placeholder_text_multiple: 'Puede seleccionar varias opciones.',
    width : '100%',
  });
  // --/CHOSEN

  // --VALIDACION PASSWORD
  var pswd;   
  var repswd;   

  $('.pswd').keyup(function() {
    // set password variable
    pswd = $(this).val();
    //validate the length
    if ( pswd.length < 8 ) {
      $('.length').removeClass('valid').addClass('invalid');
    } else {
      $('.length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if ( pswd.match(/[A-z]/) ) {
      $('.letter').removeClass('invalid').addClass('valid');
    } else {
      $('.letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $('.capital').removeClass('invalid').addClass('valid');
    } else {
      $('.capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if ( pswd.match(/\d/) ) {
      $('.number').removeClass('invalid').addClass('valid');
    } else {
      $('.number').removeClass('valid').addClass('invalid');
    }
  });

  $('.repswd').keyup(function(){
    repswd = $(this).val();
    //validate the length
    if ( repswd == pswd ) {
      $('.equality').removeClass('invalid').addClass('valid');
    } else {
      $('.equality').removeClass('valid').addClass('invalid');
    }                  
  });

  $('.pswd').on('focus',function(){
    $('.pswd_info').removeAttr('hidden','hidden');
  });

  $('.pswd').on('blur',function(){
    $('.pswd_info').attr('hidden','hidden');
   });

  $('.repswd').on('focus',function(){
    $('.pswd_info_b').removeAttr('hidden','hidden');
  });

  $('.repswd').on('blur',function(){
    $('.pswd_info_b').attr('hidden','hidden');
  });
  // --/VALIDACION PASSWORD  

  //Datapicker  
  $('.datepicker').datetimepicker({
    locale: "es", 
    daysOfWeekDisabled: [6,0],   
  });
  //End Datapicker

  
  //Registrar datos laborales  
  $('#next').on('click', function(e) {  
      e.preventDefault();
      $('.datos_laborales').attr('hidden' , 'hidden');
      $('.datos_direccion_laboral').removeAttr('hidden' , 'hidden');
      $('#back').removeAttr('class', 'hidden');
      $('#back').attr('class' , 'btn btn-primary');
      $('#next').attr('class', 'hidden');
      $('#back_show').attr('class', 'hidden');
      $('#submit').removeAttr('class', 'hidden');
      $('#submit').attr('class', 'btn btn-primary col-md-offset-7 col-lg-offset-8');
  });

  $('#back').on('click', function(e) {  
      e.preventDefault();
      $('.datos_direccion_laboral').attr('hidden' , 'hidden');
      $('.datos_laborales').removeAttr('hidden' , 'hidden');     
      $('#back').attr('class' , 'hidden');
      $('#submit').attr('class' , 'hidden');
      $('#submit_edit').attr('class' , 'hidden');
      $('#back_show').removeAttr('class', 'hidden');
      $('#back_show').attr('class', 'btn btn-primary');
      $('#next').removeAttr('class', 'hidden');
      $('#next').attr('class', 'btn btn-primary col-md-offset-7 col-lg-offset-8');
      $('#next_edit').removeAttr('class', 'hidden');
      $('#next_edit').attr('class', 'btn btn-primary col-md-offset-4 col-lg-offset-6');
  });

  $('#next_edit').on('click', function(e) {  
      e.preventDefault();
      $('.datos_laborales').attr('hidden' , 'hidden');
      $('.datos_direccion_laboral').removeAttr('hidden' , 'hidden');
      $('#back').removeAttr('class', 'hidden');
      $('#back').attr('class' , 'btn btn-primary');
      $('#next_edit').attr('class', 'hidden');     
      $('#back_show').attr('class', 'hidden');
      $('#submit_edit').removeAttr('class', 'hidden');
      $('#submit_edit').attr('class', 'btn btn-primary col-md-offset-4 col-lg-offset-6');
  });


  $("#panelPrincipal").DataTable( {
    language: {
        processing:     "Cargando...",
      search:         "Filtro:",
        lengthMenu:    "Mostrar _MENU_ Registros",
        info:           "Hay de _START_ a _END_   resgistros mostrados de _TOTAL_ en total",
        infoEmpty:      "No hay registros disponibles",
        infoFiltered:   "(Hay  _MAX_ Registros en total )",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Ningun registro coincide",
        emptyTable:     "No hay registros disponibles",
        paginate: {
            first:      "Primera",
            previous:   "< Anterior",
            next:       "Siguiente >",
            last:       "Ultima"
        },
        aria: {
          sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
          sortDescending: ": habilitado para ordenar la columna en orden descendente"
      }
    },
  
    lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "todos"]]
  });

  $("#panelSecundario").DataTable( {
    language: {
        processing:     "Cargando...",
      search:         "Filtro:",
        lengthMenu:    "Mostrar _MENU_ Registros",
        info:           "Hay de _START_ a _END_   resgistros mostrados de _TOTAL_ en total",
        infoEmpty:      "No hay registros disponibles",
        infoFiltered:   "(Hay  _MAX_ Registros en total )",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Ningun registro coincide",
        emptyTable:     "No hay registros disponibles",
        paginate: {
            first:      "Primera",
            previous:   "< Anterior",
            next:       "Siguiente >",
            last:       "Ultima"
        },
        aria: {
          sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
          sortDescending: ": habilitado para ordenar la columna en orden descendente"
      }
    },
  
    lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "todos"]]
  });

  $("#add_formacion").on("click",function(){

    // Capturamnos el boton de envío
    var btnEnviar = $("#add_formacion");

    $.ajax({
        type: $("#formInsertFormacion").attr("method"),
        url: $("#formInsertFormacion").attr("action"),
        data:$("#formInsertFormacion").serialize(),

        beforeSend: function(){
            /*
            * Esta función se ejecuta durante el envió de la petición al
            * servidor.
            * */
            // btnEnviar.text("Enviando"); Para button <button></button>
            btnEnviar.val("Enviando"); // Para input de tipo button
            btnEnviar.attr("disabled","disabled");
        },
        complete:function(data){
            /*
            * Se ejecuta al termino de la petición
            * */
            btnEnviar.val("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $(".respuesta").html(data);
            console.log(data);

        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });

    // Nos permite cancelar el envio del formulario
    return false;

  });

  $("#editar_publicacion_button").on("click",function(e){
    e.preventDefault();
    // Capturamnos el boton de envío
    var btnEnviar = $("#editar_publicacion_button");

    $.ajax({
        type: $("#form_edit_publicacion").attr("method"),
        url: $("#form_edit_publicacion").attr("action"),
        data:$("#form_edit_publicacion").serialize(),

        beforeSend: function(){
            /*
            * Esta función se ejecuta durante el envió de la petición al
            * servidor.
            * */
            // btnEnviar.text("Enviando"); Para button <button></button>
            btnEnviar.val("Enviando"); // Para input de tipo button
            btnEnviar.attr("disabled","disabled");
        },
        complete:function(data){
            /*
            * Se ejecuta al termino de la petición
            * */
            btnEnviar.val("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $("#modal_edit_publicacion"+data['id_publicacion']+"").modal('hide');
            $(".texto_publicacion"+data['id_publicacion']+"" ).empty();
            $(".texto_publicacion"+data['id_publicacion']+"" ).append(data['texto']);
            console.log(data);

        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });

    // Nos permite cancelar el envio del formulario
    return false;

  });

  $("#editar_comentario_button").on("click",function(e){
    e.preventDefault();
    // Capturamnos el boton de envío
    var btnEnviar = $("#editar_publicacion_button");

    $.ajax({
        type: $("#form_edit_comentario").attr("method"),
        url: $("#form_edit_comentario").attr("action"),
        data:$("#form_edit_comentario").serialize(),

        beforeSend: function(){
            /*
            * Esta función se ejecuta durante el envió de la petición al
            * servidor.
            * */
            // btnEnviar.text("Enviando"); Para button <button></button>
            btnEnviar.val("Enviando"); // Para input de tipo button
            btnEnviar.attr("disabled","disabled");
        },
        complete:function(data){
            /*
            * Se ejecuta al termino de la petición
            * */
            btnEnviar.val("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $("#modal_edit_comentario"+data['id_comentario']+"").modal('hide');
            $(".texto_comentario"+data['id_comentario']+"" ).empty();
            $(".texto_comentario"+data['id_comentario']+"" ).append(data['texto']);
            console.log(data);

        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });

    // Nos permite cancelar el envio del formulario
    return false;

  });

  $("#formulario_comentario").on("submit",function(e){
    e.preventDefault();
    // Capturamnos el boton de envío
    var btnEnviar = $("#editar_publicacion_button");

    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data:$(this).serialize(),

        beforeSend: function(){
            /*
            * Esta función se ejecuta durante el envió de la petición al
            * servidor.
            * */
            // btnEnviar.text("Enviando"); Para button <button></button>
            btnEnviar.val("Enviando"); // Para input de tipo button
            btnEnviar.attr("disabled","disabled");
        },
        complete:function(data){
            /*
            * Se ejecuta al termino de la petición
            * */
            btnEnviar.val("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $(".comentarios").append("<div class='alert-gris_oscuro'><div class='col-md-11'><div class='texto_comentario"+data['id_comentario']+"'>"+data['texto']+"</div><small>"+data['created_at']+"</small></div><div class='col-md-1 text-right'><a class='alert-link' data-toggle='modal' data-target='#modal_edit_comentario"+data['id_comentario']+"' title='Modificar comentario'><spam class='glyphicon glyphicon-pencil'></spam></a> <a class='alert-link' data-toggle='modal' data-target='#modal"+data['id_publicacion_fk']+"' title='Modificar comentario'><spam class='glyphicon glyphicon-remove'></spam></a><br> <b>"+data['id_usuario_fk']+"</b></div></div>");
            
            console.log(data);

        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });

    // Nos permite cancelar el envio del formulario
    return false;

  });
});
 
    