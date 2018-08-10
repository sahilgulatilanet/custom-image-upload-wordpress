<?php

function signup(){
    ?>
    <table>
        <form action="" method="post" enctype="multipart/form-data">
        <tr>
            <td>User Name</td>
            <td><input type="text" name="unm"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><select name="country">
                    <option>India</option>
                </select></td>
        </tr>
        <tr>
            <td>State</td>
            <td><select name=state>
                    <option>Gujarat</option>
                    <option>MP</option>
                    <option>UP</option>
                    <option>Punjab</option>
                </select></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="img"></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><input type="radio" name="gen" value="M">Male <input type="radio" name="gen" value="F">FeMale</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="signup_submit" value="Sign Up"></td>
        </tr>
        </form>
    </table>
<?php
    if(isset($_POST['signup_submit'])){
        global $wpdb;
        $unm=$_POST['unm'];
        $c=$_POST['country'];
        $s=$_POST['state'];
        $g=$_POST['gen'];
        $target_dir = wp_upload_dir();
        $target_file = $target_dir['path'] .'/' . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $table_name=$wpdb->prefix.'signup_list';
        $wpdb->insert(
            $table_name,
            array(
                'uid'=> null,
                'uname'=>$unm,
                'country'=>$c,
                'state'=>$s,
                'uimage'=>$target_dir['url'] .'/' .$_FILES["img"]["name"],
                'gender'=>$g
            )
        );
    }
}
add_shortcode('signup_form', 'signup');
