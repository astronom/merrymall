<h1>S carts List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Count</th>
      <th>Price</th>
      <th>User</th>
      <th>Item variant</th>
      <th>Order</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($s_carts as $s_cart): ?>
    <tr>
      <td><a href="<?php echo url_for('cart/edit?id='.$s_cart->getId()) ?>"><?php echo $s_cart->getId() ?></a></td>
      <td><?php echo $s_cart->getCount() ?></td>
      <td><?php echo $s_cart->getPrice() ?></td>
      <td><?php echo $s_cart->getUserId() ?></td>
      <td><?php echo $s_cart->getItemVariantId() ?></td>
      <td><?php echo $s_cart->getOrderId() ?></td>
      <td><?php echo $s_cart->getCreatedAt() ?></td>
      <td><?php echo $s_cart->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('cart/new') ?>">New</a>
