
$(document).ready(function () {
  $('.radio-show').click(function () {
    var inputValue = $(this).attr("value");
    var targetBox = $("." + inputValue);
    $(".radio-show-content").not(targetBox).hide();
    $(targetBox).show("1000");
  });
});
