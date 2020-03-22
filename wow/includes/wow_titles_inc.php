<?php

function toonTitle ($toonObjTitles) 
{
	foreach ($toonObjTitles as $toonTitles)
	{
		if(isset($toonTitles->selected))
		{
			return $toonTitle;
		}
	}
}

?>
