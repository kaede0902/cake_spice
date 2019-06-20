<h1>People Records</h1>


<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>mail</th>
        <th>age</th>
    
    </tr>
<?php foreach($data->toArray() as $obj): ?>

    <tr>
        <td><? h($obj->id) ?></td>
        <td><? h($obj->name) ?></td>
        <td><? h($obj->mail) ?></td>
        <td><? h($obj->age) ?></td>
    </tr>
</table>

<?php endforeach; ?>
