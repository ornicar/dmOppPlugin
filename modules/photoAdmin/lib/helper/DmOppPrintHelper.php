<?php

function dm_opp_simple_table(array $data)
{
  $html = '<table><tbody>';
  
  foreach($data as $key => $value)
  {
    if($key === $value)
    {
      $html .= '<tr><th colspan="2">'.$key.'</th></tr>';
    }
    else
    {
      $html .= '<tr><th>'.$key.'</th><td>'.$value.'</td></tr>';
    }
  }
  
  $html .= '</tbody></table>';
  
  return $html;
}