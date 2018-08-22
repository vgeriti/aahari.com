<?php require_once('fb-Auth/config.php');?>

<div id="modal" class="popupContainer" style="display:none;">
		<div class="popupHeader">
			<span class="header_title">Login</span>
			<span class="modal_close"><i class="fa fa-times"></i></span>
		</div>
		
		<div class="popupBody">
			<!-- Social Login -->
			<div class="social_login">
				<div class="">
					<a href="<?php echo $loginUrl?>" class="social_box fb">
						<span class="icon"><i class="fa fa-facebook"></i></span>
						<span class="icon_title">Connect with Facebook</span>
						
					</a>				
				</div>

				<div class="centeredText">
					<span>Or use your Email address</span>
				</div>

				<div class="action_btns">
					<div class="one_half"><button href="#" id="login_form" class="btn">Login</button></div>
					<div class="one_half last"><button href="#" id="register_form" class="btn">Sign up</button></div>
				</div>
			</div>

			<!-- Username & Password Login form -->
			<div class="user_login">
				<form name="aha_login" id="aha_login" method = "POST">
					<span id="lgn_message"></span>
					<label>Email / Username</label>
					<input type="text" id="uname" name="uname" placeholder="Email" required = "required"/>
					<br />

					<label>Password</label>
					<input type="password" id="upass" name="upass" placeholder = "Password" required = "required"/>
					<br />

					<div class="checkbox">
						<input id="remember" name="remember" type="checkbox" />
						<label for="remember">Remember me on this computer</label>
					</div>

					<div class="action_btns">
						<div class="one_half"><button href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</button></div>
						<div class="one_half last"><input type="submit" id="lgn_submit" class="btn btn_red" value="Login"/></div>
					</div>
				</form>

				<a href="#" class="forgot_password">Forgot password?</a>
			</div>

			<!-- Register Form -->
			<div class="user_register">
				<form id="aha_signup" name="aha_signup" method="post">
				<span id="reg_message"></span>
					<label>Full Name</label>
					<input type="text" name="reg_name" id="reg_name" required="required"/>
					<br />

					<label>Email Address</label>
					<input type="email" name="reg_email" id="reg_email" required="required"/>
					<br />

					<label>Password</label>
					<input type="password" name="reg_paswd" id="reg_paswd" required="required"/>
					<br />

					<div class="checkbox">
						<input id="send_updates" type="checkbox" name="send_updates" />
						<label for="send_updates">Send me occasional email updates</label>
					</div>

					<div class="action_btns">
						<div class="one_half"><button class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</button></div>
						<div class="one_half last"><input type="submit" class="btn btn_red" name="register" value="SignUp"/></div>
					</div><!-- <button id="reg_submit" class="btn btn_red">Register</button> -->
				</form>
			</div>
		</div>
	</div>