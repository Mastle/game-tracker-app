<?php

 session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
        $log_in_status = "log out" ;
        $login_directory = "./logout.php";

        
    } else {
        $log_in_status = "log in";
        $login_directory = "./login.php";
        $toggle_comments = 0;

    }

    include_once "./config/Database.php";
    $pdo_obj = new Database();
    $pdo_connection = $pdo_obj->connect();
     

    function return_random_game(){
    
    global  $pdo_connection, $game_id;
  
    $game_id = rand(1,4);
    $sql_query_by_id = "SELECT * FROM games WHERE id = :id";
    $stmt = $pdo_connection->prepare($sql_query_by_id);
    $stmt->execute(['id' => $game_id]);


        global $game_item;
    

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $game_item = array(
        'id' => $id,
        'title' => $name,
        'release_date' => $release_date,
        'metascore' => $metascore,
        'director' => $director,
        'designer' => $designer,
        'publisher' => $publisher,
         'writer' => $writer,
        'developer' => $developer,
        'picture_path' => $picture_path,
      );

        
    }



    }


    //Get game  
    $game_query = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_query'])) {
       $game_query = $_POST['search_query'];
       $sql_query_by_name = "SELECT * FROM games WHERE name = :name";
       $stmt = $pdo_connection->prepare($sql_query_by_name);
       $stmt->execute(['name' => $game_query]);
       if($stmt->rowcount() > 0){
        
              
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           extract($row);
  
           $game_item = array(
             'id' => $id,
             'title' => $name,
             'release_date' => $release_date,
             'metascore' => $metascore,
              'designer' => $designer,
              'director' => $director,
             'publisher' => $publisher,
              'writer' => $writer,
             'developer' => $developer,
             'picture_path' => $picture_path,
           );
  
          
            }

            global $game_id;
            $game_id = $game_item['id'];



          } else {

                echo "<script>" . "alert('Game not found');" . "</script>";

                return_random_game();
           }
     
      }  else {
  
          return_random_game();
  
      }

      setcookie('gameid',$game_id);
      
    include './inc/header.php'
  ?>
<section class="game-details pb-3">
    <div class="container d-flex justify-content-center">
        <form class="search-input-wrapper ms-5 pt-5" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <input class="search-input form-control" type="text" name="search_query" placeholder="Look up a game..." value="" />
            <input class="btn btn-primary" type="submit" value="Search"/>
        </form>
    </div>
    <div class="container d-flex justify-content-center mt-5 pt-5">
      <img class="framed" src=<?= $game_item['picture_path']?> alt="random image">
    </div>
    <div class="text-center pt-5 fs-1 mt-5 fw-semibold"><p><?= $game_item['title'] ?></p></div>
    <div class="container mt-5 pt-5">
        <ul class="pe-3 pt-2 text-center">  
            <li>
                <span class="title">Director</span>
                <span class="name"><?= $game_item['director']?></span>
            </li>
            <li>
                <span class="title">Designer</span>
                <span class="name"><?= $game_item['designer']?></span>
            </li>
            <li>
                <span class="title">Writer</span>
                <span class="name"><?= $game_item['writer']?></span>
            </li>
            <li>
                <span class="title">Publisher</span>
                <span class="name"><?= $game_item['publisher']?></span>
            </li>
            <li>
                <span class="title">Developer</span>
                <span class="name"><?= $game_item['developer']?></span>
            </li>
        </ul>
    </div>
    <div class="btn-wrapper container d-flex justify-content-center my-5">
      <input type="hidden" id="game-id-holder" value="<?= (isset($game_id)) ? $game_id : $game_item['id'] ?>" />
      <input type="hidden" id="user-id-holder" value="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : 0 ?>" />
      <input class="btn btn-primary" type="submit" value='Add game to your list' onclick=addGameToList()></input>
    </div>
</section>
<?php 
 $sql_query_by_id = "SELECT * FROM comments WHERE gameid = :id";
 $stmt = $pdo_connection->prepare($sql_query_by_id);
 $stmt->execute(['id' => $game_id]);

 
 $comments_arr = array();
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   extract($row);
   $comment_item = array(
     'id' => $id,
     'gameid' => $gameid,
     'userid' => $userid,
     'commentbody' => $commentbody,
   );

   array_push($comments_arr, $comment_item);

 }
  



 $sql_query_by_id = "SELECT * FROM users WHERE id = :id";
 $stmt = $pdo_connection->prepare($sql_query_by_id);
 $users_arr = array();

  for($i=0;$i < count($comments_arr) ; $i++){


 $stmt->execute(['id' => $comments_arr[$i]['userid']]);
 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
 
    $user_item = array(
      'id' => $id,
      'username' => $username,
    );
    array_push($users_arr, $user_item);
    
}
}

?>



<section class="comments">
    <div class="ms-2 mt-3 " id="first-div">
       <i class="fa-regular fa-comments fa-2xl"></i>
       <h3 class="d-inline">Comments</h2>
       <div class="container">
<form id="comment-textarea" action="./post-comment.php" method="post" novalidate >
<div class="form-floating">
  <textarea name="comment" class="form-comment form-control" placeholder="Leave a comment here"></textarea>
  <label for="floatingTextarea2">Leave a comment</label>
</div>
  <input type="submit" class="btn btn-primary my-3" value="Enter"></input>
</form>
</div>
</div>
</div>
</section>
    
    <script>
        let navSelector = document.querySelector("#nav-item-one")
        navSelector.className = "nav-item active";
        let commentSection = document.querySelector('.comments')


        let usersArr = JSON.parse('<?= json_encode($users_arr) ?>')
        let commentsRawJson = '<?= json_encode($comments_arr) ?>'
        let commentsRawJsonFixed = commentsRawJson.replace(/(?:\r\n|\r|\n)/g, '\\n')
        commentsArr = JSON.parse(commentsRawJsonFixed)
        if( usersArr.length > 0 && commentsArr.length > 0){
                for(i = 0 ; usersArr.length > i && commentsArr.length > i ; i++ ){
               
                 let newDivContainer = document.createElement('div')
               
                     newDivContainer.className = 'container my-3'
                     newDivContainer.style= 'border-bottom: 1px solid var(--han-blue)'

               
                     let newDivComment = document.createElement('div')
                     newDivComment.className = "comment mx-2 py-2"

                
                     let newImg = document.createElement('img')
                     newImg.setAttribute('src','assets/user-profile-pics/stock-user-pic.webp')
        
        
                     let newSpan = document.createElement('span')
                     newSpan.className = "mx-2 fw-bold fs-5"
                     newSpan.innerHTML = usersArr[i].username
        
              
                     let newPara = document.createElement('p')
                     newPara.className = 'fs-5'
                     newPara.innerHTML = commentsArr[i].commentbody
               
                     newDivComment.appendChild(newImg)
                     newDivComment.appendChild(newSpan)
                     newDivComment.appendChild(newPara)
                     newDivContainer.appendChild(newDivComment)
               
                     const div = document.querySelector('#first-div')
               
                     div.insertAdjacentElement('afterend', newDivContainer)
        
                 } 
                } else if('<?= isset($_SESSION["loggedin"]) ?>' != 1){

                    commentSection.style = "display: none"
                }

        let toggleCommentFrom = document.querySelector('#comment-textarea')


          if( '<?= isset($_SESSION["loggedin"]) ?>' == 1){
            
           toggleCommentFrom.style = 'display: block'
         } else{
           toggleCommentFrom.style = 'display: none'

         }
    </script>
    <script src='./scripts/updateGameList.js'></script>
<?php include './inc/footer.php' ?>








<!-- 
    current development process:
      2- Showcase the code and the app for Parviz -> 
      - gotta get rid of the rank column
      - gotta add more games
      - (at the end: originally had bigger plans, such as making the search function super smart, connecting the app to a legitimate DB, figured I should spend that time on JS, REACT and CSS)
      3- Prepare app for deployment
     


     post-production(optional): 
      - Connect the app to a game DB through a legitimate API
      - Make the search function smarter 
      - Prevent user from adding the same game twice
      - Allow users to upload profile pics
      - Restrict api access to your website
      - Use bootstrap tables for the game details section
      - Allow users to rank their games on their game list
      - Recreate the pop ups and notifications with AlpineJS
      - Add approximate string matching to your search function  
      - Use confirmationation(a more sophisticated system) for logging out

    -->