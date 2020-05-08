$(document).ready(function () {
   
    function cat () {

        $.ajax({
           url: "/",
           method: "POST",
           data: {category: 1},
           success: function (data) {

           }
        });
    }
    
})