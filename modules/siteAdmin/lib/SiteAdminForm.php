<?php

/**
 * siteAdmin admin form
 *
 * @package    opp-saint-brieuc
 * @subpackage siteAdmin
 * @author     Your name here
 */
class SiteAdminForm extends BaseSiteForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['commune_id']->setOption('order_by', array('nom', 'ASC'));
  }
}