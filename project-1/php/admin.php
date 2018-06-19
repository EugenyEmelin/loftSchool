<?php
require_once '../src/db.php';

$users_select = $dbh->prepare("SELECT user_id, name, email, phone FROM users");
$users_select->execute();
echo '<table border="1" cellspacing="0" cellpadding="3">';
echo '<h3>Зарегистрированные пользователи</h3>';
echo '<tr><th>userID</th><th>Имя</th><th>email</th><th>Телефон</th></tr>';
while ($user = $users_select->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$user['user_id']}</td><td>{$user['name']}</td><td>{$user['email']}</td><td>{$user['phone']}</td>
          </tr>";
}
echo '</table>';

$orders_select_sql = "SELECT order_id, user_id, street, home, part, appt, floor, user_comment, payment, callback
                      FROM orders";
$orders_select = $dbh->prepare($orders_select_sql);
$orders_select->execute();
echo '<table border="1" cellspacing="0" cellpadding="3">';
echo '<h3>Спсок заказов</h3>';
echo '<tr>
        <th>orderID</th>
        <th>userID</th>
        <th>Улица</th>
        <th>Дом</th>
        <th>Корпус</th>
        <th>Квартира</th>
        <th>Этаж</th>
        <th>Доп. информация</th>
        <th>Способ оплаты</th>
        <th>Позвонить?</th>
      </tr>';
while ($order = $orders_select->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$order['order_id']}</td>
            <td>{$order['user_id']}</td>
            <td>{$order['street']}</td>
            <td>{$order['home']}</td>
            <td>{$order['part']}</td>
            <td>{$order['appt']}</td>
            <td>{$order['floor']}</td>
            <td>{$order['user_comment']}</td>
            <td>{$order['payment']}</td>
            <td>{$order['callback']}</td>
          </tr>";
}
echo '</table>';
