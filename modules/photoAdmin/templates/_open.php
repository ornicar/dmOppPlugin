<?php

echo £link('dmOppAdmin/index')
->param('photo_id', $photo->id)
->text(
  £media('/dmOppPlugin/images/magnifier.png')->style('vertical-align:middle;')->set('.mr5').
  'Afficher cette photo sur la carte'
)
->target('blank');