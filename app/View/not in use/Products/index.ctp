<?php echo $this->Html->css('admin/font-awesome', array('inline' => FALSE)); ?>
<div class="aboutusmain">
    <div class="aboutusmain_top">
        <div class="container">
            <div class="col-md-12 aboutusmain_top_title">Product Listing</div>
        </div> 
    </div>
    <div class="faqbuttom">
        <div class="container">
            <div class="col-md-7 col-sm-6 col-xs-12 premimum_pad">
                <div class="permium_left" >
                    <?php
                    if (!empty($productData)) {
                        foreach ($productData as $productRow) {
                            //pr($productRow);
                            ?>   
                            <div class="premimum_leftfirst" id="<?php echo $productRow['Product']['pin_id'] ?>">
                                <div class="shop_leftfirstimg"><img src="<?php echo $this->webroot . "files/products/" . $productRow['Product']['image']; ?>" class="pro-index-img"></div>
                                <div class="shop_leftfirstrightcontet">
                                    <div class="shop_leftfirstrightcontetleft">
                                        <div class="shop_lefttitle"><?php echo __($productRow['Product']['name']); ?></div>
                                        <div class="premimum_leftfirsttext">
                                            <?php echo __($productRow['Product']['description']); ?>
                                        </div>
                                        <div class="actionbox">
                                        <?php
                                        if (!empty($currentUser) && $currentUser == $productRow['Product']['user_id']) {
                                            ?>
                                            <span title="Edit Product" class="editproductOpen pro-action" id="<?php echo $productRow['Product']['id']; ?>" data-target="#popup_addproduct" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span title="Delete Product" class="pro-action" onclick="delProduct('<?php echo $productRow['Product']['id']; ?>')">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>

                                    <div class="shop_leftbuttonouter">
                                        <button class="shop_leftbuttontop">$ <?php echo __($productRow['Product']['price']); ?></button>
                                        <a href="<?php echo addhttp( $productRow['Product']['link_url'] ); ?>" onclick="makeCount('<?php echo $productRow['Product']['id']; ?>')" class="shop_leftbuttontop shop_leftbuttonbuttom" target="_BLANK">Buy</button></a>

                                    </div>
                                </div>
                            </div> 

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <?php echo $this->render("_shop_info", false); ?>

        </div>

    </div>

</div>


<script>
    <?php if(isset($statusShop) && $statusShop==2){ ?>
    $('.premimum_leftfirst').click(function () {
        $('.premimum_leftfirst').removeClass('selected');
        $(this).toggleClass('selected');

        var pin_id = $(this).attr('id');

        $.ajax({
            url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "getpin")); ?>',
            type: "GET",
            data: {pin_id: pin_id},
            success: function (data) {
                //alert(data);
                $(".premimum_pad2").html(data);
            },
            error: function (xhr) {
                //ajaxErrorCallback(xhr);
            }
        });
    });
    <?php } ?>

    function delProduct(id) {
        if (confirm("Are you sure to delete the Product, Continue?")) {
            $.ajax({
                url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "delete")) ?>',
                type: 'POST',
                data: {id: id},
                success: function (data) {
                    try {
                        var pd = $.parseJSON(data);
                        if (pd.status == 0) {
                            alert(pd.msg);
                        } else {
                            window.location.reload();
                        }
                    } catch (e) {
                        window.console && console.log(e);
                    }
                },
                error: function (xhr) {
                    ajaxErrorCallback(xhr);
                }
            });
        }
    }
    
    function makeCount(id) {
        $.ajax({
                url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "hitcount")) ?>',
                type: 'POST',
                data: {id: id},
                success: function (data) {
                    try {
                        console.log(data);
                        var pd = $.parseJSON(data);
                        if (pd.status == 0) {
                            alert(pd.msg);
                        }
                    } catch (e) {
                        window.console && console.log(e);
                    }
                },
                error: function (xhr) {
                    ajaxErrorCallback(xhr);
                }
            });
    }
</script>
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