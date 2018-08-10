<?php

function signup_list(){
    ?>
    <table border="1" cellpadding="10">
        <tr>
            <td>UId</td>
            <td>User Name</td>
            <td>Country</td>
            <td>State</td>
            <td>Image</td>
            <td>Gender</td>
        </tr>
        <?php
        global $wpdb;
        $table_name=$wpdb->prefix.'signup_list';
        $lists=$wpdb->get_results("select uid,uname,country,state,uimage,gender from $table_name");
        foreach($lists as $list){
            ?>
            <tr>
                <td><?= $list->uid; ?></td>
                <td><?= $list->uname; ?></td>
                <td><?= $list->country; ?></td>
                <td><?= $list->state; ?></td>
                <td><img src="<?= $list->uimage; ?>" width="100" height="100"></td>
                <td><?= $list->gender; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php
}