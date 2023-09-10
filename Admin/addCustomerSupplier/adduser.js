select = document.getElementById("usertype");
choice = select.value;

function check(choice) {
    if (choice == "customer") {
        document.getElementById("customer").style.display = "block";
        document.getElementById("supplier").style.display = "none";
        
    }
    else if (choice == "supplier") {
        document.getElementById("supplier").style.display = "block";
        document.getElementById("customer").style.display = "none";
    }
}

