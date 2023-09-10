function calculateNetValue() {
    var unitPrice = parseFloat(document.getElementById("unitprice").value);
    var discount = parseFloat(document.getElementById("discount").value);

    var netValue = unitPrice - (unitPrice * (discount / 100));

    document.getElementById("netvalue").value = netValue.toFixed(2);
  }