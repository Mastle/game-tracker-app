function addGameToList(){
    const  selectGameID = document.querySelector('#game-id-holder')
    const  selectUserID = document.querySelector('#user-id-holder')
    const guID = { gameid: selectGameID.value, userid: selectUserID.value}
    const userID = selectUserID.value;
    
    
    async function addGameToList(url = '', data = {}) {
        const response = await fetch(url, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data) 
        });
        return response.json(); 
      }


    if(userID == 0){
        window.location.href ='./game-list-message.php'

    } else {
            
              addGameToList('http://localhost/game-tracker/api/game-list/update.php', guID)
            .then((response) => console.log(response.message))
          
          
   }

   }
  
  
  
  
  
  