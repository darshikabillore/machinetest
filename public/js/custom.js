// $( document ).ready(function() {
//   $('form[id="adduser"]').validate({
//     rules: {
//       name: 'required',
//       address: 'required',
//       email: {
//         required: true,
//         email: true,
//       },
//       password: {
//         required: true,
//         minlength: 6,
//       }
//     },
//     messages: {
//       name: 'This field is required',
//       address: 'This field is required',
//       email: 'Enter a valid email',
//       password: {
//         minlength: 'Password must be at least 6 characters long'
//       }
//     },
//     submitHandler: function(form) {
//       form.submit();
//     }
//   });

// });
function edit(id, name, email,type,address,phone){
    setTimeout(function() {
    $("#name").val(name);
    $("#email").val(email);
    $('#id').val(id);
    $('#address').val(address);
    $('#type').val(type);   
    if(type == 1){
      $('#type').find(":selected").text();
    }
    $('#phone').val(phone);   

    var baseUrl= $('#baseUrl').val();
        $.ajax({
           type:"GET",
           url:baseUrl+'/update',
          data: {name: name,id:id,email:email,address:address,type:type,phone:phone},
           success:function(data){  
           },
        });
    
    }, 1000);

}
$( document ).ready(function() {

$('#exampleModal').on('hidden.bs.modal', function (event) {
  $('#adduser').trigger("reset");
    $('#adduser')[0].reset();
});

    $('#roles').on('change', function() {
      if(this.value == 2){
     $('.showtherpist').show();

      }
    });
});
