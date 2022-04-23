$(document).ready(function () {
  $("form").submit(function (event) {
    //Trigger on form submit
    $("#search").empty(); //Clear the messages first

    //Validate fields if required using jQuery

    var postForm = {
      //Fetch form data
      search: $("input[name=search]").val(), //Store name fields value
    };

    $.ajax({
      //Process the form using $.ajax()
      type: "POST", //Method type
      url: "edit.php", //Your form processing file URL
      data: postForm, //Forms name
      dataType: "json",
      encode: true,
      success: function (response) {
        if (!response.success) {
          //If fails
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response.errors,
            footer: '<a href="">Why do I have this issue?</a>',
          });
          if (response.errors.name) {
            //Returned if any error from process.php
            $(".throw_error").fadeIn(1000).html(response.errors.name); //Throw relevant error
          }
        } else {
          //If successful
          console.log(response.data);
          //If successful, than throw a success message
          $.each(response.data, function (i, item) {
            console.log(item);
            var $tr = $("#table-show").append(
              "<tr><td>" + item.StudentID + "</td></td>"
            ); //.appendTo('#records_table');
          });
        }
      },
    });
    event.preventDefault(); //Prevent the default submit
  });
});
