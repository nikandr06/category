<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class HelpKontrol  extends CComponent
{
    function typ_integer_no_znak(&$par)
  { $par=trim($par);
    if (preg_match('/^[0-9]+$/',$par))  {return true; }
    else  return false;
  }
// ????? ??????? ????.  
  function typ_integer_znak(&$par)
  { $par=trim($par);
    if (preg_match('/^[+-]?[0-9]+$/',$par)) {return true; }
    else  return false;
  }
// ???????? ?????  
  function typ_float(&$par)
  { $par=trim($par);
    if (preg_match('/^[+-]?[0-9]+[\.,][0-9]+$/',$par)) {return true; }  
    else  return false;
  } 
// ?????? ????? ????????? ? ???????
  function  typ_name(&$par)
  { $par=trim($par);
    if (preg_match("{^[?-?a-z'\\\\ ]+$}i",$par) )
    { if (!get_magic_quotes_gpc()) $par=mysql_escape_string($par); 
      return true;
    }  
    else  return false;
  }  
  // ?????? ????? ?????????
  function typ_comName(&$par)
  { 
    $par=preg_replace("/[ ]+/i", ' ',$par);
    $par=trim($par);
    if (preg_match("/^[\s\da-zA-Zа-яА-Я]+/i",$par) )
    { if (!get_magic_quotes_gpc()) $par=mysql_escape_string($par); 
      return true;
    }  
    else  return false;
  }  
  // ?????? ????? ?????????
  function typ_name_lat(&$par)
  { $par=trim($par);
    if (preg_match("/^[a-z'\\\\ ]+$/i",$par)) 
    { if (!get_magic_quotes_gpc()) $par=mysql_escape_string($par); 
      return true; 
    }  
    else  return false;
  } 
  
// ????? ?????????, ??????? ? ????? ? ???????
  function typ_name_number(&$par)
  { $par=trim($par);
    if (preg_match("/^[?-?a-z0-9'\\\\ ]+$/i",$par)) 
    { if (!get_magic_quotes_gpc()) $par=mysql_escape_string($par); 
      return true; 
    }  
    else  return false;
  } 
// ????? ?????????, ??????? ? ????? 
  function typ_login(&$par)
  { $par=trim($par);
    if (preg_match("/^[?-?a-z0-9]+$/i",$par)) 
    { return true; }  
    else  return false;
  } 
// ????? ??????????? ?????
  function typ_email(&$par)
  { $par=trim($par);
    if (preg_match('/^[a-z0-9_]+@[a-z0-9_^\.]+\.[a-z]{2,3}$/i',$par)) {return true; }  
    else  return false;
  } 
// ??? ???? ?????? 1.10.2009
  function typ_date(&$par)
  { $par=trim($par);
    if (preg_match('/^([0-3]?[0-9])\.([01]?[0-9])\.([0-9]{4})$/',$par,$date))
     { $day=$date[1]; $month=$date[2]; $year=$date[3];
       if (checkdate($month,$day,$year) ) {return true;}
     };  
    return false;
  } 
}  //////////////////////////////////////////
