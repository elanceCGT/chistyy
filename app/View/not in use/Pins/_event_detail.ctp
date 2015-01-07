<?php  
    //prd($pinData["Pin"]);
    list($y,$m,$d) = explode("-",$pinData["Pin"]["event_date"]);
    $date = $d."-".$m."-".$y;
    
    
?>
<div class="aboutusmain">
  <div class="aboutusmain_top">
  <div class="container">
    <div class="aboutusmain_top_title">EVENT DETAILS</div>
  </div>
</div>
  <div class="aboutusmain_buttom">
     <div class="container">
         
         <div class="locationtop" >
            <div class="favoriet" onclick="alert('Location set as favorite.')">
                <span><img src="<?php echo $this->webroot;?>img/star.png"></span>
                FAVORITE 
            </div>
            <?php
                if($UserId ==  $pinData["Pin"]["user_id"] ){                    
                    ?>
                    <a href="<?php echo $this->Html->url(array("controller" => "pins", "action" => "edit",$pinData["Pin"]["id"]));?>" >
                        <div  class="favoriet" style="margin-right:10px" >Edit</div>
                    </a>
                    <?php                
                }
            ?>
        </div>
         
         
         
  	   <div class="event_cover_details">
  	<div class="event_details_left">
        <div class="eve_details_player_pic">
            <?php
            
                $imgArr = explode(",",$pinData["Pin"]["image"]);    
                $imageName = $imgArr[0] ;
                
                $url_imgResize = $this->webroot.'image.php?image=';
                $user_image = $url_imgResize.'img/no_user.jpg&width=468&height=315';
                if (!empty($pinData["Pin"]["image"])) {
                    $user_image = $url_imgResize.'files/pins/'.$imageName.'&width=468&height=315';
                }
            
            ?>
            <a href="<?php echo $this->webroot."files/pins/".$imageName;?>"  class="fancy" >
                <img  src="<?php echo $user_image;?>"/>
            </a>
        </div>
    	<div class="event_detail_textboxouter">
            <input type="text" class="event_detail_textbox1" placeholder="Lorem ipsum dolor sit amet" value="<?php echo $pinData["Pin"]["name"];?>"  readonly='readonly' />
        </div>
        
        <div class="event_detail_textboxouter">
            <input type="text" class="event_detail_textbox1" placeholder="Lorem ipsum dolor sit amet" value="<?php echo $pinData["Sport"]["name"];?>"  readonly='readonly' />
        </div>
        
        
        
        <div class="event_detail_textboxouter">
            <input type="text" class="event_detail_textbox1" placeholder="25-11-2014" readonly='readonly' value="<?php echo $date;?>" />
        </div>
        <div class="event_detail_textboxouter">
            <input type="text" class="event_detail_textbox1" placeholder="Lorem ipsum dolor" readonly='readonly' value='<?php echo $pinData["Pin"]["address"];?>' />
        </div>
        
        <div class="event_detail_textboxouter">
            <textarea type="text" class="event_detail_textbox4" placeholder="" readonly='readonly'  ><?php echo $pinData["Pin"]["description"];?></textarea>
        </div>
    </div> 
    <div class="event_details_right">
        
    	<div class="map_cover_eve_datils">
        
            <div class="map_cover_eve_datils" id="eventDetailMap"></div>

        </div>
        <div class="participat_main">
        	<div class=" Participants_people">
               <div class="three4">7 Participants</div>
                  <div class="three">
                  <div class="yes" onclick="alert('Thanks for joining this event.')">YES</div>
                  <div class="yes" onclick="alert('Thanks for your feedback.')" >NO</div>
                  <div class="eventdetailmay" onclick="alert('Thanks for your feedback.')">MAY BE</div>
                  <div class="join eventdetailjoinmargin" onclick="alert('Thanks for joining this event.')">JOIN</div>
                   <div id="main" class="eventdetailscroll">
                    <div class="nano">
                     <div class="overthrow nano-content ">
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/robat-14.png"/><span class="spanrobat">Robert Smith</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/sis-15.png"/><span class="spanrobat">Emily Fowler</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/bor-16.png"/><span class="spanrobat">Ethan Boyd</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/boris-17.png"/><span class="spanrobat">chloe Davis</span></div>
                       <div class="robat"><img src="<?php echo $this->webroot;?>img/robat-14.png"/><span class="spanrobat">Robert Smith</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/sis-15.png"/><span class="spanrobat">Emily Fowler</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/bor-16.png"/><span class="spanrobat">Ethan Boyd</span></div>
                      <div class="robat"><img src="<?php echo $this->webroot;?>img/boris-17.png"/><span class="spanrobat">chloe Davis</span></div>
                     </div>
                   </div>
                 </div>      
                </div>
             </div> 
             <div class="invite">
               <div class="invitetopdiv">
             	<div class="invent_text">Invite your friends</div>
                <div class="invitesociladiv">
             	<div class="event_details_facebok">
                	<div class="tetface">FACEBOOK</div>
                    <div class="num">15</div>
                    
                </div>
                <div class="event_details_twitter">
                	<div class="tetface">TWITTER</div>
                    <div class="num7">7</div>
                </div>
                </div>
              </div>  
                <div class="reviews_event_details">
                        	<div class="revipic_details"><img src="<?php echo $this->webroot;?>img/tanish-8.png"/></div>
                            <div class="revtex_details">
                            <div class="event_rightpanel_details">Tasmania</div> 
                            <div class="event_rightpanel_text_details">Cnr Northumberland Road & Olievenhout Avenue...</div>
                             </div>
                        </div> 
                <div class="reviews_event_details">
                        	<div class="revipic_details"><img src="<?php echo $this->webroot;?>img/Layer2-10.png"/></div>
                            <div class="revtex_details">
                            <div class="event_rightpanel_details">Queensland</div> 
                            <div class="event_rightpanel_text_details">Cnr Northumberland Road & Olievenhout Avenue...</div>
                             </div>
                        </div>
                <div class="reviews_event_details">
                        	<div class="revipic_details"><img src="<?php echo $this->webroot;?>img/tanish-8.png"/></div>
                            <div class="revtex_details">
                            <div class="event_rightpanel_details">Tasmania</div> 
                            <div class="event_rightpanel_text_details">Cnr Northumberland Road & Olievenhout Avenue...</div>
                             </div>
                        </div>
                        <div class="reviews_event_details">
                        	<div class="revipic_details"><img src="<?php echo $this->webroot;?>img/Layer4-11.png"/></div>
                            <div class="revtex_details">
                                <div class="event_rightpanel_details">Victoria</div> 
                                <div class="event_rightpanel_text_details ">Cnr Northumberland Road & Olievenhout Avenue...</div>
                            </div>
                        </div>                
             </div> 
        </div>
      </div>
    </div>    
    </div>
   </div>
</div>
<?php

    $markerArray = array(
        array(
            "content"   => '<div class="eventleftfirst">
                            <div class="people">
                              <div class="persun">7 people</div>
                                  <div class="three">
                                      <div class="yes">YES</div>
                                      <div class="yes resright">NO</div>
                                      <div class="may">MAY BE</div>
                                      <div class="join">JOIN</div>
                                  </div>
                          </div>
                            <div class="te">
                                  <div class="eventleftfirstdiv_line">
                                     <a href="javascript:void()" class="infotext">more Info</a>
                                     New South Wales
                                   </div>
                                   <div class="eventdate">
                                  <img src="'.$this->webroot.'img/bag.png"/> 31 Oct, 2014
                                   </div>
                                   <div class="eventleftfirsttext">Cras non ipsum rutrum, porttitor 
                                   justo a, pretium elit...</div>
                             </div>
                            <div class="eventleftfirstimg"><img src="'.$this->webroot.'img/Untitled-2.png"/></div>       
                          </div>',
            "position"  => array(
                "lat" => $pinData["Pin"]["lat"],
                "lng" => $pinData["Pin"]["long"]
            ),
            "title"     => "Event",
            "icon"      => $this->webroot."img/map_icons/event-details.png"
        )
    );
    $jsonArr = json_encode($markerArray); 
    
    echo $this->Html->css(array('jquery.fancybox'));

	echo $this->Html->script(array('jquery.mousewheel-3.0.6.pack','jquery.fancybox.pack'));
    
?>
 
<script type="text/javascript">
    
var map;
var jsonArr  = <?php echo $jsonArr;?>;
var markers = new Array();
var infowindows = new Array();

function initialize() {
    //console.log(jsonArr[0].content)
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(jsonArr[0].position.lat, jsonArr[0].position.lng),
    mapTypeControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.RIGHT_CENTER,
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE]
    },
    panControl: true,
    panControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    },
    zoomControl: true,
    zoomControlOptions: {
        style: google.maps.ZoomControlStyle.LARGE,
        position: google.maps.ControlPosition.LEFT_CENTER
    },
    scaleControl: true,  // fixed to BOTTOM_RIGHT
    streetViewControl: true,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    }
  }
  map = new google.maps.Map(document.getElementById("eventDetailMap"),mapOptions);
  createMarker();
}

function createMarker(){
    for( var i=0; i< jsonArr.length; i++ ){
        //console.log(jsonArr); 
        
        var infowindow = new google.maps.InfoWindow();
        var content = jsonArr[i].content ;
        
        var marker = new google.maps.Marker({
            position : new google.maps.LatLng(jsonArr[i].position.lat, jsonArr[i].position.lng),
            map      : map,
            title    : jsonArr[i].title,
            icon     : jsonArr[i].icon            
        });
        markers.push(marker);
        /*
        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
            return function() {
               // infowindow.setContent(content);
                //infowindow.open(map,marker);
            };
        })(marker,content,infowindow)); */
    }    
    
}
google.maps.event.addDomListener(window, 'load', initialize);
$(".fancy").fancybox();
</script>
