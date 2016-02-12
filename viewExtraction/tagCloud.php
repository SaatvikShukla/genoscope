<?php
    $filename = file_get_contents("../report/promethease_data/report_tagcloud.html");
	$start = (strpos($filename, '>(hide)</a>') + 11);
	$end = (strrpos($filename, 'majorboxfooter') - 18);
    echo substr($filename, $start, ($end - $start));
?>
