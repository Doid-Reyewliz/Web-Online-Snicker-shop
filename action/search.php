<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "";

//Admin
if($_SESSION['role'] == 2){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category = '$search'");
    }
    else{
        $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");
    }
    
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class='size'>
                                    <h3>Size: </h3>
                                    <span>40</span>
                                    <span>41</span>
                                    <span>42</span>
                                    <span>43</span>
                                </div>
                                <div class='color'>
                                    <h3>Color: </h3>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <button class='rem' data-id='{$row['Code']}' type='submit'>Remove</button>
                            </div>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h1 style='color:#fff;'>No values</h1>";
    }
}

//Moderator
if($_SESSION['role'] == 3){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category = '$search'");
    }
    else{
        $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");
    }
    
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class='size'>
                                    <h3>Size: </h3>
                                    <span>40</span>
                                    <span>41</span>
                                    <span>42</span>
                                    <span>43</span>
                                </div>
                                <div class='color'>
                                    <h3>Color: </h3>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <button class='edit' data-id='{$row['Code']}' type='submit'>Edit</button>
                            </div>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h1 style='color:#fff;'>No values</h1>";
    }
}

//User
else{
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category LIKE '$search'");
    }
    else{
        $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");
    }

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class='size'>
                                    <h3>Size: </h3>
                                    <span>40</span>
                                    <span>41</span>
                                    <span>42</span>
                                    <span>43</span>
                                </div>
                                <div class='color'>
                                    <h3>Color: </h3>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <form action='' method='post'>
                                    <input type='hidden' name='code' type='text' value='{$row['Code']}'>
                                    <button id='btn' type='submit' onclick='snack();'>Add To Cart</button>
                                </form>
                            </div>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h1 style='color:#fff;'>No values</h1>";
    }
}
?>
<script>
//For Admin
$(document).ready(function(){
    $('.rem').click(function(){
        var el = this;
        var deleteprod = $(this).data('id');
        var confirmalert = confirm("Delete this product?");

        if (confirmalert == true) {
            $.ajax({
                url: 'action/del.php',
                type: 'POST',
                data: { code:deleteprod },
                success: function(response){
                    $(el).closest('.card').fadeOut(800,function(){
                    $(this).remove();
                    });
                }
            });
        }
    });
});

//For Moderator
$(document).ready(function(){
    $('.edit').click(function(){
        var name=$('#name').val();
        var comp=$('#comp').val();
        var dif=$('#price').val();
        var code=$('#code').val();
        var id=$('#id').val();

        $.ajax({
            url:'c_edit.php',
            method:'POST',
            data:{
                id:id,
                name:name,
                comp:comp,
                dif:dif,
                code:code
            },
            success:function(response){
                alert("Successfully Edited");
            }
        });
    });
});
</script>