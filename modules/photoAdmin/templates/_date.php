<?php use_helper('Date');

if ($photo->date)
{
	echo format_date($photo->date).' '._tag('span.quiet', $photo->heure);
}
else
{
	echo $photo->annee;
}