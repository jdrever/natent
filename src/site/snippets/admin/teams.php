<form>
  <label>Country</label>
  <select>
    <option>UK</option>
  </select>
  <label>School</label>
  <select>
    <option>Example School</option>
  </select>
</form>

<div class="container m-2">
  <div class="row">
    <div class="col-6">
      <h4>Create a New Team</h4>

      <form method="post">
        <div class="mb-3">
          <label for="teamName" class="form-label">Team Name</label>
          <input type="text" class="form-control" id="teamName" name="teamName">
        </div>
        <div class="mb-3">
          <label for="teamPasword" class="form-label">Password</label>
          <input type="text" class="form-control" id="teamPassword" name="teamPassword" value="<?=$newPassword?>">
        </div>
        <button type="submit" class="btn btn-primary">CREATE TEAM</button>
      </form>
    </div>
    <div class="col-6">
      <h4>Existing Teams<h4>

    </div>
  </div>
</div>