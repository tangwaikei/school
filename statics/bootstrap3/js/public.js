	function showPwd(){
		var setPwd = document.getElementById('setpwd');
		setpwd.style.display="block";
	}

	function hidePwd(){
		document.getElementById('setpwd').style.display="none";
	}

	function checkPwd(form){
		var pwd = form.pwd.value;
		var rpwd= form.rpwd.value;
		var currentpwd = form.currentpwd.value.length;
		if(currentpwd === 0){
			alert("请填写你当前的密码");
			return (false);
		}
		if(pwd.length === 0 || rpwd.length === 0){
			alert("请填写你的密码");
			return (false);
		}
		if(rpwd !== pwd){
			alert("你输入的两次密码不相同");
			return (false);
		}
		$.post(
			"{:U('Home/User/editPwd')}",
			{
				currentpwd:currentpwd,
				pwd:pwd,
				rpwd:rpwd
			},
			function(data){
				console.log(data);
			});
	}

	function checkInfo(form){
		if(form.username.value.length == 0){
			alert("请填写用户名");
			form.username.focus();
			return (false);
		}

		if(form.password.value.length == 0){
			alert('请填写密码');
			form.password.focus();
			return (false);
		}

		if(form.repasswd.value.length == 0){
			alert('请填写密码');
			form.repasswd.focus();
			return (false);
		}

		if(form.repasswd.value !== form.password.value){
			alert("请填写一样的密码");
			form.repasswd.focus();
			return (false);
		}

		if(form.code.value.length == 0){
			alert('请填写验证码');
			form.code.focus();
			return (false);
		}					
	} 

	function clean_nametip(){
		var nametip = document.getElementById('nametip');
		nametip.innerHTML = "";		
	}
	function clean_pwdtip(){
		var pwdtip = document.getElementById('pwdtip');
		pwdtip.innerHTML  = "";
	}
	function clean_codetip(){
		var codetip= document.getElementById('codetip');
		codetip.innerHTML = "";
	}
		
	
