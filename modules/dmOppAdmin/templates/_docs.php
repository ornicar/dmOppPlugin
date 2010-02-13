<?php

if(!count($medias))
{
  return;
}

echo _open('div.dm_box.dm_opp_docs');

  echo _tag('div.title',
    _tag('h2', 'Documents')
  ).
  _open('div.dm_box_inner');

  foreach($medias as $media)
  {
    echo _tag('p.mb10', _link($media->fullWebPath)->text(
      _media('/dmOppPlugin/images/document.png')->size(32, 32)->style('vertical-align: middle')->set('.mr5').
      $media->file
    ));
  }

  echo _close('div');

  echo _close('div');