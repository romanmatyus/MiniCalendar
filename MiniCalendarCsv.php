<?
/**
 * This file is part of the NRomiixCMS
 *
 * Copyright (c) 2012 Roman Mátyus (romanmatyus@gmail.com)
 */

namespace NRomiix\Components\MiniCalendar;

use	Nette\Object,
	NRomiix\Components\MiniCalendar\IMiniCalendarStorage;

/**
 * MiniCalendarCsv
 * Class for get data from CSV file for component MiniCalendar
 * 
 * @author Roman Mátyus
 * @license MIT
 */
class MiniCalendarCsv extends Object implements IMiniCalendarStorage
{
	/** @var array */
	public $result=array();
	
	/**
	 * get $arr for connection to DB or file and parse
	 * @param string|array $arr
	 */
	function __construct($arr)
	{
		$file = __DIR__."/$arr";
		if (file_exists($file)) {
			$data = file_get_contents($file);
			//Debug::bardump($data);
			if ($data) {
				$data = explode("\r\n\r\n",$data);
				foreach (explode("\r\n",$data[0]) as $item) {
					$item = explode(":",$item);
					if ($item[1]!=="")
						$config[$item[0]]=$item[1];
				}
				$this->result['config']=$config;
					if (isset($this->result['config']['year']))
						if ($this->result['config']['year']!=date("Y")) {
							return FALSE;
						}
				$data = explode("\r\n",$data[1]);
				foreach ($data as $item) {
					$item = explode("|",$item);
					if (isset($item[1]))
						if ($item[1]!="")
							$name_day[$item[0]]=$item[1];
				}
				$this->result['data']=$name_day;
			}
		}
		return ($this->result)?TRUE:FALSE;
	}
	
	/**
	 * get only data
	 * @return NULL|array
	 */
	public function getData()
	{
		return ($this->result['data'])?$this->result['data']:NULL;
	}
	
	/**
	 * get only configuration
	 * @return NULL|array
	 */
	function getConfig()
	{
		return ($this->result['config'])?$this->result['config']:NULL;
	}
	
	/**
	 * get all data from storage
	 * @return NULL|array
	 */
	function getResult()
	{
		return ($this->result)?$this->result:NULL;
	}

}
