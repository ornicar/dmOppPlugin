<?php

if(!$photo->exists())
{
  return;
}

echo £link('photoAdmin/print')
->param('id', $photo->id)
->text(
  £media('/dmOppPlugin/images/printer.png')->style('vertical-align:middle;')->set('.mr5').
  'Imprimer la fiche de cette photo'
)
->target('blank');