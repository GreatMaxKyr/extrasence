<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=yes , initial-scale=1.0 , minimum-scalable=1.0 , maximum-scale=2.0">
    <title>Битва екстрасенсів</title>
</head>

<body>
    <div class='main'>
        <?php
            echo "<form action='index.php' method='POST'>";
            if (isset($_POST['number'])) {
                $number = $_POST['number'];
            }else {
                $number = 0;
            }
            if ($number != 0){
                if (isset($_POST['dis1'])){
                    $dis1 = $_POST['dis1'];
                    $dis2 = $_POST['dis2'];
                }else {
                    $dis1 = $dis2 = 'dis';
                }
            }
            if ($number != 0) {
                if($dis1 == $dis2){
                    $dis1 = $number;
                }elseif ($dis1 != $dis2) {
                    $dis2 = $number;
                    $dis1 = $_POST['dis1'];
                }  
            }elseif ($number == 0) {
                $dis1 = $dis2 = 'dis';
            }
            if (isset($_POST['try'])) {
                $try = $_POST['try'];
                $riddle = $_POST['riddle'];
                
                if ($number != 0) {
                    $try++;
                }
                echo "
                    <input type='hidden' name='number' value='$number'>
                    <input type='hidden' name='riddle' value='$riddle'> 
                    <input type='hidden' name='try' value='$try'>
                ";
                if ($try == 0) {
                    continues($dis1,$dis2);
                }
            } else {
                newgame();//початок гри бо нічого не передалось
                $try = 0;
                $riddle = rand(1,10);
            }
            
                               
            if ($try == 3) {
                echo "<p class='no'>Тотальна поразка</p>";
                newgame();
            } elseif ($riddle == $number) {
                echo "<p>Ви вгадали число і виграли </p>";
                newgame();
            } elseif ($riddle != $number && $number != 0) {
                echo "<p class='no'>Ви не вгадали</p>";
                continues($dis1,$dis2);
            }
            echo "
                <img src='img/ball.png' alt='magic_ball'>               
            ";
            /**
             * для того щоб записувати вибранні числа потрібно створити масив і добавляти в нього числа як учнів
             */

            function continues ($dis1,$dis2) {
                echo "
                    <div>               
                        <label class='cool-select'>                   
                            <select class='select' name='number'>                
                ";
                for ($i = 1; $i <= 10; $i++) {
                    echo ("<option "); 
                    if ($dis1 == $i || $dis2 == $i) {
                        echo ("disabled");                                               
                    }
                    echo (" value='".$i."'>$i</option>");
                }
                echo "
                                            
                            </select>
                        </label>
                        <label>
                            <input type='hidden' name='dis1' value='$dis1'>
                            <input type='hidden' name='dis2' value='$dis2'>
                            <input class='submit' type='submit' value='Вибрати число'>
                        </label>
                    </div>
                ";

            }
            function newgame () { // try=0(відправити) riddlе-нове число(відправити)
                $riddle = rand(1,10);
                echo "
                    <div>
                        <input type='hidden' name='dis1' value='dis'>
                        <input type='hidden' name='dis2' value='dis'>
                        <input type='hidden' name='number' value='0'>
                        <input type='hidden' name='try' value='0'>
                        <input type='hidden' name='riddle' value='$riddle'>
                        <input type='submit' value='Почати нову гру' class='again'>
                    </div>
                ";
            }                       
            echo "</form>";
        ?>
        
    </div>
</body>

</html>