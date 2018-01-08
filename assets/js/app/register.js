$(document).ready(function() {
  $('#res').on('click', function(event) {
    if ($(this).is(':checked')) {
      $('.us-grp').hide();
      $('.res-grp').show();
    }else {
      $('.us-grp').show();
      $('.res-grp').hide();
    }
  });

  $( "form" ).submit(function( event ) {
    event.preventDefault();
    var _err = 0;
    if ($('#res').is(':checked')) {
      var _t = 'restaurateur';

      if ($('#res_name').val() == '') {
        $('#res_name').css('border-bottom-color', 'red');
        _err++;
      }

    }else {
      var _t = 'user';

      if ($('#firstname').val() == '') {
        $('#firstname').css('border-bottom-color', 'red');
        _err++;
      }

      if ($('#lastname').val() == '') {
        $('#lastname').css('border-bottom-color', 'red');
        _err++;
      }
    }


    if (_err == 0) {
      $.ajax({
        url: API,
        type: 'POST',
        dataType: 'json',
        data: {
          'email': $('#email').val(),
          'type' : _t,
          'password' : $('#passowrd').val(),
          'firstname' : $('#firstname').val(),
          'lastname' : $('#lastname').val(),
          'res_name' : $('#res_name').val(),
          'password' : $('#passowrd').val(),
          'street' : $('#street').val(),
          'postcode' : $('#postcode').val(),
          'city' : $('#city').val(),
          'phone' : $('#phone').val()
        }
      })
      .done(function() {
        window.location.href = base_url+"login.html";
      })
      .fail(function(d) {
        $('.alert #err').html(d.responseJSON.message);
        $('.alert').fadeIn(0).fadeOut(5000);
      });
    }
  });
});
