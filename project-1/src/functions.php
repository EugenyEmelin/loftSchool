<?php
function normalize($var)
{
    $var = trim($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}
function addOrder($user_id)
{
    global $dbh, $name, $email, $street, $home, $part, $appt, $floor, $comment, $payment, $callback, $mailParam;

    $add_order_sql = "INSERT INTO orders (user_id, street, home, part, appt, floor, user_comment, payment, callback)
                      VALUES (:user_id, :street, :home, :part, :appt, :floor, :user_comment, :payment, :callback)";
    $sth_add_order = $dbh->prepare($add_order_sql);
    $sth_add_order->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $sth_add_order->bindParam(':street', $street, PDO::PARAM_STR);
    $sth_add_order->bindParam(':home', $home, PDO::PARAM_STR);
    $sth_add_order->bindParam(':part', $part, PDO::PARAM_STR);
    $sth_add_order->bindParam(':appt', $appt, PDO::PARAM_STR);
    $sth_add_order->bindParam(':floor', $floor, PDO::PARAM_STR);
    $sth_add_order->bindParam(':user_comment', $comment, PDO::PARAM_STR);
    $sth_add_order->bindParam(':payment', $payment, PDO::PARAM_STR);
    $sth_add_order->bindParam(':callback', $callback, PDO::PARAM_STR);
    $sth_add_order->execute();

    //Отправка email или запись сообщения о заказе в файл
    $order_id = $dbh->lastInsertId();
    $paymentMethod = $payment === 'cash' ? 'Наличный расчёт' : 'Оплата по карте';
    $mailSubject = "Заказ №$order_id\n\r";
    $mailMsg = "$mailSubject\n\r$name, ваш заказ будет доставлен по адресу:\n\r\n\r";
    $mailMsg .= "Ул. $street, д. $home-$part, кв.$appt, этаж $floor\n\r\n\r";
    $mailMsg .= "Способ оплаты: $paymentMethod\n\r\n\r";
    echo 'Заказ оформлен! ';
    if (mail($email, $mailSubject, $mailMsg, $mailSubject, $mailParam)) {
        echo 'Письмо отправлено. ';
    } else {
        echo 'Письмо не отправлено. ';
        if(file_put_contents("../mail/order№$order_id.txt", $mailMsg, FILE_APPEND)) {
            echo 'Сообщение записано в файл.';
        } else {
            echo 'Не удалось записать сообщение в файл. ';
        }
    }
}
function addUser()
{
    global $dbh, $name, $phone, $email;

    $add_user_sql = "INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)";
    $sth_add_user = $dbh->prepare($add_user_sql);
    $sth_add_user->bindParam(':name', $name, PDO::PARAM_STR);
    $sth_add_user->bindParam(':email', $email, PDO::PARAM_STR);
    $sth_add_user->bindParam(':phone', $phone, PDO::PARAM_STR);
    $sth_add_user->execute();
    echo 'Пользователь добавлен. ';
}
function findUser()
{
    global $email, $dbh;

    $sth = $dbh->prepare("SELECT user_id, email FROM users WHERE email = :email");
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->execute();
    if ($sth->rowCount() === 1) {
        echo 'Пользователь найден. ';
        $user_id = $sth->fetch(PDO::FETCH_ASSOC)['user_id'];
        return $user_id;
    } else {
        echo 'Пользователь не найден. ';
        return false;
    }
}
