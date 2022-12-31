<?php include './inc/header.php' ?>

    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
          <div class="col-lg-5">
            <div class="form-wrap border rounded p-4">
              <h1>Sign up</h1>
              <p>Please fill this form to register</p>
              <!-- form starts here -->
              <form action=""">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username">
                  <small class="text-danger"></small>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" name="email" id="email">
                  <small class="text-danger"></small>
                </div>
                <div class="mb-2">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                  <small class="text-danger"></small>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="togglePassword">
                  <label for="togglePassword" class="form-check-label">Show Password</label>
                </div>
                <div class="mb-3">
                  <input type="submit" class="btn btn-primary form-control" name="submit" value="Sign Up">
                </div>
                <p class="mb-0">Already have an account ? <a href="./login.php">Log In</a></p>
              </form>
              <!-- form ends here -->
            </div>
          </div>
        </div>
      </div>
      <script>
        let navSelector = document.querySelector("#nav-item-three")
        navSelector.className = "nav-item active";
      </script>
      <?php include './inc/footer.php' ?>