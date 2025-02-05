$(document).ready(function() {

    document.getElementById("check_tn").addEventListener('click', function (){

        let tracking_number = document.getElementById("tracking_number").value;
        let messageElement = document.getElementById('message');
        let shipmentElement = document.getElementById("shipment-details");
        let type = "check";
        
        if(tracking_number.length !== 8 || tracking_number === ""){
            shipmentElement.innerHTML = "";
            messageElement.innerText = "Tracking number is not in a valid format.";
            messageElement.style.color = "red";
            return false;
        }

        $.ajax({
            url: "app/Handlers/ShipmentHandler.php",
            type: "POST",
            contentType: "application/json",
            dataType: 'json',
            data: JSON.stringify({ 
                tracking_number: tracking_number,
                type: type
            }),
            success: function (data) {
                if(data.response.status === "error"){
                    messageElement.style.color = "red";
                    messageElement.innerText = data.response.message;
                }else{
                    messageElement.innerText = "";
                }
                displayShipmentDetails(data.response);
                console.log(data.response);
            },
            error: function(jqXHR, textStatus) {
                console.error("Status Text: " + textStatus);
            }
        });
    });
});

function displayShipmentDetails(shipment) {
    console.log(shipment);
    if (shipment['status'] !== 'error') {
        const shipmentDetailsHTML = `
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipment Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Tracking Number</th>
                                <td>${shipment['Tracking Number']}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>${shipment['Status']}</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>${shipment['Size']}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>${shipment['Created At']}</td>
                            </tr>
                            <tr>
                                <th>Location From</th>
                                <td>${shipment['Location From']}</td>
                            </tr>
                            <tr>
                                <th>Location To</th>
                                <td>${shipment['Location To']}</td>
                            </tr>
                            <tr>
                                <th>Delivery Info</th>
                                <td>${shipment['Delivery Info']}</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>${shipment['Note']}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        `;
        document.getElementById("shipment-details").innerHTML = shipmentDetailsHTML;
    } else {
        document.getElementById("shipment-details").innerHTML = "";
    }
}


