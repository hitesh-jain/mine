<?php global $base_url;?>
<div class="thankyoupay">
      <div class="toptitle">
        <div class="lefttitle">
          <h2>Sorry <?php print ucfirst($user->data['first_name']);?> !</h2>
          <h1>Your transaction has failed, Please try again.</h1>
        </div>
    </div>
    <div class="footerproceedlink">
          <div class="proceedleftlink">
            <ul>
              <li class="last"><a href="<?php echo $base_url.'/application/'.$app_id.'/confirmation'; ?>">< Back</a></li>
            </ul>
          </div>
    </div>
</div>