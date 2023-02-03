<?php
$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SecurePayMessage>
	<MessageInfo>
		<messageID>CHANGEME</messageID>
		<messageTimestamp>CHANGEME</messageTimestamp>
		<timeoutValue>60</timeoutValue>
		<apiVersion>xml-4.2</apiVersion>
	</MessageInfo>
	<MerchantInfo>
		<merchantID>ABC0001</merchantID>
		<password>abc123</password>
	</MerchantInfo>
	<RequestType>Payment</RequestType>
	<Payment>
		<TxnList count="1">
			<Txn ID="1">
				<txnType>0</txnType>
				<txnSource>23</txnSource>
				<amount>CHANGEME</amount>
				<currency>CHANGEME</currency>
				<purchaseOrderNo>CHANGEME</purchaseOrderNo>
				<CreditCardInfo>
					<cardNumber>CHANGEME</cardNumber>
					<cvv>CHANGEME</cvv>
					<expiryDate>CHANGEME</expiryDate>
				</CreditCardInfo>
			</Txn>
		</TxnList>
	</Payment>
</SecurePayMessage>
XML;
?>