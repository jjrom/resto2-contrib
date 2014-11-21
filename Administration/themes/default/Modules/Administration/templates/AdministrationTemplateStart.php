<?php
$_noSearchBar = true;
$_noMap = true;
$_noBreadcrumb = true;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'head.php' ?>
    <body style="overflow-x: hidden;">
        <!-- Header -->
        <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'header.php' ?>
        
        <!-- Breadcrumb -->
        <?php include 'breadcrumb.php' ?>

        <div class="row" style="text-align: center; padding-top: 25px">
            <ul class="small-block-grid-1 large-block-grid-2" >
                <li>
                    <h1>Administration</h1>
                    <p>
                        <?php echo $self->context->dictionary->translate('_a_start'); ?>
                    </p>
                </li>
                <li>
                    <ul class="small-block-grid-1 large-block-grid-1">
                        <li>

                            <a href="<?php echo $self->context->baseUrl . 'administration/users/'; ?>" class="button expand"><?php echo $self->context->dictionary->translate('_a_users_management'); ?></a>

                        </li>
                        <li>

                            <a href="<?php echo $self->context->baseUrl . 'administration/collections'; ?>" class="button expand"><?php echo $self->context->dictionary->translate('_a_collections_management'); ?></a>

                        </li>
                        <li>

                            <a href="<?php echo $self->context->baseUrl . 'administration/users/creation'; ?>" class="button expand"><?php echo $self->context->dictionary->translate('_a_user_creation'); ?></a>

                        </li>
                        <li>

                            <a href="<?php echo $self->context->baseUrl . 'administration/users/history'; ?>" class="button expand"><?php echo $self->context->dictionary->translate('_a_history'); ?></a>

                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="small-block-grid-1 large-block-grid-3" >
                <li>
                    <div class='panel'>
                        <h1><?php echo $self->context->dictionary->translate('_a_users'); ?></h1>
                        <h1><?php echo $self->stats['nb_users']['count'];?></h1>
                    </div>
                </li>
                <li>
                    <div class='panel'>
                        <h1><?php echo $self->context->dictionary->translate('_a_downloads'); ?></h1>
                        <h1><?php echo $self->stats['nb_downloads']['count'];?></h1>
                    </div>
                </li>
                <li>
                    <div class='panel'>
                        <h1><?php echo $self->context->dictionary->translate('_a_searchs'); ?></h1>
                        <h1><?php echo $self->stats['nb_search']['count'];?></h1>
                    </div>
                </li>
            </ul>

        </div>
        <!-- Footer -->
        <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'footer.php' ?>
        
        <script type="text/javascript">
            $(document).ready(function() {
                Resto.init({
                    "translation":<?php echo json_encode($self->context->dictionary->getTranslation()) ?>,
                    "language":'<?php echo $self->context->dictionary->language; ?>',
                    "restoUrl":'<?php echo $self->context->baseUrl ?>',
                    "ssoServices":<?php echo json_encode($self->context->config['ssoServices']) ?>,
                    "userProfile":<?php echo json_encode(!isset($_SESSION['profile']) ? array('userid' => -1) : array_merge($_SESSION['profile'], array('rights' => isset($_SESSION['rights']) ? $_SESSION['rights'] : array()))) ?>
                });
            });
        </script>
    </body>
</html>
