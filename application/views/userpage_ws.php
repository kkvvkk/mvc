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
        						$('#comments').append('<div class="well"><p><h5>Ответ на комментарий: </h5></p><p><h5>Автор: </h5></p><p>'+key.author[0].firstname + ' ' + key.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+key.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+key.comment_text +'</p></div><p><h5>Автор: </h5></p><p>'+item.author.firstname + ' ' + item.author.surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text +'</p></div></div>');
        					}
        				});
            		} else{
            			$('#comments').append('<div class="well"><p><h5>Автор: </h5></p><p>'+item.author[0].firstname + ' ' + item.author[0].surname+'</p><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head +'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text +'</p></div>');
            		}        			


            	});
       		}
		});
	}
</script>
<div>
	<div>
		<form id="comments">
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
	<form method="POST" action="<?php echo base_url('index.php/page_controller/back_ws'); ?>">
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