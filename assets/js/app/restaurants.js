$(document).ready(function() {
  $( "#addProduct" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
      url: API_ADD,
      type: 'PUT',
      dataType: 'json',
      data: {
        'id': $('#article_id').val(),
        'name' : $('#new_pName').val(),
        'description' : $('#new_pDesc').val(),
        'price' : $('#new_pPrice').val()
      }
    })
    .done(function() {
      location.reload();
    });
  });
});


var deleteItem = function (id) {
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

var addItemToBasket = function (id, price) {
    $.ajax({
      url: API_ADDBASKET,
      type: 'PUT',
      dataType: 'json',
      data: {
        'id' : $('#article_id').val(),
        'product_id' : id,
        'price' : price
      }
    })
    .done(function() {
      location.reload();
    });
}
