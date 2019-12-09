<?php 	// upload.php
	echo <<<_END
		<html>
		<head><title>PHP Form Upload</title></head>
		<body>
		<form method='post' action='Midterm1.php' enctype='multipart/form-data'>
			Select File: <input type='file' name='filename' size='10'>
			<input type='submit' value='Upload'>
		</form>
_END;
	function find_TheTotalBiggestAdjacentNumbers($name,$input,$length){
		$max = 0;
		$start = 0;
		$max1 = 0;
		$max2 = 0;
		$max3 = 0;
		$max4 = 0;
		//Make a 2D array
		for($i = 0; $i < 20 ;$i++){
			for($j = 0; $j < 20; $j++){
				$arr[$i][$j] = $input[$start++];
			}
		}
		// $max1 = max_RowToCol($arr);
		// $max2 = max_ColToRow($arr);
		// $max3 = max_DiagonalToLeft($arr);
		// $max4 = max_DiagonalToRight($arr);
		$result[0] = max_RowToCol($arr);
		$result[1] = max_ColToRow($arr);
		$result[2] = max_DiagonalToLeft($arr);
		$result[3] = max_DiagonalToRight($arr);
		$max = find_TheBiggest($result);
		echo "<br>The largest product of the adjecent numbers is = " . $max;
		echo "<br><br>Tester function: (don't forget to change the max in the tester function if you want a different value)";
		tester_function($name,$max);
	}
	function find_TheBiggest($arr){
		$total = 0;
		for($i=0;$i<4;$i++){
			if($arr[$i] >= $total)
				$total = $arr[$i];
		}
		return $total;
	}
	function max_RowToCol($arr){
		$total = 0;
		$max = 0;
		for($i = 0; $i < 20; $i++){
			for($j = 0; $j < 17; $j++){
				$total = $arr[$i][$j] * $arr[$i][$j+1] * $arr[$i][$j+2] * $arr[$i][$j+3];
				if($total >= $max){
					$max = $total;
				}
			}
		}
		return $max;
	}
	function max_ColToRow($arr){
		$total = 0;
		$max = 0;
		for($j = 0; $j < 20; $j++){
			for($i = 0; $i < 17; $i++){
				$total = $arr[$i][$j] * $arr[$i+1][$j] * $arr[$i+2][$j] * $arr[$i+3][$j];
				if($total >= $max){
					$max = $total;
				}
			}
		}
		return $max;
	}
	function max_DiagonalToLeft($arr){
		$total = 0;
		$max = 0;
		for($i = 0; $i < 17; $i++){
			for($j = 3; $j < 20; $j++){
				$total = $arr[$i][$j] * $arr[$i+1][$j-1] * $arr[$i+2][$j-2] * $arr[$i+3][$j-3];
				if($total >= $max){
					$max = $total;
				}
			}
		}
		return $max;
	}
	function max_DiagonalToRight($arr){
		$total = 0;
		$max = 0;
		for($i = 0; $i < 17; $i++){
			for($j = 16; $j >= 0; $j--){
				$total = $arr[$i][$j] * $arr[$i+1][$j+1] * $arr[$i+2][$j+2] * $arr[$i+3][$j+3];
				if($total >= $max){
					$max = $total;
				}
			}
		}
		return $max;
	}
	function find_TheFactorial($input) {
		$total = 1;
		//echo "<br>The number = ".$input;
		for($count = 1 ; $count <= $input; $count++) {
			$total = $total * $count;
		}
		//echo "<br>The factorial = ".$total;
		return $total;
	}
	function check_lengthFile($input){
		if ($input != 400) {
			return false;
		} else {
			echo "<br>The length of the file is correct!";
			return true;
		}
	}
	function check_eachCharacter($input,$length){
		$check = true;
		for($count = 0; $count < $length; $count++ ){
			if( $input[$count] == '0' || $input[$count] == '1' || $input[$count] == '2' || $input[$count] == '3' || $input[$count] == '4' || $input[$count] == '5' || $input[$count] == '6' || $input[$count] == '7' || $input[$count] =='8' || $input[$count] == '9' )
				$check =  true;
			else {
				echo "<br>There is a characther that is not a number!";
				return false;
			}
		}
		if($check) {
			echo "<br>Each characther only contains number!";
			return true;
		} else {
			echo "<br>The length of the file is incorrect!";
			return false;
		}
	}
	function check_typeOfFile($name){
		if (mime_content_type($name) == "text/plain"){
 			echo "<br>This is a text file!";
 			return true;
		} else {
			echo "<br>This is not a text file!";
			return false;
		}
	}
	function tester_function($name,$max){
		$condition1 = true;
		$condition2 = true;
		$condition3 = true;
		$condition4 = true;
		$fh = fopen($name, 'r');
		$line = fgets($fh);
		fclose($fh);
		$length = strlen($line);
		echo "<br>";
		if(check_lengthFile($length)){
			$condition1 = true;
		} else {
			$condition1 = false;
		}
		if(check_eachCharacter($line,$length)) {
			$condition2 = true;
		} else {
			$condition2 = false;
		}
		if (check_typeOfFile($name)) {
 			$condition3 = true;
		} else {
			$condition3 = false;
		}
		//Change the value of max to check either the function is correct or not, here
		if ($max == 5832) {
			echo "<br>Correct value!";
			$condition4 = true;
		} else {
			echo "<br>Incorrect value!";
			$condition4 = false;
		}
		if($condition1 && $condition2 && $condition3 && $condition4){
			echo "<br><br>Final: Test case passed";
		} else {
			echo "<br><br>Final: Test case not passed";
		}
	}
	function main_program(){
		echo "Before you upload the file, don't forget to change your .txt file permission into read and write for all users <br>";
		if ($_FILES){
			$name = $_FILES['filename']['name'];
			//echo $name;
			move_uploaded_file($_FILES['filename']['tmp_name'], $name);
			//echo "Uploaded image " . '$name'. "<br><img src='$name'>";
			$fh = fopen($name, 'r') or
		    	die("File does not exist or you lack permission to open it");
			$line = fgets($fh);
			fclose($fh);
			//echo $line;
			$length = strlen($line);
			echo "<br>The length of the text is = " . $length . "<br>";
			if (check_lengthFile($length) && check_eachCharacter($line,$length) && check_typeOfFile($name))
				find_TheTotalBiggestAdjacentNumbers($name,$line,$length);
			else
				echo "<br>The file should be format correctly";
			echo "<br>";
		}
	}
	main_program();
	echo "</body></html>";
?>
