<?php snippet('header') ?>
<div class="container my-4">
  <h1>Contact Us</h1>
  <p class="lead">
    You want to implement the Natural Entrepreneurs process and platform at your school? Interested in adapting the programme to higher or primary education with us?
  </p>
  <form action="#">
    <fieldset>
      <p class="required">All fields are required.</p>
      <ol class="list-unstyled">
        <li class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text"
                 name="name"
                 required="required"
                 aria-required="true"
                 class="form-control">
        </li>
        <li class="mb-3">
          <label for="name" class="form-label">School:</label>
          <input type="text"
                 name="school"
                 required="required"
                 aria-required="true"
                 class="form-control">
        </li>
        <li class="mb-3">
          <label for="name" class="form-label">Message:</label>
          <textarea class="form-control"></textarea>
        </li>
        <li class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email"
                 name="email"
                 required="required"
                 aria-required="true"
                 class="form-control">
        </li>
        <li class="submit-buttons">
          <input type="hidden"
                 id="subject"
                 name="subject"
                 value="Biomimicry Day Registration from Biolearn website">
          <input type="submit" value="Send" class="btn btn-lg btn-outline-secondary">
        </li>
      </ol>
    </fieldset>
  </form>
</div>
<?php snippet('footer') ?>