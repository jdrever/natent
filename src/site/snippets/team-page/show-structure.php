<div class="container my-4">
    <?php snippet('team-page/phase-completion') ?>
 <?php if ($editTeam) :?>  
    <?php snippet('team-page/latest-comments') ?> 
<?php endif ?>
    <div class="row g-1">
        <div class="feature col p-3 m-2 bg-light border border-secondary">
            <h3><?=t("Team Profile")?></h3>
            <?php snippet('team-page/profile') ?>
            <?php snippet('team-page/location-map') ?>
        </div>
        <div class="feature col p-3 m-2 bg-light border border-secondary">
            <h3><?=t("Topic and Challenge selected")?></h3>
            <?php snippet('team-page/challenge') ?>
            <?php snippet('team-page/context') ?>
        </div>
    </div>
    <div class="row g-1">
        <div class="feature col p-3 m-2 bg-light  border border-secondary">
        <h3><?= t("Research Questions, Natural Strategies and Design Principles") ?></h3>
        <?php snippet('team-page/strategies') ?>
        </div>
    </div>
    <div class="row g-1">
        <div class="feature col p-3 m-2 bg-light  border border-secondary">
            <h3><?=t("Design Solution")?></h3>
            <?php snippet('team-page/design') ?>
        </div>
        <div class="feature col p-3 m-2 bg-light  border border-secondary">
            <h3><?=t("Measure")?></h3>
            <?php snippet('team-page/measure') ?>
        </div>
    </div>
    <div class="row g-1">
        <div class="feature col p-3 m-2 bg-light  border border-secondary">
            <?php snippet('team-page/pitch-video') ?>
        </div>
    </div>
    <div class="row g-1">
        <div class="feature col p-3 m-2 bg-light  border border-secondary">
        <?php snippet('team-page/commons-resources') ?>
        </div>
    </div>
</div>