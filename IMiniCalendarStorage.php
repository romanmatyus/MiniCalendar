<?
/**
 * This file is part of the NRomiixCMS
 *
 * Copyright (c) 2012 Roman Mátyus (romanmatyus@gmail.com)
 */

namespace NRomiix\Components\MiniCalendar;

/**
 * IMiniCalendarStorage
 * Interface for different storage for MiniCalendar data
 * 
 * @author Roman Mátyus
 * @license MIT
 */
interface IMiniCalendarStorage
{
	/**
	 * get $arr for connection to DB or file and parse
	 * @param string|array $arr
	 */
	function __construct($arr);
	
	/**
	 * get only data
	 * @return NULL|array
	 */
	function getData();
	
	/**
	 * get only configuration
	 * @return NULL|array
	 */
	function getConfig();
	
	/**
	 * get all data from storage
	 * @return NULL|array
	 */
	function getResult();
}
