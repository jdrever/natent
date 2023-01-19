<?php
use carefulcollab\helpers as helpers;
if ($adminLocation>0) :
?>



<ul class="nav nav-tabs" id="adminTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='add') ? ' active' : '' ?>" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab"
      aria-controls="add" aria-selected="<?=($selectedTab==='add') ? 'true' : 'false' ?>" ><?= t("Add a New Teacher","Add a New Teacher") ?></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='edit') ? ' active' : '' ?>" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab"
      aria-controls="edit"
      aria-selected="<?=($selectedTab==='edit') ? 'true' : 'false' ?>"><?= t("Editing an Existing Teacher", "Editing an Existing Teacher") ?></button>
  </li>
</ul>
<div class="tab-content" id="adminTabContent">
  <div class="tab-pane fade<?=$selectedTab==='add' ? ' show active' : ''?>" id="add" role="tabpanel" aria-labelledby="add-tab">
    <div class="container mt-2 mb-4 border bg-white p-3">
      <form method="post" id="createTeacherForm" name="createTeacherForm">
        <input type="hidden" id="action" name="action" value="CREATE-TEACHER">
        <input type="hidden" id="locationId" name="locationId" value="<?=$adminLocation?>">
        <div class="mb-3">
          <label for="teacherName" class="form-label">Teacher Name</label>
          <input type="text" class="form-control" id="teacherName" name="teacherName" aria-describedby="teacherNameHelp"
            required>
          <div id="teacherNameHelp" class="form-text"><span style="font-size: 1.2em;">Please <strong>don't use anyone's
                real names!</strong></span></div>
        </div>
        <div class="mb-3">
          <label for="teacherPasword" class="form-label">Password</label>
          <input type="text" class="form-control" id="teacherPassword" name="teacherPassword" value="<?=$newPassword?>"
            aria-describedby="passwordHelp" required readonly>
          <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;">You need to <strong>note this
                password down NOW</strong> - you won't get to see it again!</span></div>
        </div>
        <button type="submit" name="createTeacherButton" id="createTeacherButton" class="btn btn-primary">ADD TEACHER</button>
      </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="passwordModalLabel">Make a note of this password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            You need to note this password down NOW - you won't get to see it again!
            <br><br>
            Password: <?=$newPassword?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
            <button type="button" class="btn btn-primary" id="createTeacherModalButton" name="createTeacherModalButton">ADD TEACHER</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="tab-content" id="adminTabContent">
  <div class="tab-pane fade<?=($selectedTab==='edit') ? ' show active' : ''?>" id="edit" role="tabpanel" aria-labelledby="edit-tab">
    <table class="table m-2 p-2 border bg-white">
      <tr>
        <th><?= t("Teacher Name","Teacher Name") ?></th>
        <th><?= t("Reset Password To","Reset Password To") ?></th>
        <th><?= t("Remove","Remove") ?></th>
      </tr>

      <?php
    foreach ($teachers as $thisTeacher)
    {
      $newResetPassword=helpers\DataHelper::random_str(8);
    ?>
      <tr>
        <td>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="RENAME-TEACHER">
            <input type="text" id="teacherName" name="teacherName" value="<?= $thisTeacher['name'] ?>" required>
            <input type="hidden" id="teacherId" name="teacherId" value="<?= $thisTeacher['id'] ?>">
            <input type="hidden" id="oldTeacherName" name="oldTeacherName" value="<?= $thisTeacher['name'] ?>">
            <input type="submit" class="btn btn-primary" value="<?= t("RENAME","RENAME") ?>">
          </form>
        </td>
        <td>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="RESET-PASSWORD">
            <input type="text" id="password" name="password" value="<?= $newResetPassword ?>" required
              aria-describedby="passwordHelp" readonly>
            <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;"><strong>Note this password down NOW
                  before clicking RESET</strong></span></div>
            <input type="hidden" id="teacherName" name="teacherName" value="<?= $thisTeacher['name'] ?>">
            <input type="submit" class="btn btn-primary" value="<?= t("RESET","RESET") ?>">
          </form>
        </td>

        <td>
          <?php 
        if ($thisTeacher['id']==$team['id'])
        { ?>
          <div class="alert alert-info" role="alert">
            <?=t("You are currently logged in as this Teacher and therefore cannot remove it","You are currently logged in as this Teacher and therefore cannot remove it")?>.
          </div>
          <?php
        }
        else
        {
?>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="REMOVE-TEACHER">
            <div class="form-floating">
              <input type="text" class="form-control" name="teacherCheck<?= $thisTeacher['id'] ?>"
                id="teacherCheck<?= $thisTeacher['id'] ?>"
                placeholder="<?= t("Type the Teacher name to confirm","Type the Teacher name to confirm") ?>"
                aria-label="<?= t("Type the Teacher name to confirm","Type the Teacher name to confirm") ?>" required
                pattern="<?= $thisTeacher['name'] ?>">
              <label
                for="teacherCheck<?= $thisTeacher['id'] ?>"><?= t("Type the Teacher name to confirm","Type the Teacher name to confirm") ?></label>
            </div>
            <input type="hidden" id="teacherId" name="teacherId" value="<?= $thisTeacher['id'] ?>">
            <input type="hidden" id="teacherName" name="teacherName" value="<?= $thisTeacher['name'] ?>">
            <input type="submit" class="btn btn-danger"
              value="<?= t("REMOVE TEACHER AND ALL OF THEIR WORK","REMOVE TEACHER AND ALL OF THEIR WORK") ?>">
          </form>
          <?php
        }
        ?>
        </td>
      </tr>
      <?php
    }
    ?>
    </table>
  </div>
</div>

<script>
  let createTeacherButton = document.getElementById('createTeacherButton');
  let createTeacherForm = document.getElementById('createTeacherForm');
  let createTeacherModalButton = document.getElementById('createTeacherModalButton');
  const passwordModal = new bootstrap.Modal('#passwordModal');
  createTeacherButton.addEventListener('click', function(event) {
    passwordModal.show();
    event.preventDefault();
  });
  createTeacherModalButton.addEventListener('click', function(event) {
    // Check if valid using HTML5 checkValidity() builtin function
    if (createTeacherForm.checkValidity()) {
      console.log('valid');
      createTeacherForm.submit();
    } else {
      passwordModal.hide();
      createTeacherForm.reportValidity();
      console.log('not valid');
    }
  });
</script>
<?php endif ?>