<!doctype html>

<html lang="en">



    <head>



        <meta charset="utf-8" />

        <title>Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="Freight Transporter" name="description" />

        <meta content="Themesbrand" name="author" />

        <!-- App favicon -->

        <link rel="shortcut icon" href="assets/images/favicon.ico">



            <?php $this->load->view('partials/head-css') ?>



</head>





    <!-- <body data-layout="horizontal"> -->

        <body class="account-page">

        <!-- Main Wrapper -->

        <div class="main-wrapper login-body">

            <div class="login-wrapper">

                <div class="container">

                

                    <img class="img-fluid logo-dark mb-2" src="assets/img/logo-bericap.png" alt="Logo">

                    <div class="loginbox">

                        

                        <div class="login-right">

                            <div class="login-right-wrap">

                                <h1>Login</h1>

                                <p class="account-subtitle">Access to our dashboard</p>

                                <?php if($this->session->flashdata("msg")):?>

                                    <div class="alert alert-danger"><?php echo $this->session->flashdata("msg"); ?></div>

                                <?php endif;?>

                                <form action="<?php echo base_url();?>?/login_auth" method="post">

                                    <div class="form-group">

                                        <label class="form-control-label">Email Address /Username</label>

                                        <input type="text" name="email" class="form-control" >

                                    </div>

                                    <div class="form-group">

                                        <label class="form-control-label">Password</label>

                                        <div class="pass-group">

                                            <input type="password" name="password" class="form-control pass-input" >

                                            <span class="fas fa-eye toggle-password"></span>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="row">

                                            <div class="col-6">

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" id="cb1">

                                                    <label class="custom-control-label" for="cb1">Remember me</label>

                                                </div>

                                            </div>

                                            <div class="col-6 text-end">

                                                <a class="forgot-link" href="auth-recoverpw">Forgot Password ?</a>

                                            </div>

                                        </div>

                                    </div>

                                    <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>

                                    <div class="login-or">

                                        <span class="or-line"></span>

                                        <span class="span-or">or</span>

                                    </div>

                                    <!-- Social Login 

                                    <div class="social-login mb-3">

                                        <span>Login with</span>

                                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>

                                    </div>-->

                                    <!-- /Social Login -->

                                    <div class="text-center dont-have"><a href="<?php echo base_url()?>?/register">Register</a></div>

                                </form>

                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- /Main Wrapper -->





        <!-- JAVASCRIPT -->

       <?php $this->load->view('partials/vendor-scripts') ?>

       <script>

            setTimeout(function() {

                $('.alert').fadeOut('fast');

            }, 3000);

       </script>



    </body>



</html>