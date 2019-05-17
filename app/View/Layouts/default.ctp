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
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
$nav_active = $this->fetch('title');
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
    <?php echo $this->Html->script('chart.min'); ?>
</head>
<body>
<div id="header">
    <div class="navbar-fixed">
        <nav class="white" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="#" class="brand-logo white-text"><img src="/img/long_logo.png" style="height: 1em; margin-top: 0.5em;"></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/users/logout" class="red-text text-lighten-1">Logout</a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/users/edit" class="red-text text-lighten-1">Profile</a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/deals" class="red-text text-lighten-1">Deals</a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/deals/report" class="red-text text-lighten-1">Report</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons red-text text-lighten-1">menu</i></a>
            </div>
        </nav>
    </div>
    <ul id="nav-mobile" class="sidenav white">
        <li><a href="/deals" class="red-text text-lighten-1">Deals</a></li>
        <li><a href="/deals/report" class="red-text text-lighten-1">Report</a></li>
        <li><a href="/users/edit" class="red-text text-lighten-1">Profile</a></li>
        <li><a href="/users/logout" class="red-text text-lighten-1">Logout</a></li>
    </ul>
</div>
<?php echo $this->Flash->render(); ?>
<main class="grey lighten-4 fullscreen">
    <?php echo $this->fetch('content'); ?>
</main>
<?php echo $this->element('sql_dump'); ?>
<?php echo $this->Html->script('materialize'); ?>
<?php echo $this->Html->script('init'); ?>
</body>
</html>
