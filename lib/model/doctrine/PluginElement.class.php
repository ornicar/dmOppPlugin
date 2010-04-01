<?php

/**
 * PluginElement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class PluginElement extends BaseElement
{

  public function getCategClasses()
  {
    $categClasses = array();

    foreach($this->get('Categs') as $categ)
    {
      $categClasses[] = $categ->get('slug');
    }

    return implode(' ', $categClasses);
  }

}