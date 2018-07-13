<div class="container">
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
                    echo "<td><img src=/loftSchool/project-2/public/img/users-images/{$user['photo']} width='30' height='30'></td>";
                    echo "<td>{$user['username']}</td>";
                    echo "<td>{$user['email']}</td>";
                    echo "<td>{$user['age']}</td>";
                    echo "<td>{$user['created_at']}</td>";
                    echo "<td>".mb_strimwidth($user['about'], 0, 35, '...')."</td>";
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php
        else: echo 'Ничего не найдено';
        endif
    ?>
</div>

