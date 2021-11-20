<!DOCTYPE html>
<html>
<head>
<title>User Details</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js">  </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js">  </script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/style.css">

</head>

<body>

	<div class="header">
	
		<div class="container">
		
			<h1 class="heading">User Details</h1>

		</div>
	  
	</div>
	
	<div class="container">
		
			<div class="row pt-4">
			
				<div class="col-md-6">
					<h4>User List</h4>
				</div>
				
				<div class="col-md-6 text-right">
					<a href="javascript:void(0);" onclick="showModal();" class="btn btn-primary">Create</a>
				</div>
				
				<div class="col-md-12 text-right pt-3">
					<table class="table table-striped" id="UserdataList">
					
					<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Designation</th>
					<th>Salary</th>
					<th>Date</th>
					<th>Edit</th>
					<th>Delete</th>
					</tr>
					
					<?php if(!empty($rows)){ ?>
					<?php foreach($rows as $row){ ?>
					
					<?php $Data['row'] = $row;
			
						  $this->load->view('user/user_row',$Data);
					?>
					
					<?php }
					
							} 
					?>
					
					</table>
				</div>
				
			</div>

	</div>
	
		<!-- Modal -->
		<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		
			<div class="modal-dialog modal-dialog-centered" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
					
						<h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
						
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						
							<span aria-hidden="true">&times;</span>
							
						</button>
						
					</div>
					
				  <div id="response">
					
				  </div>
				  
				</div>
				
		  </div>
		  
		</div>
		
		<div class="modal fade" id="ajaxResponseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		
			<div class="modal-dialog modal-dialog-centered" role="document">
			
				<div class="modal-content">
				
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<div class="modal-body">

						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
				</div>
				
		    </div>
			
		</div>
		
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
				    <div class="modal-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-danger" onclick="deleteNow();">Yes</button>
					</div>
					
				</div>
		  </div>
		</div>
	
</body>

<script>

	function showModal(){
		
		$("#createUser").modal("show");
		$("#createUser #title").html("Create");
		
		$.ajax({
			
			url:'<?php echo base_url(); ?>User/showCreateForm',
			type: 'POST',
			data:{},
			dataType: 'json',
			success: function(response){
				
				$("#response").html(response['htmldata']);
			}
		})
	}
	
	$("body").on("submit","#createUserModel",function(e){
		
		e.preventDefault();
		$.ajax({
			
			url:'<?php echo base_url(); ?>User/saveModal',
			type: 'POST',
			data:$(this).serializeArray(),
			dataType: 'json',
			success: function(response){
				
				if(response['status'] ==0 ){
					if(response['name'] != ""){
						$(".nameError").html(response["name"]).addclass('invalid-feedback');
					}
					
					if(response['email'] != ""){
						$(".emailError").html(response["email"]).addclass('invalid-feedback');
					}
					
					if(response['designation'] != ""){
						$(".designationError").html(response["designation"]).addclass('invalid-feedback');
					}
					
					if(response['salary'] != ""){
						$(".salaryError").html(response["salary"]).addclass('invalid-feedback');
					}
					
					if(response['date'] != ""){
						$(".dateError").html(response["date"]).addclass('invalid-feedback');
					}
				}else{
					
					$("#createUser").modal("hide");
					$("#ajaxResponseModal .modal-body").html(response["message"]);
					$("#ajaxResponseModal").modal("show");
					
					$("#UserdataList").append(response["row"]);
					
				}
			}
		})
	})
	
	function showEditForm(id){
		
		$("#createUser .modal-title").html("Edit");
		
		$.ajax({
			
			url:'<?php echo base_url(); ?>user/getuserdata/'+id,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				
				$("#createUser #response").html(response['htmldata']);
				$("#createUser").modal("show");
			}
		})
	}
	
	$("body").on("submit","#editUserData",function(e){
		
		e.preventDefault();
		$.ajax({
			
			url:'<?php echo base_url(); ?>user/updateUser',
			type: 'POST',
			data:$(this).serializeArray(),
			dataType: 'json',
			success: function(response){
				
				if(response['status'] ==0 ){
					
					if(response['name'] != ""){
						$(".nameError").html(response["name"]).addclass('invalid-feedback');
					}
					
					if(response['email'] != ""){
						$(".emailError").html(response["email"]).addclass('invalid-feedback');
					}
					
					if(response['designation'] != ""){
						$(".designationError").html(response["designation"]).addclass('invalid-feedback');
					}
					
					if(response['salary'] != ""){
						$(".salaryError").html(response["salary"]).addclass('invalid-feedback');
					}
					
					if(response['date'] != ""){
						$(".dateError").html(response["date"]).addclass('invalid-feedback');
					}
					
				}else{
					
					$("#createUser").modal("hide");
					$("#ajaxResponseModal .modal-body").html(response["message"]);
					$("#ajaxResponseModal").modal("show");
					
					//$("#carModalList").append(response["row"]);
					
					var id = response['row']['id'];
					//console.log(response['row']['name']);
					$("#row-"+id+" .modelName").html(response["row"]["name"]);
					$("#row-"+id+" .modelEmail").html(response["row"]["email"]);
					$("#row-"+id+" .modelDesign").html(response["row"]["designation"]);
					$("#row-"+id+" .modelSalary").html(response["row"]["salary"]);
					$("#row-"+id+" .modelDate").html(response["row"]["date"]);
					
				}
			}
		})
	})
	
	function confirmDeleteModel(id){
		
		$("#deleteModal").modal("show");
		$("#deleteModal .modal-body").html("Are You sure to delete?");
		$("#deleteModal").data("id",id);
		
	}
	
	function deleteNow(id){
		
		var id = $("#deleteModal").data('id');
		
		$.ajax({
			
			url:'<?php echo base_url(); ?>user/deleteModal'+'?'+'id='+id,
			type: 'POST',
			data:$(this).serializeArray(),
			dataType: 'json',
			success: function(response){
			
					if(response['status'] == 1 ){
						
						$("#deleteModal").modal("hide");
						$("#ajaxResponseModal .modal-body").html(response["msg2"]);
						$("#ajaxResponseModal").modal("show");
						window.location.href = "<?php echo current_url(); ?>";
						
					}else{
						
						$("#deleteModal").modal("hide");
						$("#ajaxResponseModal .modal-body").html(response["msg1"]);
						$("#ajaxResponseModal").modal("show");
						
					}
				}
			});
	}

	

</script>

</html>
