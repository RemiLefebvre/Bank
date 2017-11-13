$("button").click(function(){
  $(".options").css("display","none");
  $(this).parents(".infos").next().toggle("slow");
  $(".account").css("background-color","white");
  $(this).parents(".account").css("background-color","#d8d8d8");
});

$(".sold").each(function(){
  var sold=$(this).text();
  if (sold < 0) {
    $(this).css("color","red");
  }
  else {
    $(this).css("color","green");
  }
});
