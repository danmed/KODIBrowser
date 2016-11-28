<html>
<?PHP
include "config.inc.php";
$showid    = $_GET["show"];
$episodeid = $_GET["ep"];
$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL3    = "select c01,c00 from episode where idepisode = '" . $episodeid . "' AND idshow = '" . $showid . "'";
$result3  = mysql_query($SQL3);
  if (!$result3) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
                               $episode_info = mysql_fetch_row($result3); 
                                $episodedescription = $episode_info['c01'];
                                $episodetitle       = $episode_info['c00'];
                                
print $episodedescription;
print episodetitle;
}
