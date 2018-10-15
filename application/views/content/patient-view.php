<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Patient Details</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>
        <div style="clear:both; height: 10px;"></div>
        <div class="form_inside_container">
            <div class="show_hide_right4">
                <a href="#" id="btnBack"><img src="<?php echo theme_img('button_back.jpg'); ?>" border="0" /></a>
                <a href="<?php echo site_url('patient/visit/'.$info[0]->id); ?>" id="btnVisit"><img src="<?php echo theme_img('button_add_visit.jpg'); ?>" border="0" /></a>
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
            
            <div class="show_hide_container7"></div>
            <div class="show_hide_container7">
            	<div class="show_hide_left5">Visit Details</div>
            	<div style="clear:both; height:10px;"></div>
          	</div>
            <div class="show_hide_container7">
                <!--<table width="100%" cellpadding="5" cellspacing="1" border="0">-->
                <table width="100%" cellpadding="5" cellspacing="0" border="0" id="mytable">
                	<thead>
                    <tr class="show_hide_container4">
                        <th width="30">#</th>
                        <th width="80">Date of visit</th>
                        <th width="80">Time of visit</th>
                        <th width="30">Age</th>
                        <th width="50">Weight</th>
                        <th>Medicines</th>
                        <th width="80">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($details as $k=>$detail) { $bg = ($k%2) ? 'even' : 'odd'; ?>
                        <tr class="show_hide_container6 <?php echo $bg; ?>">
                            <td width="30"><?php echo ++$k; ?></td>
                            <td width="80"><?php echo $detail->date_visit; ?></td>
                            <td width="80"><?php echo $detail->time_visit; ?></td>
                            <td width="30"><?php echo $detail->age; ?></td>
                            <td width="50"><?php echo $detail->weight; ?></td>
                            <td style="text-align:left;">
                            <?php foreach($medicine[$detail->id] as $val) {
								echo "
									{$val->generic_name}<br />
									{$val->preparation} #{$val->pcs}<br />
									(<em>{$val->brand_name} </em>)<br />
									Sig: {$val->dosage}<br /><br />							
								";
							} ?>
                            </td>
                            <td width="80">
                            	<a class="link_show_hide" href="<?php echo site_url('patient/visit/'.$detail->patient_id.'/edit/'.$detail->id); ?>">Edit Visit</a><br />
                                <a class="link_show_hide" href="<?php echo site_url('patient/visit/'.$detail->patient_id.'/delete/'.$detail->id); ?>">Delete Visit</a><br />
                                <a target="_blank" class="link_show_hide" href="<?php echo site_url('receipt/view/'.$detail->id); ?>">View Receipt</a><br />
                          	</td>
                        </tr>
                    <?php } ?>
                   	</tbody>
                </table>
          	</div>
      	</div>
	</div>
    <div style="clear:both; height:20px;"></div>
</div>