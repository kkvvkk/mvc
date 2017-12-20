<?php include_once('header.php'); ?>
<title>Авторизация</title>

	<div>
		<form class="form-signin" role="form" method="POST" action="<?php echo base_url('index.php/action_controller/autorisation'); ?>">
			<center>
				<h2 class="form-signin-heading">Авторизация</h2>
				<div>
					<h5><?php echo $warning; ?></h5>
				</div>
				<input type="text" class="form-control" placeholder="Email" name="mail">
				<input type="password" class="form-control" placeholder="Пароль" name="password">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Войти</button>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="to_checkin">Зарегистрироваться</button>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="signin_ws">Войти без авторизации</button>
			</center>
		</form>
	</div>

<?php include_once('footer.php'); ?>