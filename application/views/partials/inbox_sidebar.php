<?php
   $uri = new \CodeIgniter\HTTP\URI(current_url(true));
   $pages = $uri->getSegments();
   $page = $uri->getSegment(count($pages));
 ?>

<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li> 
                                <a href="dashboard"><i class="la la-home"></i> <span>Back to Home</span></a>
                            </li>
                            <li class="<?php echo ($page == 'inbox' || $page == 'mail_view')?'active':'';?>"> 
                                <a href="inbox">Inbox <span class="mail-count">(21)</span></a>
                            </li>
                            <li> 
                                <a href="#">Starred</a>
                            </li>
                            <li> 
                                <a href="#">Sent Mail</a>
                            </li>
                            <li> 
                                <a href="#">Trash</a>
                            </li>
                            <li> 
                                <a href="#">Draft <span class="mail-count">(8)</span></a>
                            </li>
                            <li class="menu-title">Label <a href="#"><i class="fa fa-plus"></i></a></li>
                            <li> 
                                <a href="#"><i class="fa fa-circle text-success mail-label"></i> Work</a>
                            </li>
                            <li> 
                                <a href="#"><i class="fa fa-circle text-danger mail-label"></i> Office</a>
                            </li>
                            <li> 
                                <a href="#"><i class="fa fa-circle text-warning mail-label"></i> Personal</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Sidebar -->
