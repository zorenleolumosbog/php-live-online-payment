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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script id="securepay-ui-js" src="https://payments-stest.npe.auspost.zone/v3/ui/client/securepay-ui.min.js"></script>
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
    <form onsubmit="return false;">
      <div id="securepay-ui-container"></div>
      <button onclick="mySecurePayUI.tokenise();">Submit</button>
      <button onclick="mySecurePayUI.reset();">Reset</button>
    </form>
    <script type="text/javascript">
      var mySecurePayUI = new securePayUI.init({
        containerId: 'securepay-ui-container',
        scriptId: 'securepay-ui-js',
        clientId: '0oaxb9i8P9vQdXTsn3l5',
        merchantCode: '5AR0055',
        card: {
            allowedCardTypes: ['visa', 'mastercard', 'amex'],
            showCardIcons: true,
            onCardTypeChange: function(cardType) {
              // card type has changed
            },
            onBINChange: function(cardBIN) {
              // card BIN has changed
            },
            onFormValidityChange: function(valid) {
              // form validity has changed
            },
            onTokeniseSuccess: function(tokenisedCard) {
                console.log(tokenisedCard);
                // axios({
                //     method: 'get',
                //     url: 'https://payments-stest.npe.auspost.zone/v2/payments',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'Authorization': `Bearer ${tokenisedCar.token}` 
                //     },
                //     data: { 
                //         "amount": 10000, 
                //         "merchantCode": "5AR0055", 
                //         "token": "de305d54-75b4-431b-adb2-eb6b9e546014", 
                //         "ip": "127.0.0.1", 
                //         "orderId": "0475f32d-fc23-4c02-b19b-9fe4b0a848ac"
                //     }
                // })
                // .then(function (response) {
                //     console.log(response.data);
                // });
            },
            onTokeniseError: function(errors) {
              // tokenization failed
            }
        },
        style: {
          backgroundColor: 'rgba(135, 206, 250, 0.1)',
          label: {
            font: {
                family: 'Arial, Helvetica, sans-serif',
                size: '1.1rem',
                color: 'darkblue'
            }
          },
          input: {
           font: {
               family: 'Arial, Helvetica, sans-serif',
               size: '1.1rem',
               color: 'darkblue'
           }
         }  
        },
        onLoadComplete: function () {
          // the UI Component has successfully loaded and is ready to be interacted with
        }
      });
    </script>
  </body>
</html>
