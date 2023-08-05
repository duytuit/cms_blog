<div class="row">
    <div class="container">
        <div class="nav-top">
            <ul class="left">
                <?php if (!empty($menuLinks)):
                    foreach ($menuLinks as $item):
                        if ($item->item_location == "top"):?>
                            <li><a href="<?= generateMenuItemUrl($item); ?>"><?= esc($item->item_name); ?> </a></li>
                        <?php endif;
                    endforeach;
                endif; ?>
            </ul>
            <ul class="right">
                <?php if (authCheck()) : ?>
                    <li class="dropdown profile-dropdown nav-item-right">
                        <a href="#" class="dropdown-toggle image-profile-drop" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= getUserAvatar(user()); ?>" alt="<?= esc(user()->username); ?>" width="24" height="24">
                            <?= esc(limitCharacter(user()->username, 20, '...')); ?>&nbsp;
                            <i class="icon-arrow-down"></i>
                        </a>
                        <ul class="dropdown-menu top-dropdown">
                            <?php if (isAdmin() || isAuthor()): ?>
                                <li><a href="<?= adminUrl(); ?>"><i class="icon-dashboard"></i>&nbsp;<?= trans("admin_panel"); ?></a></li>
                            <?php endif; ?>
                            <li><a href="<?= langBaseUrl('profile/' . user()->slug); ?>"><i class="icon-user"></i>&nbsp;<?= trans("profile"); ?></a></li>
                            <li><a href="<?= langBaseUrl('reading-list'); ?>"><i class="icon-star-o"></i>&nbsp;<?= trans("reading_list"); ?></a></li>
                            <li><a href="<?= langBaseUrl('settings'); ?>"><i class="icon-settings"></i>&nbsp;<?= trans("settings"); ?></a></li>
                            <li><a href="<?= langBaseUrl('logout'); ?>"><i class="icon-logout"></i>&nbsp;<?= trans("logout"); ?></a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <?php if ($generalSettings->registration_system == 1): ?>
                        <li><a href="<?= langBaseUrl('login'); ?>"><?= trans("login"); ?></a></li>
                        <li><span class="span-sep">/</span></li>
                        <li><a href="<?= langBaseUrl('register'); ?>"><?= trans("register"); ?></a></li>
                    <?php endif; ?>
                <?php endif; ?>
    
                <li class="li-dark-mode-sw">
                    <form action="<?= base_url('inf-switch-mode'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <?php if ($darkMode == 1): ?>
                            <button type="submit" name="dark_mode" value="0" class="btn-switch-mode">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#666666" class="inf-svg-icon bi bi-sun-fill" viewBox="0 0 16 16">
                                    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                </svg>
                            </button>
                        <?php else: ?>
                            <button type="submit" name="dark_mode" value="1" class="btn-switch-mode">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#666666" class="inf-svg-icon bi bi-moon-fill dark-mode-icon" viewBox="0 0 16 16">
                                    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                                </svg>
                            </button>
                        <?php endif; ?>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>