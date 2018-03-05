<?php
    include 'api/pixabayAPI.php';
    
    if(isset($_GET['layout']))
    {
        
        if($_GET['layout'] == "vertical"){
            $_GET['layout'] = 'vertical';
        }
        else{
            $_GET['layout'] = 'horizontal';
        }
        
        //     <style>
        //         .carousel{
        //             height:1000px;
        //         }
        //         .carousel-inner img{
        //             height:1000px !important;
                    
        //         }
        //     </style>
 
            
        // }
        // echo $_GET['layout'];
    }
    else
    {
        $_GET['layout'] = 'horizontal';
    }
    
    if(isset($_GET['keyword']) && $_GET['keyword'] != ""){
        // echo "you searched for: " . $_GET['keyword'] . "</br>";
        $imageURLs = getImageURLs($_GET['keyword'],$_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];

    }
    elseif(isset($_GET['category']) && $_GET['category'] != ""){
        // echo "you searched for: " . $_GET['category'] . "</br>";
        $imageURLs = getImageURLs($_GET['category']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];

    }
    else{
    $backgroundImage = "./img/sea.jpg";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel = "stylesheet">
        <style>
            @import url("./css/styles.css");
            body{
                background-image: url('<?=$backgroundImage?>');
            }
        </style>
    </head>
    
    <body>
        </br>
        </br>
                        
            <form>
                <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
               <div id = "vOrh">
                <input type = "radio" id = "lhorizontal" name = "layout" value = "horizontal">
                <label for = "Horizontal"></label><label for="lhorizontal">Horizontal </label>
                <input type = "radio" id = "lvertical" name = "layout" value = "vertical">
                <label for = "Vertical"></label><label for="lvertical"> Vertical </label>
               </div>
                </br>
                <select name = "category">
                    <option value ="">Select One</option>
                    <option value="sea">Sea</option>
                    <option value="forest">Forest</option>
                    <option value="mountain">Mountain</option>
                    <option value"snow">Snow</option>
                </select>
                </br>
                <input type="submit" value="Search"/>
            </form>
        
        <?php
        
            if(!isset($imageURLs)){
                echo "<h2> Type a keyword to display a slideshow </br> </h2>";
            }
            else {
               
        ?>
    
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!--indicators here-->
            <div id="ver">
            <ol class = "carousel-indicators">
            <?php
                for($i = 0; $i < 7; $i++)
                {
                    echo "<li data-target='#carousel-example-generic' data-slide-to = '$i'";
                    echo ($i == 0)? "class='active'" : "";
                    echo "></li>";
                }
            ?>
            </ol>
            <!--wrapper for images-->
              <div class="carousel-inner" role = "listbox">
                  <?php
                        for($i = 0; $i < 7; $i++)
                        {
                            do{
                                $randomIndex = rand(0,count($imageURLs));
                            }while(!isset($imageURLs[$randomIndex]));
                            
                            echo '<div class="item ';
                            echo ($i == 0)? "active" : "";
                            echo '">';
                            echo '<img src="' . $imageURLs[$randomIndex] . '">';
                            echo "</div>";
                            // echo "<img src ='" . $imageURLs[$randomIndex] ."' width = '200' >";
                            unset($imageURLs[$randomIndex]);
                        }
                  
                  ?>
                </div>      
             <!--controls-->
              <a class = "left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class = "glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
              </a>
              </div>
              </div>
        <?php
           } //this ends the else statement
        ?>
                
        <!--<form>-->
        <!--    <input type="text" name="keyword" placeholder = "keyword" value="<?=$_GET['keyword']?>"/>-->
        <!--    <input type="submit" name="submit"/>-->
        <!--</form>-->
        
        
        </br>
        </br>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
    
</html>