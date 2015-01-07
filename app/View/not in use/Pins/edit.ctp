<?php    
    $viewName = "";        
    switch($pinData["Pin"]["location_type"]){
        case "2":  
            $viewName = "_event_detail_edit";
            break;
        case "3":  
            $viewName = "_shop_detail_edit";
            break;
        
        default:  
            $viewName = "_location_detail_edit";
            break;
    }
    echo $this->render($viewName, false);
?>