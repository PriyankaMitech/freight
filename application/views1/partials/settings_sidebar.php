<?php
   $uri = new \CodeIgniter\HTTP\URI(current_url(true));
   $pages = $uri->getSegments();
   $page = $uri->getSegment(count($pages));
 ?>
<!-- Settings Menu -->
<div class="widget settings-menu">
    <ul>
        <li class="nav-item">
            <a href="settings" class="nav-link <?php echo ($page == 'settings')?'active':'';?>">
                <i class="far fa-user"></i> <span>Profile Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="preferences" class="nav-link <?php echo ($page == 'preferences')?'active':'';?>">
                <i class="fas fa-cog"></i> <span>Preferences</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="tax_types" class="nav-link <?php echo ($page == 'tax_types')?'active':'';?>">
                <i class="far fa-check-square"></i> <span>Tax Types</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="expense_category" class="nav-link <?php echo ($page == 'expense_category')?'active':'';?>">
                <i class="far fa-list-alt"></i> <span>Expense Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="notification" class="nav-link <?php echo ($page == 'notification')?'active':'';?>">
                <i class="far fa-bell"></i> <span>Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="change_password" class="nav-link <?php echo ($page == 'change_password')?'active':'';?>">
                <i class="fas fa-unlock-alt"></i> <span>Change Password</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="delete_account" class="nav-link <?php echo ($page == 'delete_account')?'active':'';?>">
                <i class="fas fa-ban"></i> <span>Delete Account</span>
            </a>
        </li>
    </ul>
</div>
<!-- /Settings Menu -->