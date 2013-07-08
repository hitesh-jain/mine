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