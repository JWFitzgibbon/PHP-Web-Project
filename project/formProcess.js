window.addEventListener('load', function() {
    "use strict";

    const form = document.getElementById("bookingForm");
    let itemTotal = 0;
    let selectedCustomer = 0;

    form.onchange = calculateTotal;
    form.termsChkbx.onclick = termsBoxStatus;
    form.submit.onclick = validateForm;
    form.customerType.onchange = customerDetailDisplay;


    function calculateTotal() {
        itemTotal = 0;
        let total = 0;
        const items = form.querySelectorAll('div.item');
        const itemCount = items.length;

        for (let i = 0; i < itemCount; i++) {
            const itemList = items[i];
            const itemCheckbox = itemList.querySelector('input[data-price][type=checkbox]');
            if (itemCheckbox.checked) {
                 total = total + parseFloat(itemCheckbox.dataset.price);
                 itemTotal = itemTotal + 1;
            }
        }

        const collectionMethod = form.querySelector('input[data-price][type=radio]');
        if (collectionMethod.checked) {
            total = total + parseFloat(collectionMethod.dataset.price);
        }
        form.total.value = total;
    }//calculateTotal



    function termsBoxStatus() {
        const termsText = document.getElementById("termsText");
        const termsBox = document.querySelector('input[name="termsChkbx"][type=checkbox]');

        if (termsBox.checked) {
            termsText.style.color = "black";
            termsText.style.fontWeight = "normal";
            form.submit.disabled = false;
        }
        else {
            termsText.style.color = "red";
            termsText.style.fontWeight = "bold";
            form.submit.disabled = true;
        }
    }//termsBoxStatus()
    
    
    
    function validateForm(evt) {
        let failed = false;
        const forename = document.querySelector('input[name="forename"][type=text]');
        const surname = document.querySelector('input[name="surname"][type=text]');
        const companyName = document.querySelector('input[name="companyName"][type=text]');

        alert("Checking form ... ");
        if (selectedCustomer === 0) {
            alert("Please choose a customer type");
            failed = true;
        }

        else if (selectedCustomer === "ret") {
            if (forename.value.length === 0) {
                alert("No forename");
                failed = true;
            }
            if (surname.value.length === 0) {
                alert("No surname");
                failed = true;
            }
        }

        else if (selectedCustomer === "trd") {
            if (companyName.value.length === 0) {
                alert("No company name");
                failed = true;
            }

        }

        if (itemTotal === 0) {
            alert("No event(s) selected");
            failed = true;
        }

        if (failed === true) {
            evt.preventDefault();
            alert("Something went wrong, please complete all necessary fields");
        }
    }//validateForm



    function customerDetailDisplay() {
        selectedCustomer = form.customerType.value;
        const custBooking = document.getElementById("retCustDetails");
        const tradeBooking = document.getElementById("tradeCustDetails");

        if (selectedCustomer === "ret") {
            custBooking.style.visibility = "visible";
            tradeBooking.style.visibility = "hidden";
        }
        if (selectedCustomer === "trd") {
            custBooking.style.visibility = "hidden";
            tradeBooking.style.visibility = "visible";
        }
    }

});