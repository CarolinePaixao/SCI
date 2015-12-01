<div id="left" >
    <ul id="menu" class="collapse">
        <li class="panel">
            <a href="index.php" >
                <i class="icon-th-large"></i> Home
            </a>
        </li>
        <?php
        $active = (isset($_GET['p'])) ? $_GET['p'] : '';
        if($_SESSION['login']['role'] == 1) {
        ?>
            <li class="panel <?php if($active == 'equipe') echo 'active'; ?>">
                <a href="consulta.php?p=equipe"> <i class="icon-flag"></i> Equipes </a>
            </li>
            <li class="panel <?php if($active == 'missao') echo 'active'; ?>">
                <a href="consulta.php?p=missao"> <i class="icon-globe"></i> Missões </a>
            </li>
            <li class="panel <?php if($active == 'morador') echo 'active'; ?>">
                <a href="consulta.php?p=morador"> <i class="icon-male"></i> Moradores </a>
            </li>
        <?php
        }else if($_SESSION['login']['role'] == 2){
        ?>
            <li class="panel <?php if($active == 'equipe') echo 'active'; ?>">
                <a href="consulta.php?p=equipe"> <i class="icon-flag"></i> Equipes </a>
            </li>
            <li class="panel <?php if($active == 'igreja') echo 'active'; ?>">
                <a href="consulta.php?p=igreja"> <i class="icon-home"></i> Igrejas </a>
            </li>
            <li class="panel <?php if($active == 'missao') echo 'active'; ?>">
                <a href="consulta.php?p=missao"> <i class="icon-globe"></i> Missões </a>
            </li>
            <li class="panel <?php if($active == 'morador') echo 'active'; ?>">
                <a href="consulta.php?p=morador"> <i class="icon-male"></i> Moradores </a>
            </li>
        <?php
        }else if($_SESSION['login']['role'] == 3){
            ?>
            <li class="panel <?php if($active == 'calebe') echo 'active'; ?>">
                <a href="consulta.php?p=calebe"> <i class="icon-user"></i> Calebes </a>
            </li>
            <li class="panel <?php if($active == 'equipe') echo 'active'; ?>">
                <a href="consulta.php?p=equipe"> <i class="icon-flag"></i> Equipes </a>
            </li>
            <li class="panel <?php if($active == 'igreja') echo 'active'; ?>">
                <a href="consulta.php?p=igreja"> <i class="icon-home"></i> Igrejas </a>
            </li>
            <li class="panel <?php if($active == 'lider') echo 'active'; ?>">
                <a href="consulta.php?p=lider"> <i class="icon-star"></i> Líderes </a>
            </li>
            <li class="panel <?php if($active == 'missao') echo 'active'; ?>">
                <a href="consulta.php?p=missao"> <i class="icon-globe"></i> Missões </a>
            </li>
            <li class="panel <?php if($active == 'morador') echo 'active'; ?>">
                <a href="consulta.php?p=morador"> <i class="icon-male"></i> Moradores </a>
            </li>
            <li class="pane <?php if($active == 'aux') echo 'active'; ?>l">
                <a href="consulta.php?p=aux"> <i class="icon-file"></i> Religiões </a>
            </li>
            <?php
        }else{
            unset($_SESSION);
            header("Location:login.html");
        }
        ?>

        <li class="panel <?php if($active == 'estatisticas') echo 'active'; ?>">
            <a href="consulta.php?p=estatisticas"> <i class="icon-bar-chart"></i> Estatísticas </a>
        </li>
    </ul>
</div>
