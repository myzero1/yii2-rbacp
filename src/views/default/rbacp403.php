<?php
    $this->title = '403没有访问权限（403 forbidden）';

    \myzero1\rbacp\assets\RbacpAsset::register($this);
?>

<div class="page-error-wrap">
    <div class="page-error-conent">
        <div class="page-error-left">
            <div class="page-error-icon">
                <i class="fa fa-hand-stop-o page-error-icon-conent"></i>
            </div>
        </div>
        <div class="page-error-right">
            <div class="page-error-right-conent">
                <div class="page-error-title">
                    403
                </div>
                <div class="page-error-subtitle">
                    FORBIDDEN
                </div>
                <div class="page-error-subtitle2">
                    没有访问权限
                </div>
            </div>
        </div>
    </div>
</div>