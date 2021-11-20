<style>
.nameError, .emailError, .designationError, .salaryError, .dateError{
	color:red;
}

</style>

<form action="" method="post" id="editUserData" name="editUserData">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="modal-body">

	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" class="form-control">
		<div class="nameError"></div>
	</div>
	
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" class="form-control">
		<div class="emailError"></div>
	</div>
	
	<div class="form-group">
		<label>Designation</label>
		<input type="text" name="designation" id="designation" value="<?php echo $row['design']; ?>" class="form-control">
		<div class="designationError"></div>
	</div>
	
	<div class="form-group">
		<label>Salary</label>
		<input type="text" name="salary" id="salary" value="<?php echo $row['salary']; ?>" class="form-control">
		<div class="salaryError"></div>
	</div>
	
	<div class="form-group">
		<label>Date</label>
		<input type="date" name="date" value="<?php echo $row['date']; ?>" class="form-control">
		<div class="dateError"></div>
	</div>
	
</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

<button type="submit" class="btn btn-primary">Submit</button>

</div>

</form>