<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'DoneDeal');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php //echo $this->Html->meta('icon'); ?>
    <?php echo $this->Html->meta('icon', 'img/favicon.png', ['type' => 'image/png']) ?>
    <?php //echo $this->Html->css('cake.generic'); ?>
    <?php echo $this->Html->css('material-icons'); ?>
    <?php echo $this->Html->css('font-awesome.min'); ?>
    <?php echo $this->Html->css('materialize'); ?>
    <?php echo $this->Html->css('style'); ?>
    <?php echo $this->Html->script('jquery-3.3.1.min'); ?>
</head>
<body>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('sql_dump'); ?>
<?php echo $this->Html->script('materialize'); ?>
<?php echo $this->Html->script('init'); ?>
</body>
</html>
