document.addEventListener("DOMContentLoaded", function(){
    fetch('http://localhost:8000/api/prices')
    .then(response => response.json())
    .then(data => {
        console.log(data);

    }).catch(error => console.error('Error', error))
})

function displayPrices(prices){
    
}