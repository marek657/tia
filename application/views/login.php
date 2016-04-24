<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo ("Login"); ?></h3>
			  </div>
			  <div class="panel-body">
			    <fieldset>
			    	<?php echo form_open('userController/login'); ?>
					 	<div class="form-group">
							<label for="InputEmail"><?php echo ("Email:"); ?></label>
							<input type="email" name="email" class="form-control" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="InputPassword"><?php echo ("Password:"); ?></label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<button type="submit" name="submit" class="btn btn-default"><?php echo ("Login"); ?></button>
					</form>
				</fieldset>
			  </div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo ("Sign up"); ?></h3>
			  </div>
			  <div class="panel-body">
			    <fieldset>
			    	<?php echo form_open('userController/registration'); ?>
					 	<div class="form-group">
							<label for="InputEmail"><?php echo ("Email:"); ?></label>
							<input type="email" name="email" class="form-control" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="InputName"><?php echo ("Name:"); ?></label>
							<input type="text" name="name" class="form-control" placeholder="Enter first name">
						</div>
						<div class="form-group">
							<label for="InputName"><?php echo ("Last name:"); ?></label>
							<input type="text" name="lastname" class="form-control" placeholder="Enter last name">
						</div>
						<div class="form-group">
							<label for="InputPassword1"><?php echo ("Password:"); ?></label>
							<input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="InputPassword1"><?php echo ("Confirm password:"); ?></label>
							<input type="password" name="password2" class="form-control" id="InputPassword1" placeholder="Confirm Password">
						</div>
						<button type="submit" name="submit" class="btn btn-default"><?php echo ("Sign up"); ?></button>
					</form>
				</fieldset>
			  </div>
			</div>
		</div>
	</div>
</div>
