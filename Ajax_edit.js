function createEditForm(value) {
  let refRow = document.getElementById(value);

  let arrayTable = [];

  for (let i = 0; i < refRow.childElementCount; i++) {
    arrayTable.push(refRow.childNodes[i].innerText);
  }

  refRow.insertAdjacentHTML(
    "afterend",
    `<form method="post" id="form-edit"><tr class="row-fatch">
      <th scope="row" class="text-end"><input type="text" name="StudentID" value="` +
      arrayTable[0] +
      `" class="form-control"></th>
      <td class="fs-6"><input type="text" name="FristName" value="` +
      arrayTable[1] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="LastName" value="` +
      arrayTable[2] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="District" value="` +
      arrayTable[3] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="Province" value="` +
      arrayTable[4] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="Region" value="` +
      arrayTable[5] +
      `" class="form-control"></td>
      <td class="fs-6 d-flex justify-content-center align-items-center">                
        <button class="btn btn-secondary mx-1" type="submit" onclick="Update()">edit</button>
        <button class="btn btn-danger mx-1">cancel</button>
      </td>
    </tr></form>`
  );
}

function Update() {
  let updateData = {
    //Fetch form data
    StudentID: $("input[name=StudentID]").val(),
    FristName: $("input[name=FristName]").val(),
    LastName: $("input[name=LastName]").val(),
    District: $("input[name=District]").val(),
    Province: $("input[name=Province]").val(),
    Region: $("input[name=Region]").val(),
  };

  console.log(updateData);

  $.ajax({
    //Process the form using $.ajax()
    type: "POST", //Method type
    url: "Update.php", //Your form processing file URL
    data: updateData, //Forms name
    dataType: "json",
    encode: true,
    success: function (response) {
      if (!response.status) {
        //If fails
        Swal.fire({
          icon: "error",
          title: "failed",
          text: response.errors,
        });
      } else {
        Swal.fire({
          icon: "success",
          title: "Update Complete",
          text: response,
        });
      }
    },
  });
}

/* let updateData = {
  //Fetch form data
  StudentID: $("input[name=StudentID]").val(),
  FristName: $("input[name=FristName]").val(),
  LastName: $("input[name=LastName]").val(),
  District: $("input[name=District]").val(),
  Province: $("input[name=Province]").val(),
  Region: $("input[name=Region]").val(),
};

$.ajax({
  //Process the form using $.ajax()
  type: "POST", //Method type
  url: "Update.php", //Your form processing file URL
  data: updateData, //Forms name
  dataType: "json",
  encode: true,
  success: function (response) {
    console.log(response);
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
    }
  },
}); */
