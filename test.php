<html>
<?PHP
include "config.inc.php";
$showid    = $_GET["show"];
$episodeid = $_GET["ep"];
$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL3    = "select c01,c00 from episode where idepisode = '" . $episodeid . "' AND idshow = '" . $showid . "'";

                               while ( $db_field = mysql_fetch_assoc($result3));
                               {
                                $episodedescription = $db_field['c01'];
                                $episodetitle       = $db_field['c00'];
                               }
print $SQL3;
print $episodedescription['c01'];
print $episodetitle['c00'];
}
