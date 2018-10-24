<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<meta name="description" content="Patient Management System" />
	<meta name="keywords" content="patient, receipt, management"/>
	<title>PMS - Patient Management System</title>
	<link rel="stylesheet" type="text/css" href="<?php echo theme_css('global.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo theme_css('jquery-ui.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo theme_css('jquery.dataTables.css'); ?>"/>

	<script type="text/javascript" src="<?php echo theme_js('jquery-1.9.1.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo theme_js('jquery-1.7.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo theme_js('jquery-ui.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo theme_js('jquery.dataTables.js'); ?>"></script>
</head>
<body>
	<!-- Header -->
	<div class="menu_container">
		<?php echo $header; ?>
	</div>
	<!-- End Header -->

	<!-- Body -->
	<div class="body_container">

		<!-- Sidebar -->
		<div class="sidenav_container">
			<?php echo $sidebar; ?>
		</div>
		<!-- End Sidebar -->
		
		<!-- Contents -->
		<div class="contents_container">
			{body}
		</div>
		<!-- End Contents -->
		
	</div>
	<!-- End Body -->

	<div style="clear:both; height:20px;"></div>

	<!-- Footer -->
	<div class="footer_width">
		<?php echo $footer; ?>
	</div>
	<!-- End Footer -->

	<script type="text/javascript">
		$(document).ready(function() {
			var page = '<?php echo isset($page) ? $page : ''; ?>';

			switch (page)
			{
				case 'patient-list':
					$('#mytable').dataTable({
						"processing": true,
						"serverSide": true,
						"ajax": {
							url: "<?php echo site_url("patient/ajax") ?>",
							type: 'GET',
							success: function(data) {
								console.log(data);
							}
						}
					});
					break;

				default:
					$('#mytable').dataTable();
			}    
			
			$('#btnBack').click(function(){
				document.location = '<?php echo site_url('patient'); ?>';
			});
		});
	</script>
</body>
</html>
