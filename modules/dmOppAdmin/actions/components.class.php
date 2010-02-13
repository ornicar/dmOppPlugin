<?php

class dmOppAdminComponents extends dmAdminBaseComponents
{

  public function executeBackup()
  {
    
  }

  public function executeDocs()
  {
    $this->medias = dmDb::table('DmMedia')->findByFolderRelPath('doc');
  }

  public function executeGlobalMap(dmWebRequest $request)
  {
    $photos = dmDb::query('Photo p')
    ->withDmMedia('Image')
    ->leftJoin('p.Site s')
    ->fetchRecords();

    $this->data = sfConfig::get('app_dmOpp_globalMap');

    $this->data['photos'] = array();
    foreach($photos as $photo)
    {
      $this->data['photos'][] = array(
        'open'    => $photo->id === $request->getParameter('photo_id'),
        'coords'  => $photo->getCoords(),
        'title'   => $photo->nom,
        'html'    => $this->getHelper()->renderPartial('dmOppAdmin', 'marker', array('photo' => $photo))
      );
    }
  }

}