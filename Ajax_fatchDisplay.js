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
            text: response.errors,
          });
        } else {
          //If successful, than throw a success message

          let countRegion = [0, 0, 0, 0, 0, 0, 0];
          let countAllregion = 0;

          response.alldata.reduce((acc, cur) => {
            if (cur.Region == "ภาคกลาง") {
              countRegion[0]++;
            }
            if (cur.Region == "ภาคเหนือ") {
              countRegion[1]++;
            }
            if (cur.Region == "ภาคใต้") {
              countRegion[2]++;
            }
            if (cur.Region == "ภาคตะวันตก") {
              countRegion[3]++;
            }
            if (cur.Region == "ภาคตะวันออก") {
              countRegion[4]++;
            }
            if (cur.Region == "ภาคอีสาน") {
              countRegion[5]++;
            }
            countAllregion++;
          });

          const proportion = countRegion.map((x) => (x * countAllregion) / 100);

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
                `</td><td class="text-center fs-6">` +
                (item.Region == "ภาคกลาง" ? proportion[0] : "") +
                (item.Region == "ภาคเหนือ" ? proportion[1] : "") +
                (item.Region == "ภาคใต้" ? proportion[2] : "") +
                (item.Region == "ภาคตะวันตก" ? proportion[3] : "") +
                (item.Region == "ภาคตะวันออก" ? proportion[4] : "") +
                (item.Region == "ภาคอีสาน" ? proportion[5] : "") +
                `% </td><td class="text-center fs-6">                
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
