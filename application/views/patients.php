<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Patient Display</title>
		<script src="<?php echo theme_js('new/jquery.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo theme_js('new/datatables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo theme_js('new/dataTables.bootstrap.min.js'); ?>"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo theme_css('new/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo theme_css('new/dataTables.bootstrap.min.css'); ?>" />
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" /> -->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Patient List</h1>
					<table id="patient-table" class="table table-bordered table-striped table-hover">
						<thead>
							<td>#</td>
							<td align="left">Firstname</td>
							<td align="left">Middlename</td>
							<td align="left">Lastname</td>
							<td align="left">Sex</td>
							<td align="left">Date of Birth</td>
							<td>Action</td>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#patient-table').DataTable({
					"ajax": {
						url : "<?php echo site_url("patient/ajax") ?>",
						type : 'GET'
					},
				});
			});
		</script>
	</body>
</html>