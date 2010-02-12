<?php

use_javascript('dmGoogleMapPlugin.api');
use_javascript('dmOppPlugin.map');

echo _tag('div.dm_opp_global_map',
  _tag('textarea.none', json_encode($data)).
  'Chargement...'
);