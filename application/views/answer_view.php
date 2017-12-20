<?php include_once('header.php'); ?>
<title>Написать ответ</title>

<div>
	<form class="form-signin" role="form" method="POST" action="<?php echo base_url('index.php/page_controller/action_comment');?>">
	<h5>Написать ответ на:</h5>
		<div class="well">
			<div>
				<p><h5>Тема: </h5></p>
				<p><?php echo $comment_head;?></p>
			</div>
			<div>
				<p><h5>Сообщение: </h5></p>
				<p><?php echo $comment_text;?></p>
			</div>
    		<div class="col-xs-9">
    			<input type="text" class="form-control" rows="3" name="comment_head" style="width: 95%" placeholder="Тема">
   			 </div>		
    		<div class="col-xs-9">
    			<textarea class="form-control" rows="3" name="comment_text" style="resize: none; width: 95%" placeholder="Напишите комментарий"></textarea>
   			 </div>
  			<div class="col-xs-offset-3 col-xs-9" style=" text-align: right">
     			<input type="submit" class="btn btn-primary" value="Отправить" name="comment<?php echo $comment_id;?>">
  			</div>						
		</div>
	</form>
</div>

<?php include_once('footer.php'); ?>