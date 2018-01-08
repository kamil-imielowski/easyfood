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

  $( "#orderProducts" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
      url: API_POST_ORDER,
      type: 'UPDATE',
      dataType: 'json',
      data: {
        'id': $('#article_id').val(),
        'order_street' : $('#order_street').val(),
        'order_postcode' : $('#order_postcode').val(),
        'order_city' : $('#order_city').val(),
        'price' : $('#full_price').val()
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


var deleteBasketItem = function (id) {
    $.ajax({
      url: API_DEL_BASKET_ITEM,
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
