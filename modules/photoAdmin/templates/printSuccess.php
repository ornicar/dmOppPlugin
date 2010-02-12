<?php use_helper('Date', 'DmOppPrint', 'DmGoogleMap', 'Text');

use_stylesheet('dmOppPlugin.blueprint', 'last', array('media' => 'all'));
use_stylesheet('dmOppPlugin.print', 'last', array('media' => 'all'));

echo £('h1.title.center', dmConfig::get('site_name').' - '.$photo);

echo '<hr />';

echo £('div.span-11.colborder.append-bottom.center',
  $photo->Image->isImage()
  ? £media($photo->Image)->width(430)->height(300)->method('scale').
    ($photo->Image->license ? '<br /><strong>Licence</strong> : '.$photo->Image->license : '')
  : 'Pas de photo'
);

echo £o('div.span-11.last.append-bottom');
  
  if ($photo->Thematiques->count())
  {
    echo dm_opp_simple_table(array(
      'Com. de communes' => $commune->ComCom->nom,
      'Commune' => $commune->nom,
      'Site' => $site->nom,
      'Lieu_dit' => $site->lieuDit ? $site->lieuDit : '-',
      'Route' => $site->route ? $site->route : '-'
    ));
    echo '<hr class="soft" />';
    echo dm_opp_simple_table(array(
      'Thématique' => $photo->Thematiques->count() ? implode(', ', $photo->Thematiques->getData()) : '-',
      'Auteur' => $photo->Image->author ? $photo->Image->author : '-',
      'Date' => $photo->date ? format_date($photo->date, 'D') : $photo->annee,
      'Heure' => $photo->heure ? $photo->heure : '-'
    ));
  }
  
echo £c('div');

echo '<hr />';

echo £o('div.span-11.colborder.append-bottom');
  
  echo dm_opp_simple_table(array(
//    'Coordonnées géographiques' => 'Coordonnées géographiques',
    'Latitude' => $photo->latitude ? $photo->latitude : '-',
    'Longitude' => $photo->longitude ? $photo->longitude : '-',
    'Précision' => $photo->positionPrecision ? $photo->positionPrecision.' m.' : '-',
  ));
  echo '<hr />';
  echo dm_opp_simple_table(array(
    'Orientation' => $photo->orientation ? $photo->orientation.'°' : '-',
    'Inclinaison' => $photo->inclinaison ? $photo->inclinaison.'°' : '-',
    'Type de vue' => $photo->Vue->nom,
    'Hauteur de l\'objectif' => $photo->hauteur ? $photo->hauteur.' cm.' : '-',
    'Focale' => $photo->focale ? $photo->focale.' mm.' : '-'
  ));
  echo '<hr class="soft" />';
  echo £('p', £link($photo)->text(£link($photo)->getAbsoluteHref()));
  
echo £c('div');

echo £('div.span-11.last.append-bottom',
  ($photo->latitude && $photo->longitude)
  ? _map()
  ->coords($photo->latitude, $photo->longitude)
  ->navigationControl(true)
  ->mapTypeControl(true)
  ->scaleControl(true)
  : 'Pas de vue aérienne'
);

echo '<hr />';

echo £('div.span-11.colborder',
  £('h3', 'Emplacement').
  (($photo->Emplacement && $photo->Emplacement->isImage())
  ? £media($photo->Emplacement)->width(430)->height(350)->method('scale').
    ($photo->Emplacement->legend ? '<br /><strong>Légende</strong> : '.$photo->Emplacement->legend : '')
  : 'Pas d\'emplacement')
);

echo £('div.span-11.last',
  £('h3', 'Commentaires').
  ($photo->commentaire ? simple_format_text(escape($photo->commentaire)) : 'Pas de commentaires')
);