$(document).ready(function(){
  $("#modal_trigger").leanModal({top : 100, overlay : 0.6, closeButton: ".modal_close" });

  $(function(){
    // Calling Login Form
    $("#login_form").click(function(){
      $(".social_login").hide();
      $(".user_login").show();
      return false;
    });

    // Calling Register Form
    $("#register_form").click(function(){
      $(".social_login").hide();
      $(".user_register").show();
      $(".header_title").text('Register');
      return false;
    });

    // Going back to Social Forms
    $(".back_btn").click(function(){
      $(".user_login").hide();
      $(".user_register").hide();
      $(".social_login").show();
      $(".header_title").text('Login');
      return false;
    });

  })

  $( "#aha_login" ).submit(function( event ) {

    event.preventDefault();
    var form = document.aha_login;
    var dataString=$(form).serialize();
    //alert(dataString);   
    
    $.ajax({
      type: "POST",
      url: "login.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        var _p = $.parseJSON(html);
        if(_p.status == "Success")
        {
          //$('#lgn_message').css('color','#30b507').html(_p.message);
          top.window.location='index.php';
        }
        else if(_p.status == "Failed"){
          $('#lgn_message').css('color','#ED6347').html(_p.message);
        }
        else
          $('#lgn_message').css('color','#ED6347').html(_p.message);
      }
    });   
  });

  $( "#aha_signup" ).submit(function( event ) {
    event.preventDefault();
    var form = document.aha_signup;
    var dataString=$(form).serialize();
    alert(dataString);
    alert("in the event");

    $.ajax({
      type: "POST",
      url: "signup.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        var _p = $.parseJSON(html);
        if(_p.status == "Success")
        {          
          $('#reg_message').css('color','#30b507').html(_p.message);
          top.window.location='index.php';
        }
        else if(_p.status == "Registered"){
          $('#reg_message').css('color','#ED6347').html(_p.message);          
        }
        else
          $('#reg_message').html(_p.message);
      },
      error: function()
      {
        $('#reg_message').html(_p.message);
      }
    })
  })
});