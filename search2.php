<?PHP
$type = $_GET["type"];
if ($type == "genre") {
    $tag = "genre";
} elseif ($type == "rate") {
    $tag = "rate";
} elseif ($type == "year") {
    $tag = "year";
} else {
    $tag = "movie";
}
?>

<body bgcolor="black">
<center>
<form action="index.php" method="get" target="top">
<input type="text" name="search" value="<?PHP
print $tag;
?>">
<input type="hidden" name="tag" value="<?PHP
print $tag;
?>">
</form> 
