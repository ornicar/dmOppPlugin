<?php

/**
 * Interet form.
 *
 * @package    form
 * @subpackage Tache
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class simpleInteretForm extends InteretForm
{
  public function configure()
  {
  	$this->useFields(array('id', 'valeur'));

    $widgetValeur = $this->widgetSchema['valeur'];

  	$widgetValeur->setOption('choices', array_map('ucfirst', array_merge(
  	  array(0 => ' '),
  	  $widgetValeur->getChoices()
  	)));
  	
  	$this->validatorSchema['valeur']->addOption('choices', array_keys($widgetValeur->getChoices()));
    
    $this->widgetSchema->setNameFormat('interet_'.$this->getObject()->get('Element')->get('slug').'[%s]');

    $this->widgetSchema->setFormFormatterName('list');
  }
}