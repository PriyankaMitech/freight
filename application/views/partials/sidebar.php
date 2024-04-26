<?php
   $uri = new \CodeIgniter\HTTP\URI(current_url(true));
   $pages = $uri->getSegments();
   $page = $uri->getSegment(count($pages));
 ?>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"><span>Main</span></li>
                    <li class="<?php echo ($page == 'dashboard')?'active':'';?>">
                        <a href="dashboard"><i data-feather="home"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="<?php echo ($page == 'customer' || $page == 'add_customer' || $page == 'edit_customer')?'active':'';?>">
                        <a href="customer"><i data-feather="users"></i> <span>Customers</span></a>
                    </li>
                    <li class="<?php echo ($page == 'estimates' || $page == 'view_estimate' || $page == 'edit_estimate' || $page == 'add_estimate')?'active':'';?>">
                        <a href="estimates"><i data-feather="file-text"></i> <span>Estimates</span></a>
                    </li>
                    <li class="submenu <?php echo ($page == 'invoices' || $page == 'edit_invoice' || $page == 'view_invoice' || $page == 'invoice_grid' || $page == 'invoice_paid' || $page == 'invoice_overdue' || $page == 'invoice_draft' || $page == 'invoice_recurring' || $page == 'invoice_cancelled' || $page == 'invoices_settings' || $page == 'tax_settings' || $page == 'bank_settings' || $page == 'add_invoice' || $page == 'invoice_grid_two' || $page == 'view_invoice_two')?'active':'';?>">
                        <a href="#"><i data-feather="clipboard"></i> <span> Invoices</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'invoices' || $page == 'invoice_paid' || $page == 'invoice_overdue' || $page == 'invoice_draft' || $page == 'invoice_recurring' || $page == 'invoice_cancelled')?'active':'';?>" href="invoices">Invoices List</a></li>
                            <li><a class="<?php echo ($page == 'invoice_grid')?'active':'';?>" href="invoice_grid">Invoices Grid</a></li>
                            <li><a class="<?php echo ($page == 'invoice_grid_two')?'active':'';?>" href="invoice_grid_two">Invoices Grid 2</a></li>
                            <li><a class="<?php echo ($page == 'add_invoice')?'active':'';?>" href="add_invoice">Add Invoices</a></li>
                            <li><a class="<?php echo ($page == 'edit_invoice')?'active':'';?>" href="edit_invoice">Edit Invoices</a></li>
                            <li><a class="<?php echo ($page == 'view_invoice')?'active':'';?>" href="view_invoice">Invoices Details</a></li>
                            <li><a class="<?php echo ($page == 'view_invoice_two')?'active':'';?>" href="view_invoice_two">Invoices Details 2</a></li>
                            <li><a class="<?php echo ($page == 'invoices_settings' || $page == 'tax_settings' || $page == 'bank_settings')?'active':'';?>" href="invoices_settings">Invoices Settings</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($page == 'invoice_item' || $page == 'invoice_category')?'active':'';?>">
                        <a  href="invoice_item"><i data-feather="star"></i> <span>Items</span></a>
                    </li>
                    <li class="<?php echo ($page == 'payments' || $page == 'add_payments')?'active':'';?>">
                        <a href="payments"><i data-feather="credit-card"></i> <span>Payments</span></a>
                    </li>
                    <li class="<?php echo ($page == 'expenses' || $page == 'add_expenses' || $page == 'edit_expenses')?'active':'';?>">
                        <a href="expenses"><i data-feather="package"></i> <span>Expenses</span></a>
                    </li>
                    <li class="submenu <?php echo ($page == 'sales_report' || $page == 'expenses_report' || $page == 'profit_loss_report' || $page == 'tax_report')?'active':'';?>">
                        <a href="#"><i data-feather="pie-chart"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'sales_report')?'active':'';?>" href="sales_report">Sales Report</a></li>
                            <li><a class="<?php echo ($page == 'expenses_report')?'active':'';?>" href="expenses_report">Expenses Report</a></li>
                            <li><a class="<?php echo ($page == 'profit_loss_report')?'active':'';?>" href="profit_loss_report">Profit & Loss Report</a></li>
                            <li><a class="<?php echo ($page == 'tax_report')?'active':'';?>" href="tax_report">Taxs Report</a></li>
                        </ul>
                    </li>

                    <li class="submenu <?php echo ($page == 'blogs' || $page == 'pending_blog' || $page == 'add_blog' || $page == 'blog_details' || $page == 'edit_blog' || $page == 'blog_categories')?'active':'';?>">
                        <a href="#"><i data-feather="grid"></i> <span> Blogs</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'blogs' || $page == 'pending_blog' || $page == 'blog_details')?'active':'';?>" href="blogs">All Blogs</a></li>
                            <li><a class="<?php echo ($page == 'add_blog')?'active':'';?>" href="add_blog">Add Blog</a></li>
                            <li><a class="<?php echo ($page == 'edit_blog')?'active':'';?>" href="edit_blog">Edit Blog</a></li>
                            <li><a class="<?php echo ($page == 'blog_categories')?'active':'';?>" href="blog_categories">Categories</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo ($page == 'settings' || $page == 'preferences' || $page == 'tax_types' || $page == 'expense_category' || $page == 'notifications' || $page == 'change_password' || $page == 'delete_account')?'active':'';?>">
                        <a href="settings"><i data-feather="settings"></i> <span>Settings</span></a>
                    </li>
                    <li class="submenu <?php echo ($page == 'chat' || $page == 'calendar' || $page == 'inbox')?'active':'';?>">
                        <a href="#"><i data-feather="grid"></i> <span> Application</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'chat')?'active':'';?>" href="chat">Chat</a></li>
                            <li><a class="<?php echo ($page == 'calendar')?'active':'';?>" href="calendar">Calendar</a></li>
                            <li><a class="<?php echo ($page == 'inbox')?'active':'';?>" href="inbox">Email</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> 
                        <span>Pages</span>
                    </li>
                    <li class="<?php echo ($page == 'profile')?'active':'';?>"> 
                        <a href="profile"><i data-feather="user-plus"></i> <span>Profile</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i data-feather="lock"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="index"> Login </a></li>
                            <li><a href="register"> Register </a></li>
                            <li><a href="forgot_password"> Forgot Password </a></li>
                            <li><a href="lock_screen"> Lock Screen </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="error_404">404 Error </a></li>
                            <li><a href="error_500">500 Error </a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($page == 'users')?'active':'';?>"> 
                        <a href="users"><i data-feather="user"></i> <span>Users</span></a>
                    </li>
                    <li class="<?php echo ($page == 'blank_page')?'active':'';?>"> 
                        <a href="blank_page"><i data-feather="file"></i> <span>Blank Page</span></a>
                    </li>
                    <li class="<?php echo ($page == 'maps_vector')?'active':'';?>"> 
                        <a href="maps_vector"><i data-feather="map-pin"></i> <span>Vector Maps</span></a>
                    </li>
                    <li class="menu-title"> 
                        <span>UI Interface</span>
                    </li>
                    <li class="submenu <?php echo ($page == 'alerts' || $page == 'accordions' || $page == 'avatar' || $page == 'badges' || $page == 'buttons' || $page == 'buttongroup'|| $page == 'breadcrumbs'|| $page == 'cards'|| $page == 'carousel'|| $page == 'dropdowns'|| $page == 'grid'|| $page == 'images'|| $page == 'lightbox'|| $page == 'media'|| $page == 'modal'|| $page == 'offcanvas'|| $page == 'pagination'|| $page == 'popover'|| $page == 'progress'|| $page == 'placeholders'|| $page == 'rangeslider'|| $page == 'spinner'|| $page == 'sweetalerts'|| $page == 'tab'|| $page == 'toastr'|| $page == 'tooltip'|| $page == 'typography'|| $page == 'video')?'active':'';?>">
                        <a href="#"><i class="fab fa-get-pocket"></i> <span> Base UI</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'alerts' )?'active':'';?>" href="alerts">Alerts</a></li>
                            <li><a class="<?php echo ($page == 'accordions')?'active':'';?>" href="accordions">Accordions</a></li>
                            <li><a class="<?php echo ($page == 'avatar')?'active':'';?>" href="avatar">Avatar</a></li>
                            <li><a class="<?php echo ($page == 'badges')?'active':'';?>" href="badges">Badges</a></li>
                            <li><a class="<?php echo ($page == 'buttons' )?'active':'';?>" href="buttons">Buttons</a></li>
                            <li><a class="<?php echo ($page == 'buttongroup')?'active':'';?>" href="buttongroup">Button Group</a></li>
                            <li><a class="<?php echo ($page == 'breadcrumbs')?'active':'';?>" href="breadcrumbs">Breadcrumb</a></li>
                            <li><a class="<?php echo ($page == 'cards')?'active':'';?>" href="cards">Cards</a></li>
                            <li><a class="<?php echo ($page == 'carousel')?'active':'';?>" href="carousel">Carousel</a></li>
                            <li><a class="<?php echo ($page == 'dropdowns')?'active':'';?>" href="dropdowns">Dropdowns</a></li>
                            <li><a class="<?php echo ($page == 'grid')?'active':'';?>" href="grid">Grid</a></li>
                            <li><a class="<?php echo ($page == 'images')?'active':'';?>" href="images">Images</a></li>
                            <li><a  class="<?php echo ($page == 'lightbox')?'active':'';?>" href="lightbox">Lightbox</a></li>
                            <li><a class="<?php echo ($page == 'media')?'active':'';?>" href="media">Media</a></li>
                            <li><a class="<?php echo ($page == 'modal')?'active':'';?>" href="modal">Modals</a></li>
                            <li><a class="<?php echo ($page == 'offcanvas')?'active':'';?>" href="offcanvas">Offcanvas</a></li>
                            <li><a class="<?php echo ($page == 'pagination')?'active':'';?>" href="pagination">Pagination</a></li>
                            <li><a  class="<?php echo ($page == 'popover')?'active':'';?>" href="popover">Popover</a></li>
                            <li><a class="<?php echo ($page == 'progress')?'active':'';?>" href="progress">Progress Bars</a></li>
                            <li><a class="<?php echo ($page == 'placeholders')?'active':'';?>" href="placeholders">Placeholders</a></li>
                            <li><a  class="<?php echo ($page == 'rangeslider')?'active':'';?>" href="rangeslider">Range Slider</a></li>
                            <li><a  class="<?php echo ($page == 'spinner')?'active':'';?>" href="spinner">Spinner</a></li>
                            <li><a  class="<?php echo ($page == 'sweetalerts')?'active':'';?>" href="sweetalerts">Sweet Alerts</a></li>
                            <li><a class="<?php echo ($page == 'tab')?'active':'';?>" href="tab">Tabs</a></li>
                            <li><a  class="<?php echo ($page == 'toastr')?'active':'';?>" href="toastr">Toasts</a></li>
                            <li><a  class="<?php echo ($page == 'tooltip')?'active':'';?>" href="tooltip">Tooltip</a></li>
                            <li><a class="<?php echo ($page == 'typography')?'active':'';?>" href="typography">Typography</a></li>
                            <li><a class="<?php echo ($page == 'video')?'active':'';?>" href="video">Video</a></li>
                        </ul>
                    </li>
                    <li class="submenu <?php echo ($page == 'sweetalerts' || $page == 'tooltip' || $page == 'popover' || $page == 'ribbon' || $page == 'clipboard' || $page == 'drag_drop' || $page == 'rangeslider' || $page == 'rating' || $page == 'toastr' || $page == 'text_editor' || $page == 'counter' || $page == 'scrollbar' || $page == 'spinner' || $page == 'notifications' || $page == 'lightbox' || $page == 'stickynote' || $page == 'timeline' || $page == 'horizontal_timeline' || $page == 'form_wizard')?'active':'';?>">
                        <a href="#"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a  class="<?php echo ($page == 'ribbon')?'active':'';?>" href="ribbon">Ribbon</a></li>
                            <li><a  class="<?php echo ($page == 'clipboard')?'active':'';?>" href="clipboard">Clipboard</a></li>
                            <li><a  class="<?php echo ($page == 'drag_drop')?'active':'';?>" href="drag_drop">Drag & Drop</a></li>
                            <li><a  class="<?php echo ($page == 'rating')?'active':'';?>" href="rating">Rating</a></li>
                            <li><a  class="<?php echo ($page == 'text_editor')?'active':'';?>" href="text_editor">Text Editor</a></li>
                            <li><a  class="<?php echo ($page == 'counter')?'active':'';?>" href="counter">Counter</a></li>
                            <li><a  class="<?php echo ($page == 'scrollbar')?'active':'';?>" href="scrollbar">Scrollbar</a></li>
                            <li><a  class="<?php echo ($page == 'notifications')?'active':'';?>" href="notifications">Notification</a></li>
                            <li><a  class="<?php echo ($page == 'stickynote')?'active':'';?>" href="stickynote">Sticky Note</a></li>
                            <li><a  class="<?php echo ($page == 'timeline')?'active':'';?>" href="timeline">Timeline</a></li>
                            <li><a  class="<?php echo ($page == 'horizontal_timeline')?'active':'';?>" href="horizontal_timeline">Horizontal Timeline</a></li>
                            <li><a  class="<?php echo ($page == 'form_wizard')?'active':'';?>" href="form_wizard">Form Wizard</a></li>
                        </ul>
                    </li>
                    <li class="submenu <?php echo ($page == 'chart_apex' || $page == 'chart_js' || $page == 'chart_morris' || $page == 'chart_flot' || $page == 'chart_peity' || $page == 'chart_c3')?'active':'';?>">
                        <a href="#"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'chart_apex')?'active':'';?>" href="chart_apex">Apex Charts</a></li>
                            <li><a class="<?php echo ($page == 'chart_js')?'active':'';?>" href="chart_js">Chart Js</a></li>
                            <li><a class="<?php echo ($page == 'chart_morris')?'active':'';?>" href="chart_morris">Morris Charts</a></li>
                            <li><a class="<?php echo ($page == 'chart_flot')?'active':'';?>" href="chart_flot">Flot Charts</a></li>
                            <li><a class="<?php echo ($page == 'chart_peity')?'active':'';?>" href="chart_peity">Peity Charts</a></li>
                            <li><a class="<?php echo ($page == 'chart_c3')?'active':'';?>" href="chart_c3">C3 Charts</a></li>
                        </ul>
                    </li>
                    <li class="submenu <?php echo ($page == 'fontawesome' || $page == 'feather' || $page == 'iconic' || $page == 'material' || $page == 'pe7' || $page == 'simpleline' || $page == 'weather' || $page == 'typicon' || $page == 'flag')?'active':'';?>">
                        <a href="#"><i data-feather="award"></i> <span> Icons </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'fontawesome')?'active':'';?>" href="fontawesome">Fontawesome Icons</a></li>
                            <li><a class="<?php echo ($page == 'feather')?'active':'';?>" href="feather">Feather Icons</a></li>
                            <li><a class="<?php echo ($page == 'iconic')?'active':'';?>" href="iconic">Ionic Icons</a></li>
                            <li><a class="<?php echo ($page == 'material')?'active':'';?>" href="material">Material Icons</a></li>
                            <li><a class="<?php echo ($page == 'pe7')?'active':'';?>" href="pe7">Pe7 Icons</a></li>
                            <li><a class="<?php echo ($page == 'simpleline')?'active':'';?>" href="simpleline">Simpleline Icons</a></li>
                            <li><a class="<?php echo ($page == 'themify')?'active':'';?>" href="themify">Themify Icons</a></li>
                            <li><a class="<?php echo ($page == 'weather')?'active':'';?>" href="weather">Weather Icons</a></li>
                            <li><a class="<?php echo ($page == 'typicon')?'active':'';?>" href="typicon">Typicon Icons</a></li>
                            <li><a class="<?php echo ($page == 'flag')?'active':'';?>" href="flag">Flag Icons</a></li>
                        </ul>
                    </li>
                    <li class="submenu <?php echo ($page == 'form_basic' || $page == 'form_inputs' || $page == 'form_horizontal' || $page == 'form_vertical' || $page == 'form_mask' || $page == 'form_validation' || $page == 'form_select2' || $page == 'form_fileupload')?'active':'';?>">
                        <a href="#"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'form_basic')?'active':'';?>" href="form_basic">Basic Inputs </a></li>
                            <li><a class="<?php echo ($page == 'form_inputs')?'active':'';?>" href="form_inputs">Input Groups </a></li>
                            <li><a class="<?php echo ($page == 'form_horizontal')?'active':'';?>" href="form_horizontal">Horizontal Form </a></li>
                            <li><a class="<?php echo ($page == 'form_vertical')?'active':'';?>" href="form_vertical"> Vertical Form </a></li>
                            <li><a class="<?php echo ($page == 'form_mask')?'active':'';?>" href="form_mask">Form Mask </a></li>
                            <li><a class="<?php echo ($page == 'form_validation')?'active':'';?>" href="form_validation">Form Validation </a></li>
                            <li><a class="<?php echo ($page == 'form_select2')?'active':'';?>" href="form_select2">Form Select2 </a></li>
                            <li><a class="<?php echo ($page == 'form_fileupload')?'active':'';?>" href="form_fileupload">File Upload </a></li>
                        </ul>
                    </li>
                    <li class="submenu <?php echo ($page == 'tables_basic' || $page == 'data_tables')?'active':'';?>">
                        <a href="#"><i data-feather="layout"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php echo ($page == 'tables_basic')?'active':'';?>" href="tables_basic">Basic Tables </a></li>
                            <li><a class="<?php echo ($page == 'data_tables')?'active':'';?>" href="data_tables">Data Table </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->