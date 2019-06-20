
<h1>Articles</h1>
<?php
#    $this->Html->link(
#        'Articles', 
#        ['action' => 'index']
#    )
?>
<table>
    <tr>
        <td>
            <?= 
                $this->Html->link(
                    '+  Add Article', 
                    ['action' => 'add']
                ) 
            ?>
            <img src="https://cdn1.iconfinder.com/data/icons/hawcons/32/698554-icon-42-note-add-512.png" width="40" height="40"> 
            
        </td>
        <td>
            current user:  <?= $printUser?>
            <img src="https://cdn3.iconfinder.com/data/icons/linecons-free-vector-icons-pack/32/user-512.png" width="40" height="40"> 
        </td>
    </tr>

</table>

<table>
    <tr>
        <th>Title</th>
        <th>Auther</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    
    <?php 
        foreach ($articles as $article): 
    ?>
    <tr>

        <td>
            <?=
                $this -> Html -> link(
                    $article -> title, [
                        'action' => 'view', $article -> slug
                    ]
                )
            ?>
        </td>
        <td>
            <?=
                $this -> Html -> link(
                    $article -> user_id, [
                        'action' => 'view', $article -> slug
                    ]
                )
            ?>
            <img src="https://cdn1.iconfinder.com/data/icons/company-business-people-1/32/busibess_people-50-256.png" width="40" height="40"> 
        </td>
        <td>
            <?=
                $article->created->format(DATE_RFC850)
            ?>
        </td>
        <td>
                <img src="https://cdn1.iconfinder.com/data/icons/hawcons/32/698983-icon-136-document-edit-512.png" width="40" height="40"> 
            <?= 
                $this->Html->link('Edit', ['action' => 'edit', $article->slug]) 
            ?>
            <?=
                $this->Form->postLink(
                    'Delete',
                    ['action'=>'delete', $article->slug],
                    ['confirm'=>'Are you sure?']
                );
            ?>
                <img src="https://cdn4.iconfinder.com/data/icons/evil-icons-user-interface/64/basket-512.png" width="40" height="40"> 
        </td>

    </tr>
    <?php endforeach; ?>
    
</table>
