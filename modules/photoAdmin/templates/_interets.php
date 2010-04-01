<?php

echo _open('div.interets_wrap.clearfix');

echo _open('ul.interets.clearfix');

foreach($form->getElements() as $elementSlug => $element)
{
  $interetForm = $form['interet_'.$elementSlug];

  echo _tag('li'.toggle('.even'), array('class' => $element->categClasses),
    $interetForm['id'].
    $interetForm['valeur'].
    $interetForm['valeur']->renderLabel($element->get('nom'))
  );
}

echo _close('ul');

echo _link('@element?action=new')
->text('Ajouter un élément')
->set('.fright.s16.s16_add')
->target('blank');

echo _close('div');

if($photo->exists())
{
  echo _tag('div.text_align_center', _media($photo->Image)->height(400)->method('scale'));
}