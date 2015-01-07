<?php
if (!empty($shopData['Review'])) {
    foreach ($shopData['Review'] as $reviewRow) {
        //pr($reviewRow);
        ?>
        <div class="reviews">
            <div class="revipic">
                <?php 
                if(!empty($reviewRow['User']['image'])){
                    ?>
                    <img src="<?php echo $this->webroot . "img/" ?>no_user.jpg" height="42px" width="42px;"/>
                    <?php
                } else {
                    ?>
                    <img src="<?php echo $this->webroot . "img/" ?>no_user.jpg" height="42px" width="42px;"/>
                    <?php
                }
                ?>
                
            </div>
            <div class="revtex">
                <div class="event_rightpanel_title"><?php echo $reviewRow['User']['first_name'] . " " . $reviewRow['User']['last_name']; ?></div> 
                <div class="event_rightpanel_text"><?php echo $reviewRow['description']; ?></div>
                <div class="event_rightpanel_star">
                    <div class="rate_<?php echo $reviewRow['rating']; ?>"></div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "New review on this pin";
}
?>

