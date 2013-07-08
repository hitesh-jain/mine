<table border="0" cellspacing="0" cellpadding="0" width="100%"  style="bgcolor:#000000;">
	<tr>
		<td width="270" style="border:none;">
			<table border="1" cellspacing="1" cellpadding="1"  class="custom-user-profile">
				<tr>
					<td class="active" id="change-password-td">
					<a href="javascript:void(0);" onclick="return fnc_ChangeTab(1);">Change Password</a></td>
				</tr>
				<tr>
					<td id="update-profile-td"><a href="javascript:void(0);" onclick="return fnc_ChangeTab(2);">Update Profile</a></td>
				</tr>
				<tr>
					<td id="email-settings-td"><a href="javascript:void(0);" onclick="return fnc_ChangeTab(3);">Email Settings</a></td>
				</tr>
			</table>
		</td>
		<td style="border:none;" valign="top">
			<div id="message"></div>
			<div id="change-password" style="display:block;"> 
			</br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
			<?php
				$form_id = "client_login_form";
				echo drupal_render(drupal_get_form($form_id));
			?>
			</div>
			<div id="update-profile" style="display:none;"> 
				</br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
				<?php
				$form_id = "client_login_update_profile_form";
				echo drupal_render(drupal_get_form($form_id));
				?>
			</div>
			<div id="email-settings" style="display:none;"></br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
				<?php
				$form_id = "client_login_update_email_form";
				echo drupal_render(drupal_get_form($form_id));
				?>
			</div>
		</td>
	</tr>
</table>

<style>
.custom-user-profile{
	bgcolor:#000000;
	background-color: #ffffff;
}
.custom-user-profile tr td{
	height: 100px;
	border: 3px solid #000;
	font-size:14px;
	font-weight:bold;

}

.custom-user-profile tr td.active{
	border-right: !important none;
	/*background-color: red;*/
}

.custom-user-profile tr td.inactive{
	border-right: !important none;
	background-color: pink;
}
/*.table{
	border:none;
}*/
</style>

<script>

function fnc_ChangeTab(nArgValue){
	document.getElementById("message").innerHTML = "";
	if(nArgValue==1){
		document.getElementById("change-password").style.display = "block";
		document.getElementById("change-password-td").className = "active";
		document.getElementById("update-profile").style.display = "none";
		document.getElementById("update-profile-td").className = "";
		document.getElementById("email-settings").style.display = "none";
		document.getElementById("email-settings-td").className = "";
	}else if(nArgValue==2){
		document.getElementById("change-password").style.display = "none";
		document.getElementById("change-password-td").className = "";
		document.getElementById("update-profile").style.display = "block";
		document.getElementById("update-profile-td").className = "active";
		document.getElementById("email-settings").style.display = "none";
		document.getElementById("email-settings-td").className = "";
	}else if(nArgValue==3){
		document.getElementById("change-password").style.display = "none";
		document.getElementById("change-password-td").className = "";
		document.getElementById("update-profile").style.display = "none";
		document.getElementById("update-profile-td").className = "";
		document.getElementById("email-settings").style.display = "block";
		document.getElementById("email-settings-td").className = "active";
	}
}


</script>




		
