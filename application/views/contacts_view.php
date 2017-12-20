<?php include_once('header.php'); ?>
<title>Пользователи</title>

<div>
	<center>
		<form method="POST" action="<?php echo base_url('index.php/page_controller/to_user'); ?>">
			<?php foreach($contacts as $item):?>
				<p><button type="submit" class="btn btn-link btn-sm" name="open<?php echo $item['user_id'];?>"><?php echo $item['firstname'].' '.$item['surname'];?></button><p>
			<?php endforeach;?>	
		</form>
		<form method="POST" action="<?php echo base_url('index.php/page_controller/back_to_mypage'); ?>">
			<button type="submit" class="btn btn-link btn-sm" name="back_to_mypage">Назад</button>
		</form>
	</center>
</div>

<?php include_once('footer.php'); ?>