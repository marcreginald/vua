
	<!-- begin #header -->
	<div id="header" class="header navbar navbar-danger navbar-fixed-top">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="<?= site_url('inbox'); ?>" class="navbar-brand"> VUA SYSTEM (VUA系統)</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end mobile sidebar expand / collapse button -->

			<!-- begin navbar-right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"  style="display: none;">
					<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle has-notify" data-click="toggle-notify">
						<i class="fa fa-reply"></i>
					</a>
					<ul class="dropdown-menu dropdown-notification pull-right">
	                    <li class="dropdown-header" >Inbox (0)</li>
	                    <li class="notification-item">
	                        <a href="javascript:;">
                            	<div class="message">
                               	<h6 class="title">Read here.. &nbsp <span class="fa fa-eye fa-sm"></span></h6>	                     </div>
	                        </a>
	                    </li>
					</ul>
				</li>
				<li class="dropdown">
					<!-- 12:55PM 10-28-2017 -->
					<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle has-notify" data-click="toggle-notify" style="display: none;">
						<i class="fa fa-bell"></i>
					</a>
					<ul class="dropdown-menu dropdown-notification pull-right">
	                    <li class="dropdown-header">Notifications (<?= $user_dat['noti']; ?>)</li>
	                    <li class="notification-item">
	                        <a href="javascript:;">
	                            <div class="media"><i class="fa fa-exclamation-triangle"></i></div>
	                            <div class="message">
	                                <h6 class="title">Server Error Reports</h6>
	                           </div>
	                            <div class="option" data-toggle="tooltip" data-title="Mark as Read" data-click="set-message-status" data-status="unread" data-container="body">
	                                <i class="fa fa-circle-o"></i>
	                            </div>
	                        </a>
	                    </li>
	                    <li class="notification-item">
	                        <a href="javascript:;">

	                            <div class="media"><img src="<?= $user_dat['pic']; ?>" alt="" /></div>
	                            <div class="message">
	                                <h6 class="title">Solvia Smith</h6>
	                                <p class="desc">Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
	                         </div>
	                            <div class="option read" data-toggle="tooltip" data-title="Mark as Unread" data-click="set-message-status" data-status="read" data-container="body">
	                                <i class="fa fa-circle-o"></i>
	                            </div>
	                        </a>
	                    </li>
	                    <li class="notification-item">
	                        <a href="javascript:;">
	                            <div class="media"><img src="<?= $user_dat['pic']; ?>" alt="" /></div>
	                            <div class="message">
	                                <h6 class="title">Olivia</h6>
	                                <p class="desc">Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
	                            </div>
	                            <div class="option read" data-toggle="tooltip" data-title="Mark as Unread" data-click="set-message-status" data-status="read" data-container="body">
	                                <i class="fa fa-circle-o"></i>
	                            </div>
	                        </a>
	                    </li>
					</ul>
				</li>
				<li class="dropdown navbar-user">
					<span style="display: none;" id="user-id"><?= $user_dat['userid']; ?></span>
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="image"><img src="<?= $user_dat['pic']; ?>" alt="<?= $user_dat['name'].'Image'; ?>" /></span>
						<span class="hidden-xs"><?= $user_dat['name']; ?></span> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu pull-right">
						<!-- old inbox -->
						<!-- <li id="profile"><a href="<?= site_url('profile'); ?>">Edit Profile</a></li> -->
						<li id="profile"><a href="<?= site_url('changepass'); ?>">Change Password</a></li>
						<li class="divider" ></li>
						
						<!-- <li id="logout"><a href="javascript:;">Log Out</a></li> -->
						<li id="logout"><a href="<?= site_url('login'); ?>">Log Out</a></li>
					</ul>
				</li>
				<li>
                    <!--<a href="javascript:;" >
                        <i class="fa fa-bell"></i>
                    </a>-->
                    <a href="javascript:;" class="dropdown-toggle" data-click="right-sidebar-toggled" id="noti-flag">
                        <i class="fa fa-bell"></i>
                        <!-- style="background: rgb(50, 183, 123);" -->
                     </a>
                </li>
                
			</ul>
			<!-- end navbar-right -->
		</div>
		<!-- end container-fluid -->
	</div>
	<!-- end #header
