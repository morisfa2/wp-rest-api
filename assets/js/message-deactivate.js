window.onload = function(){
    document.querySelector('#deactivate-wp-rest-api').addEventListener('click', function(event){
        event.preventDefault()
        var urlRedirect = document.querySelector('#deactivate-wp-rest-api').getAttribute('href');
        if (confirm('Are you sure you want to save this thing into the database?')) {
            window.location.href = urlRedirect;
        } else {
            console.log('Ohhh, you are so sweet!')
        }
    })
}