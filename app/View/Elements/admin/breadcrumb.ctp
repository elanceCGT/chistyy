<?php
    $dataArray = array('Listings' => $Listings);
    //prd($Listings);
    if(isset($Listings) && !empty($Listings)){ $cnt = count($Listings)-1; ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?php echo $Listings[$cnt]['heading']  ?></h2>

                <ol class="breadcrumb">

                    <?php foreach($Listings as $k=>$list) { 
                        if($cnt==$k){
                            $class="active";
                        } else {
                            $class="";
                        } ?>
                        <li class="<?php echo $class ?>"> 
                            <a href="<?php echo $this->Html->url(array('controller'=>$list['controller'],'action'=>$list['action'])); ?>">
                                <?php if($class=='active'){ ?>
                                <strong>
                                <?php } ?>
                                    <?php echo $list['heading']  ?>
                                <?php if($class=='active'){ ?>
                                </strong>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ol>
        </div>
        <div class="col-lg-2"> </div>
    </div>


<?php } ?>
