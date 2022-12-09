<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<style>
  figcaption.figure-caption {
    font-size: 1.2em;
  }
</style>
<div class="container mt-2">
  <div class="row">
    <div class="col-sm-4">
<?php snippet('show-phases') ?>
    </div>
    <div class="col-sm-8">
      <h2>Collaboration Points</h2>
      <p class="h1">
        <i class="bi bi-star"></i> 220
      </p>
      <?php snippet('show-blocks',['fieldName' => 'collaborationContent'])?>
      <div class="accordion accordion-flush" id="accordionCommentsAppreciations">
        <div class="accordion-item">
          <h2 class="accordion-comments" id="headingComments">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
              See Latest Comments <span class="badge text-bg-primary m-2">3</span>
            </button>
          </h2>
          <div id="collapseComments" class="accordion-collapse collapse" aria-labelledby="headingComments">
            <div class="accordion-body">
              <p class="p-1 border">
                <small>
                  <i class="bi bi-chat-fill"></i>
                  on your Commons Resource by
                  <a href="/other-team-page/?teamId=91">BioBoly</a>
                  <br>
                  <i class="bi bi-quote"></i>
                  <i>Very helpful website</i>
                  <i class="bi bi-three-dots"></i>
                </small>
              </p>
              <p class="p-1 border">
                <small>
                  <i class="bi bi-chat-fill"></i>
                  on your Commons Resource by
                  <a href="/other-team-page/?teamId=78">PedaCol1</a>
                  <br>
                  <i class="bi bi-quote"></i>
                  <i>I liked so much the </i>
                  <i class="bi bi-three-dots"></i>
                </small>
              </p>
              <p class="p-1 border">
                <small>
                  <i class="bi bi-chat-fill"></i>
                  on your Commons Resource by
                  <a href="/other-team-page/?teamId=78">PedaCol1</a>
                  <br>
                  <i class="bi bi-quote"></i>
                  <i>It’s very helpfull</i>
                  <i class="bi bi-three-dots"></i>
                </small>
              </p>
              <a href="https://natent.eu/en/view-all-comments-received/" class="btn btn-sm btn-secondary">View all
                Comments received</a>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-appreciations" id="headingAppreciations">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseAppreciations" aria-expanded="false" aria-controls="collapseAppreciations">
                See Latest Appreciations<span class="badge text-bg-primary m-2">3</span>
              </button>
            </h2>
            <div id="collapseAppreciations" class="accordion-collapse collapse" aria-labelledby="headingAppreciations">
              <div class="accordion-body">
                <p class="p-1 border">
                  <small>
                    <i class="bi bi-stars"></i>
                    of your Team Challenge by
                    <a href="/other-team-page/?teamId=117">Eichhörnchen</a>
                  </small>
                </p>
                <p class="p-1 border">
                  <small>
                    <i class="bi bi-stars"></i>
                    of your Commons Resource by
                    <a href="/other-team-page/?teamId=65">Refkoll 1</a>
                  </small>
                </p>
                <p class="p-1 border">
                  <small>
                    <i class="bi bi-stars"></i>
                    of your Function by
                    <a href="/other-team-page/?teamId=78">PedaCol1</a>
                  </small>
                </p>
                <a href="https://natent.eu/en/view-all-comments-received/" class="btn btn-sm btn-secondary">View
                  all
                  Appreciations received</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <h2>Have a look around!</h2>
      <p>You can always get back to your current Phase by clicking on the RESUME YOUR LEARNING button</p>
      <h3>
        <i class="bi bi-person-heart"></i>TEAM PAGE
      </h3>
      <p>View how your team is getting on</p>
      <h3>
        <i class="bi bi-search-heart"></i>OTHER TEAMS
      </h3>
      <p>Browse other teams pages to get ideas and appreciate their work</p>
      <h3>
        <i class="bi bi-cc-circle-fill"></i>CREATIVE COMMONS
      </h3>
      <p>Find useful resources</p>
    </div>
  </div>
</div>
<?php snippet('footer') ?>