var totalPrice = 0;
var vat = 0;

function addItem() {
    var itemCode = document.getElementById("itemCode").value;
    var itemName = document.getElementById("itemName").value;
    var itemType = document.getElementById("itemtype").value;
    var quantity = parseInt(document.getElementById("quantity").value);
    var mrp = parseFloat(document.getElementById("mrp").value);
    var discount = parseFloat(document.getElementById("discount").value);

    var table = document.getElementById("itemTable");
    var row = table.insertRow(-1);

    var cell1 = row.insertCell(0);
    cell1.innerHTML = itemCode;

    var cell2 = row.insertCell(1);
    cell2.innerHTML = itemName;

    var cell3 = row.insertCell(2);
    cell3.innerHTML = itemType;

    var cell3 = row.insertCell(3);
    cell3.innerHTML = quantity;

    var cell4 = row.insertCell(4);
    cell4.innerHTML = mrp;

    var cell5 = row.insertCell(5);
    cell5.innerHTML = discount;

    var itemTotal = ((mrp - (mrp * (discount / 100))) * quantity);
    totalPrice += itemTotal;

    var cell6 = row.insertCell(6);
    cell6.innerHTML = itemTotal;
    cell6.style.fontWeight = 700;

    document.getElementById("totalPrice").innerHTML = totalPrice.toFixed(2);

    vat = totalPrice * 0.15;

    document.getElementById("vat").innerHTML = vat.toFixed(2);

    clearForm();

}




function clearForm() {
    document.getElementById("itemCode").value = "";
    document.getElementById("itemName").value = "";
    document.getElementById("itemtype").value = "";
    document.getElementById("quantity").value = "";
    document.getElementById("mrp").value = "";
    document.getElementById("discount").value = "";
}




function generateBill() {
    var customerName = document.getElementById("customerName").value;
    var customerEmail = document.getElementById("customerEmail").value;
    var paidValue = parseFloat(document.getElementById("paidValue").value)
  
    var billHTML = `
      <html>
      <head>
        <title>Bill</title>
        <style>
          /* Add any desired styling for the bill here */
        </style>
      </head>
      <body>
        <h1>Bill</h1>
        <h2>Customer Details:</h2>
        <p>Name: ${customerName}</p>
        <p>Email: ${customerEmail}</p>
  
        <h2>Items:</h2>
        <table>
          <thead>
            <tr>
              <th>Item Code</th>
              <th>Item Name</th>
              <th>Item Type</th>
              <th>Quantity</th>
              <th>MRP</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
    `;
  
    var table = document.getElementById("itemTable");
    var rows = table.rows;
    var rowCount = rows.length;
  
    for (var i = 1; i < rowCount; i++) {
      var itemCode = rows[i].cells[0].innerHTML;
      var itemName = rows[i].cells[1].innerHTML;
      var itemType = rows[i].cells[2].innerHTML;
      var quantity = rows[i].cells[3].innerHTML;
      var mrp = rows[i].cells[4].innerHTML;
      var discount = rows[i].cells[5].innerHTML;
      var total = rows[i].cells[6].innerHTML;
  
      billHTML += `
        <tr>
          <td>${itemCode}</td>
          <td>${itemName}</td>
          <td>${itemType}</td>
          <td>${quantity}</td>
          <td>${mrp}</td>
          <td>${discount}</td>
          <td>${total}</td>
        </tr>
      `;
    }
  
    var totalPrice = document.getElementById("totalPrice").innerHTML;
    var balance = paidValue - totalPrice;
    var vat = document.getElementById("vat").innerHTML;
  
    billHTML += `
        </tbody>
      </table>
  
      <h2>Total Price: ${totalPrice}</h2>
      <h2>Paid Value: ${paidValue}</h2>
      <h2>Balance: ${balance}</h2>
      <h2>Included VAT: ${vat}</h2>
  
      </body>
      </html>
    `;
  
    var newWindow = window.open();
    newWindow.document.write(billHTML);
    newWindow.document.close();
  }
  