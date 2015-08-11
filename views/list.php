<?php
require_once('./views/_helper.php');
?>

<table>
  <colspan>
    <col width="5%" />
    <col width="40%" />
    <col width="40%" />
    <col width="5%" />
    <col width="5%" />
    <col width="5%" />
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
    <?php foreach ($recipes as $r) { ?>
      <tr>
        <td><?php puts($r['id']) ?></td>
        <td><?php puts($r['title']) ?></td>
        <td><?php puts($r['authors']) ?></td>
        <td><a href="edit.php?id=<?php puts($r['id']) ?>">edit</a></td>
        <td><a href="javascript:if(confirm('delete?')) document.location = 'delete.php?id=<?php puts($r['id']) ?>'; else document.location = 'list.php';">delete</a></td>
        <td><a href="?id=<?php puts($r['id']) ?>&pos=up">up</a> <a href="?id=<?php puts($r['id']) ?>&pos=down">down</a></td>
      </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr><td colspan="5" style="color:red;text-align:right;"><a href="add.php">add</a></td></tr>
  </tfoot>
</table>
