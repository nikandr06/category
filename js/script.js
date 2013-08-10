function checked_parent(type_select,doc_t)
{
 //  var single = $(type_select).val();
   if($(type_select).attr("checked")=="checked")
   {   
//       $(doc_t).attr('style','display:block'); 
       $(doc_t).show();
   }
   else   
   {    
//       $(doc_t).attr('style','display:none');   
       $(doc_t).hide();
   }
//alert('да это ajax!!! '+single);
  return false; 
}
