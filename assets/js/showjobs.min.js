$(document).ready(function () {
  $('.job-button').click(function () {
    $("i", this).toggleClass("fa-angle-down fa-angle-up")
    $(this).toggleClass("job-button job-button-active")
    var inputValue = $(this).attr("value");
    var targetBox = $('.' + inputValue);
    $(targetBox).toggle('1000');
  })
})