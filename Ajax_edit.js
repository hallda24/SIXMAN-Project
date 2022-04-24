function createEditForm(value) {
  let refRow = document.getElementById(value);

  let arrayTable = [];

  for (let i = 0; i < refRow.childElementCount; i++) {
    arrayTable.push(refRow.childNodes[i].innerText);
  }

  console.log(arrayTable);

  refRow.insertAdjacentHTML(
    "afterend",
    `<form method="post"><tr class="row-fatch">
      <th scope="row" class="text-end"><input type="text" value="` +
      arrayTable[0] +
      `" class="form-control"></th>
      <td class="fs-6"><input type="text" value="` +
      arrayTable[1] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" value="` +
      arrayTable[2] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" value="` +
      arrayTable[3] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" value="` +
      arrayTable[4] +
      `" class="form-control"></td>
      <td class="fs-6"><input type="text" value="` +
      arrayTable[5] +
      `" class="form-control"></td>
      <td class="fs-6 d-flex justify-content-center align-items-center">                
        <button class="btn btn-secondary mx-1">edit</button>
        <button class="btn btn-danger mx-1">cancel</button>
      </td>
    </tr></form>`
  );
}
