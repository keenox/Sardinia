<div class="notice">
	<?php
	if($flashes = Yii::app()->user->getFlashes()) {
	    foreach($flashes as $key => $message) {
	        if($key != 'counters') {
	            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	                        'id'=>$key,
	                        'options'=>array(
									'title'=>$message['title'],
									'modal'=>true,
									'buttons'=>array('OK'=>'js:function(){$(this).dialog("close")}'),
	                            ),
	                        ));
	 
	            if (array_key_exists('icon', $message))            
	            	echo CHtml::image(Yii::app()->baseUrl.'/images/'.$message['icon'].'.png');
	            
	            printf('%s', $message['content']);
	 
	            $this->endWidget('zii.widgets.jui.CJuiDialog');
	        }
	    }
	}
	?>
</div>