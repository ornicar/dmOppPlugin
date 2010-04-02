<?php

class sfWidgetFormSelectRadioFlat extends sfWidgetFormSelectRadio
{
  public function formatter($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $input)
    {
      $rows[] = $input['input'].$this->getOption('label_separator').$input['label'];
    }

    return !$rows ? '' : $this->renderContentTag('div', implode($this->getOption('separator'), $rows), array('class' => $this->getOption('class')));
  }
}
