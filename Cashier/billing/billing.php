<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="billing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Billing</title>
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
            <a href="../cashier.php">Cashier Panel</a>
            <a href="billing.php">Billing</a>
            <a href="../Stock/stock.html">Stock</a>
            <a href="../purchases/purchases.php">Purchases</a>
            <a href="../quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <div class="bc">
            <h2>Billing</h2>

            <button><a href="registeredBilling.php">For Registered Customers</a></button><br>

            <div>
                <input type="text" placeholder="Search Type" name="search" id="givenType">
                <button onclick="submitType()" type="button"><i class="fa fa-search"></i></button>
            </div>

            <div class="form-section">

                <form action="stockchange.php" id="itemForm" method="POST" onsubmit="submitForm(event)">

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
                        <input type="text" id="customerName" name="customerName"><br><br>

                        <label for="customertype">Customer Mobile:</label>
                        <input type="text" id="customerMob" name="customerMob"><br><br>

                    </div>

                    <div class="item-details">
                        <label for="itemCode">Item Code:</label>
                        <select id="itemCode" name="itemCode" required onchange="loadItemData()">

                        </select>
                        <br><br>

                        <label for="itemName">Item Name:</label>
                        <input type="text" id="itemName" name="itemName" required><br><br>

                        <label for="itemtype">Item Type:</label>
                        <input type="text" id="itemtype" name="itemtype" required><br><br>

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" required pattern="[0-9]" min="0"><br><br>

                        <input type="number" id="actualquantity" name="actualquantity" required pattern="[0-9]" hidden>

                        <label for="mrp">MRP(Unit Price):</label>
                        <input type="number" id="mrp" name="mrp" required pattern="[0-9]" min="0"><br><br>

                        <label for="discount">Discount:</label>
                        <input type="number" id="discount" name="discount" required min="0"><br><br>
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
                </tr>
            </table>

            <div id="totalSection">
                <h3>Total Price: Rs.<span id="totalPrice">0</span></h3>

                <label for="paidValue">Paid Value:</label>
                <input type="number" id="paidValue" name="paidValue" pattern="[0-9]" required><br><br>



                <h4>Included VAT: Rs.<span id="vat">0</span></h4>
                <button type="button" onclick="generateBill()">Generate Bill</button>

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
                        document.getElementById("actualquantity").value = itemData?.quantity;
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
            document.getElementById("actualquantity").value = "";
        }
    }

    function loadCustomerData() {
        var customernic = document.getElementById("customernic").value;
        if (customernic !== "") {
            console.log(customernic);
            $.ajax({
                url: 'getCustomer.php',
                type: 'POST',
                data: {
                    customernic: customernic
                },
                success: function(response) {
                    var responseObject = JSON.parse(response);
                    if (responseObject.success) {
                        var customerData = responseObject.data;
                        console.log(customerData);

                        document.getElementById("customercode").value = customerData.customer_code;
                        document.getElementById("customername").value = customerData.customer_name;
                        document.getElementById("customertype").value = customerData.vat_or_non_vat;
                    } else {
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        } else {
            // Clear the customer data fields if no customer NIC is selected
            document.getElementById("customercode").value = "";
            document.getElementById("customername").value = "";
            document.getElementById("customertype").value = "";
        }
    }

    function submitForm(event) {
        event.preventDefault();
        // if actual quantity is less than the quantity entered
        var actualquantity = parseInt(document.getElementById("actualquantity").value);
        var quantity = parseInt(document.getElementById("quantity").value);

        if (actualquantity < quantity) {
            alert("Quantity entered is greater than the actual quantity");
            return;
        }

        $.ajax({
            url: 'stockchange.php',
            type: 'POST',
            data: $('#itemForm').serialize(),
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


        var data = {}

        var customerName = document.getElementById("customerName").value;
        var customerMob = document.getElementById("customerMob").value;

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
            var paidValue = parseFloat(document.getElementById("paidValue").value);
            // var totalValue = document.getElementById("totalPrice").value;
            // var vats = document.getElementById("vat").value;
            var tp = document.getElementById("totalPrice").innerHTML;
            var v = document.getElementById("vat").innerHTML;

            data.totalPrice = tp
            data.vat = v
            $.ajax({
                type: 'POST',
                url: 'addBill.php',
                data: data,
                success: function(response) {
                    alert("Saved Successfully!")
                }
            });

            // var xhttp = new XMLHttpRequest();
            // var phpFile = "addBill.php";
            // xhttp.onreadystatechange = function () {
            //     if (this.readyState === 4 && this.status === 200) {
            //         // This is the callback function when the server responds
            //         console.log("Response from server: " + this.responseText);
            //     }
            // };

            // xhttp.open("POST", phpFile, true);
            // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // xhttp.send("totalValue=" + encodeURIComponent(totalValue));
            // xhttp.send("vat=" + encodeURIComponent(vat));

            var billHTML = `
      <html>
      <head>
        <title>Bill</title>
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

.Header>img {
    margin-top: 25px;
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

        </style>
      </head>
      <body>

      <div class="Header">
            <center><img src="../../images/logo.png" style="height:140px; width:140px;"/></center>
            <h1>Ananda Paints Center</h1>
            <h4>No 470/A/2, Piliyandala Road, Arewwala, Pannipitiya</h4>
            <h4>Tel: +94777327133, +94750327133, +94758327133</h4>
        </div>

        <div class="details">
            <h2>Customer Details:</h2>
            <p>Name: ${customername}</p>
            <p>Mobile No: ${customermob}</p>
        </div>
  
        <h2 style="text-align:center">Items:</h2>
        
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
            var balance = paidValue - totalPrice;
            var vat = document.getElementById("vat").innerHTML;

            billHTML += `
        </tbody>
      </table>
  
      <div class="totalSection">
        <p>Total Price: Rs. ${totalPrice}</p>
        <p>Paid Value: Rs. ${paidValue}</p>
        <p>Balance: Rs. ${balance}</p>
        <p>Included VAT: Rs. ${vat}</p>
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







    /*=======================================================================================/*

    /*Below Field Added by Pulasthi Tharaka*/
    function submitType() {
        var type = document.getElementById("givenType").value;
        $.ajax({
            url: 'getType.php',
            type: 'POST',
            data: {
                type: type
            },
            success: function(response) {

                var responseObject = JSON.parse(response); // Convert JSON string to object
                if (responseObject.success) {
                    var itemData = responseObject.data;
                    var tr_str = "<option value =''>" + "Select Item Code" + "</option>";
                    $('#itemCode').append(tr_str);
                    $('#itemCode').empty();
                    for (var z = 0; z < itemData.length; z++) {
                        tr_str += "<option value =" + itemData[z].item_code + ">" + itemData[z].item_code +
                            "</option>";
                    }
                    $('#itemCode').append(tr_str);
                } else {
                    var tr_str = "<option value =''>" + "Type Not Found" + "</option>";
                    $('#itemCode').empty();
                    $('#itemCode').append(tr_str);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Type Not Found"
                    })
                }

            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>