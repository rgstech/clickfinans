<?php



if (!function_exists("get_controller_name"))  //pegar o controler ativo / get active controller
{
    function get_controller_name()
    {
        return  substr(\CodeIgniter\Config\Services::router()->controllerName(), 17);
    }
}



if (!function_exists("get_method_name"))   //pegar o metodo do controler ativo / get active controller method
{
    function get_method_name()
    {
        return \CodeIgniter\Config\Services::router()->methodName();
    }
}



if (!function_exists("formatDateTime")) 
{

    function formatDateTime($vdate)
    {

        $data = new DateTime($vdate);
        
        return  $data->format('d-m-Y H:i:s');
    }
}



if (!function_exists("formatDate")) 
{

    function formatDate($vdate)
    {

        $data = new DateTime($vdate);

        $parts = explode(' ',  $data->format('d/m/Y H:i:s'));
        $datePart = $parts[0];


        return  $datePart;
    }

}
    

    
if (!function_exists("formatMoney")) 
{

    function formatMoney($currency)
    {
        return "R$ " . number_format($currency , 2, "," , "."); 
        
    }
    
}



if (!function_exists("formatMoneyToDb")) 
{

    function formatMoneyToDb($currency)
    {
        return str_replace(',','.',str_replace('.','',$currency));
        
    }
    
}



