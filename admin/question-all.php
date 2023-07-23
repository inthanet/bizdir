<?php
include "header.php";
?>

<?php if($footer_row['admin_place_show'] !=1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst">All Questions</span>
                <div class="ud-cen-s2">
                    <h2>Questions</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div style="display: none" class="static-success-message log-suc"><p>Place(s) has been Permanently Deleted!!! Please wait for automatic page refresh!! </p></div>
                    <a href="#" data-toggle="modal" data-target="#askquestion" class="db-tit-btn">Add new Question</a>
                    <table class="responsive-table bordered" id="pg-resu">
							<thead>
								<tr>
									<th>No</th>
                                    <th>Questions</th>
                                    <th>Category</th>
                                    <th>Created by</th>
									<th>Published</th>
									<th>Views</th>
									<th>Edit</th>
									<th>Delete</th>
									<th>Preview</th>
                                    <th><input type="checkbox" class="checkall" id="checkall"><input type="button" style="display: none" class='multi-del-btn' id='delete_record' value='Delete' ></th>
                                </tr>
							</thead>
							<tbody>
                            <?php
                            $si = 1;
                            foreach (getAllPlaces() as $placerow) {

                            $place_id = $placerow['place_id'];

                            $category_id = $placerow['category_id'];

                            $category_row = getPlaceCategory($category_id);

                            ?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo stripslashes($placerow['place_name']); ?></td>
                                    <td><span class="db-list-ststus"><?php echo $category_row['category_name']; ?></span></td>
                                    <td><a href="#" target="_blank">John smith</a></td>
                                    <td><?php echo dateFormatconverter($placerow['place_cdt']); ?></td>
                                    <td><span class="db-list-rat"><?php echo AddingZero_BeforeNumber(place_detail_pageview_count($placerow['place_id'])); ?></span></td>
                                    <td><a href="place-edit.php?code=<?php echo $place_id; ?>" class="db-list-edit">Edit</a></td>
                                    <td><a href="place-delete.php?code=<?php echo $place_id; ?>" class="db-list-edit">Delete</a></td>
                                    <td><a target="_blank" href="<?php echo $PLACE_DETAIL_URL . urlModifier($placerow['place_slug']); ?>" class="db-list-edit">Preview</a></td>
                                    <td><input type="checkbox" class="delete_check" id="delcheck_49" onclick="checkcheckbox();"></td>
                                </tr>
                                <?php
                                $si++;
                            }
                            ?>
							</tbody>
						</table>
                </div>

            </div>
                
            </div>
        </div>
    </section>
    <!-- END -->    

    <!-- POST QUESTION POPUP -->
<div class="pop-table">
        <!-- The Modal -->
        <div class="modal fade" id="askquestion">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst">Ask Question</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="inn job-form">
                        <h4>Post your question</h4>
                        <div id="place_pop_enq_success" class="log" style="display: none;">
                            <p>Your Place Add Request Is Submitted Successfully!!!</p>
                        </div>
                        <div id="place_pop_enq_fail" class="log" style="display: none;">
                            <p>Oops!! Something Went Wrong Try Later!!!</p>
                        </div>
                        <form method="post" name="place_add_request_form" id="place_add_request_form" class="place_add_request_form">
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value=""
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <input type="text" name="place_name" class="form-control" placeholder="Question" required>
                            </div>
                            <div class="form-group">
                                <select class="chosen-select" data-placeholder="Select category">
                                    <option value="0">Select category</option>
                                    <option value="1">Technology</option>
                                    <option value="2">History</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="chosen-select" data-placeholder="Choose a #tags"  multiple>
                                    <option value="1">Technology</option>
                                    <option value="2">History</option>
                                    <option value="3">Technology</option>
                                    <option value="4">History</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="place_description" placeholder="Descriptions"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <button  type="submit" id=""  name="" class="place_add_request_submit btn btn-primary cta-clr-vio"> Submit </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script>
<script src="../js/select-opt.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="js/admin-custom.js"></script>
<script>
    $(document).ready(function () {
        $('#pg-resu').DataTable({
            "columnDefs": [
                { "bSortable": false, "aTargets": [ 7 ] }
            ]
        });
    });
</script>

<script>
    $('#delete_record').click(function(){

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){

            // Confirm alert
            var confirmdelete = confirm("Do you really want to Delete records?");
            if (confirmdelete == true) {
                $.ajax({
                    url: 'multiple_delete_users.php',
                    type: 'post',
                    data: {request: 9,deleteids_arr: deleteids_arr},
                    success: function(response){
                        $('.static-success-message').css("display", "block");
                        window.setTimeout(function(){location.reload()},3000)
                    }
                });
            }
        }
    });
</script>
</body>

</html>