import '../../main.js';

//Updates the link to the next spirit
//arg id: integer id of the current spirit
function getNextSpirit(id) {
   if(id == max) {
       nextID = 1;
   } else {
       nextID = id + 1;
   }
   let url = `../api/spirits/getOne.php?id=${nextID}`;
   let options = {
       method: "GET",
       mode: "cors",
       cache: "no-cache",
       credentials: "same-origin",
       headers: {
           "Content-Type": "application/json"
       },
       redirect: "follow",
       referrer: "no-referrer"
   };
   return fetch(url, options)
       .then(response => response.json())
       .then(jsonresponse => {
           let sid = Number(jsonresponse.records[0].id);
           let name = jsonresponse.records[0].name;
           responsehtml = `
               ${sid} ${name} &rarr;
           `;
           document.getElementById('nextSpirit').innerHTML = responsehtml;
       })
       .catch(error => console.error(error));
}

//Updates the link to the previous spirit
//arg id: integer id of the current spirit
function getPreviousSpirit(id) {
   if(id == 1) {
       nextID = max;
   } else {
       nextID = id - 1;
   }
   let url = `../api/spirits/getOne.php?id=${nextID}`;
   let options = {
       method: "GET",
       mode: "cors",
       cache: "no-cache",
       credentials: "same-origin",
       headers: {
           "Content-Type": "application/json"
       },
       redirect: "follow",
       referrer: "no-referrer"
   };
   return fetch(url, options)
       .then(response => response.json())
       .then(jsonresponse => {
           let sid = Number(jsonresponse.records[0].id);
           let name = jsonresponse.records[0].name;
           responsehtml = `&larr; ${sid} ${name}`;
           document.getElementById('previousSpirit').innerHTML = responsehtml;
       })
       .catch(error => console.error(error));
}

//calls spirit api and updates page with new information
//arg action: a string (either 'next', 'previous', 'random', or 'default')
//arg id: the integer of the current spirit
function getSpirit(action, id) {
   switch(action) {
       case 'next':
           if(id != max) {
               spiritID = id + 1;
           } else {
               spiritID = 1;
           }
           break;
       case 'previous':
           if(id == 1) {
               spiritID = max;
           } else {
               spiritID = id - 1;
           }
           break;
       case 'random':
           spiritID = Math.floor(Math.random() * max);
           break;
       default:
           spiritID = id;
           break;
   }
   let url = `../api/spirits/getOne.php?id=${spiritID}`;
   let options = {
       method: "GET",
       mode: "cors",
       cache: "no-cache",
       credentials: "same-origin",
       headers: {
           "Content-Type": "application/json"
       },
       redirect: "follow",
       referrer: "no-referrer",
   };
   return fetch(url, options)
       .then(response => response.json())
       .then(jsonresponse => {

           let id = Number(jsonresponse.records[0].id);
           let name = jsonresponse.records[0].name;
           let game = jsonresponse.records[0].game;
           let series = jsonresponse.records[0].series;
           let description = jsonresponse.records[0].description;
           htmlresponsecode = `
           <div class="descSection">
               <div class="descImgContainer">
                   <img src="../img/spiritImages/${id}.png" alt="${name}" />
               </div>
           </div>
           <div class="descSection">
               <h2>${id} ${name}</h2>
               <div class="descBox primary">
                   <p class="descText">${description}</p>
               </div>
               <div class="descBox secondary">
                   <img src="../img/seriesIcons/${series}.png" alt="${series}" />
                   <p class="descGameText">${game}</p>
               </div>
           </div>
           `;
           document.getElementById('descBody').innerHTML = htmlresponsecode;
           document.title = `${name} | Details`;
           document.getElementById('indexLink').setAttribute('href', `index.php?place=${id}`);
           currentID = id;
           getNextSpirit(spiritID);
           getPreviousSpirit(spiritID);
           getSidebarSpirits("id", spiritID - 1, "all", [1979, 2019]);
           history.pushState({}, null, `.php?id=${spiritID}`)
       })
       .catch(error=> console.error(error));
}
