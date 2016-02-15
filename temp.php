<?php
	    function ProcessRawMedicines($rawData)
	    {
	    	$pieceOfRawData = explode("<div  class='boxresult'>",$rawData[1]);
	    	//print($pieceOfRawData[0]);
	    }

	    $filename = file_get_contents("report/promethease_data/report_is-a-medicine.html");

        // Extract the div as a substring
		$start = (strrpos($filename, 'majorsection') - 12);
		$end = (strrpos($filename, 'boxfooter') - 17);
	    $extract = substr($filename, $start, ($end - $start));
        $start = null; $end = null; // null-ify vars

        // Remove the inline medicine div tag
        $extract = str_replace("<div class='sectiontext'>Medicines</div>", "", $extract);

        $extract = str_replace("(hide)</a>", "(hide)</a>&nbsp;&nbsp;&nbsp;", $extract);
        $pos = strpos($extract, "..more...");
        if ($pos !== false) {
            $extract = substr_replace($extract, "Click to see details..", $pos, "8");
        }

        //save data of each medicine
        $rawMedicines = explode("<div class='adiseasebox'>", $extract);
		ProcessRawMedicines($rawMedicines);
?>