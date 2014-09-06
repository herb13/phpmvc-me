<?php

// Class CCalendar, produces a calendar in HTML
//
// This class generates a HTM for showing a calendar with
// all months and dates. 
// 
// Revision history:
// 2014-08-11, herb - First version

namespace Herb13\Calendar;

class CCalendar
{

	private static $daysInWeek = 7;	

	private static $monday    = "Mon"; 
	private static $tuesday   = "Tue";
	private static $wednesday = "Wed";
	private static $thursday  = "Thu";
	private static $friday    = "Fri";
	private static $saturday  = "Sat";
	private static $sunday    = "Sun";
	
	private $year;
	private $month;
	private $day;
	private $dayTextual;  // Mon through Sun

   /************************************************************************** 
 	* constructor 
 	* @param 
 	* @return -
 	*/

	public function __construct() 
	{
		// Fetch today's date and save it in a form
		// that will be used within this class/object

		$this->year  =  date('Y');
		$this->month =  date('m');
		$this->day   =  date('d');
		$this->dayTextual = date('D');
	}

   /************************************************************************** 
 	* getCalendar, creates a calendar and returns it
 	* @param -
 	* @return a HTML calendar with current date highligted
 	*/

	public function getCalendar()
	{
		// First translate the current day into an integer.
		// That is, mon = 1, tue = 2, ..., sun = 7.

		$dayOfWeekAsInt = $this->getDayPosition();

		// Create all dates of current month as an array where monday's are
		// at position 1, 8, 15, ...; tuesday's at 2, 9, 16, ...; ... sunday's
		// at 7, 14, 21, ...; 

		$calendarWithDates = $this->createDateForTheMonth($dayOfWeekAsInt);

		// Create the calendar as HTML table. Each day of the week has its 
		// fixed position and the dates are fetched from calendarWith dates,
		// which is prepared for this. Calendar will look lie the following:
		// Example:   M   T   O   T   F   L   S
		//                        1   2   3   4
		//            5   6   7   8   9  10  11
		//           12  13  14  15  16  17  18
		//           19  20  21  22  23  24  25
		//           26  27  28  29  30  31

		return $this->createHtmlCalendar($calendarWithDates);
	}

   /************************************************************************** 
 	* getDayPosition, translates a day to intger or position in the week 1-7
 	* @param -
 	* @return 1-7. 0 if day is unkown
 	*/

	private function getDayPosition()
	{
		switch($this->dayTextual) {
			
			case self::$monday:
				return 1;
			case self::$tuesday:
				return 2;
			case self::$wednesday:
				return 3;
			case self::$thursday:
				return 4;
			case self::$friday:
				return 5;
			case self::$saturday:
				return 6;
			case self::$sunday:
				return 7;
			default:
				return 0;	
		}

	}

   /************************************************************************** 
 	* getMonthAsNumber, returns current month as a number
 	* @param -
 	* @return 1-12
 	*/

	public function getMonthAsNmbr()
	{
		return $this->month;
	}

   /************************************************************************** 
 	* getMonthAsText, returns current month as a text string
 	* @param -
 	* @return januari, februari, mars, ..., december
 	*/

	public function getMonthAsText()
	{
		switch($this->month) {

			case 1:
				return "Januari";
			case 2:
				return "Februari";
			case 3:
				return "Mars";
			case 4:
				return "April";
			case 5:
				return "Maj";
			case 6:
				return "Juni";
			case 7:
				return "Juli";
			case 8:
				return "Augusti";
			case 9:
				return "September";
			case 10:
				return "Oktober";
			case 11:
				return "November";
			case 12:
				return "December";
			default:
				return "något knas CCalendar::getMonth()";	
		}
	}

   /************************************************************************** 
 	* createDateForTheMonth, from the current day and date this function place
 	* all dates of the month so that a each day ends up att a fixed position.
 	* E.g. monday ends up in 1, 8, 15 etc. (first column of the calendar)
 	* @param -
 	* @return array with aligned dates
 	*/

	private function createDateForTheMonth($dayOfWeek)
	{
		$maxDate = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year); 

		// Find where we need to put in the current day in the 
		// calendar	

		for($i = 0; $i < $maxDate; $i++) {

			if((self::$daysInWeek * $i + $dayOfWeek) >= $this->day) {

				$startPos = (self::$daysInWeek * $i + $dayOfWeek) - 1;
				break;
			}
		}

		// Now we know where ciurrent day should be. Put it in
		// and add all dates up to the end of this month in an
		// array.
		//
		// TODO: Not so efficient to first loop up to max date and then down 
		// to the min date in separate loops. Make it on sigle loop instead.

		$calendar = new \SplFixedArray(75);

		// Start upwards to max date
		$tempDay = $this->day + 0; // Fix: add 0 to current day to get 1, 2, .. and not 01, 02, ..
		for($i = $startPos; $tempDay <= $maxDate ; $i++) {

			$calendar[$i] = $tempDay++;
		}

		// Go downwards to the 1st day of month

		$tempDay = $this->day + 0; // Fix: add 0 to current day to get 1, 2, .. and not 01, 02, ..
		for($i = $startPos; $tempDay > 0 ; $i--) {

			$calendar[$i] = $tempDay--;
		}

		return $calendar;
	}

   /************************************************************************** 
 	* createHtmlCalendar, creates a calendar as HTML table
 	* @param -
 	* @return vcalendar as table in HTML 
 	*/

	private function createHtmlCalendar($calendarAsArray)
	{
		$monthAsText = $this->getMonthAsText();	

		// Create heading and table header for the calendar.
		// Also add elements for styling.

		$html = "<h1>Månadskalender</h1>";
		$html .= "<table class='calendartable'>";
		$html .= "<caption>{$monthAsText} {$this->year}</caption>";
		$html .= "<tr><th>M</th><th>T</th><th>O</th><th>T</th><th>F</th><th>L</th><th>S</th></tr>";
		
		// Go through the calendar array and place all dates in the table cells.
		// Add styling elements for weekends (sat & sun) as well as for weekdays.
		// Add styling for current day, so it's possible to style it via css.

		$ready = false;	
		$i = 0;
		while($ready == false) {

			$html .= "<tr>\n";	
			for($j = 0; $j < self::$daysInWeek; $j++) {

				$weekend = ($j == 5 || $j == 6) ? "weekend" :  null;
				$today = ($calendarAsArray[$i] == $this->day) ? "today" : null;
				$html .= "<td class='{$weekend}{$today}'>{$calendarAsArray[$i]}</td>\n";
				$i++;
			}

			$html .= "</tr>\n";
		
			// check if we are ready
			if($calendarAsArray[$i] == null) { $ready = true; }
		}

		$html .= "</table>";

		// Return the complete calendar as HTML.

		return $html;
	}

} // End of class