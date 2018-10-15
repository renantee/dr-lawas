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
    <?php foreach($medicines as $k=>$medicine) {
		$medicineVal ="{$medicine->generic_name},{$medicine->brand_name},{$medicine->preparation},{$medicine->dosage},{$medicine->id}";
	?>
        <tr valign="top">
            <td align="right" width="5%"><?php echo ++$k; ?></td>
            <td width="25%"><?php echo $medicine->generic_name; ?></td>
            <td width="25%"> <?php echo "{$medicine->brand_name}<br />({$medicine->preparation})"; ?></td>
            <td><?php echo $medicine->dosage; ?></td>
            <td width="5%">
                <div class="show_hide_right4">
                    <a class="link_show_hide" href="#" id="addNew" medicine="<?php echo $medicineVal; ?>">Add Medicine</a>     
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>