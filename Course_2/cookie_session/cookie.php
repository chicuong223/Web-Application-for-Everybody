<?php 
if(!isset($_COOKIE['cuong'])){
    setcookie('cuong', '20', time() + 60);
}
?>

<pre>
<?php print_r($_COOKIE);?>
</pre>
<p><a href="cookie.php">Click here</a> or press Refresh</p>