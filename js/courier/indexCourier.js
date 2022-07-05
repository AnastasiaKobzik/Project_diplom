/*----- НАЖАТИЕ НА ВСЕ ЗАКАЗЫ ------*/
  $('.all').on('click',  function(){
    $('.my').css('text-decoration', 'none');
    $('.my').css('color', '#2C2C2C');
    $('.unaccepted').css('text-decoration', 'none');
    $('.unaccepted').css('color', '#2C2C2C');
    $('.completed').css('text-decoration', 'none');
    $('.completed').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputAllOrders.php', true);
    request.send();   
  });
/*----- НАЖАТИЕ НА МОИ ЗАКАЗЫ ------*/
  $('.my').on('click',  function(){
    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.unaccepted').css('text-decoration', 'none');
    $('.unaccepted').css('color', '#2C2C2C');
    $('.completed').css('text-decoration', 'none');
    $('.completed').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputMyOrders.php', true);
    request.send();    
  });
/*----- НАЖАТИЕ НА НЕПРИНЯТЫЕ ЗАКАЗЫ ------*/
  $('.unaccepted').on('click',  function(){
    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.my').css('text-decoration', 'none');
    $('.my').css('color', '#2C2C2C');
    $('.completed').css('text-decoration', 'none');
    $('.completed').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputUnacceptedOrders.php', true);
    request.send();    
  });
/*----- НАЖАТИЕ НА ЗАВЕРШЕННЫЕ ЗАКАЗЫ ------*/
  $('.completed').on('click',  function(){
    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.my').css('text-decoration', 'none');
    $('.my').css('color', '#2C2C2C');
    $('.unaccepted').css('text-decoration', 'none');
    $('.unaccepted').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputCompletedOrders.php', true);
    request.send();    
  });

/* кнопка забрать у ЗАРЕГ-ГО польз-ля*/
  $('.accOrdUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/acceptOrderCourier.php?id=' + idOrder.value, true);
    request.send(); 
  });
/* кнопка забрать у НЕЗАРЕГ-ГО польз-ля*/
  $('.accOrdNoUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/acceptOrderCourierNoUser.php?id=' + idOrder.value, true);
    request.send(); 
  });

/*кнопка доставлено у ЗАРЕГ-ГО польз-ля*/
  $('.deliOrdUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/orderDeliveredCourier.php?id=' + idOrder.value, true);
    request.send(); 
  });
/*кнопка доставлено у НЕЗАРЕГ-ГО польз-ля*/
  $('.deliOrdNoUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/orderDeliveredCourierNoUser.php?id=' + idOrder.value, true);
    request.send(); 
  });

/*кнопка оплачено у ЗАРЕГ-ГО польз-ля*/
  $('.paidOrdUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/orderPaidCourier.php?id=' + idOrder.value, true);
    request.send(); 
  });
/*кнопка оплачено у НЕЗАРЕГ-ГО польз-ля*/
  $('.paidOrdNoUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/courier/orderPaidCourierNoUser.php?id=' + idOrder.value, true);
    request.send(); 
  });

//Подробнее у заказа ЗАРЕГ-ГО польз-ля
  $('.moreOrdUser').on('click', function(){
    var id = this.querySelector('.hiddenOrdUser').value;
    var numbOrd = this.querySelector('.numberOrder').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputMoreOrder.php?id=' + id + '&numbOrd=' + numbOrd, true);
    request.send();
  });

//Подробнее у заказа НЕЗАРЕГ-ГО польз-ля
  $('.moreOrdNoUser').on('click', function(){
    var id = this.querySelector('.hiddenOrdNoUser').value;
    var numbOrd = this.querySelector('.numberOrderNoUser').value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputMoreOrderNoUser.php?id=' + id + '&numbOrd=' + numbOrd, true);
    request.send();
  });

/*нажатие на ВЕРНУТЬСЯ*/
$('.comeBack').on('click', function(){
  location.reload(); 
});