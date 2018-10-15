<div class="contents_button_container">
	<div class="small_header_top3">
  		<div class="small_header_left"></div>
  		<div class="small_header_right"></div>
    	<div class="small_header_title">Today's List of Patients</div>
  	</div>
</div>
<div class="contents_inside_container2">
	<div class="contents_inside2_container2">
		<div style="clear:both"></div>         
        <div style="clear:both; height:10px;"></div>
        <table width="100%" cellpadding="5" cellspacing="0" border="0" id="mytable">
            <thead>
            <tr class="show_hide_container4">
                <th width="80">Time of Visit</th>
                <th width="80">Date of Visit</th>
                <th align="left">Firstname</th>
                <th align="left">Lastname</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($patients as $k=>$patient) { ?>
                <tr>
                    <td><?php echo (!empty($patient->time_visit)) ? $patient->time_visit : $patient->time_created; ?></td>
                    <td><?php echo (!empty($patient->date_visit)) ? $patient->date_visit : $patient->date_created; ?></td>
                    <td><?php echo $patient->firstname; ?></td>
                    <td><?php echo $patient->lastname; ?></td>
                    <td>
                    	<div class="show_hide_right4">
                            <a class="link_show_hide" href="<?php echo site_url('patient/edit/'. $patient->id); ?>">Edit Info</a>  |
                            <a class="link_show_hide" href="<?php echo site_url('patient/view/'. $patient->id); ?>">View Details</a> |
                            <a class="link_show_hide" href="<?php echo site_url('patient/visit/'. $patient->id); ?>">Add Visit</a>
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