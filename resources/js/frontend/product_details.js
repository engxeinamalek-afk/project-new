window.addToCart = function(event, form) {
    event.preventDefault();
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: new FormData(form)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); 
    })
    .catch(error => console.error('Error:', error));
}
