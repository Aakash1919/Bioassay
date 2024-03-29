 <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="/login/logout" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo base_url();?>assets/theme/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo base_url();?>assets/theme/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->


        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='<?php echo base_url();?>assets/theme/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/theme/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/theme/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/owl/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/nestable/jquery.nestable.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->


        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/actions.js"></script>

        <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/demo_dashboard.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/ckeditor/ckeditor.js"></script>
       
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>