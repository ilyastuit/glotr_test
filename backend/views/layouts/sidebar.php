<?php
$username = Yii::$app->user->getIdentity()->username ?? "Guest";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">TODO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $username?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => 'TODO List', 'header' => true],
                    ['label' => 'Список задач', 'icon' => 'th', 'url' => ['/tasks']],
                    ['label' => 'Статусы', 'icon' => 'th', 'url' => ['/status']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>