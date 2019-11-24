<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 16/07/2015
 * @Time    : 10:24
 * @File    : index.php
 * @Version : 1.0
 */

foreach ($news as $new) :  ?>
    <div class="col-xs-6 col-sm-4 col-md-4">
        <div class="animated rotateInDownLeft">
            <div class="service-box">
                <div class="service-icon">
                    <span class="fa fa-music fa-2x"></span>
                </div>
                <div class="service-desc">
                    <h5><?= $new->titre; ?></h5>
                    <div class="divider-header"></div>
                    <p><?= $new->extrait; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php
endforeach;
?>
