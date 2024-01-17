<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goodcard - track your collection of Pokémon cards</title>
</head>

<body>

    <h1>Goodcard - track your collection of Pokémon cards</h1>

    <form action="" method="POST">

        <input type="text" name="card_name" placeholder="name">
        <input type="text" name="card_primary_type" placeholder="primary type">
        <input type="text" name="card_secondary_type" placeholder="secondary type (optional)">
        <button type="submit">Create</button>
    </form>

    <ul>
        <?php foreach ($cards as $card) : ?>
            <li><?= $card['id'] ?></li>
            <li><?= $card['name'] ?></li>
            <li><?= $card['primary_type'] ?></li>
            <?php if (!empty($card['secondary_type'])) { ?> <li><?= $card['secondary_type'];
                                                            } ?></li>
                <form action="delete" method="POST">
                    <input type="hidden" name="card_id" value="<?= $card['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
                </br>
            <?php endforeach; ?>
    </ul>



</body>

</html>