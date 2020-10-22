<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $active;?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="/assets/theme/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <?php
                    $r = $this->session->flashdata('response');
                    if(isset($r)){?>
                            <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
                <?php } ?>
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <form action="/login/loginA" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="username" class="form-control" placeholder="Username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                     <!--    <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div> -->
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-info btn-block" value="Log In">
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy;  2019 BioAssay Systems. All rights reserved
                    </div>
                   
                </div>
            </div>
            
        </div>
        
    </body>
</html>






