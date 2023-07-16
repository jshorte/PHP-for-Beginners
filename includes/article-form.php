<!-- Output errors into list -->
<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">

<!-- Display values if previously submitted -->
<!-- "htmlspecialchars" convert special chars to html to avoid XSS injection -->
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($title); ?>"> 
    </div>

    <div>
        <textarea name="content" id="content" rows="4" cols="40" placeholder="Article Content"><?= htmlspecialchars($content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?= htmlspecialchars($published_at); ?>">
    </div>

    <button>Save</button>

</form>