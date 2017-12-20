<?php include_once('header.php'); ?>
<title><?php echo $about_user[0]['firstname'].' '.$about_user[0]['surname'];?></title>

<script>
	var count = 5;
	function show_more(){
		$$a({
        	type:'post',//тип запроса
        	url: "ajax_on_userpage",
        	data:{'count': count},//параметры запроса
        	success:function (data) {//возвращаемый результат от сервера
        		var comments = JSON.parse(data);
        		var user = <?php echo $this->session->userdata('user_id');?>;
        		if(comments.length < 5){
        			$("#show_mo").val("Показывать больше нечего");
        		}        		
        		comments.forEach(function(item, i, comments){
            		if(item.comment_delete == 1){
            			$('#comments').append('<div class="well"><p class="text-error">Комментарий удалён</p></div>');
            		}
            		else if(item.answer_to != 0){
        				comments.forEach(function(key, i, comments){
        					if (key.comment_id == item.answer_to) {
        						$('#comments').append('<div class="well"><p><h5>Ответ на комментарий: </h5></p><p><h5>Автор: </h5></p><p>'+key.author[0].firstname + ' ' + key.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+key.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+key.comment_text +'</p></div><p><h5>Автор: </h5></p><p>'+item.author[0].firstname + ' ' + item.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text +'</p></div></div>');
        					}
        				});
            		} else if(user == item.author[0].user_id){
            			$('#comments').append('<div class="well"><p><h5>Автор: </h5></p><p>'+item.author[0].firstname + ' ' + item.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text +'</p></div><div class="col-xs-offset-3 col-xs-9" style=" text-align: right"><input type="submit" class="btn btn-danger" name="delete'+item.comment_id+'" value="Удалить"><input type="submit" class="btn btn-primary" name="answer'+item.comment_id+'" value="Ответить"></div></div>');
            		} else{
             			$('#comments').append('<div class="well"><p><h5>Автор: </h5></p><p>'+item.author[0].firstname + ' ' + item.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text +'</p></div><div class="col-xs-offset-3 col-xs-9" style=" text-align: right"><input type="submit" class="btn btn-primary" name="answer'+item.comment_id+'" value="Ответить"></div></div>');           			
            		}       			


            	});
       		}
		});
	}
</script>

<div>
	<div>
		<form class="form-signin" id="comments" role="form" method="POST" action="<?php echo base_url('index.php/page_controller/action_comment');?>">
			<?php foreach ($comments as $item): ?>
				<div class="well">
					<?php if($item['comment_delete'] ==1){ ?>
					<div>
						<p><h5>Автор: </h5></p>
						<p><?php echo $item['author'][0]['firstname'].' '.$item['author'][0]['surname'];?></p>
					</div>					
					<div>
						<p class="text-error">Комментарий удалён</p>
					</div>
					<?php }
						elseif ($item['answer_to'] != 0) {?>
						<div>
							<p><h5>Ответ на комментарий: </h5></p>
							<p><h5>Автор: </h5></p>
							<?php foreach ($comments as $key) {
								if ($key['comment_id'] == $item['answer_to']) { ?>
									<p><?php echo $key['author'][0]['firstname'].' '.$key['author'][0]['surname'];?></p>
						</div>
						<div class="col-xs-9">
							<p><h5>Тема: </h5></p>
    						<p><?php echo $key['comment_head'];?></p>				
						</div>
    					<div class="col-xs-9">
    						<p><h5>Сообщение: </h5></p>
    						<p><?php echo $key['comment_text'];?></p>
   			 			</div>			
								<?php }
							}?>
					<div>
						<p><h5>Автор: </h5></p>
						<p><?php echo $item['author'][0]['firstname'].' '.$item['author'][0]['surname'];?></p>
					</div>
					<div class="col-xs-9">
						<p><h5>Тема: </h5></p>
    					<p><?php echo $item['comment_head'];?></p>				
					</div>
    				<div class="col-xs-9">
    					<p><h5>Сообщение: </h5></p>
    					<p><?php echo $item['comment_text'];?></p>
   			 		</div>	
   			 		<div class="col-xs-offset-3 col-xs-9" style=" text-align: right">
   			 			<?php if ($item['author'][0]['user_id'] == $user_id){?>
   			 				<input type="submit" class="btn btn-danger" name="delete<?php echo $item['comment_id'];?>" value="Удалить">
						<?php }?>
     					<input type="submit" class="btn btn-primary" value="Ответить" name="answer<?php echo $item['comment_id'];?>">
  					</div> 			 							
					<?php }					
					else{ ?>				
					<div>
						<p><h5>Автор: </h5></p>
						<p><?php echo $item['author'][0]['firstname'].' '.$item['author'][0]['surname'];?></p>
					</div>
					<div class="col-xs-9">
						<p><h5>Тема: </h5></p>
    					<p><?php echo $item['comment_head'];?></p>				
					</div>
    				<div class="col-xs-9">
    					<p><h5>Сообщение: </h5></p>
    					<p><?php echo $item['comment_text'];?></p>
   			 		</div>
   			 		<div class="col-xs-offset-3 col-xs-9" style=" text-align: right">
   			 			<?php if ($item['author'][0]['user_id'] == $user_id){?>
   			 				<input type="submit" class="btn btn-danger" name="delete<?php echo $item['comment_id'];?>" value="Удалить">
						<?php }?>
     					<input type="submit" class="btn btn-primary" value="Ответить" name="answer<?php echo $item['comment_id'];?>">
  					</div>
  					<?php }?>  					
				</div>
			<?php endforeach;?>	
		</form>
	</div>

	<?php if(count($comments) == 5){ ?>
		<center>
			<input type="button" value="Показать еще" onclick="show_more()" id="show_mo" class="btn btn-info">
		</center>
	<?php } ?>

	<form class="form-signin" role="form" method="POST" action="<?php echo base_url('index.php/page_controller/userpage_comments'); ?>">
		<div class="well">
    		<div class="col-xs-9">
    			<input type="text" class="form-control" rows="3" name="comment_head" style="width: 95%" placeholder="Тема">
   			 </div>		
    		<div class="col-xs-9">
    			<textarea class="form-control" rows="3" name="comment_text" style="resize: none; width: 95%" placeholder="Напишите комментарий"></textarea>
   			 </div>
  			<div class="col-xs-offset-3 col-xs-9" style=" text-align: right">
     			<input type="submit" class="btn btn-primary" value="Отправить" name="comment<?php echo $about_user[0]['user_id'];?>">
  			</div>
		</div>
	</form>

	<form method="POST" action="<?php echo base_url('index.php/page_controller/contacts'); ?>">
		<center>
			<button type="submit" class="btn btn-link btn-sm" name="contacts">Назад</button>
		</center>		
	</form>
	<form method="POST" action="<?php echo base_url('index.php/page_controller/signout'); ?>">
		<center>
			<button type="submit" class="btn btn-link btn-sm" name="signout">Выйти</button>
		</center>
	</form>
</div>

<?php include_once('footer.php'); ?>