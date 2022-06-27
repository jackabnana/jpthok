<?
if (!$user->get_session())
{
	$red = "login.php?red=".$get->get_current_url();
	header("location: $red");
}
?>



<div id="AdminHeader">

<div class="logo">

<a href="index.php">

    <img src="<?=ADMIN_PATH?>/images/admin-logo.png" width="200"/>

</a>

</div>



<div class="searcharea">

<form action="" method="" onsubmit=''>

<input type="text" class="top-input" placeholder="Type to search ..."/>

<input type="submit" class="top-input-search" value="" />

</form>

</div>



<div class="logout">

<a href="<?=ADMIN_PATH?>/index.php?getmeout=ok"><strong>Logout</strong><img src="<?=ADMIN_PATH?>/images/logout.png" width="22" /></a>

</div>

<div style="clear:both;"></div>

</div>