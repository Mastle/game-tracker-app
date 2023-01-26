function addGameToList(){
    const  selectGameID = document.querySelector('#game-id-holder')
    const  selectUserID = document.querySelector('#user-id-holder')
    const gameID = selectGameID.value
    const userID = selectUserID.value


    if(userID == 0){
        window.location.href ='./game-list-message.php'

    }else {
  
    console.log(gameID)
    console.log(userID)
   }

   //Create the fetch that'll make the API call to add game to the user's gamelist




   }
  
  
  
  
  
  