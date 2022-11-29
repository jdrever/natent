<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php 



foreach ($areas as $area) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/SDGs/<?=$area['id'] . $imageFileEnding ?>" alt="<?=$area['name']?>">
                    <div class="card-body">
                        <p class="card-text"><strong><?=pll__(trim($area['name']))?></strong><br /><?=pll__(trim($area['description']))?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="<?=$challengePage ?>/?areaId=<?=$area['id'] ?>" 
                                    class="btn btn-sm btn-primary float-end"><?=pll__("SELECT THIS TOPIC")?> &#8594;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

