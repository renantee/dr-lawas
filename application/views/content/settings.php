<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Configure Defaults</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>
        <div style="clear:both; height: 10px;"></div>
        <div class="form_inside_container">
        	<div class="show_hide_container7"></div>
            <div class="show_hide_container7">
            	<div class="show_hide_left5">Receipt Content</div>
            	<div style="clear:both; height:10px;"></div>
          	</div>
          	<div class="show_hide_container3">
                <form name="frmSettingsInfo" id="frmSettingsInfo" method="post" action="<?php echo site_url('settings'); ?>">
                	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr valign="top">
                            <td>Header Logo</td>
                            <td>
                            	<input readonly="readonly" name="header" type="hidden" class="searchbox_style8" id="header" value="<?php echo $settings['header']; ?>" />
                                <img src="<?php echo $settings['header']; ?>" border="0" />
                           	</td>
                        </tr> 
                        <tr>
                            <td colspan="2"><div style="clear:both; height:20px;"></div></td>
                        </tr>
                        <tr valign="top">
                            <td>RX Logo</td>
                            <td>
                            	&nbsp;&nbsp;&nbsp;&nbsp;<input readonly="readonly" name="rx" type="hidden" class="searchbox_style8" id="rx" value="<?php echo $settings['rx']; ?>" />
                                <img width="64" height="64" src="<?php echo $settings['rx']; ?>" border="0" />
                           	</td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="clear:both; height:20px;"></div></td>
                        </tr>
                        <tr valign="top">
                            <td>License No.</td>
                            <td><input name="license" type="text" class="searchbox_style8" id="license" value="<?php echo $settings['license']; ?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="clear:both; height:20px;"></div></td>
                        </tr>
                        <tr valign="top">
                            <td>PTR No.</td>
                            <td><input name="ptr" type="text" class="searchbox_style8" id="ptr" value="<?php echo $settings['ptr']; ?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="clear:both; height:20px;"></div></td>
                        </tr>
                        <tr valign="top">
                            <td>TIN No.</td>
                            <td><input name="tin" type="text" class="searchbox_style8" id="tin" value="<?php echo $settings['tin']; ?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="clear:both; height:20px;"><input type="hidden" name="submitForm" value="save_settings" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<a href="#" id="btnSaveSettingsInfo"><img src="<?php echo theme_img('button_update.jpg'); ?>" border="0" /></a>
                                <?php echo $message; ?>
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
    $('#btnSaveSettingsInfo').click(function(){
		$('#frmSettingsInfo').submit();
	});	
} );
</script>