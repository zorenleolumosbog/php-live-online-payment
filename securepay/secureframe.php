<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
font-family: Arial;
font-size: 17px;
padding: 8px;
}

* {
box-sizing: border-box;
}

.row {
display: -ms-flexbox; /* IE10 */
display: flex;
-ms-flex-wrap: wrap; /* IE10 */
flex-wrap: wrap;
margin: 0 -16px;
}

.col-25 {
-ms-flex: 25%; /* IE10 */
flex: 25%;
}

.col-50 {
-ms-flex: 50%; /* IE10 */
flex: 50%;
}

.col-75 {
-ms-flex: 75%; /* IE10 */
flex: 75%;
}

.col-25,
.col-50,
.col-75 {
padding: 0 16px;
}

.container {
background-color: #f2f2f2;
padding: 5px 20px 15px 20px;
border: 1px solid lightgrey;
border-radius: 3px;
}

input[type=text], input[type=number] {
width: 100%;
margin-bottom: 20px;
padding: 12px;
border: 1px solid #ccc;
border-radius: 3px;
}

select{
    width: 100%;
margin-bottom: 20px;
padding: 12px;
border: 1px solid #ccc;
border-radius: 3px;
}

label {
margin-bottom: 10px;
display: block;
}

.icon-container {
margin-bottom: 20px;
padding: 7px 0;
font-size: 24px;
}

.btn {
background-color: #04AA6D;
color: white;
padding: 12px;
margin: 10px 0;
border: none;
width: 100%;
border-radius: 3px;
cursor: pointer;
font-size: 17px;
}

.btn:hover {
background-color: #45a049;
}

a {
color: #2196F3;
}

hr {
border: 1px solid lightgrey;
}

span.price {
float: right;
color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
.row {
flex-direction: column-reverse;
}
.col-25 {
margin-bottom: 20px;
}
}
body{
    background: black;
}
h2{
    color: #ffffff;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body>
<?php 
include '../dbconnection_local.php';
global $db_conn;
$order_id=$_REQUEST['id'];
//user info
$sql = "SELECT * FROM clients WHERE order_id = ?";
$stmt = $db_conn->prepare($sql);
$stmt->execute([$order_id]);

if($stmt->rowCount()){
    $row = $stmt->fetch();
    // var_dump($row);

    $client_name = $row['client_name'];
    $order_id = $row['order_id'];
    $currency = $row['currency'];
    $amount = $row['amount'];
}
else{
    echo 'Invalid ID. Please contact admin'; 
    die();
}
?>
<center>
<img src="https://ges-dev1.remotestaff.com/assets/rs-logo-white.7f1bb1fc.png" alt="Remotestaff" loading="lazy" style="height: 70px;">
<h2>Remote Staff Payment Form</h2>

</center>
<!-- <p>Welcome, Client</p> -->
<div class="row">
<div class="col-75">
<div class="container">
    <form action="https://test.payment.securepay.com.au/secureframe/invoice" method="post">
    
    <div class="row">
        <div class="col-50">
        <h3>Invoice Information</h3>
            <label for="staticEmail" class="col-sm-2 col-form-label">Client Name</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $client_name; ?>">
            </div>

            <label for="staticEmail" class="col-sm-2 col-form-label">Invoice ID</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext doc_id" id="staticEmail" value="<?php echo $order_id; ?>">
            </div>

            <label for="staticEmail" class="col-sm-2 col-form-label">Amount</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $currency . ' ' . $amount; ?>">
            </div>
        </div>

        <div class="col-50">
        <h3>Payment</h3>
        <label for="fname">Card Type</label>
        <!-- <div class="icon-container">
            <i class="fa fa-cc-visa" style="color:navy;"></i>
            <i class="fa fa-cc-amex" style="color:blue;"></i>
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
            <i class="fa fa-cc-discover" style="color:orange;"></i>
        </div> -->
        <!-- <select name="EPS_CARDTYPE">
            <option value="2">Amex</option>
            <option value="6">Visa</option>
            <option value="5">Mastercard</option>
        </select> -->
        <input type="hidden" name="bill_name" value="transact">
        <input type="hidden" name="merchant_id" value="ABC0001">
        <input type="hidden" name="primary_ref" value="<?php echo $order_id; ?>">
        <input type="hidden" name="txn_type" value="0">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
        <input type="hidden" name="fp_timestamp" value="<?php echo date('YmdHis'); ?>">
        <input type="hidden" name="fingerprint"
        value="33de8f9454a62513838ce534309c76ff8ac2c925bfda0364663d836254497899">
        <input type="hidden" name="currency" value="<?php echo $currency; ?>">
        <input type="hidden" name="display_cardholder_name" value="<?php echo $client_name; ?>">
        <input type="hidden" name="return_url" value="https://www.remotestaff.com.au/payment/thank-you.php">
        <!-- <input
            type="hidden"
            class="EPS_RESULTURL"
            name="EPS_RESULTURL"
            value="https://www.remotestaff.com.au/payment/thank-you.php"
        />

        <label for="cname">Name on Card</label>
        <input type="text" id="cname" name="cardname" placeholder="John Doe">
        <label for="ccnum">Credit card number</label>
        <input type="text" id="ccnum" name="EPS_CARDNUMBER" placeholder="1111-2222-3333-4444">
        <label for="expmonth">Exp Month</label>
        <input type="number" id="expmonth" name="EPS_EXPIRYMONTH" placeholder="01">
        <div class="row">
            <div class="col-50">
            <label for="expyear">Exp Year</label>
            <input type="number" id="expyear" name="EPS_EXPIRYYEAR" placeholder="2022"> 
            </div>
            <div class="col-50">
            <label for="cvv">CVV</label>
            <input type="number" id="cvv" name="EPS_CCV" placeholder="123">
            </div>
        </div> -->
        </div>
        
    </div>
    <label>
        <!-- <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing -->
    </label>
    <input type="submit" value="PAY NOW" class="btn">
    </form>
    <center>
     <p class="foot-info" id="foot-info">© 2022 Copyright | All rights reserved.</p>
    </center>
</div>
</div>
</div>
<?php 

?>
<script>
    $(document).ready(function () {
        console.log("SecurePay");
        let amt= $('#EPS_AMOUNT').val();
        let doc_id = $('.doc_id').val();
        $("#EPS_REFERENCEID").val(doc_id);
    });
</script>
</body>
</html>
