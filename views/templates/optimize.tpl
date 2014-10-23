<?php use oat\tao\helpers\Template as _tpl;?>
<!-- <link rel="stylesheet" href="<?=_tpl::css('optimize.css', 'tao')?>" type="text/css" /> -->

<header class="section-header flex-container-full">
    <h2><?=__("TAO optimizer")?></h2>
</header>

<div class="flex-container-main-form main-container">
    <p><?= __("Classes and their associated data can be stored in two different modes.")?></p>
    <ul>
        <li>
            <strong><?=__("Design Mode:")?></strong> <?=__("suitable for data modeling (default mode).")?>
        </li>
        <li>
            <strong><?=__("Production Mode:")?></strong> <?=__("recommended for maximum performance e.g. once your data model is stable.")?>
        </li>
    </ul>
    <div class="feedback-warning">
        <strong><?=__("Warning:")?></strong> <?=__("make sure to back up your data before changing modes.")?>
    </div>
    <div id="compilation-recompile-button-container">
            <input type="button" class="btn-warning" value="<?=__("Switch to Production Mode")?>" id="compileButton"/>
            <input type="button" class="btn-warning" value="<?=__("Switch to Design Mode")?>" id="decompileButton"/>
    </div>

</div>
<div class="data-container-wrapper flex-container-remaining">
    <div id="compilation-grid-container">
            <div id="compilation-table-container">
                    <table id="compilation-grid" class="matrix"/>
            </div>
    </div>

    <div id="compilation-grid-results" class="ext-home-container ui-state-highlight"/>
</div>
