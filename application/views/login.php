<!DOCTYPE html>
<html lang="en">

<head>
	<?php include(APPPATH.'views/templates/header.php'); ?>
</head>
<body class="pace-top">

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-container">

        <!--bg-cover-->
        <div class="bg-cover">
            <img src="<?= base_url('assets/img/background/loginpage.jpg'); ?>" alt="" style="height:100%; width:100%;">
        </div>
	    <!-- begin login -->
		<div class="login">
		    <!-- begin login-brand -->
            <div class="login-brand bg-danger text-white">
                 <span class="fa fa-plane" style="font-size: 27px;"> </span> &nbsp; VUA System (VUA系統)
            </div>
		    <!-- end login-brand -->
		    <!-- begin login-content -->
            <div class="login-content">

                <img src="<?= base_url('assets/img/unilogo.jpg'); ?>" alt="Uni Orient" style="margin-left: 12%; margin-bottom:5px;">

                <div id="alert-msg"></div>

                <form id="frm-login" method="post" accept-charset="utf-8" novalidate>
                    <div class="form-group" id="fg-email">
                        <input type="email" class="form-control input-lg" placeholder="Email Address (電子郵件地址)" id="user-email" autofocus required name="user_email"/>
                    </div>
                    <div class="form-group" id="fg-pass">
                        <input type="password" class="form-control input-lg" placeholder="Password (密碼)" id="user-pass" required name="user_pass"/>
                    </div>
                    <div class="row m-b-20">
                       
                       <div class="col-sm-12">
                          <input type="submit" class="btn btn-success btn-lg btn-block" id="btn-login" value="Sign In (簽到)" />
                           <!-- <button class="btn btn-lg btn-info btn-link btn-block m-t-10" style="color:white;"> Forgot Password (忘記密碼)</button> -->
                           
                       </div>
                       
                       <!--<div class="col-sm-6">
                            
                            
                        </div>
                        
                        <div class="col-sm-6">
                            
                        </div>-->
                        
                    </div>
                    <div class="text-center hd">
                        Forget Password? Click <a href="javascript:;" class="text-muted"> here </a>
                    </div>
                </form>

            </div>
		    <!-- end login-content -->
		</div>
		<!-- end login -->
	</div>
	<!-- end page container -->

	<?php include(APPPATH.'views/templates/footer.php'); ?>

    <!-- LOGIN JS HERE -->
     <script src="<?= base_url('assets/js/pages/login/login.js'); ?>"></script> 

</body>

</html>
