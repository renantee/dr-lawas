<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Edit Patient</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>
        <div style="clear:both; height: 10px;"></div>
        <div class="form_inside_container">
        	<div class="show_hide_container7"></div>
            <div class="show_hide_container7">
            	<div class="show_hide_left5">Basic Info</div>
            	<div style="clear:both; height:10px;"></div>
          	</div>
          	<div class="show_hide_container3">
                <form name="frmPatientInfo" id="frmPatientInfo" method="post" action="<?php echo site_url('patient'); ?>">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                            <td width="22%">Sex</td>
                            <td width="78%">
                            	<input name="sex" type="radio" value="m" <?php if($info[0]->sex=='m') { ?>checked="checked"<?php } ?> /> Male
                                &nbsp;&nbsp;&nbsp;
                                <input name="sex" type="radio" value="f" <?php if($info[0]->sex=='f') { ?>checked="checked"<?php } ?> /> Female
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><input name="birthdate" type="text" class="searchbox_style4" id="birthdate" value="<?php echo $info[0]->birthdate; ?>" /> (yyyy-mm-dd)</td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><input name="firstname" type="text" class="searchbox_style8" id="firstname" value="<?php echo $info[0]->firstname; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><input name="middlename" type="text" class="searchbox_style8" id="middlename" value="<?php echo $info[0]->middlename; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input name="lastname" type="text" class="searchbox_style8" id="lastname" value="<?php echo $info[0]->lastname; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><textarea name="address" class="searchbox_style6"><?php echo $info[0]->address; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;<input type="hidden" name="submitForm" value="update_patient" /><input type="hidden" name="patient_id" value="<?php echo $info[0]->id; ?>" /></td>
                        </tr>                        
                        <tr>
                            <td colspan="2">
                            	<a href="#" id="btnSavePatientInfo"><img src="<?php echo theme_img('button_update.jpg'); ?>" border="0" /></a>
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
	$(function() {
		$( "#birthdate" ).datepicker({dateFormat: 'yy-mm-dd'});
	});
	
    $('#btnSavePatientInfo').click(function(){
		$('#frmPatientInfo').submit();
	});
	
	$('#btnCancel').click(function(){
		document.location = '<?php echo site_url('patient'); ?>';
	});		
} );
</script>