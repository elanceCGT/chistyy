<div class="shop_right">
    <div class="lastcor">
        <?php //pr($shopData); ?>

        <input type="hidden" id="storeshopid" name="storeshopid" value="<?php echo $shopData['Pin']['id']; ?>">
        <div class="locationtopimg">
            <img src="<?php echo $this->webroot . "files/pins/" . $shopData['Pin']['image']; ?>" class="img-responsive" >
        </div>

        <div class="shoprightinput">
            <input type="text" readonly="" value="<?php
            if (isset($shopData['Pin']['name']) && !empty($shopData['Pin']['name'])) {
                echo $shopData['Pin']['name'];
            } else {
                echo "Shop Title";
            }
            ?>" placeholder="Puma Tokyo" class="shoprighttextbox">

        </div>

        <div class="shoprightinput">
            <input type="text" readonly="" value="<?php echo __($shopData['Pin']['address']); ?>" placeholder="Puma Tokyo" class="shoprighttextbox">
        </div>

        <div class="shoprightinput">
            <input type="text" readonly="" value="<?php echo __($shopData['Pin']['phone']); ?>" placeholder="Puma Tokyo" class="shoprighttextbox">

        </div>

        <?php if (!empty($currentUser) && $currentUser == $shopData['Pin']['user_id']) { ?>
            <div class="eventrightbutton" id="addproductOpen" data-target="#popup_addproduct" data-toggle="modal">Add Product</div>
        <?php } ?>

        <?php echo $this->element('review'); ?>

        <div class="eventrightbuouter">
            <button id="add-review-btn" data-toggle="modal" data-target="#popup_add_review" class="eventrightbutton">Add Review</button>                         
            <button class="eventrightbutton buttomargin" onclick="window.open('<?php echo addhttp($shopData['Pin']['shop_link']); ?>', '_blank')">Shop link</button>
        </div>

        <div class="shoprightbuttomviewdiv">
            <span ><img src="<?php echo $this->webroot . "img/" ?>shopviewarrow.png" /></span>
            <a href="<?php echo $this->Html->url(array('controller' => 'pins', 'action' => 'detail', $shopData['Pin']['id'])); ?>"  >View more...</a>
        </div>


    </div>
</div>


<?php
/*  function retrun right url
 *  20 Dec 2014
 */

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
?>
        