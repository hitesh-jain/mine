 <?php
    if(isset($_SESSION['quick_quote'])){
    
    $values=$_SESSION['quick_quote'];
    $planid=$values['planId']; 
    //dpr($values); 
    $arg = arg();
    $application_no= $arg[2];
    //dpr($arg);
}
?>
    <div>
        <span> Enter all possible payment details to make payment(latter it ll be a billdesk payment details form.)</span>
        <div>
            <ul>
                <li>Application No:<?php echo $application_no?></li>
                <li>Quote No:<?php echo $values['quote_no'];?></li>
                <li>Transaction Amount: Rs. <?php echo number_format($values['finalPremium'][$planid]); ?></li>
            </ul>
        </div>
        <a style="float:right;" href="/payment/confirm/<?php echo $application_no.'/'.$values['finalPremium'][$planid]?>" >Pay Now</a>
    </div>