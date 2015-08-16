<?php
require_once('./views/_helper.php');
?>

<table cellspacing="0" cellpadding="0">
  <colspan>
    <col width="5%" />
    <col width="35%" />
    <col width="30%" />
    <col width="5%" />
    <col width="5%" />
    <col width="10%" />
  </colspan>
  <tbody>
    <tr>
      <th></th>
      <th>Rezept</th>
      <th>Author</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <?php
      foreach ($recipes as $r) {
        $pos = $r['position'];
    ?>
      <tr <?php if (isset($_GET['active']) && $_GET['active'] == $r['id']) puts("class=\"active\"") ?>>
        <td><?php puts($r['id']) ?></td>
        <td><?php puts($r['title']) ?></td>
        <td><?php puts($r['authors']) ?></td>
        <td><a href="edit.php?id=<?php puts($r['id']) ?>">edit</a></td>
        <td><a href="javascript:if(confirm('delete?')) document.location = 'delete.php?id=<?php puts($r['id']) ?>'; else document.location = 'list.php';">delete</a></td>
        <td>
            <?php if ($pos > 0) { ?>
              <a href="?id=<?php puts($r['id']) ?>&pos=<?php puts($r['position']-1) ?>">up</a>
            <?php } ?>
            <?php if ($pos < count($recipes)-1) { ?>
              <a href="?id=<?php puts($r['id']) ?>&pos=<?php puts($r['position']+1) ?>">down</a>
            <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr><td colspan="6" style="color:red;text-align:right;"><a href="add.php">add</a></td></tr>
  </tfoot>
</table>
