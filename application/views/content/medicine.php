<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">List of Medicines</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>         
        <div style="clear:both; height:10px;"></div>
        <table width="100%" cellpadding="5" cellspacing="0" border="0" id="mytable">
            <thead>
            <tr class="show_hide_container4">
                <th width="5%">#</th>
                <th align="left" width="25%">Generic Name</th>
                <th align="left" width="25%">
                	Brand Name<br />
                	(Preparation)
              	</th>
                <th align="left">Dosage</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($medicines as $k=>$medicine) { ?>
                <tr valign="top">
                    <td align="right" width="5%"><?php echo ++$k; ?></td>
                    <td width="25%"><?php echo $medicine->generic_name; ?></td>
                    <td width="25%"> <?php echo "{$medicine->brand_name}<br />({$medicine->preparation})"; ?></td>
                    <td><?php echo $medicine->dosage; ?></td>
                    <td width="10%">
                    	<div class="show_hide_right4">
                            <a class="link_show_hide" href="<?php echo site_url('medicine/edit/'. $medicine->id); ?>">Edit Info</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div style="clear:both"></div>
	</div>
    <div style="clear:both; height:20px;"></div>
</div>