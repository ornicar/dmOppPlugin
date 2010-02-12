<?php

class dmOppToolKit
{
  /*
   * Convertit des DMS en degré décimaux
   */
  public static function dmsToDec($dms)
  {
    $dms = strtolower(trim($dms));

    if(!preg_match('|^\d+:\d+:\d+[nose]$|', $dms))
    {
      return null;
    }

    $vals = explode(':', trim($dms, ' nose'));

    if (count($vals) != 3)
    {
      return null;
    }

    $dec = $vals[0] + $vals[1]/60 + $vals[2]/3600;

    if (in_array($dms{strlen($dms)-1}, array('s', 'o')))
    {
      $dec = - $dec;
    }

    return $dec;
  }
}