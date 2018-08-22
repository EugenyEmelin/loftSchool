<div class="container">
    <button class="btn btn-default" id="send">Кнопка</button>
    <?php if (count($users) > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <?php
                foreach ($theads as $thead) {
                    echo "<th scope='col'>$thead</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
                echo '<tr>';
                    echo "<td><img src=/public/img/users-images/{$user['photo']} width='30' height='30'></td>";
                    echo "<td>{$user['username']}</td>";
                    echo "<td>{$user['email']}</td>";
                    echo "<td>{$user['age']}</td>";
                    echo "<td>{$user['created_at']}</td>";
                    echo "<td>".mb_strimwidth($user['about'], 0, 35, '...')."</td>";
                echo '</tr>';
            }?>
        </tbody>
    </table>
    <?php
        else: echo 'Ничего не найдено';
        endif
    ?>
</div>
<script>
    document.querySelector('#send').addEventListener('click', function (e) {
        e.preventDefault()
        fetch('/user/all', {
            method: 'POST',
            body: 'id=2',
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).then(function(response) {
            return response.text()
        }).then(function(text) {
            console.log(text)
        })
    })
</script>

