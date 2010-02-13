<?php

echo _tag('div.dm_box.dm_opp_backup',
  _tag('div.title',
    _tag('h2', 'Sauvegardes')
  ).
  _tag('div.dm_box_inner',
    _tag('p.mb10', _link('dmOppAdmin/backupMysql')->text(
      _media('/dmOppPlugin/images/database_go.png')->size(32, 32)->style('vertical-align: middle')->set('.mr5').
      'Sauvegarder la base de données'
    )).
    _tag('p', _link('dmOppAdmin/backupImages')->text(
      _media('/dmOppPlugin/images/tarball.png')->size(32, 32)->style('vertical-align: middle')->set('.mr5').
      'Sauvegarder les photos'
    ))
  )
);