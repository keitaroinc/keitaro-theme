$(document).ready(function () {
  $('.job-button').click(function () {
    var inputValue = $(this).attr("value");
    var targetBox = $('.' + inputValue);
    $(targetBox).toggle('1000');
  })
})