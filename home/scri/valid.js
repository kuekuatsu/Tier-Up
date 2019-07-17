$(document).ready(function(){
   /*name*/
   $('#FirstName').blur(function(){
      var regex=/^[a-zA-Z]+$/;
      var input=$(this).val();
      if(regex.test(input)==false)
      {
         $('#FirstName').addClass("is-invalid");
         $('#FirstName').setError("err");
         $('#sButton').attr("disabled",true);
      }
      else
      {
         $('#FirstName').removeClass("is-invalid");
         $('#sButton').attr("disabled",false);
      }
   });
   $('#LastName').blur(function(){
      var regex=/^[a-zA-Z]+$/;
      var input=$(this).val();
      if(regex.test(input)==false)
      {
         $('#LastName').addClass("is-invalid");
         $('#sButton').attr("disabled",true);
      }
      else
      {
         $('#LastName').removeClass("is-invalid");
         $('#sButton').attr("disabled",false);
      }
   });
/*Username*/
   $('#UserName').blur(function(){
      var regex=/[a-zA-Z0-9_.@]{3,}$/;
      var input=$(this).val();
      if(regex.test(input)==false)
      {
         $('#UserName').addClass("is-invalid");
         $('#sButton').attr("disabled",true);
      }
      else
      {
         $('#UserName').removeClass("is-invalid");
         $('#sButton').attr("disabled",false);
      }
   });

   $('#Email').blur(function(){
      var regex=/^[a-zA-Z0-9._]{4,}@[a-z]{3,}\.(com|net|co)+$/;
      var input=$(this).val();
      if(regex.test(input)==false)
      {
         $('#Email').addClass("is-invalid");
         $('#Email').setError("err");
         $('#sButton').attr("disabled",true);
      }
      else
      {
         $('#Email').removeClass("is-invalid");
         $('#sButton').attr("disabled",false);
      }
   });

   $('#Password').blur(function(){
      var regex=/^[a-zA-Z]+$/;
      var input=$(this).val();
      if(regex.test(input)==false)
      {
         $('#Password').addClass("is-invalid");
         $('#Password').setError("err");
         $('#sButton').attr("disabled",true);
      }
      else
      {
         $('#Password').removeClass("is-invalid");
         $('#sButton').attr("disabled",false);
      }
   });
});
