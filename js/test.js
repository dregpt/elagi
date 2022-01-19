

/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@ Start:A function to scroll automatically to the last recorded session:   @@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/
function scrollToLastRecordedSession(){
    let sesAnch= document.querySelectorAll(".sesanch");

    let rctmarray=[];
    let rectms=[];
    for(let i = 0; i<sesAnch.length; i++){
        let rctm = sesAnch[i].getAttribute("data-rctm");
        let sesId= sesAnch[i].getAttribute("data-sesid");
        rctmarray.push(rctm);
        rctmarray.forEach(function(element,index){
            if(element!==""){
                rectms.push(parseInt(element));
            }
        })

        let lastRcTime=Math.max(...rectms)
        let targetSes=document.querySelector("#ses"+sesId)
        if(rctm==lastRcTime){
            console.log(targetSes);
             targetSes.scrollIntoView({behavior:"smooth", block:"center"});
             //break;
        }
    }
}

scrollToLastRecordedSession();
/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@ End    @@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/



"how version control id "



