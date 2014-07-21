<div class="content_title">
		<h2>ورود به پنل مديريت</h2>
	  </div>
<div class="content_content">
        <div class="msg-error">
            <?php $session->flash('auth'); ?>
        </div>
        
			<?php 
				echo $form->create('User',array('url'=>array('controller'=>'managers' , 'action'=>'login')));

						echo $form->input('email');

						echo $form->input('password');
						
						echo $form->end(__("Login",true));
			?>

</div>

