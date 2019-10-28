  function changeToThanks(clr)
{
  $.when(  	$.get("insertColor.php?color=" + clr)).then(location.href="thanks.php"); //inserts the vote into the database, then changes to a different page
}

function changeToVote()
{
	//replace contents of element by id with found element by id from other page
	//in this case, replace contents of element with id "bodyID with the contents of the element with id "containerID" from the vote.html page
	$("#bodyID").load("vote.html #containerID"); //loads container in vote page into bodyID of index page
}
