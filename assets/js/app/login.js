$(document).ready(function() {
  $( "form" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
      url: API,
      type: 'POST',
      dataType: 'json',
      data: {
        'email' : $('#login-username').val(),
        'pass' : $('#login-password').val()
      }
    })
    .done(function() {
      window.location.href = base_url;
    })
    .fail(function(d) {
      $('.alert #err').html(d.responseJSON.message);
      $('.alert').fadeIn(0).fadeOut(5000);
    });

  });
});
