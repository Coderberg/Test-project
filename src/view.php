<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>

<body>

<div class="container bg-white shadow">

    <h2>Please leave your feedback</h2>

    <?php if ($errors): ?>

        <div class="alert alert-danger">
            <ul>

                <?php foreach ($errors as $error): ?>

                    <li><?= $error; ?></li>

                <?php endforeach; ?>

            </ul>
        </div>

    <?php endif; ?>

    <div id="alert"></div>

    <form method="post" id="form">

        <input type="hidden" id="_csrf_token" name="_csrf_token" value="<?=$token?>">

        <label for="name">Name: <span class="red">*</span></label><br>
        <input type="text" id="name" name="name" class="form-control"><br>

        <label for="email">E-mail: <span class="red">*</span></label><br>
        <input type="email" id="email" name="email" class="form-control"><br>

        <label for="text">Text: <span class="red">*</span></label><br>
        <textarea id="text" name="text" class="form-control" rows="2"></textarea><br>

        <div class="button">
            <button type="submit" id="submit" class="btn">Send your message</button>
        </div>
    </form>

</div>

<?php if (!$items): ?>

    <div class="container bg-white shadow">

        No feedback yet

    </div>

<?php else: ?>

    <?php foreach ($items as $item): ?>

        <div class="container bg-white shadow">

            <strong><?= $item['name'] ?></strong><br>

            <?= $item['email'] ?><br>

            <small>
                <?= format_date($item['published_at']) ?>
            </small>
            <br><br>

            <?= $item['text'] ?><br>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

<script src="js/jquery.min.js"></script>
<script src="js/feedback.js"></script>

</body>
</html>
