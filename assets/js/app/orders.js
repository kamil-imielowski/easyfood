var setComplited = function (id) {
    $.ajax({
      url: API_UPDATE,
      type: 'UPDATE',
      dataType: 'json',
      data: {
        'id' : id
      }
    })
    .done(function() {
      location.reload();
    });
}
