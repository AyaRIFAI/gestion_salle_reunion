require('./bootstrap');
import { offset } from '@popperjs/core';
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import { divide } from 'lodash';
let main=document.querySelector('.adminHome');
let mainProf=document.querySelector('.profHome');
let form=document.querySelector('.form');
let login=document.querySelector('.loginPage');
let table0=document.querySelector('.table2');
if(main != null || mainProf != null){
    class pageHome{
        constructor(backGroundImg, linksObject){
            this.backGroundImg=backGroundImg,
            this.linksObject=linksObject;
        }
    }
    let page1, page2, page3, page4, preced=0, next=0, timeA,timeB, timeC, timeD;
    
    function buildHome(page, preced2, next2){
        main.innerHTML="";
        document.body.style.cssText="";
            document.body.style.cssText="background-image: url('"+page.backGroundImg+"');background-size:cover;transition-duration:0.6s; transition-property:background-image";
            let princDev=document.createElement('div');
            princDev.className="princDev d-flex flex-column justify-content-around align-items-center";
            for(let linkTitle in page.linksObject){
                let minDev=document.createElement('div');
                minDev.className="minDev p-4";
                let a=document.createElement('a');
                a.className="text-decoration-none fs-5 fw-bold";
                a.href=page.linksObject[linkTitle]; 
                let text=document.createTextNode(linkTitle);
                a.appendChild(text);
                minDev.appendChild(a);
                princDev.appendChild(minDev);
            }
            main.appendChild(princDev);
            preced=preced2;
            next=next2
           
        }
        
        if(mainProf == null){
            console.log('ancien');
            page1=new pageHome('http://gestion_salles_project/storage/imgs/salle1.jpg', {'Ajouter une réservation':'http://gestion_salles_project/reservations/add', 'Liste des réservations actuels':'http://gestion_salles_project/reservations/actuals'});
            page2=new pageHome('http://gestion_salles_project/storage/imgs/salle2.jpg', {'Liste des demandes de réservation':'http://gestion_salles_project/reservations/demands', 'Demandes de réservation en attente':'http://gestion_salles_project/reservations/waiting','Demandes de modification de réservation':'http://gestion_salles_project/reservations/update', 'Demandes de modification de réservation en attente':'http://gestion_salles_project/reservations/update/waiting'});
            page3=new pageHome('http://gestion_salles_project/storage/imgs/salle3.jpg', {'Historique des réservations':'http://gestion_salles_project/reservations/historic','Liste des réservations refusées' :'http://gestion_salles_project/reservations/refused'});
            page4=new pageHome('http://gestion_salles_project/storage/imgs/salle4.jpg', {'Liste des salles':'http://gestion_salles_project/salles', 'Liste des professeurs':'http://gestion_salles_project/profs', 'Liste des départements':'http://gestion_salles_project/departements'});        
        }else {
            let id=document.getElementById('nonImportant').innerText;
            console.log(id);
            console.log('new');
            main=mainProf;
            page1=new pageHome('http://gestion_salles_project/storage/imgs/salle1.jpg', {'Demander une réservation':'http://gestion_salles_project/reservations/add', 'Liste des salles':'http://gestion_salles_project/salles','Vos demandes de réservation envoyées':'http://gestion_salles_project/reservations/prof/send/'+id});
            page2=new pageHome('http://gestion_salles_project/storage/imgs/salle2.jpg', {'Vos demandes de réservation acceptés':'http://gestion_salles_project/reservations/prof/accepted/'+id,'Vos demandes de réservation refusés':'http://gestion_salles_project/reservations/refused/'+id,'Vos demandes de réservation mises en attente':'http://gestion_salles_project/reservations/waiting'});
            page3=new pageHome('http://gestion_salles_project/storage/imgs/salle3.jpg', {'Vos demandes de modification de résevation envoyées' :'http://gestion_salles_project/reservations/update', 'Vos demandes de modification de résevation mises en attente':'http://gestion_salles_project/reservations/update/waiting'});
            page4=new pageHome('http://gestion_salles_project/storage/imgs/salle4.jpg', {'Liste des réservations actuels':'http://gestion_salles_project/reservations/actuals', 'Historique des réservations':'http://gestion_salles_project/reservations/historic'});        
        }
    
    let delay=5000;
    function successionPages(number=1){
        let delay1, delay2, delay3, delay4;
        switch(number){
            case 1:
                delay1=0;
                delay2=delay1+delay;
                delay3=delay2+delay;
                delay4=delay3+delay
                break;
            case 2:
                delay2=0;
                delay3=delay2+delay;
                delay4=delay3+delay
                delay1=delay4+delay;
                break;
            case 3:
                delay3=0;
                delay4=delay3+delay
                delay1=delay4+delay;
                delay2=delay1+delay;
                break;
            case 4:
                delay4=0;
                delay1=delay4+delay;
                delay2=delay1+delay;
                delay3=delay2+delay
                break;
            }
        timeA=setTimeout(buildHome, delay1, page1, 4, 2);
        timeB=setTimeout(buildHome, delay2, page2, 1, 3);
        timeC=setTimeout(buildHome, delay3, page3, 2, 4);
        timeD=setTimeout(buildHome, delay4, page4, 3, 1);
    }
    successionPages();
    
    let interval1=setInterval(successionPages, 20000);
    let interval2, interval3;
    let rightBtn=document.querySelector('.right');
    let leftBtn=document.querySelector('.left');
    
    rightBtn.addEventListener('click', function() {
        clearInterval(interval1);
        clearInterval(interval2);
        clearInterval(interval3);
        clearTimeout(timeA);
        clearTimeout(timeB);
        clearTimeout(timeC);
        clearTimeout(timeD);
        successionPages(next);
        interval2=setInterval(successionPages, 20000, next);
    });
    leftBtn.addEventListener('click',function() {
        clearInterval(interval1);
        clearInterval(interval2);
        clearInterval(interval3);
        clearTimeout(timeA);
        clearTimeout(timeB);
        clearTimeout(timeC);
        clearTimeout(timeD);
        successionPages(preced);
        interval3=setInterval(successionPages, 20000, preced);
    });
}else if(form != null || login !=null){
    document.body.style.cssText="background-image: url('http://gestion_salles_project/storage/imgs/login3.jpg');background-size: cover; background-position-y: -50px; -webkit-backdrop-filter: blur(15px); -moz-backdrop-filter: blur(15px); backdrop-filter: blur(15px) grayscale(0.5) opacity(0.8);background-color: rgba(182, 182, 182, 0.2);";
}else if(table0 != null){
    document.body.style.cssText="background-image: url('http://gestion_salles_project/storage/imgs/login3.jpg');background-size: cover; background-position-y: -50px; -webkit-backdrop-filter: blur(15px); -moz-backdrop-filter: blur(15px); backdrop-filter: blur(15px) grayscale(0.5) opacity(0.8);background-color: rgba(182, 182, 182, 0.2);";
    let btn1=document.getElementById('one');
    let btn2=document.getElementById('two');
    // let departements0=document.querySelector('.departements');
    // console.log(departements0);
    let departements0=null;
    let departements=null;
    let i=1;
    if(document.querySelector('.departements')){
    departements0=document.querySelector('.departements').innerText;
    departements=JSON.parse(departements0);
    i=0;
    }
    console.log(departements);
    console.log('hi', btn1, btn2);
    // console.log(typeof(table0));
    let table=JSON.parse(table0.innerHTML);
    console.log(table);

    function avanceTable(){
        let dernier=table.pop();
        table.unshift(dernier);
        console.log(table);
    }
    function reculeTable(){
        let premier=table.shift();
        table.push(premier);
        console.log(table);
        
    }
   
function createCard(element){
    let divBig= document.createElement('div');
    divBig.className="card";
    divBig.style.cssText="width: 10rem; height:calc(100% / 3) overflow:hidden;";
    let img=document.createElement('img');
    img.className="card-img-top img-fluid";
    img.alt="Card image cap";
    img.src="http://gestion_salles_project/storage/"+element.path_image;
    divBig.appendChild(img);
    // let divSmall=document.createElement('div');
    // divSmall.className="card-body";
    // let h5=document.createElement('h5');
    // h5.className="card-body";
    // h5.style.cssText="font-size:1rem;"
    // let titleInside=document.createTextNode(title+" "+element.lastName + " " + element.firstName);
    // h5.appendChild(titleInside);
    // divSmall.appendChild(h5);
    // divBig.appendChild(divSmall);
    return divBig;
}
let listePart=document.querySelector(".liste");
        function firstTime(){
        let card1=createCard(table[0]);
        let card2=createCard(table[1]);
        let card3=createCard(table[2]);
        listePart.appendChild(card1);
        listePart.appendChild(card2);
        listePart.appendChild(card3);
            return [card1, card2, card3];
    }
    let table2=firstTime();
    table2[0].classList.add('here');
    fillDetails();
    btn1.addEventListener('click', function (){
        avanceTable();
        listePart.removeChild(table2[2]);
        let newCard=createCard(table[0], "Pr");
        listePart.prepend(newCard);
        table2[0].classList.remove('here');
        table2=[newCard, table2[0], table2[1]];
        table2[0].classList.add('here');
        fillDetails();
    });
    btn2.addEventListener('click', function(){
        reculeTable();
        listePart.removeChild(table2[0]);
        let newCard=createCard(table[2], "Pr");
        listePart.appendChild(newCard);
        table2[0].classList.remove('here');
        table2=[table2[1], table2[2], newCard];
        table2[0].classList.add('here');

        fillDetails();
    });
    function fillDetails(){
        let placeOfImg=document.querySelector(".placeOfImg");
        placeOfImg.innerHTML="";
        let img=document.createElement('img');
        img.className="img-fluid";
        img.src="http://gestion_salles_project/storage/"+ table[0].path_image;
        placeOfImg.appendChild(img);
        if(!i){
            img.alt="Photo de profil du professeur";
            document.querySelector("input[name='lastName']").value=table[0].lastName;
            document.querySelector("input[name='firstName']").value=table[0].firstName;
            document.querySelector("input[name='Tel']").value=table[0].Tel;
            document.querySelector("input[name='email']").value=table[0].email;
            let departement=departements[(table[0].departement_id) - 1];
            console.log(departement);
            document.querySelector("input[name='departement']").value=departement.sigle;
            document.querySelector('.modifier').setAttribute('href', "http://gestion_salles_project/profs/update/"+table[0].id);

    }else {
        img.alt="Photo de la salle";
        document.querySelector("input[name='name']").value=table[0].name;
        document.querySelector("input[name='surface']").value="Surface de la salle: "+table[0].surface+" m²";
        document.querySelector("textarea[name='description']").value="Description de la salle:\n"+table[0].description;
        if(document.querySelector('.modifier')){
            document.querySelector('.modifier').setAttribute('href', "http://gestion_salles_project/salles/update/"+table[0].id);

        }
    }
        }
        
    }else if(document.querySelector('.listeDepartements')){
        document.body.style.cssText="background-image: url('http://gestion_salles_project/storage/imgs/login3.jpg');background-size: cover; background-position-y: -50px; -webkit-backdrop-filter: blur(15px); -moz-backdrop-filter: blur(15px); backdrop-filter: blur(15px) grayscale(0.5) opacity(0.8);background-color: rgba(182, 182, 182, 0.2);";
        let btn1=document.getElementById('one');
        let btn2=document.getElementById('two');
        let table0=document.querySelector('.listeDepartements').innerText;
        let table=JSON.parse(table0);
        let resultat0=document.querySelector('.resultatsDepartements').innerText;
        let resultats=JSON.parse(resultat0);
        console.log(table);
        console.log(resultats);
        function avanceTable(){
            let dernier=table.pop();
            table.unshift(dernier);
        }
        function reculeTable(){
            let premier=table.shift();
            table.push(premier);

        }
        function createCard(element){
            let divBig= document.createElement('div');
            divBig.className="card h-lg-20 h-md-60 h-sm-60";
            divBig.style.cssText="width: 10rem; margin-bottom:20px; overflow:hidden; transition-duration:0.3s;";
            let divSmall=document.createElement('div');
            divSmall.className="card-body";
            let h5=document.createElement('h5');
            h5.className="card-body font-weight-bold fs-3 text-center" ;
            h5.style.cssText="font-size:1rem;"
            let titleInside=document.createTextNode(element.sigle);
            h5.appendChild(titleInside);
            divSmall.appendChild(h5);
            divBig.appendChild(divSmall);
            return divBig;
        }
        let listePart=document.querySelector(".liste");
        function firstTime(){
        let card1=createCard(table[0]);
        let card2=createCard(table[1]);
        let card3=createCard(table[2]);
        listePart.appendChild(card1);
        listePart.appendChild(card2);
        listePart.appendChild(card3);
            return [card1, card2, card3];
    }
    let table2=firstTime();
    table2[0].classList.add('here');
    fillDetails();
    btn1.addEventListener('click', function (){
        avanceTable();
        listePart.removeChild(table2[2]);
        let newCard=createCard(table[0]);
        listePart.prepend(newCard);
        table2[0].classList.remove('here');
        table2=[newCard, table2[0], table2[1]];
        table2[0].classList.add('here');
        fillDetails();
    });
    btn2.addEventListener('click', function(){
        reculeTable();
        listePart.removeChild(table2[0]);
        let newCard=createCard(table[2]);
        listePart.appendChild(newCard);
        table2[0].classList.remove('here');
        table2=[table2[1], table2[2], newCard];
        table2[0].classList.add('here');

        fillDetails();
    });
    function createLign(ele){
        let tr=document.createElement('tr');
        tr.className="align-middle";
        let td1=document.createElement('td');
        td1.className="namePr";
        console.log(ele.lastName);
        let name=document.createTextNode(ele.lastName + ele.firstName);
        td1.appendChild(name);
        let td2=document.createElement('td');
        td2.className="emailPr";
        let text2=document.createTextNode(ele.email);
        td2.appendChild(text2);
        tr.appendChild(td1);
        tr.appendChild(td2);
        document.querySelector('tbody').appendChild(tr);
    }
    function fillDetails(){
        document.querySelector('tbody').innerHTML="";
        let h3=document.querySelector('.titreH3');
        h3.innerHTML=table[0].sigle +':  '+table[0].name;
        h3.style.cssText="min-width:360px";
        document.querySelector('.modifier').setAttribute('href', "http://gestion_salles_project/departements/update/"+table[0].id);
        for(let ele of resultats){
            if(ele.sigle === table[0].sigle ){
                createLign(ele);
            }
        }
    }

    }else if (document.querySelector('.noOne')){
        document.body.style.cssText="background-image: url('http://gestion_salles_project/storage/imgs/login3.jpg');background-size: cover; background-position-y: -50px; -webkit-backdrop-filter: blur(15px); -moz-backdrop-filter: blur(15px); backdrop-filter: blur(15px) grayscale(0.5) opacity(0.8);background-color: rgba(182, 182, 182, 0.2);";
       
    }

