<?php

/**
 * photoAdmin admin form
 *
 * @package    opp-saint-brieuc
 * @subpackage photoAdmin
 * @author     Your name here
 */
class PhotoAdminForm extends BasePhotoForm
{
  protected
  $elements,
  $interets;

  public function configure()
  {
    parent::configure();

    $this->validatorSchema['focale']->setOption('min', 1);
    $this->validatorSchema['focale']->setOption('max', 100);

    $this->validatorSchema['hauteur']->setOption('min', 1);
    $this->validatorSchema['hauteur']->setOption('max', 1000);

    $this->validatorSchema['orientation']->setOption('min', 0);
    $this->validatorSchema['orientation']->setOption('max', 359);

    $this->validatorSchema['inclinaison']->setOption('min', -90);
    $this->validatorSchema['inclinaison']->setOption('max', +90);

    $this->validatorSchema['latitude']->setOption('min', -180);
    $this->validatorSchema['latitude']->setOption('max', +180);

    $this->validatorSchema['longitude']->setOption('min', -180);
    $this->validatorSchema['longitude']->setOption('max', +180);

    $this->validatorSchema['position_precision']->setOption('min', 0);
    $this->validatorSchema['position_precision']->setOption('max', 10000);

    $this->widgetSchema['site_id']->setOption('order_by', array('nom', 'ASC'));

    foreach($this->getElements() as $elementSlug => $element)
    {
      $this->embedForm('interet_'.$elementSlug, $this->getInteretFormForElement($element));
    }
  }

  protected function createMediaFormForEmplacementId()
  {
    $form = parent::createMediaFormForEmplacementId();

    unset($form['author'], $form['license']);

    $form->setMimeTypeWhiteList(array(
      'image/jpeg',
      'image/png'
    ));

    return $form;
  }

  protected function createMediaFormForImageId()
  {
    $form = parent::createMediaFormForImageId();

    unset($form['legend']);

    $form->setMimeTypeWhiteList(array(
      'image/jpeg',
      'image/png'
    ));

    return $form;
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    $return = parent::bind($taintedValues, $taintedFiles);

    foreach($this->getValues() as $key => $value)
    {
      if (strncmp($key, 'interet_', 8) === 0)
      {
        if (!$value['valeur'])
        {
          if ($value['id'])
          {
            Doctrine_Query::create()
            ->delete('Interet t')
            ->where('t.id = ?', $value['id'])
            ->execute();
          }

          unset($taintedValues[$key]);
          unset($this[$key]);
        }
      }
    }

    return $return;
  }

  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (is_null($forms))
    {
      $forms = $this->embeddedForms;
    }

    foreach ($forms as $formKey => $form)
    {
      if ($form instanceof simpleInteretForm)
      {
        if (!$form->getObject()->get('photo_id'))
        {
          $form->getObject()->set('photo_id', $this->object->get('id'));
        }
      }
    }

    return parent::saveEmbeddedForms($con, $forms);
  }

  public function getElements()
  {
    if (null === $this->elements)
    {
      $this->elements = dmDb::query('Element e INDEXBY e.slug')->orderBy('e.nom ASC')->fetchRecords();
    }

    return $this->elements;
  }

  protected function getInteretByElementSlug($elementSlug)
  {
    if (is_null($this->interets))
    {
      if ($this->getObject()->exists())
      {
        $this->interets = dmDb::query('Interet t, t.Element e INDEXBY e.slug')
        ->select('t.*, e.slug, e.slug as element_slug')
        ->where('t.photo_id = ?', $this->getObject()->get('id'))
        ->fetchRecords();
      }
      else
      {
        $this->interets = array();
      }
    }

    foreach($this->interets as $interet)
    {
      if ($interet->get('element_slug') === $elementSlug)
      {
        return $interet;
      }
    }

    return null;
  }

  protected function getInteretFormForElement(Element $element)
  {
    if (!$interet = $this->getInteretByElementSlug($element->get('slug')))
    {
      $interet = new Interet();

      if($this->getObject()->exists())
      {
        $interet->set('Photo', $this->getObject());
      }
      
      $interet->set('Element', $element);
    }

    return new simpleInteretForm($interet);
  }
}