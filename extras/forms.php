<?php
     if (isset($_POST['submitForm'])) { 
		if ($_POST['step'] == 1) {
		echo "FORM 1";
		  print_r($_POST);
		}
		if ($_POST['step'] == 2) {
		echo "FORM 2";
		  print_r($_POST);
		}
		
		if ($_POST['step'] == 3) {
		echo "FORM 3";
		  print_r($_POST);
		}

     }

?>
<form action="" name="form1" method="post">
<input type="text" value="" name="A" />
<input type="text" value="" name="B" />
<input type="text" value="" name="C" />
<input type="text" value="" name="D" />
<input type="hidden" name="step" value="1" />
<input type="Submit" value="Submit Form" name="submitForm" />
</form>

<form action="" name="form2" method="post">
<input type="text" value="" name="A" />
<input type="text" value="" name="B" />
<input type="text" value="" name="C" />
<input type="text" value="" name="D" />
<input type="hidden" name="step" value="2" />
<input type="Submit" value="Submit Form" name="submitForm" />
</form>

<form action="" name="form3" method="post">
<input type="text" value="" name="A" />
<input type="text" value="" name="B" />
<input type="text" value="" name="C" />
<input type="text" value="" name="D" />
<input type="hidden" name="step" value="3" />
<input type="Submit" value="Submit Form" name="submitForm" />
</form>