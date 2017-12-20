<?php include_once('header.php'); ?>
<title>Регистрация</title>

	<div>
		<form class="form-signin" role="form" method="POST" action="<?php echo base_url('index.php/action_controller/checkin'); ?>">
			<center>
				<h2 class="form-signin-heading">Регистрация</h2>
				<div>
					<h5><?php echo $warning; ?></h5>
				</div>
				<input type="text" class="form-control" placeholder="Имя" name="firstname">
				<input type="text" class="form-control" placeholder="Фамилия" name="surname">
				<input type="text" class="form-control" placeholder="Email" name="mail">
				<input type="password" class="form-control" placeholder="Пароль"  name="password">
				<input type="password" class="form-control" placeholder="Подтвердите пароль"  name="password1">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="checkin">Зарегистрироваться</button>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="back">Назад</button>
			</center>
		</form>
	</div>

<?php include_once('footer.php'); ?>