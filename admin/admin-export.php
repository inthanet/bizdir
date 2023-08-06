<?php
include "header.php";
?>

<?php if ($admin_row['admin_import_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list posr">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Export</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Export Datas</h4>
                                    <?php if(!empty($_SESSION['msg'])){
                                        echo "<h2 style='color:red;'>".$_SESSION['msg'].'</h2>';
                                        unset($_SESSION['msg']);
                                    }
                                    ?>
                                    <form name="export_all_database" id="export_all_database" action="export_all_database.php" method="post">
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12"> 
                                                <select name="table_prefix" required="required" id="table_prefix"
                                                        class="chosen-select form-control">
                                                    <?php echo DB_EXPORT_PREFIX;?>
                                                </select>        
                                            </div>

                                            <div class="col-md-12"> 
                                               <lable>New Prefix (<small>Let empty for not change</small>)</lable><br> 
                                               <input type="text" name="new_table_prefix">         
                                            </div>

                                            <div class="col-md-12">
                                               <button type="submit" class="btn btn-primary">Click here to export all tables for the selected table-prefix. </button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip">Go to Dashboard >></a>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="ud-notes">
                                        <p><b>Notes:</b> Hi, Here you can easy export your database files.<br>The export file can be used to create all tables and import the data via PhpMyAdmin.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> <script src="../js/select-opt.js"></script>
</body>

</html>