<?php

echo 'test';

?>
<html>
<body>
<form action="sample.php" method="post">
<table>
	<tr>
		<td>Maker Name:</td>
		<td><input type="text" name="maker_name" /></td>
	</tr>
	<tr>
		<td>Project Name:</td>
		<td><input type="text" name="project_name" /></td>
	</tr>
	<tr>
		<td>Completion Date:</td>
		<td><input type="text" name="completion" /></td>
	</tr>
	<tr>
		<td>Materials Used:</td>
		<td><input type="text" name="materials" /></td>
	</tr>
	<tr>
		<td>Process & Function</td>
		<td><input type="text" name="process" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Submit" id="submit" /></td>
	</tr>
</table>
</form>

</body>
</html>
