<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class DateID extends Controller
{
	private static function getDayName($dayOfWeek)
	{
		$dayName = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
		return $dayName[$dayOfWeek];
	}

	private static function getMonthName($month)
	{
		$monthName = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		return $monthName[$month - 1];
	}

	public static function formatTime($date)
	{
		$carbon_date = Carbon::parse($date);

		$hour = $carbon_date->hour;
		$formattedHour = ($hour < 10)?  '0' . (string)($hour) : (string)($hour);

		$minute = $carbon_date->minute;
		$formattedMinute = ($minute < 10)?  '0' . (string)($minute) : (string)($minute);

		return $formattedHour . '.' . $formattedMinute;
	}

	public static function formatDate($date, $showDayName)
	{
		$carbon_date = Carbon::parse($date);

		if($showDayName) $dayName = self::getDayName($carbon_date->dayOfWeek);
		else $dayName = '';

		$day = $carbon_date->day;
		$monthName = self::getMonthName($carbon_date->month);
		$year = $carbon_date->year;

		if($showDayName) return $dayName . ', ' . $day . ' ' . $monthName . ' ' . $year;
		else return $day . ' ' . $monthName . ' ' . $year;
	}

	public static function formatDateTime($date, $showDayName)
	{
		$formattedDate = self::formatDate($date, $showDayName);
		$formattedTime = self::formatTime($date);

		return $formattedDate . ', ' . $formattedTime;
	}
}