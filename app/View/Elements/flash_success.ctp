<!-- <div class="flashMessage flashSuccess">
    <div class="">
        <div class="alert alert-success">
            <a class="close" href="#" data-dismiss="alert">×</a>
            <strong>Success!</strong>
            <? echo __($message); ?>
        </div>
    </div>
</div> -->

<div class="alert alert-success alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
    <? echo __($message); ?>
    <!--<a class="alert-link" href="#">Alert Link</a>-->
</div>