<?php 
    foreach($notes as $note) {  ?>

    <form class='edit-description' action="/notes/update/<?= $note['id'] ?>" method='POST'>
        <h4><?= $note['title'] ?></h4>
        <textarea name="description" id="description" cols="70" rows="10" placeholder="Edit description here..."><?= $note['description'] ?></textarea>
        <br>
        <input class='update' type="submit" value="Update">
    </form>

    <form action="/notes/delete" method="post">
            <button type="submit" class='remove-yes' name="id" value="<?= $note['id'] ?>">Delete</button>
    </form>

<?php }  ?>