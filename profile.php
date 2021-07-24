<?php
    require("./includes/head.php");
?>

<div class="flex-content container">
  <div class="card" style="max-width: 300px;">
      <img src="https://via.placeholder.com/400x150.png?text=Your+Profile+Image" class="card-img-top" alt="profile picture">
      <div class="card-body">
          <div class="mb-2">
              <label class="form-label">Mail</label>
              <input type="text" class="form-control" disabled placeholder=<?php echo $_SESSION['email'] ?> aria-describedby="mail">
          </div>
          <div class="mb-2">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" disabled placeholder=<?php echo $_SESSION['name'] ?> aria-describedby="name">
          </div>
          <div class="mb-2">
              <label class="form-label">Surname</label>
              <input type="text" class="form-control" disabled placeholder=<?php echo $_SESSION['surname'] ?> aria-describedby="surname">
          </div>
      </div>
  </div>
</div>


<?php
    require("./includes/footer.php");
?>