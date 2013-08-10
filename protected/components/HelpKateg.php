<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class HelpKateg  extends CComponent
{  Const  razdel= '|||';
public static function myPaginat($pages,$start_page,$show_page,$action,$kod)
    {  $answer['pages']=''; $answer['start_page']=$start_page;  $answer['tek_page']=$kod;
        if( $pages<=1)  return $answer; 
    
        if( $pages<=$show_page)
        { $start_page=1; $end_page=$pages;  $begin_str=''; $end_str='';   }  
       else 
       { if( $kod==-1) // в начало
           { $start_page=1; $kod=1; $begin_str=''; 
              $end_str= HelpKateg::puc_end($action,$start_page);   
           }
           elseif ( $kod==-91) // в конец
            { $start_page=$pages-$show_page;  $kod=$pages;  $end_str='';  
               $begin_str= HelpKateg::puc_begin($action,$start_page);
            }
           elseif ( $kod==-7) // <
            { 
                if( $start_page<=$show_page+1) 
                {
                   $start_page=1; $begin_str=''; 
                   $end_str= HelpKateg::puc_end($action,$start_page);    
                }
                else //рисуем все
                { 
                    $start_page=$start_page-$show_page;
                    $begin_str= HelpKateg::puc_begin($action,$start_page);
                    $end_str= HelpKateg::puc_end($action,$start_page);   
                }                 
               $kod=$start_page;
            }
           elseif ( $kod==-97) // >
            {   
                if( $start_page>=$pages-2*$show_page) 
                { 
                   $start_page=$pages-$show_page;  $end_str='';  
                   $begin_str= HelpKateg::puc_begin($action,$start_page); 
                }
                else//рисуем все
                { 
                    $start_page=$start_page+$show_page;
                    $begin_str =HelpKateg::puc_begin($action,$start_page);
                    $end_str= HelpKateg::puc_end($action,$start_page);   
                } 
               $kod=$start_page;
            }
           else // текущая страница
           { $begin_str=''; $end_str='';
               if($kod>$show_page)  $begin_str= HelpKateg::puc_begin($action,$start_page); 
               if($kod<$pages-$show_page){ $end_str= HelpKateg::puc_end($action, $start_page); }
           }  
          $end_page=$start_page+$show_page;
       }
      $res=$begin_str;
      for( $k=$start_page; $k<=$end_page; $k++)
      {
        $url=Yii::app()->createUrl($action, array("kod"=>$k,'start_page'=>$start_page));
        $tek=( $k==$kod) ? '&nbsp;&nbsp;'.$k : '&nbsp;&nbsp;'.CHtml::link($k, $url);   
        $res.=$tek; 
       }
       $res.='&nbsp;&nbsp;'.$end_str;

/*        if( Yii::app()->session['name_page']=='redak' ) {$pages->currentPage= Yii::app()->session['pagin_page'] ;}
        Yii::app()->session['pagin_page'] = $pages->currentPage;
        Yii::app()->session['name_page'] = 'table';
*/
      $answer['pages']=$res; $answer['start_page']=$start_page;  $answer['tek_page']=$kod;
         return  $answer;
    }


}