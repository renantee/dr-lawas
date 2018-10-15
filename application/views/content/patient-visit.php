<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Patient Details > Add New Visit</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>
        <div style="clear:both; height: 10px;"></div>
        <div class="form_inside_container">
            <div class="show_hide_right4">
                <a href="#" id="btnBack"><img src="<?php echo theme_img('button_back.jpg'); ?>" border="0" /></a>
            </div>
            <div style="clear:both"></div>
            
        	<div class="show_hide_container7"></div>
            <div class="show_hide_container7">
            	<div class="show_hide_left5">Basic Info</div>
            	<div style="clear:both; height:10px;"></div>
          	</div>
            <div class="show_hide_container3">
            	<table class="inside_table_container">
                	<tr>
                    	<td width="100">Name</td>
                        <td>: <?php echo $info[0]->firstname.' '.$info[0]->middlename.' '.$info[0]->lastname; ?></td>
                        <td width="100">Date of Birth</td>
                        <td>: <?php echo $info[0]->birthdate; ?></td>                        
                    </tr>                    
                    <tr>
                    	<td>Address</td>
                        <td>: <?php echo $info[0]->address; ?></td>
                        <td>Age</td>
                        <td width="80">: <?php echo $info[0]->age; ?></td>
                    </tr>
                    <tr>
                        <td>No. of visit</td>
                        <td>: <?php echo $info[0]->no_of_visit; ?></td>
                        <td>Sex</td>
                        <td>: <?php echo ($info[0]->sex=='m') ? 'Male' : 'Female'; ?></td>
                    </tr>
                </table>
            </div>
            <div style="clear:both; height:10px;"></div>
            
            <form name="frmPatientInfo" id="frmPatientInfo" method="post" action="<?php echo site_url('patient'); ?>">
                <div class="show_hide_container7"></div>
                <div class="show_hide_container7">
                    <div class="show_hide_left5">Visit Details</div>
                    <div style="clear:both; height:10px;"></div>
                </div>            
            
            	<div class="show_hide_container3">                
                    <table class="inside_table_container">
                    	<tr>
                            <td width="100">Date of Visit</td>
                            <td>: <input readonly="readonly" name="date_visit" type="text" class="searchbox_style4" id="date_visit" value="<?php echo $visit['date']; ?>" /> (yyyy/mm/dd)</td>
                        </tr>
                        <tr>
                            <td>Time of Visit</td>
                            <td>: <input name="time_visit" type="text" class="searchbox_style4" id="time_visit" value="<?php echo $visit['time']; ?>" /> (hh:mm:ss)</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>: <input name="weight" type="text" class="searchbox_style8" id="weight" value="" /></td>
                        </tr>                    
                    </table>                
          		</div>
                <div style="clear:both; height:10px;"></div>
                
                <div class="show_hide_container7"></div>
                <div class="show_hide_container7">
                    <div class="show_hide_left5">Medicine Details</div>
                    <div style="clear:both; height:10px;"></div>                  
                </div>
                
                <div class="show_hide_container3">
                	<a class="link_show_hide" href="#medicine_details" id="showHide">+ Show/Hide Medicine List</a>
                    <div id="medicineList" style="display:none;">
						<div style="clear:both; height:10px;"></div>
						<?php echo $list_of_medicine; ?>
                   	</div>
                </div>
                <div style="clear:both; height:10px;"></div>
                
                <div class="show_hide_container3">
                	<a id="medicine_details"></a>
                    <div id="addinput"></div>
                </div>
                
                <div class="show_hide_container3">                	
                    <input type="hidden" name="submitForm" value="save_visit" />
                    <input type="hidden" name="age" value="<?php echo $info[0]->age; ?>" />
                    <input type="hidden" name="patient_id" value="<?php echo $info[0]->id; ?>" />
                    <a href="#" id="btnSavePatientInfo"><img src="<?php echo theme_img('button_save.jpg'); ?>" border="0" /></a>
                    <a href="#" id="btnCancel"><img src="<?php echo theme_img('button_cancel.jpg'); ?>" border="0" /></a>
                    <a href="#" id="btnReset"><img src="<?php echo theme_img('button_reset.jpg'); ?>" border="0" /></a>
                </div>
            </form>
      	</div>
	</div>
    <div style="clear:both; height:20px;"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {		
	$(function() {
		$( "#date_visit" ).datepicker({dateFormat: 'yy-mm-dd'});
	});
	
	$('#btnSavePatientInfo').click(function(){
		/*
		if($.trim($('#weight').val()).length < 1) {
			alert('Weight is required!');
			return false;
		}
		*/
		
		if($.trim($('[name="generic_name[]"]').val()).length < 1) {
			alert('Please add at least one medicine!');
			return false;
		}
		
		$('#frmPatientInfo').submit();
	});
	
	$('#btnCancel').click(function(){
		document.location = '<?php echo site_url('patient/view/'.$info[0]->id); ?>';
	});
	
	$('#btnReset').click(function(){
		document.location = '<?php echo site_url('patient/visit/'.$info[0]->id); ?>';
	});
	
	$('#showHide').click(function(){
		$('#medicineList').slideToggle('slow');
	});
	
	$(function() {
		var addDiv = $('#addinput');
		var i = $('#addinput table').size() + 1;
		
		$('#addNew').live('click', function() {
			var str = $(this).attr('medicine').split(',');
			
			$('<table class="inside_table_container"><tr><td width="100">Generic name</td><td>: <input readonly="readonly" type="text" class="searchbox_style8" name="generic_name[]" value="'+str[0]+'" /></td><td width="100">Brand name</td><td width="230">: <input readonly="readonly" type="text" class="searchbox_style8" name="brand_name[]" value="'+str[1]+'" /></td></tr><tr><td>Preparation</td><td>: <input type="text" class="searchbox_style8" name="preparation[]" value="'+str[2]+'" /></td><td>Sig</td><td>: <input type="text" class="searchbox_style8" name="dosage[]" value="'+str[3]+'" /></td></tr><tr><td>#</td><td colspan="3">: <input type="text" class="searchbox_style8" name="pcs[]" value="1" /></td></tr><tr><td colspan="4"><a class="link_show_hide" href="#" id="remNew">- Remove Medicine</a><div class="show_hide_container7"><input type="hidden" name="medicine_id[]" value="'+str[4]+'" /></div></td></tr></table>').appendTo(addDiv);
			i++;
			
			return false;
		});
		
		
		$('#remNew').live('click', function() {
			if( i > 1 ) {
				$(this).parents('table').remove();
				i--;
			}
			return false;
		});
	});
} );
</script>