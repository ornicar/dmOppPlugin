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

  	$widgetValeur
    ->setOption('choices', array_map('ucfirst', array_merge(
  	  array(null => 'Aucun'),
  	  $widgetValeur->getChoices()
  	)))
    ->setOption('expanded', true)
    ->setOption('renderer_class', 'sfWidgetFormSelectRadioFlat');

  	$this->validatorSchema['valeur']
    ->setOption('choices', array_keys($widgetValeur->getChoices()))
    ->setOption('required', false);

    $this->widgetSchema->setNameFormat('interet_'.$this->getObject()->get('Element')->get('slug').'[%s]');

    $this->widgetSchema->setFormFormatterName('list');
  }
}