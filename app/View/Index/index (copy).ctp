
<?php /*?>
<div class="content">
	<div class="map_div">
		<div class="homemapimg" id="myMapDiv"></div>
		<div class="home_header">
			<?php echo $this->element('header'); ?>
		</div>
		<div class="rightbox createPin"><?php echo __('CREATE YOUR PIN'); ?></div>
	</div>

	<div class="section_5">
		<div class="covdu">
			<div class="official"><?php echo $premierLeagueData["CmsPage"]["title"]; ?><!-- THE OFFICIAL FANTASY GAME OF </br> THE PREMIER LEAGUE --></div>
			<div class="tp">
                <?php
				$limit = 500;
				$premierLeagueData["CmsPage"]["description"] = $premierLeagueData["CmsPage"]["description"];
				if (strlen($premierLeagueData["CmsPage"]["description"]) > $limit)
				{
					$premierLeagueData["CmsPage"]["description"] = substr($premierLeagueData["CmsPage"]["description"], 0, $limit);
				}
				echo $premierLeagueData["CmsPage"]["description"];
				?>
            </div>
		</div>
	</div>

	<div class="section_3" id="aboutusDiv">
		<div class="coverdv">
			<div class="about"><?php echo $cmsPageData["CmsPage"]["title"]; ?></div>
			<div class="tex">                    
				<?php
				$limit = 500;
				$cmsPageData["CmsPage"]["description"] = strip_tags($cmsPageData["CmsPage"]["description"]);
				if (strlen($cmsPageData["CmsPage"]["description"]) > $limit){
					$cmsPageData["CmsPage"]["description"] = substr($cmsPageData["CmsPage"]["description"], 0, $limit);
				}
				echo $cmsPageData["CmsPage"]["description"];
				?>
			</div>
			<div class="clickbt" onclick="javascript:window.location = '<?php
			echo $this->Html->url(array("controller" => "aboutus"));
			?>'" >view more</div>
		</div>
	</div>

	<div class="section_4">
		<div class="covrdiv">
			<div class="title"><?php echo $ourTeamData["CmsPage"]["title"]; ?></div>
			<div class="tiltxe"><?php echo $ourTeamData["CmsPage"]["description"]; ?></div>
			<div class="photo">
				<?php
				foreach ($TeamMemberData as $k => $v){
					$cls = ($k == (count($TeamMemberData) - 1) ) ? "nomarginright" : "";
					?>
					<div class="propic <?php echo $cls; ?>">
						<div class="pic"><img class="imgCircle" src="<?php echo $this->webroot . "files/our_team/" . $v["TeamMember"]["image"]; ?>"/></div>
						<div class="name"><?php echo $v["TeamMember"][langField("name")];?></div>
						<div class="post">
							<?php
                                echo $v["TeamMember"][langField("designation")];
							?>  
						</div>
					</div>
					<?php
				}
				?>				

			</div>
		</div>
	</div>

	<div class="section_2" id="section_2">
        <div class="vedio_content">
        <div class="TTIL">LOREM  IPSUM  DOLOR  SIT AMET</div>
        
    
		<div class="play tubular-pause"><img src="<?php echo $this->webroot . "img/" ?>play.png"/></div>
        </div>
	</div>

	<div class="section_6">
		<div class="codu">
			<div class="titl">CONTACT US</div>
			<div class="titli">DMR Co.,Ltd.</div>
			<div class="add"><img src="<?php echo $this->webroot . "img/" ?>pins53.png"/>  HEAD OFFICE: MARUKI BLD.303, 1-13-7, NISHIGOTANDA, </br>SHINAGAWA-KU, TOKYO, 141-0031, JAPAN</div>
			<div class="add"><img src="<?php echo $this->webroot . "img/" ?>phone43.png"/>  TEL: +81-3-5759-5775</div>
			<div class="add "><img src="<?php echo $this->webroot . "img/" ?>printer11.png"/>  FAX: +81-3-5759-5774</div>
		</div>
	</div>
</div>

<script>
    $( document ).ready(function() {
        var yt_id = '<?php echo $ytId; ?>';
        if (!yt_id.trim()) {
            yt_id = 'DSLgAsrcpGQ';
        }
        console.log(yt_id);
        $('.vedio_content').tubular({
            videoId: yt_id,//2JnYcuRW_qo -- DSLgAsrcpGQ
            divid : 'section_2'
        });
    });
    
    $('.play').click(function(){
         $('.play').toggleClass('tubular-play');
         $('.play').toggleClass('tubular-pause');
         
        if($( '.play' ).hasClass( "tubular-play" )){
            $('.play').find('img').attr('src','<?php echo $this->webroot; ?>'+'img/pause.png');
        }else{
            $('.play').find('img').attr('src','<?php echo $this->webroot; ?>'+'img/play.png');
        }
    });
</script>

<?php
include_once '_map-js.ctp';

*/?>