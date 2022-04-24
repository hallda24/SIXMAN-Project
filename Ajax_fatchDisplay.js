$(document).ready(function () {
  $("#form-search").submit(function (event) {
    event.preventDefault(); //Prevent the default submit

    var postForm = {
      //Fetch form data
      search: $("input[name=search]").val(), //Store name fields value
    };

    $("#search").empty(); //Empty the div before fetching new data

    $.ajax({
      //Process the form using $.ajax()
      type: "POST", //Method type
      url: "fatchDisplay.php", //Your form processing file URL
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

          $(".row-fatch").remove();

          $.each(response.data, function (i, item) {
            let $trHTML = $("#table-show").append(
              `<tr id="` +
                item.StudentID +
                `" class="row-fatch"
               ><th scope="row" class="text-end">` +
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
                `</td><td class="text-center fs-6">                
                <button class="btn btn-primary" onclick="createEditForm(` +
                item.StudentID +
                `)">edit</button>
              </td></tr>`
            );
          });
        }
      },
    });
  });
});
