<?php include 'includes/config.php'; ?>


<?php

    $username = $_SESSION['user'];
    $sql_query = "SELECT id, username, email FROM tbl_admin WHERE username = ?";

    $data = array();
            
    $stmt = $connect->stmt_init();
    if($stmt->prepare($sql_query)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $data['id'],
            $data['username'],
            $data['email']
            );
        $stmt->fetch();
        $stmt->close();
    }

	// pending order
	$sql_pending = "SELECT COUNT(*) as num FROM tbl_order WHERE status = '0' ";
	$total_pending = mysqli_query($connect, $sql_pending);
	$total_pending = mysqli_fetch_array($total_pending);
	$total_pending = $total_pending['num'];

	$sql_pending_result = "SELECT * FROM tbl_order WHERE status = '0' ORDER BY id DESC LIMIT 5";
	$result = mysqli_query($connect, $sql_pending_result);   
            
?>

<!doctype html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Propeller Admin Dashboard">
<meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">

<title>ShopApp</title>
<meta name="description" content="Admin is a material design and bootstrap based responsive dashboard template created mainly for admin and backend applications."/>

<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

<!-- Google icon -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/dropify.css">

<!-- Propeller css -->
<!-- build:[href] assets/css/ -->
<link rel="stylesheet" type="text/css" href="assets/css/propeller.min.css">
<!-- /build -->

<!-- Select2 css-->
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/css/select2-bootstrap.css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/css/pmd-select2.css" />

<link rel="stylesheet" type="text/css" href="assets/plugins/pagination/css/pagination.css" />

<!-- Propeller date time picker css-->
<!-- <link rel="stylesheet" type="text/css" href="components/datetimepicker/css/bootstrap-datetimepicker.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="components/datetimepicker/css/pmd-datetimepicker.css" /> -->

<!-- Propeller theme css-->
<link rel="stylesheet" type="text/css" href="assets/themes/css/propeller-theme.css" />

<!-- Propeller admin theme css-->
<link rel="stylesheet" type="text/css" href="assets/themes/css/propeller-admin.css">

</head>

<body>
<!-- Header Starts -->
<!--Start Nav bar -->
<nav class="navbar navbar-inverse navbar-fixed-top pmd-navbar pmd-z-depth">

	<div class="container-fluid">
		<div class="pmd-navbar-right-icon pull-right navigation">
			<!-- Notifications -->
            <div class="dropdown notification icons pmd-dropdown">
			
				<a href="javascript:void(0)" title="Notification" class="dropdown-toggle pmd-ripple-effect"  data-toggle="dropdown" role="button" aria-expanded="true">
					<div data-badge="<?php echo $total_pending; ?>" class="material-icons md-light pmd-sm pmd-badge  pmd-badge-overlap">assignment</div>
				</a>
			
				<div class="dropdown-menu dropdown-menu-right pmd-card pmd-card-default pmd-z-depth" role="menu">
					<!-- Card header -->
					<div class="pmd-card-title">
						<div class="media-body media-middle">
							<a href="#" class="pull-right"><?php echo $total_pending; ?> Заказ</a>
							<h3 class="pmd-card-title-text">Новые Заказы</h3>
						</div>
					</div>
					
					<!-- Notifications list -->
					<ul class="list-group pmd-list-avatar pmd-card-list">

					<?php if ($total_pending == '0') { ?>
						<li class="list-group-item">
							<p class="notification-blank">
								<span class="dic dic-notifications-none"></span> 
								<span>У Вас нет новых заказов</span>
							</p>
						</li>

					<?php } else { ?>

					<?php while($row = mysqli_fetch_array($result)) { ?>						
						<li class="list-group-item unread">
							<a href="order-detail.php?id=<?php echo $row['id'];?>">
								<div class="media-body">
									<span class="list-group-item-heading">
										<span><?php echo $row['name'];?></span>
									</span>
									<span class="list-group-item-text"><?php echo $row['order_total'];?></span>
									<span class="list-group-item-text"><?php echo $row['date_time'];?></span>
								</div>
							</a>
						</li>
					<?php } ?>
						<li class="list-group-item unread">
							<a href="manage-order.php">
								<div class="media-body">
									<div align="center">Все заказы</div>
								</div>
							</a>
						</li>

					<?php } ?>
						
					</ul><!-- End notifications list -->

				</div>
				
				
            </div> <!-- End notifications -->
		</div>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a href="javascript:void(0);" data-target="basicSidebar" data-placement="left" data-position="slidepush" is-open="true" is-open-width="1200" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect pull-left margin-r8 pmd-sidebar-toggle"><i class="material-icons md-light">menu</i></a>	
		  <a href="dashboard.php" class="navbar-brand">
		  	ShopApp
		  </a>
		</div>
	</div>

</nav><!--End Nav bar -->
<!-- Header Ends -->

<!-- Sidebar Starts -->
<div class="pmd-sidebar-overlay"></div>

<!-- Left sidebar -->
<aside id="basicSidebar" class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open bg-fill-darkblue sidebar-with-icons" role="navigation">
	<ul class="nav pmd-sidebar-nav">
		
		<!-- User info -->
		<li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" aria-expandedhref="javascript:void(0);">
				<div class="media-left">
					<img src="assets/themes/images/user-icon.png" alt="New User">
				</div>
				<div class="media-body media-middle">Привет, <?php echo $data['username'] ?></div>
				<div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
			</a>
			<ul class="dropdown-menu">
				<li><a href="edit-profile.php?id=<?php echo $data['id']; ?>">Профиль</a></li>
				<li><a href="logout.php">Выход</a></li>
			</ul>
		</li><!-- End user info -->
		
		<li> 
			<a class="pmd-ripple-effect" href="dashboard.php">	
				<i class="media-left media-middle material-icons">dashboard</i>
				<span class="media-body">Главная</span>
			</a> 
		</li>

		<li> 
			<a class="pmd-ripple-effect" href="manage-order.php">	
				<i class="media-left media-middle material-icons">content_paste</i>
				<span class="media-body">Заказы</span>
			</a>
		</li>

		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" href="javascript:void(0);">	
				<i class="material-icons media-left pmd-sm">dns</i> 
				<span class="media-body">Категории</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="add-category.php">Добавить</a></li>
				<li><a href="manage-category.php">Все Категории</a></li>
				<li style="display:none;"><a href="edit-category.php"></a></li>
			</ul>
		</li>

		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" href="javascript:void(0);">	
				<i class="material-icons media-left pmd-sm">local_mall</i> 
				<span class="media-body">Товары</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="add-product.php">Добавить</a></li>
				<li><a href="manage-product.php">Все Товары</a></li>
				<li style="display:none;"><a href="edit-product.php"></a></li>
				<li style="display:none;"><a href="send-onesignal-product-notification.php"></a></li>
			</ul>
		</li>

		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" href="javascript:void(0);">	
				<i class="material-icons media-left pmd-sm">notifications</i> 
				<span class="media-body">Уведомления</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="add-notification.php">Добавить</a></li>
				<li><a href="manage-notification.php">Все Уведомления</a></li>
				<li style="display:none;"><a href="edit-notification.php"></a></li>
				<li style="display:none;"><a href="send-onesignal-notification.php"></a></li>
			</ul>
		</li>		

		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" href="javascript:void(0);">	
				<i class="material-icons media-left pmd-sm">live_help</i> 
				<span class="media-body">Помощь</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="add-help.php">Добавить</a></li>
				<li><a href="manage-help.php">Файлы Помощь</a></li>
				<li style="display:none;"><a href="edit-help.php"></a></li>
			</ul>
		</li>		

		<li> 
			<a class="pmd-ripple-effect" href="settings.php">	
				<i class="media-left media-middle material-icons">settings</i>
				<span class="media-body">Настройки</span>
			</a> 
		</li>

		<li> 
			<a class="pmd-ripple-effect" href="logout.php">	
				<i class="media-left media-middle material-icons">power_settings_new</i>
				<span class="media-body">Выход</span>
			</a> 
		</li>
		
	</ul>
</aside><!-- End Left sidebar -->
<!-- Sidebar Ends -->  