function createEditForm(value) {
  let refRow = document.getElementById(value);

  let arrayTable = [];

  for (let i = 0; i < refRow.childElementCount; i++) {
    arrayTable.push(refRow.childNodes[i].innerText);
  }

  refRow.insertAdjacentHTML(
    "afterend",
    `<form method="post" id="form-edit"><tr class="row-fatch" id="form` +
      arrayTable[0] +
      `">
      <th scope="row" class="text-end text-danger" id="StudentID` +
      arrayTable[0] +
      `">` +
      arrayTable[0] +
      `</th>
      <td class="fs-6"><input type="text" name="FristName` +
      arrayTable[0] +
      `" value="` +
      arrayTable[1] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="LastName` +
      arrayTable[0] +
      `" value="` +
      arrayTable[2] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="District` +
      arrayTable[0] +
      `" value="` +
      arrayTable[3] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="Province` +
      arrayTable[0] +
      `" value="` +
      arrayTable[4] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" name="Region` +
      arrayTable[0] +
      `" value="` +
      arrayTable[5] +
      `" class="form-control"></td>
      <td></td>
      <td class="fs-6 d-flex justify-content-center align-items-center">                
        <button class="btn btn-secondary mx-1" type="submit" onclick="Update(` +
      value +
      `)">edit</button>
        <button class="btn btn-danger mx-1" onclick="cancel(` +
      value +
      `)">cancel</button>
      </td>
    </tr></form>`
  );
}

function Update(id) {
  let updateData = {
    //Fetch form data
    StudentID: $("#StudentID" + id).text(),
    FristName: $("input[name=FristName" + id + "]").val(),
    LastName: $("input[name=LastName" + id + "]").val(),
    District: $("input[name=District" + id + "]").val(),
    Province: $("input[name=Province" + id + "]").val(),
    Region: $("input[name=Region" + id + "]").val(),
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

function cancel(id) {
  document.getElementById("form" + id).remove();
}
