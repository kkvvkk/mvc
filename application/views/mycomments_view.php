<?php include_once('header.php'); ?>
<title>Мои комментарии</title>

<script>
	var count = 5;
	function show_more(){
		$$a({
        	type:'post',//тип запроса
        	url: "ajax",
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
            		else{
            			$('#comments').append('<div class="well"><div class="col-xs-9"><p><h5>Тема: </h5></p><p>'+item.comment_head+'</p></div><div class="col-xs-9"><p><h5>Сообщение: </h5></p><p>'+item.comment_text+'</p></div></div>');
            		}
            	});
            	count = count + 5;
       		}
		});
	}
</script>
<div>
	<form  class="form-signin" role="form" id="comments">
		<?php foreach ($comments as $item):?>
			<div class="well">
				<?php if($item['comment_delete'] ==1){ ?>			
					<div>
						<p class="text-error">Комментарий удалён</p>
					</div>
				<?php }
				else{ ?>
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

	<?php if(count($comments) == 5){ ?>
		<center>
			<input type="button" value="Показать еще" onclick="show_more()" id="show_mo" class="btn btn-info">
		</center>
	<?php } ?>
	<form method="POST" action="<?php echo base_url('index.php/page_controller/back_to_mypage'); ?>">
		<center>
			<button type="submit" class="btn btn-link btn-sm" name="back_to_mypage">Назад</button>
		</center>
	</form>

</div>


<?php include_once('footer.php'); ?>

