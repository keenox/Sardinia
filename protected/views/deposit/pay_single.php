<?php
function get_deposit_status_by_id($status){
	switch($status){
		case '0': return "AWAITING PAYMENT"; break;
		case '1': return "PAYMENT FAILED. AWAITING PAYMENT."; break;
		case '2': return "PAYMENT RECEIVED";	break;
	}
	return "INVALID DEPOSIT STATUS";
}
function get_html_pay_form($code, $deposit_id, $credits, $amount){
    $amount = '0.01';
    switch($code){
        case 'lr':

            return '<form action="https://sci.libertyreserve.com/en" id="payment_form" method="POST">
<input type="hidden" name="lr_acc" value="U7074533">
<input type="hidden" name="lr_amnt" value="'.$amount.'">
<input type="hidden" name="lr_currency" value="LRUSD">
<input type="hidden" name="lr_comments" value="Deposit of '.$credits.' CREDITS on ABC.com (ID: #'.$deposit_id.')">
<input type="hidden" name="lr_success_url" value="http://localhost/yii/sardinia/index.php/deposit/lr?status=1">
<input type="hidden" name="lr_success_url_method" value="POST">
<input type="hidden" name="lr_fail_url" value="http://localhost/yii/sardinia/index.php/deposit/lr?status=0">
<input type="hidden" name="lr_fail_url_method" value="POST">
<input type="hidden" name="deposit_id" value="'.$deposit_id.'">
<input type="submit" value="PAY NOW" style="font-size:24px;"/>
</form>';

            break;
        case 'wbt':

        return "fuck you i'm not done.";
            break;
    }
}
?>

<?php
$this->breadcrumbs=array(
	'Deposits'=>array('/deposit/pay'),
	'Pay #'.$deposit->id,
);?>
<h1><?php echo "Deposit #".$deposit->id." Summary"; ?></h1>
<?php
    if($flash_message != null){
        if($flash_message==="1"){
            $text = "PAYMENT HAS BEEN RECEIVED.";
            $bg = "#009933";
        } else {
            $text = "PAYMENT FAILED. PLEASE <a href='#' onclick='document.payment_form.submit()'>TRY AGAIN.</a>";
            $bg = "#bb0000";
        }
?>
<p>
<div style="width:80%; background: <?php echo $bg; ?>; padding: 10px; color:#fff;"><b><?php echo $text; ?></b></div>
</p>
<?php
    }
?>
<p>
	<br />
    Credits bought: <?php echo $deposit->credits; ?><br />
    Date: <?php echo $deposit->order_placed; ?> (<?php echo get_deposit_status_by_id(0); ?>)<br />
    Last modified: <?php echo $deposit->order_modified; ?> (<?php echo get_deposit_status_by_id($deposit->status); ?>)<br /><br />
    
    Payment method: <?php echo $payment_method->code; ?><br />
    Payment commission fee: USD $<?php echo $deposit->amount-$deposit->credits; ?> (<?php echo $payment_method->deposit_fee; ?> %)
    <br /><hr />
    TOTAL AMOUNT: <b>USD $<?php echo $deposit->amount; ?></b><br />
    CURRENT STATUS: <b><?php echo get_deposit_status_by_id($deposit->status); ?></b><br />
    
</p>
<?php
if($deposit->status != 2){
	// it means it has not been paid yet
	// show the user how to pay it!
?>
<br /><br />
<h2>Payment Instructions</h2>

<p>
SOME TEXT DIFFERENT FOR EACH PAYMENT METHOD CONTAINING SOME INFO ONLY THE SUPERADMIN CAN CHANGE.<br /><br />
Payment details:
<hr />
BANK OF ITALY<br />
Account: BLA BLA BLA<br />
SWIFT: lakjlasjd<br />
THIS INFO IS LOADED FROM A FILE WHICH ONLY THE SUPERADMIN CAN CHANGE!!!
<hr />
FOR LIBERTY RESERVE THE BUTTON BELOW WILL BE A LINK TO LIBERTYRESERVE.COM.<br />
FOR BANK WIRE TRANSFER THE BUTTON BELOW WILL BE A LINK TO A UPLOAD PAGE.<br />
</p>

<br /><br />
<?php echo get_html_pay_form($payment_method->code, $deposit->id, $deposit->credits, $deposit->amount); ?>

<?php
}
?>