<?php // echo $this->element('admin/breadcrumb',array('Listings'=>$Listings)); ?>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
                    
                    <?php
						echo $this->Form->create('TeamMember' ,array("class" => "form-horizontal formAdmin"));
                        
                        echo $this->Form->input( 'image',array('type' => 'hidden')) ; 
					?>
                        
                        <div class="form-group <?php echo $this->Form->isFieldError('name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('name',array('type' => 'text','placeholder' => 'Name','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
							    ?>
                                
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('name_jpn') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Name JPN</label>
                            
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('name_jpn',array('type' => 'text','placeholder' => 'Name JPN','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
                                 ?>
                            </div>
                            
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('email') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('designation',array('type' => 'text','placeholder' => 'Email','class'=>'form-control','label' => false,'div' => false,

                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 
                                    //echo "<span class='control-label'>".$this->Form->error('lname')."</span>";

                                 ?>
                            </div>
                        </div>




                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('designation_jpn') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Designation JPN</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('designation_jpn',array('type' => 'text',  'placeholder' => 'Designation JPN','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
                                    //echo "<span class='control-label'>".$this->Form->error('password')."</span>";
							    ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">  
                                <?php
                                   $imgPathBig =  $this->webroot."files/our_team/".$this->request->data["TeamMember"]["image"]."?t=".time();
                                ?>
                                <img src="<?php echo $imgPathBig;?>" id="UserImages" alt="Responsive image" class="rnd" />                                
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>



                    <?php
						echo $this->Form->end();
					?>
                </div>
                    
                <!-- </div> -->
            </div>
        
            
            
        </div>
    </div>
</div>


<!-- POP UP HTML START-->
<?php
    echo $this->html->css(
            array(
                    'admin/crop_image/jquery.Jcrop',
                    'admin/crop_image/jcrop_main',
            )
         );
    echo $this->html->script(array(
            'admin/crop_image/jquery.Jcrop',
            'admin/crop_image/jcrop_main_ourteam',
            'admin/ajaxupload.3.5',            
        ));
?>
<style >
.img_div {
    border: 1px solid #CCCCCC;
    height: 170px;
    margin: 26px auto;
    overflow: hidden;
    width: 170px;
}
.rnd{
    border-radius: 50%;
}
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="myCloseBtn" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Crop Image</h4>
      </div>
      <div class="modal-body">
            <!--INNER CONTENT START-->
            <div style="float:left;min-width:329px;height:300px; margin-left:30px;" >
                <img  id="cropbox1" style="width:400px;height:300px;" src=""  />
            </div>
            <div style="box-shadow: none; "class="img_div rnd" >                                                    
                <img id="preview" src="" />
            </div>
            <div class="clearDiv" style="height:39px;"></div>
            <div>
                <button class="btn btn-primary" name="cropImgBtn" title="Crop & save" id="cropImgBtn" type="button" onclick="setCropImg()"> 
                    Crop & save
                </button>
            </div>
            

            <!--HIDDEN FORM START-->
            <div style="display:none" >
                    <div style="margin:5px;">
                        <?php echo $this->Form->create('image',array('enctype' => 'multipart/form-data'));
                              echo $this->Form->input('mycode',array('type'=>'text','id'=>'mycode','label' => false,'div' => false,'required' => false));
                        ?>
                        <label>X1 
                            <?php echo $this->Form->input('x',array('type'=>'text','id'=>'x', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                        </label>
                        <label>Y1 
                            <?php echo $this->Form->input('y',array('type'=>'text','id'=>'y', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                             
                        <label>X2 
                            <?php echo $this->Form->input('x2',array('type'=>'text','id'=>'x2', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                        </label>
                        <label>Y2 
                            <?php echo $this->Form->input('y2',array('type'=>'text','id'=>'y2', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                        </label>
                        <label>W 
                            <?php echo $this->Form->input('w',array('type'=>'text','id'=>'w', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                        </label>
                        <label>H 
                            <?php echo $this->Form->input('h',array('type'=>'text','id'=>'h', 'label' => false,'div' => false,'required' => false,'size' => '4')); ?>
                            <?php echo $this->Form->end();?> 
                        </label>
                    </div>
                </div>
            
            <div style="clear:both;"></div>
            <!---HIDDEN FORM END->
            <!--OUTER CONTENT END-->
      </div>
      <?php
      /*<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>*/
      ?>

    </div>
  </div>
</div>
<!-- POP UP END -->
<script type="text/javascript">
    
var PathUrl = "<?php echo $this->webroot; ?>";

$(document).ready(function(){
    
    var btnUpload=$("#UserImages");
    
    new AjaxUpload(btnUpload, {
        action: '<?php echo $this->Html->url( array("admin"=>true,"controller" => "images", "action" => "admin_uploadteam"));?>',
        
        name: 'uploadfile',         
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                // extension is not allowed 
                alert('Only JPG, PNG or GIF files are allowed');
                return false;
            }
             
            // $('#loading-image').fadeIn();
        },
        onComplete: function(file, response){
           // console.log(response);
           //thumb_836266151_1418728523.jpg|t=1418728523~~~400@@250
          
            
            var imageNameArr  = response.split("~~~");
            var imageName1    = imageNameArr[0].split("|");;
            imageName         = imageName1[0];
            var sizeArr       = imageNameArr[1].split("@@");
            gWIDTH = sizeArr[0];
            gHEIGHT = sizeArr[1];
            if(gWIDTH < 200 && gHEIGHT < 220 ){
                 alert("Please provide image of size Greater than 200 X 220 pixels.");
                 $('#loading-image').fadeOut();
                return false;
            }
            $("#cropbox1").css('width',gWIDTH+"px");
            $("#cropbox1").css('height',gHEIGHT+"px");
            $("#cropbox1,#preview").attr("rel",imageName+"");
            $("#cropbox1,#preview").attr("src",PathUrl+'files/our_team/temp/'+imageName);
            setTimeout("initializingCrop()",1000);  
            $("#myModal").modal("show");
            
    
    
        }
    });
    
});
function setCropImg(){
    //$('#image_sub').show();
    //$('#cropImgBtn').attr('disabled','disabled');
    /* var styles = {
                    background : "linear-gradient(to bottom, #999999, #6c6c6c) repeat scroll 0 0 #999999",
                    border: "1px solid #999999",
                    boxShadow :"none",                    
                };
    */
    //$('#cropImgBtn').css(styles);
    var pstyle=$("#preview").attr("style");
    var psrc = $("#preview").attr("src");
    //var opt = {"style" :pstyle,"src" :psrc};
    var opt = {"src" :psrc};
    $("#UserImages").attr(opt);
    
    //if(is_adminimg == 1){
    //    window.parent.$("#left_panelimg").attr(opt);
    //}
    setMyCode($("#cropbox1").attr("rel"));
}
  
function setMyCode(mySrc){
        $("#mycode").val(mySrc);
        var mycode   = $("#mycode").val() ;
        var x        = $("#x").val() ;
        var y        = $("#y").val() ;
        var x2       = $("#x2").val() ;
        var y2       = $("#y2").val() ;
        var w        = $("#w").val() ;
        var h        = $("#h").val() ;
        $.ajax({
            type: "POST",
            async : false,
            url : '<?php echo $this->Html->url(array("admin"=>true,"controller" => "images","action" => "admin_save_our_team"));?>',
            data : { mycode : mycode,x:x,y:y,x2:x2,y2:y2,w:w,h:h },
            success : function(retData){
                   //alert(retData);
                   var s = "<?php echo $this->webroot.'files/our_team/';?>"+retData;
                   $("#UserImages").attr("src",s);
                   $("#TeamMemberImage").val(retData);
                   //$("#UserImages").attr("style","");
                   //$("#myCloseBtn").trigger("click");
                   $("#myModal").modal("hide");
                
            },
            error : function(){
                alert("Error occured while changing status.");
            } 
        });
        
        
    } 
</script>