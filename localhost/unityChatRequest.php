<?php include 'database.php'?> 

<?php

	$table=$_REQUEST['tableName']."UnityTable";
	// need to post the username here 
	// table will be named <username>UnityTable
	
	$sql = "SELECT id, name, comment FROM ".$table."";
	$result = mysqli_query($connect, $sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		// 
		while($row = mysqli_fetch_assoc($result))
		{
			// sets a local name (try to grab $row['name'] instead if possible
			$theID = $row['id'];
			
			// prints the information to the page to be read
			// the name:, comment:, | and ; are needed to parse the information
			echo "name:".$row['name'] . "|comment:".$row['comment']. ";";
			
			// deletes it from the database
			mysqli_query($connect, "DELETE FROM ".$table." WHERE id=".$theID."");
		}
	}
?>