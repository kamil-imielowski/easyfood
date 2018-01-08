var deleteRestaurant = function (id) {
    $.ajax({
      url: API_DEL,
      type: 'DELETE',
      dataType: 'json',
      data: {
        'id' : id
      }
    })
    .done(function() {
      location.reload();
    });
}
