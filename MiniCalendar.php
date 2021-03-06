<?
/**
 * This file is part of the NRomiixCMS
 *
 * Copyright (c) 2012 Roman Mátyus (romanmatyus@gmail.com)
 */

namespace NRomiix\Components;

use Nette\Application\Control,
	NRomiix\Components\MiniCalendar\MiniCalendarCsv;
/**
 * MiniCalendar
 * component for fast creating mini calendar
 * 
 * @author Roman Mátyus
 * @license MIT
 */
class MiniCalendar extends Control
{
	/** @var string */
	private $result="";
	
	/** @var array */
	private $item=array();
	
	/**
	 * add text string to the result
	 * @param string $text
	 * @return MiniCalendar
	 */
	public function addText($text)
	{
		if (is_string($text))
			$this->result .= $text;
		return $this;
	}
	
	/**
	 * add day of the week to the result
	 * @param string $patern
	 * @param string $lang
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addDayOfTheWeek($pattern = "%s",$lang="",$date="now")
	{
		$data_from_file = new MiniCalendarCsv("dayoftheweek.$lang.csv");
		$day_translate = $data_from_file->getData();
		if(strtotime($date))
			$this->result .= str_replace("%s",\Nette\String::lower($day_translate[date("l",strtotime($date))]),$pattern);
		return $this;
	}
	
	/**
	 * add date to the result
	 * @param string $patern
	 * @param string $format
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addDate($pattern="%s",$format="d.m.Y",$date="now")
	{
		if(strtotime($date)&&is_string($format))
			$this->result .= str_replace("%s",date($format,strtotime($date)),$pattern);
		return $this;
	}
	
	/**
	 * add day holyday to the result from arbitrary source
	 * @param string $source
	 * @param string $pattern
	 * @param string $con
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addDayFrom($source="Csv",$pattern="%s",$con="", $date="now") 
	{
		$source = '\\NRomiix\\Components\\MiniCalendar\\MiniCalendar'.$source;
		$data_from_file = new $source($con);
		$data_from_file = $data_from_file->getData();
		if (isset($data_from_file[date("m-d",strtotime($date))]))
			$this->result .= str_replace("%s",$data_from_file[date("m-d",strtotime($date))],$pattern);
		return $this;
	}
	
	/**
	 * render MiniCalendar
	 */
	public function render()
	{
		$template = parent::createTemplate();
		$template->setFile(__DIR__ . '/minicalendar.latte');
		$template->result = $this->result;
		$template->render();
	}
}
