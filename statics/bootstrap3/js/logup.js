		function checkName(){
			var username = document.getElementById('username').value;
			var tips     = document.getElementById('name_tips');
			
			if( username.length <= 0 ){
				console.log(tips.innerHTML);
				tips.innerHTML = "请填写用户名哦";
			}			
			else{
				$.post(
					'{:U('Logup/checkUsername')}',
					{
						username : username
					},
					function(data){
						if(data.status){
							tips.innerHTML = "你可以注册这个名字";
						}
						else{
							tips.innerHTML = "这个名字已经被被注册了";
						}
					});
			}
		}

		function checkPass(){
			var password = document.getElementById('password').value;
			var repassword = document.getElementById('repassword').value;			
			var repass_tips = document.getElementById('repass_tips');

			if(password.length <= 0 || repassword.length <= 0 ){
				repass_tips.innerHTML = "两次输入的密码不一样哦";
			}
			else{
				repass_tips.innerHTML = "两次输入的密码都一样";
			}
		}