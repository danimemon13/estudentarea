
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/popper.js"></script>
<script src="<?=base_url()?>js/bootstrap.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg bg-transparent" role="document">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table id="spndng_dtls" class="table table-striped table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Spending Amount (€)</th>
                                <th>Clicks</th>
                                <th>Revenue</th>
                                <th>Leads</th>
                                <th>Chats</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-action" class="btn btn-primary modal_btn border-0">Add Spending</button>
                    <button type="button" class="btn btn-secondary modal_btn_dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function modals(actionheader, body, button, action) {
        header = actionheader;
        body = body;
        button = button;
        action = action;
        if (header != null || header != '') {
            $('#myModal .modal-header h5').html(header);
        }
    
        if (body != null || body != '') {
            $('#myModal .modal-body').html(body);
        };
    
        $('#myModal').modal('show');
        if (button == null || button == '') {
            $('#btn-action').hide();
        } else {
            $('#myModal .modal-footer #btn-action').attr("onClick", action).html(button);
        }
        
    }
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(element).select();
    
        if (document.execCommand("copy")) {
            $temp.remove()
            swal("Successfully!", "Your selected value Copy Now!", "success");
        };

    }
</script>

</body>
</html>