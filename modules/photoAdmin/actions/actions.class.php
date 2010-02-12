<?php

require_once dirname(__FILE__).'/../lib/photoAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/photoAdminGeneratorHelper.class.php';

/**
 * photoAdmin actions.
 *
 * @package    opp-saint-brieuc
 * @subpackage photoAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class photoAdminActions extends autoPhotoAdminActions
{

	public function executePrint(dmWebRequest $request)
	{
    sfConfig::set('sf_web_debug', false);

	  $this->getResponse()->clearStylesheets();
//    $this->getResponse()->clearJavascripts();

	  $table = dmDb::table('Photo');

	  $query = $table->joinAll($table->createQuery('photo'))
    ->leftJoin('site.Commune commune')
    ->leftJoin('commune.ComCom comCom')
	  ->where('photo.id = ?', $request->getParameter('id'));

		$this->forward404Unless(
		  $this->photo = $query->fetchRecord()
		);

		$this->site = $this->photo->Site;

    $this->commune = $this->site->Commune;

		$this->setLayout(realpath(dirname(__FILE__).'/..').'/templates/layoutPrint');
	}
}
