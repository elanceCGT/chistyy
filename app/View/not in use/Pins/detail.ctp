<?php
    
    $viewName = "";
    
    //prd($pinData["Pin"]["location_type"]);
    
    switch($pinData["Pin"]["location_type"]){
        case "1":  
            $viewName = "_location_detail";
            break;
        case "2":  
            $viewName = "_event_detail";
            break;
        case "3":  
            $viewName = "_shop_detail";
            break;
        
        default:  
            $viewName = "_location_detail";
            break;
    }
    echo $this->render($viewName, false);
?>