<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 16/07/2015
 * @Time    : 10:28
 * @File    : show.php
 * @Version : 2.0
 */
?>
<div class="col-md-10 center">
    <h1><?= $news->titre ?></h1>
    <img src="<?= $news->logo; ?>" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10">
    <article>
        <p><?= $news->contenu ?></p>
    </article>

</div>

