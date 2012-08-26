<h1>S wishlists List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Item</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($s_wishlists as $s_wishlist): ?>
    <tr>
      <td><a href="<?php echo url_for('wishlist/edit?id='.$s_wishlist->getId()) ?>"><?php echo $s_wishlist->getId() ?></a></td>
      <td><?php echo $s_wishlist->getUserId() ?></td>
      <td><?php echo $s_wishlist->getItemVariantId() ?></td>
      <td><?php echo $s_wishlist->getCreatedAt() ?></td>
      <td><?php echo $s_wishlist->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wishlist/new') ?>">New</a>
