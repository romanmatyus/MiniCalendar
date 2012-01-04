<?
/**
 * This file is part of the NRomiixCMS
 *
 * Copyright (c) 2012 Roman Mátyus (romanmatyus@gmail.com)
 */

namespace NRomiix;

use Nette,
	Nette\Debug,
	Nette\Application\Control;

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
	
	/** @var array */
	private $day_translate = array("Monday"=>"Pondelok","Tuesday"=>"Utorok","Wednesday"=>"Streda","Thursday"=>"Štvrtok","Friday"=>"Piatok","Saturday"=>"Sobota","Sunday"=>"Nedeľa");
	
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
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addDayOfTheWeek($pattern = "%s",$date="now")
	{
		if(strtotime($date))
			$this->result .= str_replace("%s",\Nette\String::lower($this->day_translate[date("l",strtotime($date))]),$pattern);
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
	 * add name day to the result from the source file CSV
	 * @param string $patern
	 * @param string $lang
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addNameDay($pattern="%s",$lang="", $date="now") 
	{
		$data_from_file = self::parseCsv(__DIR__."/name_day.$lang.csv");
		if (isset($data_from_file["data"][date("m-d",strtotime($date))]))
			$this->result .= str_replace("%s",$data_from_file["data"][date("m-d",strtotime($date))],$pattern);
		return $this;
	}
	
	/**
	 * add day of public hollyday to the result from the source file CSV
	 * @param string $patern
	 * @param string $lang
	 * @param string $date
	 * @return MiniCalendar
	 */
	public function addPublicHollyDay($pattern="%s",$lang="", $date="now") 
	{
		$data_from_file = self::parseCsv(__DIR__."/public.$lang.csv");
		if (isset($data_from_file["data"][date("m-d",strtotime($date))]))
			$this->result .= str_replace("%s",$data_from_file["data"][date("m-d",strtotime($date))],$pattern);
		return $this;
	}
	
	/**
	 * parse source CSV file
	 * @param string $file
	 * @return array|NULL
	 */
	private function parseCsv($file) 
	{
		$result=array();
		if (file_exists($file)) {
			$data = file_get_contents($file);
			if ($data) {
				$data = explode("\r\n\r\n",$data);
				$config = explode("\r\n",$data[0]);
				foreach ($config as $item) {
					$item = explode(":",$item);
					if ($item[1]!=="")
						$config[$item[0]]=$item[1];
				}
				$result['config']=$config;
				$data = explode("\r\n",$data[1]);
				
				foreach ($data as $item) {
					$item = explode("|",$item);
					if (isset($item[1]))
						if ($item[1]!="")
							$name_day[$item[0]]=$item[1];
				}
				$result['data']=$name_day;
			}
		}
		return ($result)?$result:NULL;
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
