<?php
if (isset($_POST['submitForm']))
{
	if ($_POST['step'] == 1) {		
		$info = array(
			'from' 	 => $user_data['username'],
			'to' => $_POST['member'],
			'amount' => $_POST['balance']
		);
		if(!user_exists( $_POST['member']))
		{
		?>
		<script> alert("This user isn't registered in this group."); </script>
		<?php
		}else if($_POST['member'] === $user_data['username']){
		?>
		<script> alert("You can't give money to yourself."); </script>
		<?php
		}else if($_POST['balance'] < 0){
		?>
		<script> alert("You can't \"give\" a negative amount of money."); </script>
		<?php
		}else if($_POST['balance'] == 0){
		?>
		<script> alert("Null Transaction."); </script>
		<?php
		}
		else{
		//print_r($info);
			add_entry($info);
		}
	}

	if ($_POST['step'] == 2) {
		$info = "empty";
		compute_my_balance($info);
	}
	
	if ($_POST['step'] == 3) {
		delete_member($user_data['username']);
		header('Location: logout.php');
	}
}
?>
<!--
<script>
function delete_account()
{
	alert("Are you sure?");
	//delete_member($user_data['username']);
	<?php
	//header('Location: logout.php');
	?>
}
</script>

-->

<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">
<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>
<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>
<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>

<script>
	$(document).ready(function() {
		$('#windowTitleDialog').bind('show', function () {
			document.getElementById ("xlInput").value = document.title;
			});
		});
	function closeDialog () {
		$('#windowTitleDialog').modal('hide'); 
		};
	function okClicked () {
		document.title = document.getElementById ("xlInput").value;
		closeDialog ();
		};
</script>

<div class="container">

	<div class="form-signin">
		  <form  action="" method="POST">
			<h2 class="form-signin-heading">Add a transaction</h2>
			<input type="text" class="input-block-level" name="member" placeholder="Member to whom you gave money?">
			<input type="text" class="input-block-level" name="balance" placeholder="How much money did you give?">
			<input type="hidden" name="step" value="1" />
			<button class="btn btn-large btn-primary" type="submit" name="submitForm">Add Entry</button>
		  </form>

			<p style="font-size:1.3em;">Calculate minimum no. of transactions required for settlement.</p>
		  	
			<div class="divButtons">
				<a data-toggle="modal" href="#windowTitleDialog" class="btn btn-primary btn-large">Calculate</a>
			</div>
	  </div>
	  <div class="form-signin">

			<form action="" style="float:center;" method="POST">
				<input type="hidden" name="step" value="3" />
				<button class="btn btn-large btn-primary" type="Submit" name="submitForm">Delete Account</button>
			</form>
		<div class="divButtons">
			<a  href="changepassword.php" class="btn btn-primary btn-large">Change Password</a>
			<a  href="logout.php" class="btn btn-primary btn-large">Log Out</a>
		</div>
		
		<div id="windowTitleDialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Minimum no. of transactions required are as follows:</h3>
			</div>
			
			<div class="modal-body">
				<div class="divDialogElements">
					<input class="xlarge" id="xlInput" name="xlInput" type="hidden" />
					<p style="font-family:Arial Black;">
					<?php 
					compute_my_balance("none");
					?>
					</p>
				</div>
			</div>
			
			<div class="modal-footer">
				<a href="#" class="btn btn-primary" onclick="closeDialog();">OK</a>
			</div>
		</div>
				
	</div>
</div>