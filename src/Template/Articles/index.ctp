
<h1>Articles</h1>
<?php
#    $this->Html->link(
#        'Articles', 
#        ['action' => 'index']
#    )
?>
<?= 
    $this->Html->link(
        '+  Add Article', 
        ['action' => 'add']
    ) 
?>
<table>
    <tr>
        <th>Title</th>
        <th>Auther</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    
    <?php 
        foreach ($articles as $article): 
        #debug($this->Articles);
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
        </td>
        <td>
            <?=
                $article->created->format(DATE_RFC850)
            ?>
        </td>
        <td>
            <?= 
                $this->Html->link('Edit', ['action' => 'edit', $article->slug]) 
            ?>
            <?=
                $this->Form->postLink(
                    'Delete',
                    ['action'=>'delete', $article->slug],
                    ['confirm'=>'Are you sure?']
                )
            ?>
        </td>

    </tr>
    <?php endforeach; ?>
    
</table>
