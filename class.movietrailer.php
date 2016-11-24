<?php
/**
* @package MovieTrailer
* Fetch movie trailer from YouTube
*
* @author Nitesh Apte
* @copyright 2010
* @version 1.0
* @access public
* @License GPL
*/

class MovieTrailer
{
	/**
	* Private variables for website interaction
	*/
	private $movieName;
	private $movieYear;
	private $page;
	private $embed;
	private $matches;

	/**
	* __construct()
	* Fetch movie trailer from YouTube
	*
	* @param $movie Movie Name
	* @param $year Movie Year
	* @return none
	*/
	public function __construct($movie, $year)
	{
		$movie = str_replace('&', 'and', $movie);
		$this->movieName = str_replace(' ', '+', $movie);
		$this->movieYear = $year;
		$this->page = file_get_contents('http://www.youtube.com/results?search_query='.$this->movieName.'+'.$this->movieYear.'+trailer&aq=1&hl=en');

		if($this->page)
		{
			if(preg_match('~<a .*?href="/watch\?v=(.*?)".*?</div>~s', $this->page, $this->matches))
			{
				$this->embed = '<embed src="http://www.youtube.com/v/'.$this->matches[1].'" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" width="446" height="289"></embed>';
				echo $this->embed;
			}
		}
		else
		{
			echo "<b>check internet connection.....</b>";
		}
	}
}
?>