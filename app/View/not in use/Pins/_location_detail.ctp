<?php //prd($pinData);?>
<div class="aboutusmain">
	<div class="aboutusmain_top">
       <div class="container">
    <div class="col-md-12 aboutusmain_top_title">Location  Detail </div>
  </div> 
    </div>
	<div class="faqbuttom">
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
          
        
          
        <div class="col-md-7 col-sm-6 col-xs-12 premimum_pad reslocationleft">
           <div class="permium_left" >
              <div class="locationform">
                <form action="" method="">
                    <div class="locationforminput"><input type="text" class="locationtextbox" value="<?php echo $pinData["Pin"]["name"]; ?>" readonly/></div>
                  <div class="locationforminput"><input type="text"  class="locationtextbox" value="<?php echo $pinData["Pin"]["address"]; ?>" readonly/></div>
                  <div class="locationforminput">
                    <button type="button" class="locationformbutton locationformbutton_hover" style="width:100%"><?php echo $pinData["Sport"]["name"]; ?></button>
                    
                  </div>
                  <div class="locationtablediv">
                   <div class="table-responsive">
                    <table class="table  table-striped locationtable">
                      <thead>
                        <tr>
                          <th>Day</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th class="locationtabledivcenter">Closed</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Monday</td>
                          <td><?php echo $pinData["Pin"]["mon_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["mon_end"]; ?></td>
                          <td>
                            <div class="locationcheckdiv">
                                <input id="c1" class="signup_check" type="checkbox" name="cc1" onclick="return false;" <?php echo ($pinData["Pin"]["mon_isclosed"] == "1") ? "checked" : ""; ?> />
                                <label for="c1">
                                <span></span>
                                </label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Tuesday</td>
                          <td><?php echo $pinData["Pin"]["tue_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["tue_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c2" class="signup_check" type="checkbox" name="cc2" onclick="return false;" <?php echo ($pinData["Pin"]["tue_isclosed"] == "1") ? "checked" : ""; ?> >
                            <label for="c2">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                        <tr>
                          <td>Wednesday</td>
                          <td><?php echo $pinData["Pin"]["wed_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["wed_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c3" class="signup_check" type="checkbox" name="cc3" onclick="return false;" <?php echo ($pinData["Pin"]["wed_isclosed"] == "1") ? "checked" : ""; ?> >
                            <label for="c3">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                        <tr>
                          <td>Thursday</td>
                          <td><?php echo $pinData["Pin"]["thu_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["thu_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c4" class="signup_check" type="checkbox" name="cc4" onclick="return false;" <?php echo ($pinData["Pin"]["thu_isclosed"] == "1") ? "checked" : ""; ?> >
                            <label for="c4">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                        <tr>
                          <td>Friday</td>
                          <td><?php echo $pinData["Pin"]["fri_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["fri_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c5" class="signup_check" type="checkbox" name="cc5" onclick="return false;" <?php echo ($pinData["Pin"]["fri_isclosed"] == "1") ? "checked" : ""; ?> >
                            <label for="c5">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                        <tr>
                          <td>Saturday</td>
                          <td><?php echo $pinData["Pin"]["sat_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["sat_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c6" class="signup_check" type="checkbox" name="cc6" onclick="return false;" <?php echo ($pinData["Pin"]["sat_isclosed"] == "1") ? "checked" : ""; ?> >
                            <label for="c6">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                        <tr>
                          <td>Sunday</td>
                          <td><?php echo $pinData["Pin"]["sun_start"]; ?></td>
                          <td><?php echo $pinData["Pin"]["sun_end"]; ?></td>
                          <td><div class="locationcheckdiv">
                            <input id="c7" class="signup_check" type="checkbox" name="cc7" onclick="return false;" <?php echo ($pinData["Pin"]["sun_isclosed"] == "1") ? "checked" : ""; ?>>
                            <label for="c7">
                            <span></span>
                            </label>
                          </div></td>
                        </tr>
                      </tbody>
                    </table>
                   </div>
                  </div>
                  <div class="locationforminput"><input type="text" class="locationtextbox" value="<?php echo $pinData["Pin"]["email"];?>" readonly /></div>
                  <div class="locationforminput">
                    <div class="locationforminputleft"><input type="text" class="locationtextbox" value="<?php echo $pinData["Pin"]["price"];?>" readonly/></div>
                    <div class="locationforminputright"><input type="text" class="locationtextbox" value="<?php echo $pinData["Pin"]["phone"];?>" readonly/></div>
                  </div>
                </form>
              </div>
              <div class="eventleftfirst">
                            <div class="people">
                              <div class="persun">7 people</div>
                                  <div class="three">
                                      <div class="yes">YES</div>
                                      <div class="yes">NO</div>
                                      <div class="may">MAY BE</div>
                                      <div class="join">JOIN</div>
                                  </div>
                          </div>
                            <div class="te">
                                  <div class="eventleftfirstdiv_line">
                                     
                                     New South Wales
                                   </div>
                                   <div class="eventdate">
                                  <img src="<?php echo $this->webroot;?>img/bag.png"/> 31 Oct, 2014
                                   </div>
                                   <div class="eventleftfirsttext">Cras non ipsum rutrum, porttitor 
                                   justo a, pretium elit...</div>
                             </div>
                            <div class="eventleftfirstimg"><img src="<?php echo $this->webroot;?>img/Untitled-2.png"/></div>       
                          </div>
              <div class="eventleftfirst">
                            <div class="people">
                              <div class="persun">7 people</div>
                                  <div class="three">
                                      <div class="yes">YES</div>
                                      <div class="yes">NO</div>
                                      <div class="may">MAY BE</div>
                                      <div class="join">JOIN</div>
                                  </div>
                          </div>
                            <div class="te">
                                  <div class="eventleftfirstdiv_line">
                                     
                                     New South Wales
                                   </div>
                                   <div class="eventdate">
                                  <img src="<?php echo $this->webroot;?>img/bag.png"/> 31 Oct, 2014
                                   </div>
                                   <div class="eventleftfirsttext">Cras non ipsum rutrum, porttitor 
                                   justo a, pretium elit...</div>
                             </div>
                            <div class="eventleftfirstimg"><img src="<?php echo $this->webroot;?>img/Untitled-2.png"/></div>       
                          </div>
              <div class="eventleftfirst">
                            <div class="people">
                              <div class="persun">7 people</div>
                                  <div class="three">
                                      <div class="yes">YES</div>
                                      <div class="yes">NO</div>
                                      <div class="may">MAY BE</div>
                                      <div class="join">JOIN</div>
                                  </div>
                          </div>
                            <div class="te">
                                  <div class="eventleftfirstdiv_line">
                                     
                                     New South Wales
                                   </div>
                                   <div class="eventdate">
                                  <img src="<?php echo $this->webroot;?>img/bag.png"/> 31 Oct, 2014
                                   </div>
                                   <div class="eventleftfirsttext">Cras non ipsum rutrum, porttitor 
                                   justo a, pretium elit...</div>
                             </div>
                            <div class="eventleftfirstimg"><img src="<?php echo $this->webroot;?>img/Untitled-2.png"/></div>       
                          </div>
              <div class="eventleftfirst">
                            <div class="people">
                              <div class="persun">7 people</div>
                                  <div class="three">
                                      <div class="yes">YES</div>
                                      <div class="yes">NO</div>
                                      <div class="may">MAY BE</div>
                                      <div class="join">JOIN</div>
                                  </div>
                          </div>
                            <div class="te">
                                  <div class="eventleftfirstdiv_line">
                                    
                                     New South Wales
                                   </div>
                                   <div class="eventdate">
                                  <img src="<?php echo $this->webroot;?>img/bag.png"/> 31 Oct, 2014
                                   </div>
                                   <div class="eventleftfirsttext">Cras non ipsum rutrum, porttitor 
                                   justo a, pretium elit...</div>
                                   <div class="locationfav"><span><img src="<?php echo $this->webroot;?>img/localstarimg.png" /></span>Favorite</div>
                             </div>
                            <div class="eventleftfirstimg"><img src="<?php echo $this->webroot;?>img/Untitled-2.png"/></div>       
                          </div>
                                                              
           </div>
        </div>
        <div class="col-md-5 col-sm-6 col-xs-12 premimum_pad2 reslocationright">
          <div class="shop_right">
              <div class="locationtopimg">
                  <?php
                        $imgArr = explode(",",$pinData["Pin"]["image"]);    
                        $imageName = $imgArr[0] ;
                        
                        $url_imgResize = $this->webroot.'image.php?image=';
                        $user_image = $url_imgResize.'img/no_user.jpg&width=464&height=266';
                        if (!empty($pinData["Pin"]["image"])) {
                            $user_image = $url_imgResize.'files/pins/'.$imageName.'&width=464&height=266';
                        }

                    ?>
                  <a href="<?php echo $this->webroot."files/pins/".$imageName;?>" class="fancy" >
                      <img src="<?php echo $user_image;?>" />
                  </a>
                  
              </div>
            	<div class="shoprightslider">
                    
                        <?php 
                            if( count($imgArr) > 0 ){
                                ?>
                                    <div id="slider1">
                                        <a class="buttons prev" href="#"><img src="<?php echo $this->webroot;?>img/Shopleftarrow.png" /></a>
                                        <div class="viewport slider2height">
                                            <ul class="overview slider2">
                                                <?php                                                
                                                    for( $i = 0 ;$i < count($imgArr) ;$i++ ){                                                        
                                                        ?>
                                                        <li><img style="width:92px;height:92px;" src="<?php echo $this->webroot.'files/pins/'.$imgArr[$i];?>" /></li>                                                        
                                                        <?php
                                                    }
                                                ?>                                                
                                            </ul>
                                        </div>
                                        <a class="buttons next" href="#"><img src="<?php echo $this->webroot;?>img/Shoprigtarrow.png" /></a>
                                    </div>
                                <?php
                            }
                        ?>
                    
                        </div>
                <div class="locationmapdiv">
                  <div class="locationmap"  id="locationMapDiv" ></div>
                </div>        
            </div>
        </div>
        <div class="locationbuttomdiv">
          <?php echo $this->element("reviewdetail"); ?>
          <div class="locationbuttonouter">
              <div class="pinD">
                  <input type="hidden" id="storeshopid" name="storeshopid" value="<?php echo $pinData['Pin']['id']; ?>">
                  <button id="add-review-btn"  data-toggle="modal" data-target="#popup_add_review" class="locationbutton">add review</button>  
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
 <script>
        var jsonArr = <?php echo $jsonArr;?>;
        
        $(document).ready(function(){});
        /* MAP */
            
        var map;
        
        var markers = new Array();
        var infowindows = new Array();

        function initialize() {
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
          map = new google.maps.Map(document.getElementById("locationMapDiv"),mapOptions);
          createMarker();
        }

        function createMarker(){

             
            for( var i=0; i< jsonArr.length; i++ ){
                //console.log(jsonArr[i].position.lat); 

                var infowindow = new google.maps.InfoWindow();
                var content = jsonArr[i].content ;




                var marker = new google.maps.Marker({
                    position : new google.maps.LatLng(jsonArr[i].position.lat, jsonArr[i].position.lng),
                    map      : map,
                    title    : jsonArr[i].title,
                    icon     : jsonArr[i].icon            
                });
                markers.push(marker);




               /* google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                    return function() {


                        infowindow.setContent(content);
                        infowindow.open(map,marker);


                    };
                })(marker,content,infowindow)); */

            }    


        }
        google.maps.event.addDomListener(window, 'load', initialize);
    $(".fancy").fancybox();
    </script>