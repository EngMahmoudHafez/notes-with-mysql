<?php

$connection =require_once './connection.php';


$notes=$connection->getNotes();
$currentNote=[
        'id'=>'',
        'tittle'=>'',
        'description'=>''
];
if(isset($_GET['id'])){

        $currentNote =$connection->getNoteById($_GET['id'])['0'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
<div>
    <form class="new-note" action="save.php" method="post">
        <input type="hidden" name="id" value="<?=$currentNote['id']?>">
        <input type="text" name="title" placeholder="Note title" autocomplete="off"
        value="<?=$currentNote['tittle']?>">
        <textarea name="description" cols="30" rows="4"
                  placeholder="Note Description" ><?=$currentNote['description']?></textarea>
        <button>
            <?php if ($currentNote['id']!=null)
                echo "Update Note";
            else
                echo "New Note";
            ?>
        </button>
    </form>
    <div class="notes">
        <?php foreach ($notes as $note){ ?>
        <div class="note">
            <div class="title">
                <a href="?id=<?=$note['id']?>"><?=$note['tittle']?></a>
            </div>
            <div class="description">
                <?=$note['description']?>
            </div>
            <small><?=$note['create_date']?></small>
            <form action="delete.php" method="post">
                <input type="hidden" name="id" value="<?=$note['id']?>" >
                <button  class="close">X</button>
            </form>

        </div>
            <?php }?>
    </div>
</div>
</body>
</html>