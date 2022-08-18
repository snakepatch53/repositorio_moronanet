<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('./view/component/head.php') ?>
    <title>Archivos</title>
</head>

<body>
    <div class="title">Visor de Archivos Moronanet</div>
    <?= getBackLink($proyect, $currentFolder) ?>

    <?php
    if ($handle = opendir($currentFolder)) {
        $counter = 0;
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if (is_dir($currentFolder . '/' . $entry)) {
                    echo getItem($proyect, $currentFolder, $entry, false);
                } else {
                    echo getItem($proyect, $currentFolder, $entry, true);
                }
                $counter++;
            }
        }
        closedir($handle);
    }
    ?>
</body>

</html>

<?php
function getItem($proyect, $url, $data,  $isFile)
{
    $url = str_replace('./', '', $url);
    if (!$isFile) {
        $url = str_replace('data', '', $url);
    }
    ob_start();
?>
    <a class="item" href="<?= $proyect['root_absolute'] . $url . "/" . $data ?>">
        <img src="<?= $proyect['root_absolute'] ?>view/icon/<?= $isFile ? "file" : "folder" ?>.png" />
        <span><?= $data ?></span>
    </a>
    <?php
    $html = ob_get_clean();
    return $html;
}
function getBackLink($proyect, $currentFolder)
{
    $temp = [];
    if ($currentFolder != './data') {
        $currentFolder = str_replace('./data', '', $currentFolder);
        $currentFolder = array_filter(explode('/', $currentFolder));
        $currentFolder = array_slice($currentFolder, 0, count($currentFolder) - 1);
        $temp = $currentFolder;
        $currentFolder = implode('/', $currentFolder);
        ob_start();
    ?>
        <a class="item" href="<?= $proyect['root_absolute'] . $currentFolder ?>">
            <img src="<?= $proyect['root_absolute'] ?>view/icon/return.png" />
            <span>Regresar a <?= $currentFolder == '' ? 'Inicio' : $temp[count($temp) - 1] ?></span>
        </a>
<?php
        $html = ob_get_clean();
        return $html;
    } else {
        return '';
    }
}
?>