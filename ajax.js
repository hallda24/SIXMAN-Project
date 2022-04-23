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
            title: "failed",
            text: response.errors.search,
          });
          if (response.errors) {
            //Returned if any error from process.php
            Swal.fire({
              icon: "error",
              title: "Returned if any error from edit.php",
              text: response.errors,
            });
          }
        } else {
          //If successful
          console.log(response);
          //If successful, than throw a success message

          if ($("#head-table-show").hasClass("d-none")) {
            $("#head-table-show").removeClass("d-none");
          }

          $("#search-form").text(`ค้นหาด้วย " ` + response.search + ` "`);

          $.each(response.data, function (i, item) {
            let $trHTML = $("#table-show").append(
              `<tr><th scope="row" class="text-end">` +
                item.StudentID +
                `</th><td class="text-center fs-6">` +
                item.FristName +
                `</td><td class="text-center fs-6">` +
                item.LastName +
                `</td><td class="text-center fs-6">` +
                item.District +
                `</td><td class="text-center fs-6">` +
                item.Province +
                `</td><td class="text-center fs-6">` +
                item.Region +
                `</td><td class="text-center fs-6"><button class="btn btn-primary">edit</button></td></tr>`
            );
          });
        }
      },
    });
    event.preventDefault(); //Prevent the default submit
  });
});
