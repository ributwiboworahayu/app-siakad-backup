<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>LOGIN FORM SIAKAD</title>
	<script type="text/javascript" src="<?=base_url();?>\assets\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>\assets\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
	<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

	* {
		box-sizing: border-box;
	}

	body {
		background: #f6f5f7;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		font-family: 'Montserrat', sans-serif;
		height: 100vh;
		margin: -20px 0 50px;
	}

	h1 {
		font-weight: bold;
		margin: 0;
	}

	h2 {
		text-align: center;
	}

	p {
		font-size: 14px;
		font-weight: 100;
		line-height: 20px;
		letter-spacing: 0.5px;
		margin: 20px 0 30px;
	}

	span {
		font-size: 12px;
	}

	a {
		color: #333;
		font-size: 14px;
		text-decoration: none;
		margin: 15px 0;
	}

	button {
		border-radius: 20px;
		border: 1px solid #FF4B2B;
		background-color: #FF4B2B;
		color: #FFFFFF;
		font-size: 12px;
		font-weight: bold;
		padding: 12px 45px;
		letter-spacing: 1px;
		text-transform: uppercase;
		transition: transform 80ms ease-in;
	}

	button:active {
		transform: scale(0.95);
	}

	button:focus {
		outline: none;
	}

	button.ghost {
		background-color: transparent;
		border-color: #FFFFFF;
	}

	form {
		background-color: #FFFFFF;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 50px;
		height: 100%;
		text-align: center;
	}

	input {
		background-color: #eee;
		border: none;
		padding: 12px 15px;
		margin: 8px 0;
		width: 100%;
	}

	.container {
		background-color: #fff;
		border-radius: 10px;
		box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
		0 10px 10px rgba(0,0,0,0.22);
		position: relative;
		overflow: hidden;
		width: 768px;
		max-width: 100%;
		min-height: 480px;
	}

	.form-container {
		position: absolute;
		top: 0;
		height: 100%;
		transition: all 0.6s ease-in-out;
	}

	.sign-in-container {
		left: 0;
		width: 50%;
		z-index: 2;
	}

	.container.right-panel-active .sign-in-container {
		transform: translateX(100%);
	}

	.sign-up-container {
		left: 0;
		width: 50%;
		opacity: 0;
		z-index: 1;
	}

	.container.right-panel-active .sign-up-container {
		transform: translateX(100%);
		opacity: 1;
		z-index: 5;
		animation: show 0.6s;
	}

	@keyframes show {
		0%, 49.99% {
			opacity: 0;
			z-index: 1;
		}

		50%, 100% {
			opacity: 1;
			z-index: 5;
		}
	}

	.overlay-container {
		position: absolute;
		top: 0;
		left: 50%;
		width: 50%;
		height: 100%;
		overflow: hidden;
		transition: transform 0.6s ease-in-out;
		z-index: 100;
	}

	.container.right-panel-active .overlay-container{
		transform: translateX(-100%);
	}

	.overlay {
		background: #FF416C;
		background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
		background: linear-gradient(to right, #FF4B2B, #FF416C);
		background-repeat: no-repeat;
		background-size: cover;
		background-position: 0 0;
		color: #FFFFFF;
		position: relative;
		left: -100%;
		height: 100%;
		width: 200%;
		transform: translateX(0);
		transition: transform 0.6s ease-in-out;
	}

	.container.right-panel-active .overlay {
		transform: translateX(50%);
	}

	.overlay-panel {
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 40px;
		text-align: center;
		top: 0;
		height: 100%;
		width: 50%;
		transform: translateX(0);
		transition: transform 0.6s ease-in-out;
	}

	.overlay-left {
		transform: translateX(-20%);
	}

	.container.right-panel-active .overlay-left {
		transform: translateX(0);
	}

	.overlay-right {
		right: 0;
		transform: translateX(0);
	}

	.container.right-panel-active .overlay-right {
		transform: translateX(20%);
	}

	.social-container {
		margin: 20px 0;
	}

	.social-container a {
		border: 1px solid #DDDDDD;
		border-radius: 50%;
		display: inline-flex;
		justify-content: center;
		align-items: center;
		margin: 0 5px;
		height: 40px;
		width: 40px;
	}

	footer {
		background-color: #222;
		color: #fff;
		font-size: 14px;
		bottom: 0;
		position: fixed;
		left: 0;
		right: 0;
		text-align: center;
		z-index: 999;
	}

	footer p {
		margin: 10px 0;
	}

	footer i {
		color: red;
	}

	footer a {
		color: #3c97bf;
		text-decoration: none;
	}
	.alert {
		padding: 20px;
		background-color: #f44336;
		color: white;
		opacity: 1;
		transition: opacity 0.6s;
	}

	.alert.success {background-color: #04AA6D;}
	.alert.info {background-color: #2196F3;}
	.alert.warning {background-color: #ff9800;}

	.closebtn {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}

	.closebtn:hover {
		color: black;
	}

	@media screen and (max-width: 800px) {
		.overlay-container{
			display: none;
		}
		.sign-in-container {
			left: 0;
			width: 100%;
			z-index: 2;
		}
		.container{
			top: 5%;
		}

	}
</style>
</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-in-container">
			<div id="notif"></div>
			<?= form_open(base_url().'login/auth_chek', array('id' =>'form-login'  )); ?>
			<h1>Sign in</h1>

			<span>or use your account</span>
			<input type="email" placeholder="Email" name="email" />
			<input type="password" placeholder="Password" name="password" />
			<!-- <a href="#" id="signUp">Forgot your password?</a> -->
			<button id="log">Sign In</button>
			<?= form_close(); ?>
			
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Lupa Password Anda?</h1>
					<p>Silahakn hubungi pihak admin Atau team ICT Politeknik Kampar</p>
					<!-- <button class="ghost" id="signIn">Sign In</button> -->
				</div>
				<div class="overlay-panel overlay-right">
					<img src="<?=base_url()?>assets/plkm.png" width="60%">
					<h2>POLITEKNIK KAMPAR</h2>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		// const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		// signUpButton.addEventListener('click', () => {
		// 	container.classList.add("right-panel-active");
		// });
		function ajaxcsrf() {
			var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
			var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
			var csrf = {};
			csrf[csrfname] = csrfhash;
			$.ajaxSetup({
				"data": csrf
			});
		}

		$(function() {
			ajaxcsrf();
			$('form#form-login').on('submit', function (e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				// $('#log').text('Ceking Akun').attr('disabled', 'disabled');
				$.ajax({
					url: $(this).attr('action'),
					type: 'POST',
					dataType: 'JSON',
					data: $(this).serialize(),
					success:function(respon) {
						if (respon.response=='200') {
							$('#notif').html('<div class="alert success">'+
								'<span class="closebtn">&times;</span>'+
								'<strong>Success!</strong> Login Berhasil Sedang Redirect.'+
								'</div>');
							setInterval(function(){ window.location.href = "welcome/role"; }, 3000);
						}else if(respon.response==404){
							$('#notif').html('<div class="alert danger">'+
								'<span class="closebtn">&times;</span>'+
								'<strong>GAGAL!</strong> Akun Tidak Temukan .'+
								'</div>');

						}else{
							$('#notif').html('<div class="alert danger">'+
								'<span class="closebtn">&times;</span>'+
								'<strong>GAGAL!</strong> Email dan password Tidak Boleh Kosong.'+
								'</div>');

						}

						setInterval(function(){ $('.alert').css('display', 'none'); }, 5000);
					}
				})

			});
		});
	</script>
</body>
</html>