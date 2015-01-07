<!-- <div class="flashMessage flashError">
    <div class="">
        <div class="alert alert-error">
            <a class="close" href="#" data-dismiss="alert">×</a>
            <strong>Error!</strong>
            <? echo __($message); ?>
        </div>
    </div>
</div> -->

<div class="alert alert-danger alert-dismissable" style="z-index:99999">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
        <? echo __($message); ?>
    <!--<a class="alert-link" href="#">Alert Link</a>-->
</div>