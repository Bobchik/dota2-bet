// $("#start_form").submit(function (e) {
//     // var url = "/js/node-dota2/examples/example2.js";
//     var url = "/lobby";
//     // var url = "http://localhost:8080";
//     $.ajax({
//         type: "POST",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: url,
//         data: $("#start_form").serialize(),
//         success: function () {
//             console.log("Good"); // show response from the php script.
//         }
//     });
//     e.preventDefault();
// });

// function loadDoc() {
//     var xhttp = new XMLHttpRequest();
//
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("demo").innerHTML =
//                 this.responseText;
//         }
//     };
//     xhttp.open("GET", "/js/4501o.txt", true);
//     xhttp.send();
// }