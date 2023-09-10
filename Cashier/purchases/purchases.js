function calculateCost() {
    var qty = parseFloat(document.getElementById("quantity").value);
    var unitprice = parseFloat(document.getElementById("unit_price").value);
    var discount = parseFloat(document.getElementById("discount").value);
    var cost = ((qty * unitprice) - ((qty * unitprice) * (discount / 100)));
    document.getElementById("cost").value = cost.toFixed(2);
}