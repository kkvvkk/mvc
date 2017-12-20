<?php include_once('header.php'); ?>
<title>Пользователи</title>

<div>
	<center>
		<div>
			<h4>Вы зашли без авторизации</h4>
			<p><h4>Ограничена возможность комментирования</h4></p>
		</div>
		<form method="POST" action="<?php echo base_url('index.php/page_controller/to_user'); ?>">
			<?php foreach($contacts as $item):?>
				<p><button type="submit" class="btn btn-link btn-sm" name="open<?php echo $item['user_id'];?>"><?php echo $item['firstname'].' '.$item['surname'];?></button><p>
			<?php endforeach;?>	
		</form>
	</center>
	<form method="POST" action="<?php echo base_url('index.php/page_controller/signout'); ?>">
		<center>
			<button type="submit" class="btn btn-link btn-sm" name="signout">Выйти</button>
		</center>
	</form>	
</div>

<?php include_once('footer.php'); ?>