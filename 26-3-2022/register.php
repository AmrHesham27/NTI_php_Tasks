<?php
require_once './components/header.php';
require_once './components/navBar.php';

Auth::noLoggedInUser();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Writer = new Writer();
    $Writer->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm']);
};

?>

<div class="row col-sm-12 col-lg-6 mx-auto mt-5">
    <div class="form-holder">
        <div class="form-content">
            <div class="form-items text-center">
                <h3 class="mb-5">Register</h3>
                <form method="post" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>>
                    <div class="col-md-12 d-flex flex-column my-5">
                        <label>Name</label>
                        <input  type="text" name="name" placeholder="name" required>
                        <?php
                            Validation::echoError('name');
                        ?>
                    </div>

                    <div class="col-md-12 d-flex flex-column my-5">
                        <label>Email</label>
                        <input  type="email" name="email" placeholder="E-mail Address" required>
                        <?php
                            Validation::echoError('email');
                        ?>
                    </div>

                    <div class="col-md-12 d-flex flex-column my-5">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="password" required>
                        <?php
                            Validation::echoError('password');
                        ?>
                    </div>

                    <div class="col-md-12 d-flex flex-column my-5">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="confirm" placeholder="confirm password" required>
                        <?php
                            Validation::echoError('confirm');
                        ?>
                    </div>

                    <div class="form-button mt-3 d-flex">
                        <button id="submit" type="submit" class="button1 mx-auto my-3 btn btn-primary">Create Account</button>
                    </div>
                </form>
                <?php
                    include_once './components/mssg.php';
                ?>
            </div>
        </div>
    </div>
</div>