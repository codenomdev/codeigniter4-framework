<!-- Widget Start -->
<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="index.html">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                One<span class="font-w400">UI</span>
            </span>
        </a>
        <div>
            <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                <?php
                foreach (\unserialize($adminMenu) as $menuItem) :
                ?>
                    <li class="nav-main-item" id="<?= $menuItem->getId(); ?>">
                        <a class="nav-main-link <?php
                                                if ($menuItem->isCurrent()) {
                                                    echo 'active ';
                                                }
                                                if ($menuItem->hasChildren()) {
                                                    echo 'nav-main-link-submenu"';
                                                    echo ' data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">';
                                                } else {
                                                    echo '"href="' . $menuItem->getUri() . '">';
                                                } ?>
                            <?php
                            if ($menuItem->hasIcon()) :
                            ?>
                                <i class=" nav-main-link-icon <?= $menuItem->getIcon(); ?>"></i>
                        <?php endif; ?>
                        <?php
                        if ($menuItem->getAttribute('icon')) :
                        ?>
                            <i class="nav-main-link-icon <?= $menuItem->getAttribute('icon'); ?>"></i>
                        <?php endif; ?>
                        <span class="nav-main-link-name"><?= $menuItem->getLabel(); ?></span>
                        </a>
                        <?php if ($menuItem->hasChildren()) : ?>
                            <ul class="nav-main-submenu">
                                <?php foreach ($menuItem->getChildren() as $childItem) : ?>
                                    <li class="nav-main-item" id="<?= $childItem->getId(); ?>">
                                        <a class="nav-main-link" href="<?= $childItem->getUri(); ?>">
                                            <span class="nav-main-link-name"><?= $childItem->getLabel(); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Widget -->