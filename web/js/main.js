// avoid showing the screen asking if the form
// should be submitted again. 
// the post are also erased in order to 
// no sent anything
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

// when the document is loaded, execute initialize
window.onload = initialize;

function initialize(){

  let buttonShowAllRecords = document.getElementById("btnViewAllRecords");
  buttonShowAllRecords.addEventListener("click",toggleRecordsContainerDisplay);

  let buttonClearSessionSubmissions = document.getElementById("btnClearSessionSubmissions");
  buttonClearSessionSubmissions.addEventListener("click", clearSessionSubmissions);

} // end of window.onload

function toggleRecordsContainerDisplay(event){

  let button = event.target;
  let recordsContainer = document.getElementById("records-container");

  if(recordsContainer.style.display == "block"){
    
    recordsContainer.style.display = "none";
    button.innerHTML = "Show All Records";
    button.classList.remove("btn-danger");
    button.classList.add("btn-primary");

  } else {

    recordsContainer.style.display = "block";
    button.innerHTML = "Hide All Records";
    button.classList.remove("btn-primary");
    button.classList.add("btn-danger");

  }

}//function toggleRecordsContainerDisplay(event)
