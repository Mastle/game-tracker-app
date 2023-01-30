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
            .then((response) => {
            let newPara = document.createElement('p')
            newPara.className='game-list-notification position-sticky top-0 text-center w-25 text-white rounded pt-3 fs-5';
            newPara.setAttribute('x-data','{show: true}')
            newPara.setAttribute('x-init','setTimeout(() => show = false, 3000)')
            newPara.setAttribute('x-show','show')
            let newParaText = document.createTextNode(response.message)
            newPara.appendChild(newParaText)
            let section = document.querySelector('.game-details')
            let container = document.querySelector('.container')
            section.insertBefore(newPara, container)
          })
         

        
          
   }

   }
  
  
  