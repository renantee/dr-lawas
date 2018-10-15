<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Edit Medicine</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>
        <div style="clear:both; height: 10px;"></div>
        <div class="form_inside_container">
        	<div class="show_hide_container7">
            	<div class="show_hide_left5">Basic Info</div>
            	<div style="clear:both; height:5px;"></div>
          	</div>
          	<div class="show_hide_container3">
                <form name="frmMedicineInfo" id="frmMedicineInfo" method="post" action="<?php echo site_url('medicine'); ?>">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>Generic Name:</td>
                            <td><input name="generic_name" type="text" class="searchbox_style8" id="generic_name" value="<?php echo $info[0]->generic_name; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Brand Name:</td>
                            <td><input name="brand_name" type="text" class="searchbox_style8" id="brand_name" value="<?php echo $info[0]->brand_name; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Preparation:</td>
                            <td><textarea name="preparation" class="searchbox_style6" id="preparation"><?php echo $info[0]->preparation; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Sig:</td>
                            <td><textarea name="dosage" class="searchbox_style6" id="dosage"><?php echo $info[0]->dosage; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;<input type="hidden" name="submitForm" value="update_medicine" /><input type="hidden" name="medicine_id" value="<?php echo $info[0]->id; ?>" /></td>
                        </tr>                        
                        <tr>
                            <td colspan="2">
                            	<a href="#" id="btnSaveMedicineInfo"><img src="<?php echo theme_img('button_update.jpg'); ?>" border="0" /></a>
                                <a href="#" id="btnCancel"><img src="<?php echo theme_img('button_cancel.jpg'); ?>" border="0" /></a>
                          	</td>
                        </tr>
                    </table>
                </form>
          	</div>
         </div>
         <div style="clear:both"></div>
	</div>
    <div style="clear:both; height:20px;"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#btnSaveMedicineInfo').click(function(){
		if($.trim($('#preparation').val()).length < 1) {
			alert('Preparation is required!');
			return false;
		}
		
		if($.trim($('#dosage').val()).length < 1) {
			alert('Sig is required!');
			return false;
		}
		
		$('#frmMedicineInfo').submit();
	});
	
	$('#btnCancel').click(function(){
		document.location = '<?php echo site_url('medicine'); ?>';
	});
} );
</script>