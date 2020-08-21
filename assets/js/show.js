// // (function ($) {
// //   $(document).ready(function showElement() {
// //     var target = event.target || event.srcElement;
// //     let element = $('#' + target.value)
// //     if (target.checked == true) {
// //       element.css("display", "inline-block")
// //       window.setTimeout(function () {
// //         element.css("opacity", "1");
// //         element.css("transform", "scale(1)");
// //       }, 0);
// //     } else {
// //       element.css("opacity", "0");
// //       element.css("transform", "scale(0)");
// //       window.setTimeout(function () {
// //         element.css("display", "none")
// //       }, 400);
// //     }

// //   })

// // })(jQuery);

// function showElement() {
//   // Get the checkbox
//   var target = event.target || event.srcElement;
//   var id = target.id
//   let element = document.getElementById(target.value)
//   if (target.checked == true) {
//     element.style.display = "inline-block"
//     window.setTimeout(function () {
//       element.style.opacity = 1;
//       element.style.transform = 'scale(1)';
//     }, 0);
//   } else {
//     element.style.opacity = 0;
//     element.style.transform = 'scale(0)';
//     window.setTimeout(function () {
//       element.style.display = "none"
//     }, 400);
//   }
// }

var showElement = function () {
  var target = event.target || event.srcElement;
  let element = $('#' + target.value)
  if (target.checked == true) {
    element.css("display", "inline-block")
    window.setTimeout(function () {
      element.css("opacity", "1");
      element.css("transform", "scale(1)");
    }, 0);
  } else {
    element.css("opacity", "0");
    element.css("transform", "scale(0)");
    window.setTimeout(function () {
      element.css("display", "none")
    }, 400);
  }
}