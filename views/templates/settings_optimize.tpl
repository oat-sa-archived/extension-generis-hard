<?php
use oat\tao\helpers\Template;
?>

<?php
if (get_data('optimizable')) {
    Template::inc('optimize.tpl');
}
?>

<?php
Template::inc('form-footer.tpl', 'tao');
?>

