
/*РЕДАКТИРОВАНИЕ ФОРМУ*/
 /* $('.editForm').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.formForm').html(this.response);
      }
    }
    request.open('GET','pages/admin/editForm.php?idForm='+id, true);
    request.send(); 
  });*/
/*УДАЛЕНИЕ ФОРМЫ*/
 /* $('.deleteForm').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#deleteForm').modal('show');
      }
    }
    request.open('GET','pages/admin/deleteForm.php?idForm='+id, true);
    request.send(); 
  });*/
/*ДОБАВИТЬ ФОРМУ*/
 /* $('.subAddForm').on('click',  function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formAddForm);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/addForm.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('.addFormModal').html(msg.success);
            
          } else {
            $('.error').html(msg.error);
          }
        }
      });
    }
  });*/