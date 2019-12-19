<!--begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		
		<!--begin the sidebar-->
		<ul class="nav">
            
            <li class="nav-user">
                <div class="image">
                    <img src="<?= $user_dat['pic']; ?>" alt="" />
                </div>
                <div class="info">
                    <div class="name dropdown">
                        <span> <?= $user_dat['name']; ?></span>
                        <!-- <ul class="dropdown-menu">
                            <li><a href="<?= site_url('profile'); ?>">Edit Profile</a></li>
                        </ul> -->
                    </div>
                    <div class="position" id="user-position"><?= $acc_type; ?></div>
                </div>
            </li>
        
            <li class="nav-header">Menu (菜單)</li>
            
            <li id="dashboard">
                <a href="<?= site_url('dashboard') ?>">
                    <i class="fa fa-home"></i>
                    <span>Dashboard (儀表板)</span>
                </a>
            </li>  <!--draftagent-->
            
            <li id="draftagent">
                <a href="<?= site_url('draftagent'); ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Draft (草案)</span>
                </a>
            </li>  <!--draftagent-->
            
            <li id="sent">
                <a href="<?= site_url('sent'); ?>">
                    <i class="fa fa-send-o"></i>
                    <span>Sent (發送)</span>
                </a>
            </li>  <!--sent-->
            
		    <li id="inbox">
                <a href="<?= site_url('inbox'); ?>">
                <span class="badge pull-right" title="Inbox SA"></span>
                    <i class="fa fa-envelope-o"></i>
                    <span>Inbox (收件箱)</span>
                </a>
            </li>  <!--inbox-->
            
            <li id="batchrecords">
                <a href="<?= site_url('batchrecords'); ?>">
                <span class="badge pull-right hd" title="Inbox SA">1</span>
                    <i class="fa fa-file-text-o"></i>
                    <span>Batch Records (撰寫信件)</span>
                </a>
            </li>  <!--batchrecords-->
            
            <li id="mgrdraftrquestlet">
                <a href="<?= site_url('mgrdraftrquestlet'); ?>">
                <span class="badge pull-right hd" title="Inbox SA">1</span>
                    <i class="fa fa-file-pdf-o"></i>
                    <!-- <span>Saved (Request Letter)</span> -->
                    <span>Request Letters (請求信)</span>
                </a>
            </li>  <!--mgrdraftrquestlet-->
            
            <!-- <li class="has-sub active" id="visa">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-files-o"></i>
                    <span>Visa (簽證)</span> 
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li id="inprocess"><a href="<?= site_url('inprocess'); ?>">In-Process (在進程)</a></li>
                    <li id="approved"> <a href="<?= site_url('approved'); ?>"> Approved (批准)</a></li>
                </ul>
            </li> visa -->

            <li id="transactions">
                <a href="<?= site_url('transactions'); ?>">
                    <i class="fa fa-archive"></i>
                    <span>Transactions (交易)</span>
                </a>
            </li>  <!--transactions-->

            <li id="junk">
                <a href="<?= site_url('junk'); ?>">
                    <i class="fa fa-trash-o"></i>
                    <span>Junk (破爛)</span>
                </a>
            </li>  <!--junk-->

            <li id="users">
                <a href="<?= site_url('users'); ?>">
                    <i class="fa fa-group"></i>
                    <span>Users (用戶)</span>
                </a>
            </li>  <!--users-->

            <li id="settings">
                <a href="<?= site_url('settings'); ?>">
                    <i class="fa fa-cog"></i>
                    <span>Settings (設置)</span>
                </a>
            </li>  <!--settings-->
            
            <!-- left arrow -->
			<li class="divider has-minify-btn">
                <!-- begin sidebar minify button -->
                <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-left"></i></a>
                <!-- end sidebar minify button -->
			</li>
            
		</ul>
		<!--end sidebar-->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
