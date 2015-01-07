<div class="modal-dialog pinpopup">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 id="myModalLabel" class="modal-title pintext">add review</h4>
        </div>
        <div class="modal-body">
            <?php
            echo $this->Form->create('Review', array(
                'id' => 'AddReview',
                'method' => 'POST',
                'url' => array('controller' => 'reviews', 'action' => 'add'),
                'autocomplete' => 'off',
            ));

            echo $this->Form->hidden('pin_id', array('value' => $shop_id));
            ?>
            <input type="hidden" value="review" name="q">
            <div class="signinpopupinput">
                <?php 
                echo $this->Form->input('description',array(
                    'type' => 'textarea',
                    'required' => true,
                    'class' => 'signinpopupinputbox',
                    'label' => false,
                    'placeholder' => 'Review Description'
                )); 
                ?>
            </div>
            <div class="signinpopupinput">
                <div class="ratfont">Rating</div>
                <div class="basic" data-average="12" data="10_5" data-id="1"></div>
                <?php
                    echo $this->Form->input('rating',array('type'=>'hidden'));
                ?>
            </div>
            
<!--            <div class="starimages">
                <img src="<?php //echo $this->webroot . "img/" ?>starblankimg.png">
                <img src="<?php //echo $this->webroot . "img/" ?>starblankimg.png">
                <img src="<?php //echo $this->webroot . "img/" ?>starblankimg.png">
                <img src="<?php //echo $this->webroot . "img/" ?>starblankimg.png">
                <img src="<?php //echo $this->webroot . "img/" ?>starblankimg.png">
                <span>0/5</span></div>-->
            <div class="signinpopupinput">
                <div class="signinpopup_buttondin">
                    <button class="signinpopupregisterbutton" type="submit"><?php echo __('SUBMIT');?></button>
                    <button data-dismiss="modal" class="signinpopupcancelbutton">Cancel</button>
                </div>
            </div>
            <div class="clearfix"></div>
            </form> 
            <?php $this->Form->end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
 	$(".basic").jRating({
        length: 5,
        step: true,
        decimalLength: 0.5,
        callPhpfun: false,
        bigStarsPath: '<?php echo $this->webroot.IMAGES_URL."stars.png";?>', // path of the icon stars.png
        smallStarsPath: '<?php echo $this->webroot.IMAGES_URL."stars.png";?>', // path of the icon small.png
        onSuccess: function (){
            $("#ReviewRating").val(this.rateValue);
        }
    });
  });
</script>