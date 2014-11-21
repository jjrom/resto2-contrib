<?php
    $_noSearchBar = true;
    $_noMap = true;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'head.php' ?>
    <body style="overflow-x: hidden;">
        <!-- Header -->
        <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'header.php' ?>
        
        <!-- Breadcrumb -->
        <?php include 'breadcrumb.php' ?>
        
        <div class="row maincontent" >
            
            <form>
                <h3 style="text-align: center;">
                    <?php echo $self->context->dictionary->translate('_a_text_createrights'); ?> <?php echo $self->collectionRight; ?> <?php echo $self->context->dictionary->translate('_for'); ?> <?php echo $self->userProfile['email'] ?>
                </h3>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_collection_and_feature'); ?></legend>
                    <label><?php echo $self->context->dictionary->translate('_a_feature_id'); ?>
                        <input id="featureid" type="text" placeholder="featureid..." value="">
                    </label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_search'); ?></legend>
                    <input type="radio" name="search" value="true" id="search"><label for="search"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="nosearch" value="false" id="nosearch"><label for="nosearch"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_visualize'); ?></legend>
                    <input type="radio" name="visualize" value="true" id="visualize"><label for="visualize"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="novisualize" value="false" id="novisualize"><label for="novisualize"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_download'); ?></legend>
                    <input type="radio" name="download" value="true" id="download"><label for="download"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="nodownload" value="false" id="nodownload"><label for="nodownload"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_can_post'); ?></legend>
                    <input type="radio" name="canpost" value="true" id="canpost"><label for="canpost"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="cantpost" value="false" id="cantpost"><label for="cantpost"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_can_put'); ?></legend>
                    <input type="radio" name="canput" value="true" id="canput"><label for="canput"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="cantput" value="false" id="cantput"><label for="cantput"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>
                <fieldset>
                    <legend><?php echo $self->context->dictionary->translate('_a_can_delete'); ?></legend>
                    <input type="radio" name="candelete" value="true" id="candelete"><label for="candelete"><?php echo $self->context->dictionary->translate('_true'); ?></label>
                    <input type="radio" name="cantdelete" value="false" id="cantdelete"><label for="cantdelete"><?php echo $self->context->dictionary->translate('_false'); ?></label>
                </fieldset>

            </form>

            <a id="_save" href="#" class="button expand"><?php echo $self->context->dictionary->translate('_a_save_right'); ?></a>
        </div>
        <!-- Footer -->
        <?php include realpath(dirname(__FILE__)) . '/../../../templates/' . 'footer.php' ?>

        <script type="text/javascript" >
            $(document).ready(function() {

                var self = this;

                function initialize() {
                    $('input:radio[name=nodownload]').attr('checked', true);
                    $('input:radio[name=nosearch]').attr('checked', true);
                    $('input:radio[name=novisualize]').attr('checked', true);
                    $('input:radio[name=cantpost]').attr('checked', true);
                    $('input:radio[name=cantput]').attr('checked', true);
                    $('input:radio[name=cantdelete]').attr('checked', true);
                }

                this.addRight = function() {
                    if ($("#featureid").val() === ''){
                       Resto.Util.alert($('.maincontent'), 'Please set featureid');
                    }else{
                        Resto.Util.showMask();
                        
                        $.ajax({
                            type: "POST",
                            async: false,
                            url: "<?php echo $self->context->baseUrl . 'administration/users/' . $self->segments[1] . '/rights' ?>",
                            dataType: "json",
                            data: {
                                emailorgroup: '<?php echo $self->userProfile['email'] ?>',
                                collection: '<?php echo $self->collectionRight; ?>',
                                featureid: $("#featureid").val(),
                                search: $('input[name=search]:checked').val(),
                                visualize: $('input[name=visualize]:checked').val(),
                                download: $('input[name=download]:checked').val(),
                                canput: $('input[name=canput]:checked').val(),
                                canpost: $('input[name=canpost]:checked').val(),
                                candelete: $('input[name=candelete]:checked').val(),
                                filters: 'null'
                            },
                            success: function() {
                                window.location = "<?php echo $self->context->baseUrl . 'administration/users/' . $self->segments[1] ?>";
                            },
                            error: function(e) {
                                Resto.Util.hideMask();
                                Resto.Util.alert($('.maincontent'),'error : ' + e['responseJSON']['ErrorMessage']);
                            }
                        });
                    }
                };
                
                $("#_save").on('click', function() {
                    self.addRight();
                });

                $("#download").on('click', function() {
                    $('input:radio[name=download]').attr('checked', true);
                    $('input:radio[name=nodownload]').attr('checked', false);
                });

                $("#nodownload").on('click', function() {
                    $('input:radio[name=download]').attr('checked', false);
                    $('input:radio[name=nodownload]').attr('checked', true);
                });

                $("#search").on('click', function() {
                    $('input:radio[name=search]').attr('checked', true);
                    $('input:radio[name=nosearch]').attr('checked', false);
                });

                $("#nosearch").on('click', function() {
                    $('input:radio[name=search]').attr('checked', false);
                    $('input:radio[name=nosearch]').attr('checked', true);
                });

                $("#visualize").on('click', function() {
                    $('input:radio[name=visualize]').attr('checked', true);
                    $('input:radio[name=novisualize]').attr('checked', false);
                });

                $("#novisualize").on('click', function() {
                    $('input:radio[name=visualize]').attr('checked', false);
                    $('input:radio[name=novisualize]').attr('checked', true);
                });

                $("#canpost").on('click', function() {
                    $('input:radio[name=canpost]').attr('checked', true);
                    $('input:radio[name=cantpost]').attr('checked', false);
                });

                $("#cantpost").on('click', function() {
                    $('input:radio[name=canpost]').attr('checked', false);
                    $('input:radio[name=cantpost]').attr('checked', true);
                });

                $("#canput").on('click', function() {
                    $('input:radio[name=canput]').attr('checked', true);
                    $('input:radio[name=cantput]').attr('checked', false);
                });

                $("#cantput").on('click', function() {
                    $('input:radio[name=canput]').attr('checked', false);
                    $('input:radio[name=cantput]').attr('checked', true);
                });

                $("#candelete").on('click', function() {
                    $('input:radio[name=candelete]').attr('checked', true);
                    $('input:radio[name=cantdelete]').attr('checked', false);
                });

                $("#cantdelete").on('click', function() {
                    $('input:radio[name=candelete]').attr('checked', false);
                    $('input:radio[name=cantdelete]').attr('checked', true);
                });

                initialize();
                
                $(document).ready(function() {
                    Resto.init({
                        "translation":<?php echo json_encode($self->context->dictionary->getTranslation()) ?>,
                        "language":'<?php echo $self->context->dictionary->language; ?>',
                        "restoUrl":'<?php echo $self->context->baseUrl ?>',
                        "ssoServices":<?php echo json_encode($self->context->config['ssoServices']) ?>,
                        "userProfile":<?php echo json_encode(!isset($_SESSION['profile']) ? array('userid' => -1) : array_merge($_SESSION['profile'], array('rights' => isset($_SESSION['rights']) ? $_SESSION['rights'] : array()))) ?>
                    });
                });
            });
        </script>
    </body>
</html>
