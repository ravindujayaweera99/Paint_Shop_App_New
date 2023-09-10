<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="billing.css">
    <title>Quotation</title>
</head>

<body>
    <?php

    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    $connection = mysqli_connect($host, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }

    ?>

    <div class="header">
        <h3>Ananda Paint Center</h3>
    </div>

    <div class="hc">
        <nav>
            <a href="../admin.php">Admin Panel</a>
            <a href="../userRegistration/userReg.php">Add System User</a>
            <a href="../addCustomerSupplier/addCustomerSupplier.php">Customer and Supplier Registration</a>
            <a href="../addCustomerSupplier/viewcustomers.php">Registered Customers</a>
            <a href="../addCustomerSupplier/viewsuppliers.php">Registered Suppliers</a>
            <a href="../confirmStock/confirmstock.php">Confirm Products</a>
            <a href="../Stock/stock.php">Stock</a>
            <a href="">Reports</a>
            <a href="../purchases/purchases.php">Purchased Items</a>
            <a href="../expenses/expensesMain.php">Expenses</a>
            <a href="quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

                <div class="bc">
            <h2>Quotation</h2>

            <div class="form-section">

                <form id="itemForm" method="POST" onsubmit="submitForm(event)">

                    <div class="customer-details" id="customer-details">

                        <!-- <label for="customernic">Customer NIC:</label>
                        <br>
                        <select id="customernic" name="customernic" required onchange="loadCustomerData()">
                            <option value="">Select a Customer</option>
                            
                        </select>
                        <br><br>
                        <label for="customercode">Customer Code:</label>
                        <input type="text" id="customercode" name="customercode"><br><br> -->

                        <label for="customername">Customer Name :</label>
                        <input type="text" id="customerName" name="customerName">

                        <label for="customertype">Customer Mobile:</label>
                        <input type="text" id="customerMob" name="customerMob">

                        <label for="customeraddress">Customer Address:</label>
                        <input type="text" id="customeraddress" name="customeraddress">

                    </div>

                    <div class="item-details">
                        <label for="itemCode">Item Code:</label>
                        <select id="itemCode" name="itemCode" required onchange="loadItemData()">
                            <option value="">Select an item</option>
                            <?php
                            $query = "SELECT item_code FROM stock";
                            $result = mysqli_query($connection, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['item_code'] . "'>" . $row['item_code'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No items found</option>";
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="itemName">Item Name:</label>
                        <input type="text" id="itemName" name="itemName" required><br><br>

                        <label for="itemtype">Item Type:</label>
                        <input type="text" id="itemtype" name="itemtype" required><br><br>

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" required pattern="[0-9]"><br><br>

                        <label for="mrp">MRP(Unit Price):</label>
                        <input type="number" id="mrp" name="mrp" required pattern="[0-9]"><br><br>

                        <label for="discount">Discount:</label>
                        <input type="number" id="discount" name="discount"><br><br>
                    </div>

                    <button id="add-item" type="submit">Add Item</button>
                </form>
            </div>

            <table id="itemTable">
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Item Type</th>
                    <th>Quantity</th>
                    <th>MRP</th>
                    <th>Discount</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </table>
            <div id="editModal" class="modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);  width:400px">
                <div id="editForm" style="display: flex; flex-direction: column; align-items: flex-start;">

                    <label for="editQuantity">Quantity:</label>
                    <input type="text" id="editQuantity"><br>
                    <label for="editDiscount">Discount:</label>
                    <input type="text" id="editDiscount"><br>
                    <!-- <button type="button" id="saveEditButton">Save</button> -->
                    <button type="button" id="saveEditButton" style="background-color: #4CAF50; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px; cursor: pointer;">Save</button>


                </div>
            </div>



            <div id="totalSection">
                <h3>Total Price: Rs.<span id="totalPrice">0</span></h3>

                <button type="button" onclick="generateBill()">Generate Quotation</button>

            </div>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadItemData() {
            var itemCode = document.getElementById("itemCode").value;
            if (itemCode !== "") {
                console.log(itemCode);
                $.ajax({
                    url: 'getItem.php',
                    type: 'POST',
                    data: {
                        itemCode: itemCode
                    },
                    success: function(response) {
                        var responseObject = JSON.parse(response);
                        if (responseObject.success) {
                            var itemData = responseObject.data;
                            console.log(itemData);

                            document.getElementById("itemName").value = itemData?.item_name;
                            document.getElementById("itemtype").value = itemData?.item_type;
                            document.getElementById("mrp").value = itemData?.unit_price;
                        } else {
                            console.log(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            } else {
                // Clear the item data fields if no item is selected
                document.getElementById("itemName").value = "";
                document.getElementById("itemtype").value = "";
                document.getElementById("mrp").value = "";
            }
        }

        function submitForm(event) {
            event.preventDefault();
            $.ajax({
                // url: 'stockchange.php',
                // type: 'POST',
                // data: $('#itemForm').serialize(),
                success: function(response) {
                    addItem()
                },
                error: function(xhr, status, error) {
                    alert(error)
                }
            });
        }

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

            var cell7 = row.insertCell(7);
            // cell7.innerHTML = "delete"

            var deleteButton = document.createElement("button");
            deleteButton.innerHTML = "Delete";
            deleteButton.style.backgroundColor = "#FF5733";
            deleteButton.style.color = "#FFFFFF";
            deleteButton.style.border = "none";
            deleteButton.style.padding = "5px 10px";
            deleteButton.style.cursor = "pointer";
            deleteButton.onclick = function() {
                deleteRow(row);
            };
            cell7.appendChild(deleteButton);

            var cell8 = row.insertCell(8);
            // cell8.innerHTML = "edit";

            var editButton = document.createElement("button");
            editButton.innerHTML = "Edit";
            editButton.style.backgroundColor = "#337AB7";
            editButton.style.color = "#FFFFFF";
            editButton.style.border = "none";
            editButton.style.padding = "5px 10px";
            editButton.style.cursor = "pointer";
            editButton.onclick = function() {
                editRow(row);
            };
            cell8.appendChild(editButton);

            document.getElementById("totalPrice").innerHTML = totalPrice.toFixed(2);

            vat = totalPrice * 0.15;

            document.getElementById("vat").innerHTML = vat.toFixed(2);

            clearForm();

        }

        function deleteRow(row) {
            var rowIndex = row.rowIndex;
            var table = document.getElementById("itemTable");
            table.deleteRow(rowIndex);
        }

        function editRow(row) {
            var table = document.getElementById("itemTable");
            var rowIndex = row.rowIndex;
            var cells = row.cells;
            var mrp = cells[4].innerHTML

            var editModal = document.getElementById("editModal");
            editModal.style.display = "block";

            var editForm = document.getElementById("editForm");

            var saveEditButton = document.getElementById("saveEditButton");
            saveEditButton.onclick = function() {

                var newQuantity = document.getElementById("editQuantity").value
                var newDiscount = document.getElementById("editDiscount").value

                var itemTotal = ((mrp - (mrp * (newDiscount / 100))) * newQuantity);
                totalPrice += itemTotal;

                var editedData = [
                    newQuantity,
                    newDiscount,
                    itemTotal
                ];

                cells[3].innerHTML = editedData[0];
                cells[5].innerHTML = editedData[1];
                cells[6].innerHTML = editedData[2];
                // updateRow(row, editedData);

                editModal.style.display = "none";
            };


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
            var customerMob = document.getElementById("customerMob").value;
            var customerAdd = document.getElementById("customeraddress").value;

            if (customerMob == "" && customerName == "") {
                alert("Enter Customer Details!");
            } else {
                var telephoneRegex = /^\d{10}$|^0\d{9}$/;

                if (!telephoneRegex.test(customerMob)) {
                    alert("Invalid Telephone Number. Please enter a valid Sri Lankan telephone number.");
                    return false;
                }
                var customername = document.getElementById("customerName").value;
                var customermob = document.getElementById("customerMob").value;
                var totalValue = document.getElementById("totalPrice").value;

                var billHTML = `
      <html>
      <head>
        <title>Quotation</title>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
font-family: 'Poppins', sans-serif;
padding: 0%;
margin: 0%;
}

.Header>h1,
.Header>h4 {
    text-align: center;
    color: #F3DE8A;
}

.Header {
    width: 100%;
    padding-top: 15px;
    padding-bottom: 15px;
    border-bottom: 2px solid #272838;
    background-color: #272838;
}

 .footer {
    width: 100%;
    height: 50px;
    padding-top: 15px;
    padding-bottom: 15px;
    border-top: 2px solid #272838;
    background-color: #272838;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.footer>p {
    font-size: 20px;
    color: #F3DE8A;
}

table {
    margin: auto;
}

th,
td {
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    text-align: center;
}

.totalSection {
    display:flex;
    flex-direction:column;
    justify-content: center;
    align-items: center;
    padding-top: 35px;
    padding-bottom: 25px;
    text-align: left;
}

.totalSection>p {
    font-weight: 500;
}

.details {
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items : center;
    text-align:left;
    margin-top: 25px;
    margin-bottom: 25px;
}
        </style>
      </head>
      <body>

      <div class="Header">
            <center><img src="../../images/logo.png" style="height:140px; width:140px;"/></center>
            <h1>Ananda Paints Center</h1>
            <h4>No 470/A/2, Piliyandala Road, Arewwala, Pannipitiya</h4>
            <h4>Tel: +94777327133, +94750327133, +94758327133</h4>
        </div>

        <h1 style="text-align:center;">Quotation</h1>
        
        <div class="details">
            <h2>Customer Details:</h2>
            <p>Name: ${customername}</p>
            <p>Mobile No: ${customermob}</p>
            <p>Address: ${customerAdd}</p>
        </div>
  
        <h2 style="text-align:center;">Items:</h2>
        <table>
          <thead>
            <tr>
              <th>Item Code</th>
              <th>Item Name</th>
              <th>Item Type</th>
              <th>Quantity</th>
              <th>MRP</th>
              <th>Discount</th>
              <th>Total (Rs.)</th>
              <th>Actions</th>
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

                var totalPrice = parseFloat(document.getElementById("totalPrice").innerHTML);

                billHTML += `
        </tbody>
      </table>
  
      <div class="totalSection">
            <p>Total Price: Rs. ${totalPrice}</p>
      </div>
            
      <div class="footer">
            <p>Thank You for Shopping With us!</p>
        </div>

      </body>
      </html>
    `;

                var newWindow = window.open();
                newWindow.document.write(billHTML);
                newWindow.document.close();
                newWindow.print();
            }



            // // SQL query to insert data into the database
            // var sqlQuery = `INSERT INTO bill (customer_name, total_value, included_vat)
            //       VALUES ('${customername}', ${totalValue}, ${vat})`;

            // // Example Node.js and MySQL code to execute the SQL query
            // var mysql = require('mysql');
            // var connection = mysql.createConnection({
            //     host: 'localhost',
            //     user: 'root',
            //     password: '',
            //     database: 'paintshopdb'
            // });

            // connection.connect(function (err) {
            //     if (err) {
            //         console.error('Error connecting to the database: ' + err.stack);
            //         return;
            //     }

            //     console.log('Connected to the database.');

            //     // Execute the SQL query
            //     connection.query(sqlQuery, function (error, results, fields) {
            //         if (error) {
            //             console.error('Error executing the SQL query: ' + error.stack);
            //             return;
            //         }

            //         console.log('Data inserted successfully.');

            //         // Continue with the rest of your code...

            //         connection.end(); // Close the database connection
            //     });
            // });

        }

        select = document.getElementById("user");
        choice = select.value;

        function check(choice) {
            if (choice == "walkin") {
                document.getElementById("walk-in").style.display = "block";
                document.getElementById("customer-details").style.display = "none";

            } else if (choice == "registered") {
                document.getElementById("walk-in").style.display = "none";
                document.getElementById("customer-details").style.display = "block";
            }
        }



        // function calcBalance() {
        //     paidValue = parseFloat(document.getElementById("paidValue").value);
        //     totalPrice = parseFloat(document.getElementById("totalPrice").value);

        //     var balance = paidValue - totalPrice;

        //     document.getElementById("balance").value = balance.toFixed(2);
        // }
    </script>
</body>

</html>