<?php

/**
 * communeAdmin admin form
 *
 * @package    opp-saint-brieuc
 * @subpackage communeAdmin
 * @author     Your name here
 */
class CommuneAdminForm extends BaseCommuneForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['com_com_id']->setOption('order_by', array('nom', 'ASC'));
  }
}