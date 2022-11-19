<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>


  <p>This is your first introduction to communicating with others on the platform.</p>
  <p>Here are simple ground rules:</p>
  <ul class="has-background" style="background-color:#f2e1d3">
    <li>Be respectful and friendly to others &#8211; remember that nature rewards cooperation and so do we.</li>
    <li>Don&#8217;t use anyone&#8217;s full name &#8211; respect their privacy and your own.</li>
  </ul>
  <p></p>
<div class="container bg-light p-3">
  <form class="form-inline" method="post" action="<?= $page->url() ?>"
    enctype="multipart/form-data">
    <input type="hidden" name="point" id="point" value="Profile">
    <label for="school-info" class="m-1">Tell us about your Team (don't share your names!):</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="description" name="description" rows="8"
      required>My team is formed of myself (Richard). I am the Director of Wild Awake, one of the partners behind the Natural Entrepreneurs programme. I've worked in nature-based learning for over 20 years and think I have a good understanding of how we can learn from nature. I think my key skills are in blue-sky thinking and making connections between seemingly different ideas and bringing them together. I'm definitely not a technical scientist but am adventerous in testing out new ideas.</textarea>
    <label for="form-check">Tell us what Skillsets your team have:</label>
    <div class="container">
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Biology" name="skills[]" id="skills" checked>
            <label class="form-check-label" for="skills">Biology</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Chemistry" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">Chemistry</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Physics" name="skills[]" id="skills" checked>
            <label class="form-check-label" for="skills">Physics</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Entrepreneurship" name="skills[]" id="skills"
              checked>
            <label class="form-check-label" for="skills">Entrepreneurship</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Business" name="skills[]" id="skills" checked>
            <label class="form-check-label" for="skills">Business</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Design" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">Design</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Art" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">Art</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Engineering" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">Engineering</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Digital - videos" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">
              Digital Communications
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Computing" name="skills[]" id="skills" checked>
            <label class="form-check-label" for="skills">
              Computing
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col border border-secondary bg-light p-2 m-1">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Photography" name="skills[]" id="skills">
            <label class="form-check-label" for="skills">
              Photography
            </label>
          </div>
        </div>
      </div>
    </div>
    <br>
    <?php snippet('guide-navigation', ['taskButton' =>$taskButton]) ?>
  </form>
</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
