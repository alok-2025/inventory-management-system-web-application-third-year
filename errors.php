<!-- show error message if any -->
<!-- the below code checks if there are any errors -->
<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<!-- the below code loops through any errors -->
		<?php foreach ($errors as $error) : ?>
			<!-- the below code shows the error message on the screen -->
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
