<?php include './inc/header.php' ?>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="form-wrap border rounded p-4">
                    <h1>Log In</h1>
                    <p>Please login to continue</p>
                    <form action="">
                        <div class="mb-3">
                            <label for="user_login" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" name="user_login" id="user_login" >
                            <!-- <small class="text-danger">log in failed</small> -->
                        </div>
                        <div class="mb-2">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="user_password">
                            <!-- <small class="text-danger">log in failed</small> -->
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="togglePassword">
                            <label for="togglePassword" class="form-check-label">Show Password</label>
                          </div>
                          <div class="mb-3">
                            <input type="submit" class="btn btn-primary form-control" name="submit" value="Log In">
                          </div>
                          <p class="mb-0">Don't have an account ? <a href="./register.php">Sign Up</a></p>
                        </form>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let navSelector = document.querySelector("#nav-item-three")
        navSelector.className = "nav-item active";
    </script>
    <?php include './inc/footer.php' ?>
