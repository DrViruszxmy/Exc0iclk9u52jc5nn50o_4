<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Date extends Model
{
    
	public static function getCurrentSchoolYear() {
		$date = Carbon::now();
	    $current_year = $date->year;
	    $school_year = '';
	    $sem = '';

	    if ($date->month >= 6 && $date->month <= 12) {
	        $next_year = $date->year + 1;
	        $school_year = $current_year . '-' . $next_year;
	        if ($date->month >= 6 && $date->month <= 10) {
	            $sem = '1st';
	        } else if ($date->month >= 11 && $date->month <= 12) {
	            $sem = '2nd';
	        }
	    } else if ($date->month >= 1 && $date->month <= 3) {
	        $prev_year = $date->year - 1;
	        $school_year = $prev_year . '-' . $current_year;
	        $sem = '2nd';
	    }
	    return $school_year;
	}

	public static function getCurrentSemester() {
		$date = Carbon::now();
	    $current_year = $date->year;
	    $school_year = '';
	    $sem = '';

	    if ($date->month >= 6 && $date->month <= 12) {
	        $next_year = $date->year + 1;
	        $school_year = $current_year . '-' . $next_year;
	        if ($date->month >= 6 && $date->month <= 10) {
	            $sem = '1st';
	        } else if ($date->month >= 11 && $date->month <= 12) {
	            $sem = '2nd';
	        }
	    } else if ($date->month >= 1 && $date->month <= 3) {
	        $prev_year = $date->year - 1;
	        $school_year = $prev_year . '-' . $current_year;
	        $sem = '2nd';
	    }
	    return $sem;
	}

	public static function school_years($start)
	{
		$years = [];
        $end_year = Carbon::now();
        $start_year = Carbon::createFromDate($start);

       while ($end_year->year != $start_year->year ) {
           $start_year->addYear(1);
           $plus = $start_year->year + 1;
           $years[] = "$start_year->year-$plus";
       }

       return $years;
	}

	public static function dateToday()
	{
		$date = new Carbon();
        $today = $date->format('l');

       return $today;
	}

	public static function dateTodayFull()
	{
		$date = new Carbon();
        $today = $date->format('M d, Y');

       return $today;
	}
}
