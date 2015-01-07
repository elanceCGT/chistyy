<?php
    $reqData = $this->request->data;
    
    $title = "Add Product";
    $btnTitle = "Add";
    if(isset($reqData['Product']['id']) && !empty($reqData['Product']['id'])){
        $title = "Edit Product";
        $btnTitle = "Update";
    }
?>
<div class="modal-dialog pinpopup">
    <div class="modal-content">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 id="myModalLabel" class="modal-title pintext"><?php echo __($title); ?></h4>
      </div>
      <div class="modal-body">
        <?php
				echo $this->Form->create('Product', array(
					'id' => 'AddProduct',
					'method' => 'POST',
                    'type' => 'file',
					'url' => array('controller' => 'products', 'action' => 'add'),
					'autocomplete' => 'off',
				));
                
                if(isset($reqData['Product']['id']) && !empty($reqData['Product']['id'])){
                    echo $this->Form->hidden("id",array(
                        'value' => $reqData['Product']['id'],
                      ));
                    echo $this->Form->hidden("pin_id",array(
                        'value' => $reqData['Product']['pin_id'],
                      ));
                }else{
                    echo $this->Form->hidden("pin_id",array(
                        'value' => $pin_id,
                      ));
                }
        ?>
          
        <div class="pinpopupinput"> 
            <?php 
              echo $this->Form->input("name",array(
                  'label' => false,
                  'placeholder' => 'Product Name',
                  'class' => 'pinpopuptextbox',
                  'div' => array('class' => 'input_wrapper'),
                  'required' => true,
                ));
            ?>
          
        <div class="pinpopupinput"> 
<!--          <div class="pinpopup2inputimg"><img src="<?php //echo $this->webroot."img/"?>popupimg1.png"></div>
          <div class="pinpopup2inputext">Image Name1<span><img src="<?php //echo $this->webroot."img/"?>popupimgcrossimg.png"></span></div>-->
        </div>
        <div class="pinpopupinputprodt"> 
         <div class="popupbrowsemaindiv">
          <div id="path">Product Image</div>
          <div class="popupbrowsediv">
            <input type="file" name="data[Product][image]" id="browseimg2" class="browseimg">
            <!--<input id="ProductImage" class="pinpopuptextbox" type="file" required="required" placeholder="Image" name="data[Product][image]">-->
            Browse
          </div>
        </div>
        </div>
            
<!--        <div class="pinpopupinputprodt">  
            <?php 
//              echo $this->Form->input("image",array(
//                    'type' => 'file',
//                    'label' => false,
//                    'placeholder' => 'Image',
//                    'class' => 'pinpopuptextbox',
//                    'div' => array('class' => 'input_wrapper'),
//                    'required' => true,
//                ));
            ?>
        </div>-->
            
        
        <div class="pinpopupinput"> 
            <?php 
              echo $this->Form->input("description",array(
                    'type' => 'textarea',
                    'label' => false,
                    'placeholder' => 'Product Description',
                    'class' => 'pinpopuptextbox adddproducttextarea',
                    'div' => array('class' => 'input_wrapper'),
                    'required' => true,
                ));
            ?>
        </div>
        <div class="pinpopupinput"> 
            <?php 
              echo $this->Form->input("price",array(
                    'label' => false,
                    'placeholder' => 'Add Price',
                    'class' => 'pinpopuptextbox',
                    'div' => array('class' => 'input_wrapper'),
                    'required' => true,
                ));
            ?>
        </div>

        <div class="pinpopupinput"> 
            <?php 
              echo $this->Form->input("link_url",array(
                    'label' => false,
                    'placeholder' => 'Link URL',
                    'class' => 'pinpopuptextbox',
                    'div' => array('class' => 'input_wrapper'),
                    'required' => true,
                ));
            ?>
        </div>
          
        <div class="addproductpopup_buttondin">
           <button class="signinpopupregisterbutton"><?php echo __($btnTitle); ?></button>
           <button type="button" class="signinpopupcancelbutton" onclick="goBack();">Cancle</button>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
    
<script type="text/javascript">
    function goBack() {
        $("#popup_addproduct").modal('hide');
    }
</script>