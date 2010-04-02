<?php

echo _open('div.interets_wrap.opp_interet_selector.clearfix');

echo _open('ul.element_categs');

echo _tag('li', _tag('a', array('data-slug' => 'no-categ'), 'Non classé'));

foreach(dmDb::query('ElementCateg c')->orderBy('c.nom')->fetchRecords() as $categ)
{
  echo _tag('li', _tag('a', array('data-slug' => $categ->slug), $categ->nom));
}

echo _close('ul');

echo _open('ul.interets.clearfix');

foreach($form->getElements() as $elementSlug => $element)
{
  $interetForm = $form['interet_'.$elementSlug];

  echo _tag('li', array('class' => $element->categClasses),
    $interetForm['id'].
    $interetForm['valeur']->renderLabel(_tag('span', $element->get('nom'))).
    $interetForm['valeur']
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