<?php
$action = $_POST['action'];
$inv_no = $_POST['inv_no'];
$id = $_POST['id'];
if($action == 'edit'){
    ?>
    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="contact-tab" title="add-chat" data-toggle="tab" href="#chat_change" role="tab" aria-controls="contact5" aria-selected="false">Links</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" title="com" data-toggle="tab" href="#comments_tab" role="tab" aria-controls="home5" aria-selected="true">PDF</a>
        </li>
            <li class="nav-item">
            <a class="nav-link" id="home-tab" title="inv_u_a" data-toggle="tab" href="#inv_u_a" role="tab" aria-controls="home5" aria-selected="true">Update Amount</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="border: 1px solid #dddddd;">
        <div class="tab-pane fade show active" id="chat_change" role="tabpanel" aria-labelledby="home-tab">
            <?php
                    $date = date('Y-m-d H:i:s');
                    $strtotime = strtotime("+2 days");
                    $url = 'https://'.$website[0]['name'].'/order/?inv='.$inv_no;
                    $payment_link = "https://paymentprocessterminal.com/paynow/dinvoice/".$inv_no;
                    echo '<div class="alert alert-success form-group" role="alert"> Payment Link!!<input class="form-control " value="'.$payment_link.'" /></div>';
                    echo '<div class="alert alert-success form-group" role="alert"> Get A Quote Link!!<input class="form-control " value="'.$url.'" /></div>';
                ?>

        </div>
        <div class="tab-pane fade  " id="comments_tab" role="tabpanel" aria-labelledby="home-tab">
            <iframe src="<?=base_url().'uploads/invoice/'.$inv_no.'.pdf';?>#toolbar=0&navpanes=0&statusbar=0&view=Fit;readonly=true; disableprint=true;zoom=scale,left,top;" width="500" height="500"></iframe>
        </div>
        <div class="tab-pane" id="inv_u_a" role="tabpanel" aria-labelledby="home-tab">
            <form id="amount-form">
                <div class="form-group">
                    <label for="description" class="mr-1">Enter Amount</label>
                    <input name="inv_id" style="display:none;" value="<?=$id;?>"/>
                    <input type="number" required name="amount" class="form-control"/>
                    
                </div>
                <div class="form-group">
                    <label for="description" class="mr-1">Enter Pount Amount</label>
                    <select class="form-control" name="point_amount" required>
                        <option value=".0">Select Amount</option>
                        <?php 
                        for($i=0;$i<=99;$i++){
                        $i = str_pad($i, 2, "0", STR_PAD_LEFT);
                        ?>
                        <option value="<?='.'.$i;?>"><?=$i;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary col-md-2 col-lg-2 col-xs-12 col-sm-12">Save</button>
                </div>
            </form>

            <script>
                 $("#amount-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#amount-form").serializeArray();
                    // console.log(data);
                    action_res('Invoice Status',data,'','');
                });
            </script>
        </div>
    </div>

    <?php
}else if($action == 'delete'){

}else if($action == 'history'){

}else{
    echo "No Action Found";
}
?>
