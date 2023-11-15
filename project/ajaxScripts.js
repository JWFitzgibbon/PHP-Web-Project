window.addEventListener('load', function() {
    "use strict";

    const OFFERS = 'getOffers.php';
    const XMLOFFERS = 'getOffers.php?useXML';

    xmlGenerateOffers();
    generateOffers();
    setInterval(function () { generateOffers() }, 5000);

    function generateOffers() {
        fetch(OFFERS)
            .then(
                function (response) {
                    return response.text();
                })
            .then(
                function (data) {
                    console.log(data);
                    document.getElementById("offers").innerHTML = data;
                })
            .catch(
                function (err) {
                    console.log("There was an error.", err);
                });
    }//generateOffers

    function xmlGenerateOffers() {
        fetch(XMLOFFERS)
            .then(
                function (response) {
                    return response.text();
                })
            .then(
                function (data) {
                    console.log(data);
                    let parser = new DOMParser();
                    let xmlDoc = parser.parseFromString(data, "text/xml");
                    document.getElementById("XMLoffers").innerHTML = xmlDoc.getElementsByTagName("offer")[0].textContent;
                })
            .catch(
                function (err) {
                    console.log("An error has occurred.", err);
                });
    }//xmlGenerateOffers


});

