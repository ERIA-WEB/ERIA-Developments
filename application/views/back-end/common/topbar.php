<?php
$user_data = $this->session->userdata('logged_in');
?>

<div class='page-topbar '>
    <div class='logo-area'></div>
    <div class='quick-area'>
        <div class='pull-left'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class='pull-right'>
                <div style="padding: 18px; font-size: 12px; "> <span id="log_req_head"> </span> <span id="log_req">
                    </span> </div>
            </div>
        </div>
        <div class='pull-right' style="margin-right:25px">
            <div class='pull-left'
                style="margin-top: 7px; color: #5596cf; font-weight: bold; padding: 10px; font-size: 9px;	 "> <span
                    id="date_time"></span> &nbsp;&nbsp;</div>
            <div class='pull-right'>
                <ul class="info-menu right-links list-inline list-unstyled">
                    <li class="profile showopacity">
                        <a href="#" data-toggle="dropdown" class="toggle">
                            <?php 
                                if (isset($profile)) {

                                    if ($profile->p_pic) { ?>
                            <img src="<?php echo base_url() ?>resources/images/profile/<?php echo $profile->p_pic ?>"
                                alt="user-image" class="img-circle img-inline" style="object-fit: cover;">
                            <?php } else { ?>
                            <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" alt="user-image"
                                class="img-circle img-inline" style="object-fit: cover;">
                            <?php }
                                } else { ?>
                            <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" alt="user-image"
                                class="img-circle img-inline" style="object-fit: cover;">
                            <?php } ?>
                            <span>
                                <?php 
                                $user_data = $this->session->userdata('logged_in');
                                //var_dump($user_data);
                                if (isset($user_data)) {
                                    echo substr($user_data['username'], 0, 5);
                                }
                                
                                ?>
                                <i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">
                            <!--<li>
                                    <a href="#settings">
                                        <i class="fa fa-wrench"></i>
                                        Settings
                                    </a>
                                </li>-->
                            <li>
                                <a href="<?php echo base_url() ?>system-content/Profile">
                                    <i class="fa fa-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li class="last">
                                <a href="<?php echo base_url() ?>Logout  ">
                                    <i class="fa fa-lock"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="chat-toggle-wrapper">
                        <a href="#" data-toggle="chatbar" class="toggle_chat"> <?php /*?>
                            <i class="fa fa-comments"></i>
                            <span class="badge badge-warning">9</span>
                            <i class="fa fa-times"></i>
                            <?php */ ?> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>