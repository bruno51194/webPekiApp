(function($) {
    "use strict";
  
  // Options for Message
  //----------------------------------------------
  var options = {
    'btn-loading': '<i class="fa fa-spinner fa-pulse"></i>',
    'btn-success': '<i class="fa fa-check"></i>',
    'btn-error': '<i class="fa fa-remove"></i>',
    'msg-success': 'Tot bé! Redireccionant...',
    'msg-error': "L'usuari o la contrasenya estàn malament",
    'msg-invalid-email' : "Format invàlid d'email",
    'msg-existe-email' : 'Aquest email ja existeix',
    'msg-form-uncomplete' : "Hi ha camps sense completar",
    'useAJAX': true,
  };

  // Login Form
  //----------------------------------------------
  // Validation
  $("#login-form").validate({
    rules: {
      lg_username: "required",
      lg_password: "required",
    },
    errorClass: "form-invalid"
  });
  
  // Form Submission
  var login = $("#login-form");
  login.submit(function() {
    remove_loading(login);
    form_loading(login);
    if(options['useAJAX'] == true)
    {
      $.ajax({
      url: "Slim/api.php/usuarios/existe",
      type: "POST",
      data: login.serialize(),
      success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    form_success(login);
                    document.cookie="id="+responseTextarray[1];
                    document.cookie="email="+responseTextarray[2];
                    document.cookie="tipo="+responseTextarray[3];
                    window.location.href = "index.php";
                  }
                  else if(responseTextarray[0] == "0"){
                    form_failed(login);
                  }
                  else{
                      alert(responseText);
                  }
          }
      });
      return false;
    }
  });
  
  // Register Form
  //----------------------------------------------
  // Validation
  $("#register-form").validate({
    rules: {
      reg_email: {
        required: true,
        email: true
      },
      reg_password: {
        required: true,
        minlength: 5
      },
      reg_password_confirm: {
        required: true,
        minlength: 5,
        equalTo: "#register-form [name=reg_password]"
      },
      reg_name: {
        required: true
      },
      reg_surname: {
        required: true
      },
      reg_cp: {
        required: true,
        digits: true
      },
      reg_pob: {
        required: true
      },
      reg_addr: {
        required: true
      },
      reg_tel: {
        required: true,
        digits: true
      },
      reg_agree: "required",
    },
    errorClass: "form-invalid",
    errorPlacement: function( label, element ) {
      if( element.attr( "type" ) === "checkbox" || element.attr( "type" ) === "radio" ) {
        element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
      }
      else {
        label.insertAfter( element ); // standard behaviour
      }
    }
  });

  // Form Submission
  var registre = $("#register-form");
  registre.submit(function() {
    remove_loading($(this));
    
    if(options['useAJAX'] == true)
    {

      $.ajax({
      url: "Slim/api.php/insertarUsuarios",
      type: "POST",
      data: registre.serialize(),
      success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    registre.html("<div id='resultado_correcto' class='form-group text-center'><div class='alert alert-success'><strong>Operació exitosa!</strong> T'has registrat a PekiApp.</div></div>");
                    window.location.href = "index.php";
                  }
                  else if(responseTextarray[0] == "2"){
                    email_existeix(registre);
                  }
                  else if(responseTextarray[0] == "3"){
                    email_invalid(registre);
                  }
                  else if(responseTextarray[0] == "4"){
                    form_uncomplete(registre)
                  }else{
                    alert(responseTextarray[0]);
                    alert('Opss! Ha ocurrido algun problema.');
                  }
          }
      });
      return false;
    }
  });

  // Loading
  //----------------------------------------------
  function remove_loading($form)
  {
    $form.find('[type=submit]').removeClass('error success');
    $form.find('.login-form-main-message').removeClass('show error success').html('');
  }

  function form_loading($form)
  {
    $form.find('[type=submit]').addClass('clicked').html(options['btn-loading']);
  }
  
  function form_success($form)
  {
    $form.find('[type=submit]').addClass('success').html(options['btn-success']);
    $form.find('.login-form-main-message').addClass('show success').html(options['msg-success']);
  }

  function form_failed($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html(options['msg-error']);
  }
  function email_invalid($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html(options['msg-invalid-email']);
  }
  function email_existeix($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html(options['msg-existe-email']);
  }
  function form_uncomplete($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html(options['msg-form-uncomplete']);
  }

  // Dummy Submit Form (Remove this)
  //----------------------------------------------
  // This is just a dummy form submission. You should use your AJAX function or remove this function if you are not using AJAX.
  function dummy_submit_form($form)
  {
    if($form.valid())
    {
      form_loading($form);
      
      setTimeout(function() {
        form_success($form);
      }, 2000);
    }
  }
  
})(jQuery);