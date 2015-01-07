<div class="locationbuttomdiv_topfirst">
<!--    <img src="<?php //echo $this->webroot; ?>img/starimg.png" />
    <img src="<?php //echo $this->webroot; ?>img/starimg.png" />
    <img src="<?php //echo $this->webroot; ?>img/starimg.png" />
    <img src="<?php //echo $this->webroot; ?>img/starimg.png" />
    <img src="<?php //echo $this->webroot; ?>img/starblankimg.png" />-->

    <span><?php echo count($pinData['Review']); ?> Reviews</span>
</div>

<?php
if (!empty($pinData['Review'])) {
    foreach ($pinData['Review'] as $reviewRow) {
        //pr($reviewRow);
        ?>

        <div class="locationbuttomdiv_topfirst">
            <div class="locationbuttomdiv_topfirst_left">
                <div class="locationbuttomdiv_profileimg">
                    <?php
                            if (!empty($reviewRow['User']['image'])) {
                                ?>
                                <img src="<?php echo $this->webroot . "img/" ?>no_user.jpg" height="42px" width="42px;"/>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo $this->webroot . "img/" ?>no_user.jpg" height="42px" width="42px;"/>
                                <?php
                            }
                            ?>
                    <!--<img src="<?php //echo $this->webroot; ?>img/locationprofileimg1.png" />-->
                </div>
                <div class="locationbuttomdiv_profileinfo">
                    <div class="locationbuttomdiv_profileinfo_title"><?php echo $reviewRow['User']['first_name'] . " " . $reviewRow['User']['last_name']; ?></div>
                    <div class="locationbuttomdiv_profileinfo_text"><?php echo $reviewRow['description']; ?></div>
                </div>
            </div>
            <div class="locationbuttomdiv_topfirst_right">
                <div class="rate_<?php echo $reviewRow['rating']; ?>"></div>
            </div>
        </div>
        <?php
    }
} else {
    echo "New review on this pin";
}
?>

