<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 13:22
 * @File    : edit.php
 * @Version : 2.0
 */
?>
<h1 class="page-header"><?= $title ?></h1>

<form method="post" >
    <?= $form->input('titre', 'Titre de la news', ['class' => 'titre',  'onkeypress' => 'previHTML()',  'onkeyup' => 'previHTML()']); ?>
    <?= $form->input('logo', 'Image de présentation', ['class' => 'imageNews', 'onkeypress' => 'previHTML()', 'onkeyup' => 'previHTML()']); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea', 'class' => 'contenuHTML',  'onkeypress' => 'previHTML()',  'onkeyup' => 'previHTML()']); ?>
    <?= $form->submit('Sauvegarder'); ?>
</form>

<hr>
<div style="border:1px solid black; display:none" class="blockPrevi">
    <h2 style="text-align:center">Previsualisation</h2>
    <hr style="width:90%; border:1px solid black"><br>
    <div class="col-md-10 center">
        <h1 class="previTitre"></h1>
        <img alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10 previImage">
        <article class="previHTML">
        </article>
    </div>
</div>

<script>
    function previHTML() {
        var imageNews = $(".imageNews").val();
        var ContenuHTML = $(".contenuHTML").val();
        var titre = $(".titre").val();
        $(".previHTML").empty().append(ContenuHTML);
        $(".previTitre").empty().append(titre);
        $(".previImage").empty().attr("src", imageNews);
        $(".blockPrevi").show();
    }
</script>