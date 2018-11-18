<?php 

// fungsi untuk menampilkan pesan peringatan
function alert($pesan) {
	// tampilkan alert javascript
	echo "<script>alert('{$pesan}');</script>";
}

// fungsi untuk mengalihkan ke url(x)
function redirect($url) {
	// tampilkan alert javascript
	echo "<script>window.location='{$url}';</script>";
}

// fungsi untuk mengganti format tanggal
function tanggal($format, $tanggal){
	return date($format, strtotime($tanggal));
}

function build_calendar($month, $year, $hightlight=[], $dateArray) {
	// Create array containing abbreviations of days of week.
	$daysOfWeek = array('Mg','Sn','Sl','Rb','Km','Jm','Sa');
	// What is the first day of the month in question?
	$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
	// How many days does this month contain?
	$numberDays = date('t', $firstDayOfMonth);
	// Retrieve some information about the first day of the
	// month in question.
	$dateComponents = getdate($firstDayOfMonth);
	// What is the name of the month in question?
	$monthName = $dateComponents['month'];
	// What is the index value (0-6) of the first day of the
	// month in question.
	$dayOfWeek = $dateComponents['wday'];
	// Create the table tag opener and day headers
	$calendar = "<table class=\"calendar table table-bordered\">";
	$calendar .= "<caption>$monthName $year</caption>";
	$calendar .= "<tr>";
	// Create the calendar headers
	foreach($daysOfWeek as $day) {
		$calendar .= "<th class=\"header bg-info text-light\">$day</th>";
	}
	// Create the rest of the calendar
	// Initiate the day counter, starting with the 1st.
	$currentDay = 1;
	$calendar .= "</tr><tr>";
	// The variable $dayOfWeek is used to
	// ensure that the calendar
	// display consists of exactly 7 columns.
	if ($dayOfWeek > 0) { 
		$calendar .= "<td colspan=\"$dayOfWeek\">&nbsp;</td>"; 
	}
	$month = str_pad($month, 2, "0", STR_PAD_LEFT);
	while ($currentDay <= $numberDays) {
        // Seventh column (Saturday) reached. Start a new row.
		if ($dayOfWeek == 7) {
			$dayOfWeek = 0;
			$calendar .= "</tr><tr>";
		}
		$currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
		$date = "$year-$month-$currentDayRel";

		if ($currentDay == date('j')) {
			$calendar .= "<td class=\"day bg-success text-light\" rel=\"$date\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hari ini\">$currentDay</td>";
		} else {
			if (isset($hightlight[$currentDay])) {
				$calendar .= "<td class=\"day bg-primary text-light\" rel=\"$date\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$hightlight[$currentDay]}\">$currentDay</td>";
			} else {
				$calendar .= "<td class=\"day\" rel=\"$date\">$currentDay</td>";
			}
		}
        
        // Increment counters
		$currentDay++;
		$dayOfWeek++;
	}
    // Complete the row of the last week in month, if necessary
	if ($dayOfWeek != 7) { 
		$remainingDays = 7 - $dayOfWeek;
		$calendar .= "<td colspan=\"$remainingDays\">&nbsp;</td>"; 
	}
	$calendar .= "</tr>";
	$calendar .= "</table>";
	return $calendar;
}